<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    function __construct(

    ){
        $this->token = env('FONNTE_WA_TOKEN');
        $this->url = env('FONnTE_WA_LINK');
    }

    public function sendNotification($noWa,$message)
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
                // 'target' => '082233684670|Fonnte|Admin',
                'target' => $noWa,
                'message' => $message,
                'typing' => false,
                'delay' => '5',
                // 'countryCode' => '62',
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
}
