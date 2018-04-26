<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
   public function index(){
       return view('test');
   }

   public function payment(Request $r){

//       return $r;

       \Stripe\Stripe::setApiKey("sk_test_J8Qu60frbczlbH9VqxWtmgad");


// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
       $token = $_POST['stripeToken'];
       $charge = \Stripe\Charge::create([
           'amount'=>50,
           'currency' => 'EUR',
           'description' => 'Example charge',
           'source' => $token,
           "metadata" => array("order_id" => "6735")
       ]);
       dd('Success Payment');
   }
}
