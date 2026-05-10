<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;

class TestingController extends Controller
{
    function __construct(

    ){
        $this->token = env('FONNTE_WA_TOKEN');
        $this->url = env('FONnTE_WA_LINK');
    }

    public function testingWA()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => '082233684670|Fonnte|Admin',
                'message' => 'test message to {name} as {var1}',
                'typing' => false,
                'delay' => '5',
                'countryCode' => '62',
                'duration' => 1,
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $this->token" //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function testingTelegram()
    {
        // 'text' => 'Booking Code : '.$datas['transaction']['booking']['booking_code']."\n".
        //                             'Booking Name : '.$datas['transaction']['booking']['booking_name']."\n".
        //                             'Billing Name : '.json_decode($datas['transaction']['payment_billing'])->first_name.' '.json_decode($datas['transaction']['payment_billing'])->last_name."\n".
        //                             'Billing Email : '.json_decode($datas['transaction']['payment_billing'])->email."\n".
        //                             'Billing Phone : '.json_decode($datas['transaction']['payment_billing'])->phone."\n".
        //                             'Total : Rp. '.number_format($datas['transaction']['amount'],2,',','.')."\n".
        //                             'Status : '.$datas['transaction']['status']."\n".
        //                             'Tanggal Pembayaran : '.$datas['transaction']['payment_date']

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => 'Invoice : #'.date('Ymd').rand()."\n".
                        'Booking Name : Rio Anugrah'."\n".
                        'Booking Email : rioanugrah999@gmail.com'."\n".
                        'Booking Phone : 082233684670'."\n".
                        'Total : 150.000'."\n".
                        'Status : PAID'."\n\n".
                        'Notifikasi ini sah dan dibuat oleh sistem.'
        ]);

        // return redirect()->back();
        return 'OK';
    }
}
