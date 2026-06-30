<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Payment\TripayController;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Payments;

use \Carbon\Carbon;
use DB;

class CartController extends Controller
{
    function __construct(
        TripayController $tripayPayment,
        Cart $cart,
        CartItem $cartItem,
        Product $product,
        ProductCategory $productCategory,
        Orders $orders,
        OrderItems $orderItems,
        Payments $payments
    )
    {
        $this->tripayPayment = $tripayPayment;

        $this->cart = $cart;
        $this->cartItem = $cartItem;
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->orders = $orders;
        $this->orderItems = $orderItems;
        $this->payments = $payments;

        $this->midtrans_client_key = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_CLIENT_KEY_LIVE') : env('MIDTRANS_CLIENT_KEY_DEMO');
        $this->midtrans_server_key = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_SERVER_KEY_LIVE') : env('MIDTRANS_SERVER_KEY_DEMO');
        $this->url_payment = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_LINK_LIVE') : env('MIDTRANS_LINK_DEMO');

        if (env('TRIPAY_IS_PRODUCTION') == false) {
            $this->tripay_api_key = env('TRIPAY_API_KEY_SANDBOX');
            $this->tripay_private_key = env('TRIPAY_PRIVATE_KEY_SANDBOX');
            $this->tripay_merchant = env('TRIPAY_MERCHANT_SANDBOX');
            $this->tripay_url = env('TRIPAY_SANDBOX');
        }else{
            $this->tripay_api_key = env('TRIPAY_API_KEY_PRODUCTION');
            $this->tripay_private_key = env('TRIPAY_PRIVATE_KEY_PRODUCTION');
            $this->tripay_merchant = env('TRIPAY_MERCHANT_PRODUCTION');
            $this->tripay_url = env('TRIPAY_PRODUCTION');
        }
    }

    public function cart()
    {
        $data['categorys'] = $this->productCategory->with('products')->where('status','Active')->orderBy('created_at','desc')->get();

        $data['cart'] = $this->cart->with('cartItems')->where('user_id',auth()->user()->id)
                                    ->where('status','O')
                                    ->first();

        if (empty($data['cart'])) {
            return redirect()->back();
        }

        $data['channels'] = json_decode($this->tripayPayment->getPayment())->data;

        // dd($data);

        return view('frontend.cart.index',$data);
    }

