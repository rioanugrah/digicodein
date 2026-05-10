<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Payments;
use App\Models\ProductCategory;
use App\Models\Orders;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Slider $slider,
        ProductCategory $productCategory,
        Orders $order,
        Payments $payment
    )
    {
        $this->middleware('auth');

        $this->slider = $slider;
        $this->productCategory = $productCategory;
        $this->payment = $payment;
        $this->order = $order;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasRole('Administrator') == true) {
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('frontend.index');
        }
        // if (auth()->user()->hasRole('Administrator') == true) {
        //     $data['total_transaksi'] = $this->payment->sum('amount');
        //     $data['total_transaksi_berhasil'] = $this->payment->where('payment_status','Paid')->sum('amount');
        //     $data['total_transaksi_menunggu'] = $this->payment->where('payment_status','Unpaid')->sum('amount');
        //     $data['total_transaksi_gagal'] = $this->payment->whereIn('payment_status',['Expired','Failed','Canceled','Unknown'])->sum('amount');
        // }else{
        //     $data['total_transaksi'] = $this->payment->whereHas('orders', function($query){
        //                                                 $query->where('user_id',auth()->user()->id);
        //                                             })->sum('amount');
        //     $data['total_transaksi_berhasil'] = $this->payment->whereHas('orders', function($query){
        //                                                         $query->where('user_id',auth()->user()->id);
        //                                                     })
        //                                                     ->where('payment_status','Paid')
        //                                                     ->sum('amount');
        //     $data['total_transaksi_menunggu'] = $this->payment->whereHas('orders', function($query){
        //                                                         $query->where('user_id',auth()->user()->id);
        //                                                     })
        //                                                     ->where('payment_status','Unpaid')
        //                                                     ->sum('amount');
        //     $data['total_transaksi_gagal'] = $this->payment->whereHas('orders', function($query){
        //                                                         $query->where('user_id',auth()->user()->id);
        //                                                     })
        //                                                     ->whereIn('payment_status',['Expired','Failed','Canceled','Unknown'])
        //                                                     ->sum('amount');
        // }

        // return view('home',$data);
    }

    public function index_admin()
    {
        $data['total_transaksi'] = $this->payment->sum('amount');
        $data['total_transaksi_berhasil'] = $this->payment->where('payment_status','Paid')->sum('amount');
        $data['total_transaksi_menunggu'] = $this->payment->where('payment_status','Unpaid')->sum('amount');
        $data['total_transaksi_gagal'] = $this->payment->whereIn('payment_status',['Expired','Failed','Canceled','Unknown'])->sum('amount');
        return view('home',$data);
    }

    public function index_user()
    {
        if (empty(auth()->user()->profile)) {
            return redirect()->route('user.account');
        }

        $data['sliders'] = $this->slider->where('status','Active')->orderBy('created_at','desc')->get();

        $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

        $data['total_transaksi'] = $this->payment->whereHas('orders', function($query){
                                                    $query->where('user_id',auth()->user()->id);
                                                })->sum('amount');
        $data['total_transaksi_berhasil'] = $this->payment->whereHas('orders', function($query){
                                                            $query->where('user_id',auth()->user()->id);
                                                        })
                                                        ->where('payment_status','Paid')
                                                        ->sum('amount');
        $data['total_transaksi_menunggu'] = $this->payment->whereHas('orders', function($query){
                                                            $query->where('user_id',auth()->user()->id);
                                                        })
                                                        ->where('payment_status','Unpaid')
                                                        ->sum('amount');
        $data['total_transaksi_gagal'] = $this->payment->whereHas('orders', function($query){
                                                            $query->where('user_id',auth()->user()->id);
                                                        })
                                                        ->whereIn('payment_status',['Expired','Failed','Canceled','Unknown'])
                                                        ->sum('amount');

        $data['orders'] = $this->order->where('user_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(5);

        return view('user.dashboard',$data);
    }

    public function detailOrderUser($id)
    {
        $order = $this->order->with('orderItems')
                            ->where('id',$id)
                            ->where('user_id',auth()->user()->id)
                            ->first();

        if (empty($order)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Order Tidak Ditemukan'
            ]);
        }

        $orderItem = [];

        foreach ($order->orderItems as $key => $value) {
            $orderItem[] = [
                'id' => $value->id,
                'order_item' => $value->order_item,
                'link_download' => $value->order->product_link,
                'link_description' => $value->order->product_link_description,
                'lisensi' => $value->lisensi
            ];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $order->id,
                'order_code' => $order->order_code,
                'order_date' => $order->created_at->format('Y-m-d H:i:s'),
                'total_price' => $order->total_price,
                'status' => $order->status,
                'order_items' => $orderItem
            ]
        ]);
    }
}
