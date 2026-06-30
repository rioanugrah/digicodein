<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateways\WhatsappController;
use Illuminate\Http\Request;

use Telegram\Bot\Laravel\Facades\Telegram;

use \Carbon\Carbon;

class MidtransController extends Controller
{
    function __construct()
    {
        $this->midtrans_client_key = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_CLIENT_KEY_LIVE') : env('MIDTRANS_CLIENT_KEY_DEMO');
        $this->midtrans_server_key = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_SERVER_KEY_LIVE') : env('MIDTRANS_SERVER_KEY_DEMO');
        $this->url_payment = env('MIDTRANS_IS_PRODUCTION') == true ? env('MIDTRANS_LINK_LIVE') : env('MIDTRANS_LINK_DEMO');
    }

    public function test_payment()
    {
        \Midtrans\Config::$serverKey = $this->midtrans_server_key;
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-'.rand(),
                'gross_amount' => "10000",
            ],
            'customer_details' => array(
                'first_name' => 'Rio',
                'last_name' => 'Anugrah',
                'email' => 'rioanugrah999@gmail.com',
                'phone' => '082233684670',
            ),
        ];
        $data['midtrans_client_key'] = $this->midtrans_client_key;
        $data['link_url_payment'] = $this->url_payment;
        $data['snapToken'] = \Midtrans\Snap::getSnapToken($params);

        return $data['snapToken'];
    }

    public function callback(Request $request)
     {
        $serverKey = $this->midtrans_server_key;
        $hashedKey = hash('sha512',$request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if ($hashedKey == $request->signature_key) {
            $payment = \App\Models\Payments::where('payment_references',$request->order_id)->first();

            if (!$payment) {
                return response()->json(['message' => 'Pembayaran Tidak Ditemukan'], 404);
            }

            $transactionStatus = $request->transaction_status;

            switch ($transactionStatus) {
                case 'capture' :
                    if($request->payment_type == 'credit_card') {
                        if($request->fraud_status == 'challenge') {
                            $payment->update([
                                'payment_method' => $request->payment_type,
                                'payment_status' => 'Unpaid'
                            ]);
                        } else {
                            $payment->update([
                                'payment_method' => $request->payment_type,
                                'payment_status' => 'Paid'
                            ]);
                            $payment->orders->update([
                                'status' => 'Success'
                            ]);

                            Telegram::sendMessage([
                                'chat_id' => env('TELEGRAM_CHAT_ID'),
                                'text' => 'Invoice : '.$request->order_id."\n".
                                            'Tanggal Pembayaran : '.date('Y-m-d H:i:s')."\n".
                                            'Booking Name : '.$request['customer_details']['full_name']."\n".
                                            'Booking Email : '.$request['customer_details']['email']."\n".
                                            'Booking Phone : '.$request['customer_details']['phone']."\n".
                                            'Total : Rp. '.number_format($request->gross_amount,0,',','.')."\n".
                                            'Status : '.$request->transaction_status."\n\n".
                                            '* Notifikasi ini sah dan dibuat oleh sistem.'
                            ]);

                            $message = 'Terima kasih *'.$request['customer_details']['full_name'].'* telah belanja di DigiCodein. berikut melampirkan bukti pembayaran : '."\n\n".
                                'Invoice : '.$request->order_id."\n".
                                'Tanggal Pembayaran : '.date('Y-m-d H:i:s')."\n".
                                'Total : Rp. '.number_format($request->gross_amount,0,',','.')."\n".
                                'Status : PAID'."\n\n".
                                '*Notifikasi ini sah dan dibuat oleh sistem.*';

                            (new WhatsappController)->sendNotification($request['customer_details']['phone'],$message);
                        }
                    }
                    break;
                case 'settlement' :
                    $payment->update ([
                        'payment_method' => $request->payment_type,
                        'payment_status' => 'Paid',
                        'payment_date' => Carbon::now()
                    ]);

                    $payment->orders->update([
                        'status' => 'Success'
                    ]);

                    foreach ($payment->orders->orderItems as $key => $value) {
                        $value->product->update([
                            'product_quantity' => $value->product->product_quantity - $value->quantity
                        ]);
                    }

                    // $payment->orders->product->update([
                    //     'product_quantity' => $payment->orders->product->product_quantity - 1
                    // ]);

                    Telegram::sendMessage([
                        'chat_id' => env('TELEGRAM_CHAT_ID'),
                        'text' => 'Invoice : '.$request->order_id."\n".
                                    'Tanggal Pembayaran : '.date('Y-m-d H:i:s')."\n".
                                    'Booking Name : '.$request['customer_details']['full_name']."\n".
                                    'Booking Email : '.$request['customer_details']['email']."\n".
                                    'Booking Phone : '.$request['customer_details']['phone']."\n".
                                    'Total : Rp. '.number_format($request->gross_amount,0,',','.')."\n".
                                    'Status : '.$request->transaction_status."\n\n".
                                    '* Notifikasi ini sah dan dibuat oleh sistem.'
                    ]);

                    $message = 'Terima kasih *'.$request['customer_details']['full_name'].'* telah belanja di DigiCodein. berikut melampirkan bukti pembayaran : '."\n\n".
                                'Invoice : '.$request->order_id."\n".
                                'Tanggal Pembayaran : '.date('Y-m-d H:i:s')."\n".
                                'Total : Rp. '.number_format($request->gross_amount,0,',','.')."\n".
                                'Status : PAID'."\n\n".
                                '*Notifikasi ini sah dan dibuat oleh sistem.*';

                    (new WhatsappController)->sendNotification($request['customer_details']['phone'],$message);
                    break ;
                case 'pending' :
                    $payment->update([
                        'payment_method' => $request->payment_type,
                        'payment_status' => 'Unpaid'
                    ]);
                    break ;
                case 'deny' :
                    $payment->update([
                        'payment_method' => $request->payment_type,
                        'payment_status' => 'Failed'
                    ]);
                    break ;
                case 'expire' :
                    $payment->update([
                        'payment_method' => $request->payment_type,
                        'payment_status' => 'Expired'
                    ]);
                    break ;
                case 'cancel' :
                    $payment->update([
                        'payment_method' => $request->payment_type,
                        'payment_status' => 'Canceled'
                    ]);
                    $payment->orders->update([
                        'status' => 'Cancelled'
                    ]);
                    break ;
                default :
                    $payment->update([
                        'payment_method' => $request->payment_type,
                        'payment_status' => 'Unknown'
                    ]);
                    $payment->orders->update([
                        'status' => 'Cancelled'
                    ]);
                    break ;
            }

            return response()->json([ 'message' => 'Callback received successfully' ]);
            // $payment->update([
            //     'status' => 'Paid'
            // ]);
        }
        // if ($hashedKey !== $request->signature_key) {
        //     return response()->json([ 'message' => 'Invalid signature key' ],403);
        // }

        // $transactionStatus = $request->transaction_status;
        // $orderId = $request->order_id;

        // $payment = \App\Models\Payments::where('payment_references',$orderId)->first();

        // if (!$payment) {
        //     return response()->json(['message' => 'Pembayaran Tidak Ditemukan'], 404);
        // }

        // switch ($transactionStatus) {
        //     case 'capture' :
        //         if($request->payment_type == 'credit_card') {
        //             if($request->fraud_status == 'challenge') {
        //                 $order->update([ 'status' => 'pending' ]);
        //             } else {
        //                 $order->update([ 'status' => 'success' ]);
        //             }
        //         }
        //         break;
        //     case 'settlement' :
        //         $payment->update ([
        //             'status' => 'Paid',
        //             'payment_date' => Carbon::now()
        //         ]);
        //         break ;
        //     case 'pending' :
        //         $payment->update(['status' => 'Pending']);
        //         break ;
        //     case 'deny' :
        //         $payment->update(['status' => 'Failed']);
        //         break ;
        //     case 'expire' :
        //         $payment->update(['status' => 'Expired']);
        //         break ;
        //     case 'cancel' :
        //         $payment->update(['status' => 'Canceled']);
        //         break ;
        //     default :
        //         $payment->update(['status' => 'Unknown']);
        //         break ;
        // }

        // return response()->json([ 'message' => 'Callback received successfully' ]);
    }
}
