<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
   public function index(){
       return view('test');
   }


   public function paymentField(Request $r){

       return view('payment');
   }

   public function payment(Request $r){

       try {
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
       } catch(\Stripe\Error\Card $e) {
           // Since it's a decline, \Stripe\Error\Card will be caught
           $body = $e->getJsonBody();
           $err  = $body['error'];

           print('Status is:' . $e->getHttpStatus() . "\n");
           print('Type is:' . $err['type'] . "\n");
           print('Code is:' . $err['code'] . "\n");
           // param is '' in this case
           print('Param is:' . $err['param'] . "\n");
           print('Message is:' . $err['message'] . "\n");
       } catch (\Stripe\Error\RateLimit $e) {
           // Too many requests made to the API too quickly
       } catch (\Stripe\Error\InvalidRequest $e) {
           // Invalid parameters were supplied to Stripe's API
       } catch (\Stripe\Error\Authentication $e) {
           // Authentication with Stripe's API failed
           // (maybe you changed API keys recently)
       } catch (\Stripe\Error\ApiConnection $e) {
           // Network communication with Stripe failed
       } catch (\Stripe\Error\Base $e) {
           // Display a very generic error to the user, and maybe send
           // yourself an email
       } catch (Exception $e) {
           // Something else happened, completely unrelated to Stripe
       }


   }
}
