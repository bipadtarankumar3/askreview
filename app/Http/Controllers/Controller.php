<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendOtp($otp, $mobile) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://yoursms.in/sms-panel/api/http/index.php?username=ClickipediaAdmin&apikey=191C7-7D3E5&apirequest=Text&sender=Clicki&mobile='.$mobile.'&message=You%20have%20requested%20to%20reset%20your%20admin%20panel%20password.%20Your%20OTP%20is%20'.$otp.'.%20Do%20not%20share%20it%20with%20anyone.%20Clickipedia&route=TRANS&TemplateID=1407173764581495462&format=JSON',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: PHPSESSID=nrtt695jh10g03fk865rjd1tn4'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        return true;

    }

}
