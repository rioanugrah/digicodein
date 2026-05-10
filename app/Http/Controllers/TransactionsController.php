<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\Orders;

use \Carbon\Carbon;

use DataTables;
use Validator;

class TransactionsController extends Controller
{
    function __construct(
        Payments $payment,
        Orders $order
    ){
        $this->payment = $payment;
        $this->order = $order;
    }

    public function payment_index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->payment->get();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('tanggal_pembayaran', function($row){
                                if (empty($row->payment_date)) {
                                    return '-';
                                }else{
                                    return Carbon::create($row->payment_date)->format('d-m-Y H:i:s');
                                }
                            })
                            ->addColumn('references', function($row){
                                return $row->payment_references;
                            })
                            ->addColumn('billings', function($row){
                                return json_decode($row->payment_billing)->first_name.' '.json_decode($row->payment_billing)->last_name;
                            })
                            ->addColumn('fee_admin', function($row){
                                return 'Rp. '.number_format($row->fee_admin,0,',','.');
                            })
                            ->addColumn('total', function($row){
                                return 'Rp. '.number_format($row->amount,0,',','.');
                            })
                            ->addColumn('status', function($row){
                                switch ($row->payment_status) {
                                    case 'Unpaid':
                                        return '<span class="badge badge-yellow">'.$row->payment_status.'</span>';
                                        break;
                                    case 'Paid':
                                        return '<span class="badge badge-green">'.$row->payment_status.'</span>';
                                        break;
                                    case 'Expired':
                                        return '<span class="badge badge-red">'.$row->payment_status.'</span>';
                                        break;
                                    case 'Failed':
                                        return '<span class="badge badge-red">'.$row->payment_status.'</span>';
                                        break;
                                    case 'Canceled':
                                        return '<span class="badge badge-red">'.$row->payment_status.'</span>';
                                        break;
                                    case 'Unknown':
                                        return '<span class="badge badge-red">'.$row->payment_status.'</span>';
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                                // return $row->payment_status;
                            })
                            ->addColumn('action', function($row){
                                $btn = '<div class="d-flex flex-wrap gap-2">';
                                $btn .=     '<button type="button" class="btn btn-green btn-sm" onclick="detail(`'.$row->id.'`)">';
                                $btn .=         '<i class="ri-eye-line me-1"></i> Detail';
                                $btn .=     '</button>';
                                $btn .= '</div>';

                                return $btn;
                            })
                            ->rawColumns(['action','status'])
                            ->make(true);
        }

        return view('admin.payments.index');
    }

    public function payment_detail($id)
    {
        $data = $this->payment->find($id);
        
        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message_title' => 'Gagal',
                'message_content' => 'Transaksi Tidak Ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $data->id,
                'fee_admin' => 'Rp. '.number_format($data->fee_admin,0,',','.'),
                'payment_method' => $data->payment_method,
                'payment_references' => $data->payment_references,
                'payment_billing' => [
                    'name' => json_decode($data->payment_billing)->first_name.' '.json_decode($data->payment_billing)->last_name
                ],
                'payment_order' => $data->payment_order,
                'payment_status' => $data->payment_status,
                'payment_date' => $data->payment_date,
                'total' => 'Rp. '.number_format($data->amount+$data->fee_admin,0,',','.'),
            ]
        ]);
    }
}
