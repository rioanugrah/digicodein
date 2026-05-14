<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

use \Carbon\Carbon;

use DataTables;
use Validator;
use Pdf;

class OrdersController extends Controller
{
    function __construct(
        Orders $order
    ){
        $this->order = $order;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->order->get();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('tgl_order', function($row){
                                return $row->created_at->format('Y-m-d H:i:s');
                            })
                            ->addColumn('billings', function($row){
                                return json_decode($row->payments->payment_billing)->first_name.' '.json_decode($row->payments->payment_billing)->last_name;
                            })
                            ->addColumn('total_price', function($row){
                                return 'Rp. '.number_format($row->total_price,0,',','.');
                            })
                            ->addColumn('status', function($row){
                                switch ($row->status) {
                                    case 'Pending':
                                        return '<span class="badge badge-yellow">'.$row->status.'</span>';
                                        break;
                                    case 'Success':
                                        return '<span class="badge badge-green">'.$row->status.'</span>';
                                        break;
                                    case 'Cancelled':
                                        return '<span class="badge badge-red">'.$row->status.'</span>';
                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                            })
                            ->addColumn('action', function($row){
                                $btn = '<div class="d-flex flex-wrap gap-2">';
                                $btn .=     '<button type="button" class="btn btn-green btn-sm" onclick="orderDetail(`'.$row->id.'`)">';
                                $btn .=         '<i class="ri-eye-line me-1"></i> Detail';
                                $btn .=     '</button>';
                                if ($row->status == 'Success') {
                                    $btn .=     '<button type="button" class="btn btn-blue btn-sm" onclick="detailLisensi(`'.$row->id.'`)">';
                                    $btn .=         '<i class="ri-key-2-line me-1"></i> Lisensi';
                                    $btn .=     '</button>';
                                    $btn .=     '<a href='.route('admin.orders.invoice',['id' => $row->id]).' class="btn btn-blue btn-sm" target="_blank">';
                                    $btn .=         '<i class="ri-download-2-line me-1"></i> Invoice';
                                    $btn .=     '</a>';
                                }
                                $btn .= '</div>';

                                return $btn;
                            })
                            ->rawColumns(['action','status'])
                            ->make(true);
        }

        return view('admin.orders.index');

    }

    public function detail($id)
    {
        $order = $this->order->with('orderItems')
                            ->where('id',$id)
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

    public function lisensiSimpan(Request $request)
    {
        $order = $this->order->with('orderItems')
                            ->where('id',$request->lisensi_order_id)
                            ->first();

        if (empty($order)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Lisensi Tidak Ditemukan'
            ]);
        }

        foreach ($order->orderItems as $key => $value) {
            $value->update([
                'lisensi' => $request['lisensi'][$key]
            ]);
        }

        return response()->json([
            'success' => true,
            'message_title' => 'Berhasil',
            'message_content' => 'Lisensi Berhasil Dibuat'
        ]);
    }

    public function invoice($id)
    {
        $data['order'] = $this->order->find($id);

        if (empty($data['order'])) {
            return redirect()->back();
        }

        // $pdf = Pdf::loadView('invoices.invoice',$data);
        // return $pdf->stream('Invoice.pdf');
        return view('invoices.invoice',$data);
    }
}