    public function cartAdd(Request $request, $slug)
    {
        $product = $this->product->where('slug',$slug)->first();

        if (empty($product)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Produk Tidak Ditemukan'
            ]);
        }

        $cekCart = $this->cart->where('user_id',auth()->user()->id)
                                ->where('status','O')
                                ->first();

        if (empty($cekCart)) {
            $idCart = $this->cart->create([
                'user_id' => auth()->user()->id,
                'status' => 'O'
            ]);

            $this->cartItem->create([
                'cart_id' => $idCart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);

            $message_title="Berhasil !";
            $message_content= "Produk ".$product->product_name." Berhasil Ditambah";
            $message_type="success";
            $message_succes = true;

            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
            );

            return response()->json($array_message);
        }else{
            $cekCartItem = $this->cartItem->where('cart_id',$cekCart->id)
                                        ->where('product_id',$product->id)
                                        ->first();

                                        // dd($cekCartItem);
            if ($cekCartItem) {
                return response()->json([
                    'success' => false,
                    'message_title' => 'Gagal',
                    'message_content' => 'Produk Ini Sudah Ditambahkan'
                ]);
            }

            $this->cartItem->create([
                'cart_id' => $cekCart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);

            $message_title="Berhasil !";
            $message_content= "Produk ".$product->product_name." Berhasil Ditambah";
            $message_type="success";
            $message_succes = true;

            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
            );

            return response()->json($array_message);
        }
    }

    public function cartDelete(Request $request)
    {
        $cekCart = $this->cart->where('user_id',auth()->user()->id)
                                ->where('status','O')
                                ->first();

        $cartItem = $this->cartItem->where('id',$request->id)
                                ->where('cart_id',$cekCart->id)
                                ->delete();

        $message_title="Berhasil !";
        $message_content= "Item Berhasil Dihapus";
        $message_type="success";
        $message_succes = true;

        $array_message = array(
            'success' => $message_succes,
            'message_title' => $message_title,
            'message_content' => $message_content,
            'message_type' => $message_type,
        );

        return response()->json($array_message);
                                // dd($cartItem);
    }

    public function cartCheckout(Request $request)
    {
        $data['categorys'] = $this->productCategory->with('products')->where('status','Active')->orderBy('created_at','desc')->get();

        DB::beginTransaction();

        $idOrder = Str::uuid()->toString();
        $idPayment = Str::uuid()->toString();

        $noTrx = Carbon::now()->format('Ymd').'-'.rand(100,999);
        $data['references'] = 'TRX-'.$noTrx;

        $totalQty = [];
        $totalPrice = [];
        $items = [];
        $itemTripays = [];

        foreach ($request->item_id as $key => $value) {
            // $this->product
            $explode = explode('|',$value);
            $product = $this->product->find($explode[1]);

            if (empty($product)) {
                return redirect()->back();
            }

            if ($product->product_quantity > 0) {
                array_push($totalPrice,$product->product_price*$request['qty'][$key]);

                $this->orderItems->create([
                    'order_id' => $idOrder,
                    'order_item' => $product['product_name'],
                    'price' => $product['product_price'],
                    'quantity' => $request['qty'][$key]
                ]);

                $items[] = [
                    'id' => rand(),
                    'price' => $product['product_price'],
                    'quantity' => $request['qty'][$key],
                    'name' => $product['product_name']
                ];

                $itemTripays[] = [
                    'name' => $product['product_name'],
                    'price' => $product['product_price'],
                    'quantity' => $request['qty'][$key],
                ];
            }

        }

        // dd(array_sum($totalPrice));
        $order = $this->orders->create([
            'id' => $idOrder,
            'user_id' => auth()->user()->id,
            'payment_id' => $idPayment,
            'order_code' => 'ORD-'.$noTrx,
            // 'order_item' => $data['product']['product_name'],
            'total_price' => array_sum($totalPrice),
            'status' => 'Pending'
        ]);

        if ($order) {
            switch (env('IS_PAYMENT')) {
                case 'TRIPAY':
                    // dd($itemTripays,
                    //     $request->paymentMethod,
                    //     array_sum($totalPrice),
                    //     auth()->user()->profile->first_name,
                    //     auth()->user()->profile->last_name,
                    //     auth()->user()->email,
                    //     auth()->user()->profile->phone_number,
                    //     $data['references'],
                    //     route('user.home'));

                    $paymentTripay = $this->tripayPayment->requestTransaction(
                        $itemTripays,
                        explode('|',$request->paymentMethod)[1],
                        array_sum($totalPrice),
                        auth()->user()->profile->first_name,
                        auth()->user()->profile->last_name,
                        auth()->user()->email,
                        auth()->user()->profile->phone_number,
                        $data['references'],
                        route('user.home')
                    );

                    $payment = $this->payments->create([
                        'id' => $idPayment,
                        'amount' => array_sum($totalPrice),
                        'fee_admin' => json_decode($paymentTripay)->data->total_fee,
                        'payment_method' => explode('|',$request->paymentMethod)[1],
                        'payment_references' => $data['references'],
                        'payment_token' => '-',
                        'payment_billing' => json_encode([
                            'first_name' => auth()->user()->profile->first_name,
                            'last_name' => auth()->user()->profile->last_name,
                            'email' => auth()->user()->email,
                            'phone' => auth()->user()->profile->phone_number,
                        ]),
                        'payment_status' => 'Unpaid'
                    ]);

                    $this->cart->where('user_id',auth()->user()->id)
                                        ->where('status','O')
                                        ->update([
                                            'status' => 'C'
                                        ]);
                                        
                    // dd(json_decode($paymentTripay)->data->checkout_url);
                    DB::commit();
                    return redirect(json_decode($paymentTripay)->data->checkout_url);
                    break;
                case 'MIDTRANS':
                    \Midtrans\Config::$serverKey = $this->midtrans_server_key;
                    \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
                    \Midtrans\Config::$isSanitized = true;
                    \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

                    $params = [
                        'transaction_details' => [
                            'order_id' => $data['references'],
                            'gross_amount' => array_sum($totalPrice),
                        ],
                        "item_details" => $items,
                        'customer_details' => array(
                            'first_name' => auth()->user()->profile->first_name,
                            'last_name' => auth()->user()->profile->last_name,
                            'email' => auth()->user()->email,
                            'phone' => auth()->user()->profile->phone_number,
                        ),
                    ];
                    $data['midtrans_client_key'] = $this->midtrans_client_key;
                    $data['link_url_payment'] = $this->url_payment;
                    $data['snapToken'] = \Midtrans\Snap::getSnapToken($params);

                    $payment = $this->payments->create([
                        'id' => $idPayment,
                        'amount' => array_sum($totalPrice),
                        'fee_admin' => 0,
                        'payment_method' => '-',
                        'payment_references' => $data['references'],
                        'payment_token' => $data['snapToken'],
                        'payment_billing' => json_encode([
                            'first_name' => auth()->user()->profile->first_name,
                            'last_name' => auth()->user()->profile->last_name,
                            'email' => auth()->user()->email,
                            'phone' => auth()->user()->profile->phone_number,
                        ]),
                        'payment_status' => 'Unpaid'
                    ]);

                    $this->cart->with('cartItems')->where('user_id',auth()->user()->id)
                                        ->where('status','O')
                                        ->update([
                                            'status' => 'C'
                                        ]);

                    $data['total'] = array_sum($totalPrice);
                    DB::commit();

                    return view('frontend.orders.checkout',$data);
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        // DB::commit();
        // dd($request->all());
    }
}
