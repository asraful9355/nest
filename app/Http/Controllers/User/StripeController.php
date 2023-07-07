<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){

        \Stripe\Stripe::setApiKey('sk_test_51NQoGRI4vGyHGoAyP1XkCcesrIpIR6UgBt8eHMyhrgiUAXX1iBJAVn42zMA4xQUTRDwbev2NcQbgJTMJ8kYbtCvL00RuzMVAJS');


        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
          'amount' => 999*100,
          'currency' => 'usd',
          'description' => 'Easy Mulit Vendor Shop',
          'source' => $token,
          'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);


    }// End Method 


}