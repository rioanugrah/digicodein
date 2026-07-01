<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use App\Models\Slider;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Payments;

use \Carbon\Carbon;
use Validator;
use DB;

class FrontendController extends Controller
{
    function __construct(
        Slider $slider,
        Product $product,
        ProductCategory $productCategory,
        Orders $orders,
        OrderItems $orderItems,
        Payments $payments
    ){
        $this->slider = $slider;
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->orders = $orders;
        $this->orderItems = $orderItems;
        $this->payments = $payments;

        $this->midtrans_client_key = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_CLIENT_KEY_LIVE') : env('MIDTRANS_SERVER_KEY_DEMO');
        $this->midtrans_server_key = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_SERVER_KEY_DEMO') : env('MIDTRANS_CLIENT_KEY_DEMO');
        $this->url_payment = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_LINK_LIVE') : env('MIDTRANS_LINK_DEMO');
    }

    public function index()
    {
        $data['categorys'] = Cache::remember('product_category', 60, function(){
            return $this->productCategory->with('products')->where('status','Active')->orderBy('created_at','desc')->get();
        });

        $data['sliders'] = Cache::remember('slider', 60, function(){
            return $this->slider->where('status','Active')->orderBy('created_at','desc')->get();
        });

        // dd($data);
        return view('frontend.index',$data);
    }

    public function category_product($slug)
    {
        $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

        $data['listProduct'] = $this->productCategory->with('products')->where('slug',$slug)->where('status','Active')->first();

        return view('frontend.categoryProduct.index',$data);
    }

    public function product_detail($slug)
    {
        $data['product'] = $this->product->where('slug',$slug)->first();

        if (empty($data['product'])) {
            return redirect()->back();
        }

        $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

        return view('frontend.products.detail',$data);
    }
    
    public function tentang_kami()
    {
        $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

        return view('frontend.tentangKami.index',$data);
    }
    
    public function syarat_ketentuan()
    {
        $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

        return view('frontend.syaratKetentuan.index',$data);
    }
    
    public function kebijakan_privasi()
    {
        $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

        return view('frontend.kebijakanPrivasi.index',$data);
    }

    public function order($slug)
    {
        $data['product'] = $this->product->where('slug',$slug)->first();

        if (empty($data['product'])) {
            return redirect()->back();
        }

        $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

        return view('frontend.orders.index',$data);
    }

    public function checkout(Request $request, $slug)
    {
        DB::beginTransaction();

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];

        $messages = [
            'first_name.required' => 'Nama Depan Wajib Diisi',
            'last_name.required' => 'Nama Belakang Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'phone.required' => 'No. Telepon Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){
            try {
                $data['product'] = $this->product->where('slug',$slug)->first();

                if (empty($data['product'])) {
                    return redirect()->back();
                }

                if ($data['product']['product_quantity'] > 0) {
                    $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

                    $idPayment = Str::uuid()->toString();
                    $data['references'] = 'TRX-'.Carbon::now()->format('Ymd').'-'.rand(100,999);

                    $payment = $this->payments->create([
                        'id' => $idPayment,
                        'amount' => $data['product']['product_price'],
                        'fee_admin' => 0,
                        'payment_method' => '-',
                        'payment_references' => $data['references'],
                        'payment_billing' => json_encode([
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                        ]),
                        'payment_status' => 'Unpaid'
                    ]);

                    // dd($payment);

                    if ($payment) {
                        $idOrder = Str::uuid()->toString();
                        $order = $this->orders->create([
                            'id' => $idOrder,
                            'user_id' => auth()->user()->id,
                            'payment_id' => $idPayment,
                            'order_code' => 'ORD-'.Carbon::now()->format('Ymd').'-'.rand(),
                            // 'order_item' => $data['product']['product_name'],
                            'total_price' => $data['product']['product_price'],
                            'status' => 'Pending'
                        ]);

                        $this->orderItems->create([
                            'order_id' => $idOrder,
                            'order_item' => $data['product']['product_name'],
                            'price' => $data['product']['product_price'],
                            'quantity' => 1
                        ]);

                        \Midtrans\Config::$serverKey = $this->midtrans_server_key;
                        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
                        \Midtrans\Config::$isSanitized = true;
                        \Midtrans\Config::$is3ds = true;

                        $params = [
                            'transaction_details' => [
                                'order_id' => $data['references'],
                                'gross_amount' => $data['product']['product_price'],
                            ],
                            'customer_details' => array(
                                'first_name' => $request->first_name,
                                'last_name' => $request->last_name,
                                'email' => $request->email,
                                'phone' => $request->phone,
                            ),
                        ];
                        $data['midtrans_client_key'] = $this->midtrans_client_key;
                        $data['link_url_payment'] = $this->url_payment;
                        $data['snapToken'] = \Midtrans\Snap::getSnapToken($params);
                    }

                    DB::commit();

                    return view('frontend.orders.checkout',$data);
                }else{
                    return redirect()->back()->with('error','Produk Ini Sudah Habis');
                }

            } catch (\Exception $th) {
                return $th;
            }
        }

        return redirect()->back()->with('errors',$validator->errors()->all());

    }
}
