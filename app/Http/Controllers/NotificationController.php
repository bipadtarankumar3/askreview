<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\notification;

use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Str;

use Config;
use Mail;
use App\Mail\adminForgotPassMail;
use App\Mail\OtpVerifyMail;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;



class NotificationController extends Controller
{
    
    public function view_notification($id)
    {

        $notification = notification::where('id',$id)->first();
        $notification_up = notification::where('id',$id)->update([
            'action_taken'=>'Y'
        ]);
        
        return redirect($notification->url);
    }
}
