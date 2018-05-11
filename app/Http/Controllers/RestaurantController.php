<?php
namespace App\Http\Controllers;
use App\Category;
use App\Customer;
use App\Item;
use App\Itemsize;
use App\Order;
use App\Orderitems;
use App\Resturanttime;
use App\Shipaddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Resturant;
use App\Rating;
use Session;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Darryldecode\Cart\Facades\CartFacade as Cart;
class RestaurantController extends Controller
{
    public function Restaurants(Request $r){
        $searchresult = Resturant::where('status','Active')
            ->where(function($q) use ($r){
                $q->orWhere('zip', $r->searchbox)
                    ->orWhere('city', $r->searchbox);
            })
            ->get();

        return view('restaurants.index')

            ->with('resturant',$searchresult);
    }
    public function ViewMenu($resid){
        $restaurant = Resturant::select('*')
            ->where('resturantId',$resid)
            ->get();
        $resttime = Resturanttime::select('*')
            ->where('fkresturantId' , $resid)
            ->where('day' , date('l'))
            ->first();
        $open= date('H.i',strtotime($resttime->opentime));
        $close= date('H.i',strtotime($resttime->closetime));
        $now=date('H.i');
        // 13 <now <23.00
        if($open <$now && $close >$now ){
            $restaurantStatus= "Open";
        }
        else{
            $restaurantStatus= "Close";
        }

        $resRating=Rating::select(DB::raw('COUNT(ratingId) as totalRating'),DB::raw('AVG(rating) as avgRating'))->where('restaurantId',$resid)->groupBy('restaurantId')->get();

        $catagory = Category::select('*')
            ->where('fkresturantId', $resid)
            ->get();
        $itemsize = Itemsize::select('*')
            ->where('status', 'Active')
            ->get();
        $cartCollection = Cart::getContent();


        return view('restaurants.profile')
            ->with('category', $catagory)
            ->with('restaurant', $restaurant)
            ->with('resid', $resid)
            ->with('itemsize', $itemsize)
            ->with('restaurantRating', $resRating)
            ->with('restaurantStatus', $restaurantStatus)

            ->with('cartitem', $cartCollection);
    }
    public function getItem(Request $r){
        $resid = $r->resid;
        $catagory = Category::select('*')
            ->where('fkresturantId', $resid)
            ->get();
        $item = Item::select('item.*' ,'itemsize.*' )
            ->leftJoin('itemsize','itemsize.itemsizeId','=','itemsize.item_itemId')
            ->leftJoin('resturant','item.fkresturantId','=','resturant.resturantId')
            ->where('item.fkresturantId',$resid)
            ->where('item.status','Active')
            ->get();
        $itemsize = Itemsize::select('*')
            ->where('status', 'Active')
            ->get();
        return view('restaurants.showitem')
            ->with('category', $catagory)
            ->with('item' , $item)
            ->with ('itemsize', $itemsize);
    }
    public function getItemByCategory(Request $r){
        $resid = $r->resid;
        $catid = $r->catid;
        $catagory = Category::select('*')
            ->where('fkresturantId', $resid)
            ->where('categoryId', $catid)
            ->get();
        $item = Item::select('item.*' ,'itemsize.*' )
            ->leftJoin('itemsize','itemsize.itemsizeId','=','itemsize.item_itemId')
            ->leftJoin('resturant','item.fkresturantId','=','resturant.resturantId')
            ->where('item.fkresturantId',$resid)
            ->where('item.fkcategoryId',$catid)
            ->where('item.status','Active')
            ->get();
        $itemsize = Itemsize::select('*')
            ->where('status', 'Active')
            ->get();
        return view('restaurants.showitem')
            ->with('category', $catagory)
            ->with('item' , $item)
            ->with ('itemsize', $itemsize);
    }
    public function addCart(Request $r){

        $itemSizeId =Itemsize::findOrFail($r->itemid);

        $item =  Item::select('itemId','itemName','itemsizeName', 'price','itemsizeId', 'delfee', 'resturantId')
            ->leftJoin('itemsize','item.itemid','=','itemsize.item_itemId')
            ->leftJoin('resturant','resturant.resturantId','=','item.fkresturantId')
            ->where('itemsize.itemsizeId', $itemSizeId->itemsizeId)
            ->where('item.itemid', $itemSizeId->item_itemId)
            ->limit(1)
            ->get();

        $cartCollection = Cart::getContent();



        foreach ($item as $it){

            //Check Order From Same Restaurant
            if(!$cartCollection->isEmpty()){
                foreach ($cartCollection as $c)
                {
                    $resid =   $c->attributes->resid;
                    if($resid!=$it->resturantId){
                        return 'mismatch';
                    }

                }

            }

            Cart::add(array(
                'id' => $it->itemsizeId,
                'name' => $it->itemName,
                'price' => $it->price,
                'quantity' => 1,
                'attributes' => array(
                    'size' =>  $it->itemsizeId,
                    'sizeName' =>  $it->itemsizeName,
                    'delfee' => $it->delfee,
                    'resid' => $it->resturantId
                )
            ));
        }
    }
    //cartid and itemid is same
    public function updateItemSize(Request $r){
        $itemsize = $r->itemsize;
        $cartid = $r->cartid;
        $itemsize = Itemsize::select('*')
            ->where('item_itemId',$cartid)
            ->where('itemsizeId',$itemsize)
            ->first();

        foreach (Cart::getContent($cartid) as $cr){
            $delfeeC = $cr->attributes->delfee;
            $residC = $cr->attributes->resid;
        }
        Cart::update($cartid, array(
            'price' => $itemsize->price, // new item name
            'attributes' => array(
                'size' =>  $itemsize->itemsizeId,
                'delfee' => $delfeeC,
                'resid' => $residC
            ) // new item price, price can also be a string format like so: '98.67'
        ));
    }
    public function updateItemQty(Request $r){
        $qty = $r->qty;
        $cartid = $r->cartid;
        Cart::update($cartid, array(
            'quantity' => array(
                'relative' => false,
                'value' => $qty
            ),
        ));
    }
    public function removeCart(Request $r){
        Cart::remove($r->itemid);
    }
    public function checkout(){

        $cartitem = Cart::getContent();
        if($cartitem->isEmpty()){
            Session::flash('message','Cart Is Empty');
            return back();
        }



        foreach ($cartitem as $c)
        {
            $resid =   $c->attributes->resid;
            break;
        }

        $restaurantInfo=Resturant::findOrFail($resid);



        return view('checkout')
            ->with('cartitem', $cartitem)
            ->with('minOrder',$restaurantInfo->minOrder);
    }


    public function SubmitOrder(Request $r){


        $cartCollection = Cart::getContent();
        foreach ($cartCollection as $c)
        {
            $resid =   $c->attributes->resid;
            if (Session::get('ordertype') == "Delivery") {
                $delfee = $c->attributes->delfee;
            }else{
                $delfee = 0;
            }
            break;
        }


//        $restaurantInfo=Resturant::findOrFail($resid);
        $restaurantInfo=Resturant::where('resturantId',$resid)->get(array('minOrder'));
        $totalPrice=Cart::getTotal();

        foreach ($restaurantInfo as $resInfoo){
            $resMinOrder=$resInfoo->minOrder;
        }

        if($totalPrice >= $resMinOrder){
            $totalPrice=$totalPrice;
            $delfee=0;
        }
        else{
            $totalPrice+=$delfee;
        }


        if($r->stripeToken){

            try {
                    \Stripe\Stripe::setApiKey("sk_test_J8Qu60frbczlbH9VqxWtmgad");
                // Token is created using Checkout or Elements!
                // Get the payment token ID submitted by the form:
                $token = $r->stripeToken;
                $charge = \Stripe\Charge::create([
                    'amount'=>$totalPrice*100,
                    'currency' => 'EUR',
                    'description' => 'New Order Payment',
                    'source' => $token,
                ]);
//                dd('Success Payment');
            } catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];

                $code= $err['code'];
                $msg=$err['message'];
                $data=array('cardError'=>'2','code'=>$code,'message'=>$msg);
                // $msg ='Status is:' . $e->getHttpStatus() . "\n";
                //  $msg.='Type is:' . $err['type'] . "\n";
                // $msg.='Code is:' . $err['code'] . "\n";
                // param is '' in this case
                // $msg.='Param is:' . $err['param'] . "\n";
                // $msg.='Message is:' . $err['message'] . "\n";
                // Session::flash('message',$err);
                return $data;

            } catch (\Stripe\Error\RateLimit $e) {
                // Too many requests made to the API too quickly
                // Session::flash('message','Too many requests made to the API too quickly');
                $code= 'RateLimit';
                $msg='Too many requests made to the API too quickly';
                $data=array('cardError'=>'2','code'=>$code,'message'=>$msg);
                return $data;

            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
                // Session::flash('message','Invalid parameters were supplied to Stripes API');
                // return '2';
                $code= 'InvalidRequest';
                $msg='Invalid parameters were supplied to Stripes API';
                $data=array('cardError'=>'2','code'=>$code,'message'=>$msg);
                return $data;

            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // Session::flash('message','Authentication with Stripe\'s API failed');
                // return '2';
                $code= 'Authentication';
                $msg='Authentication with Stripe\'s API failed';
                $data=array('cardError'=>'2','code'=>$code,'message'=>$msg);
                return $data;

                // (maybe you changed API keys recently)
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
                // Session::flash('message','Network communication with Stripe failed');
                //  return '2';
                $code= 'ApiConnection';
                $msg='Network communication with Stripe failed';
                $data=array('cardError'=>'2','code'=>$code,'message'=>$msg);
                return $data;
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                // Session::flash('message','Display a very generic error to the user, and maybe send');
                //  return '2';

                $code= 'Stripe Error';
                $msg='Error In Payment with Stripe , Please Try after Sometime';
                $data=array('cardError'=>'2','code'=>$code,'message'=>$msg);
                return $data;

            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                //  Session::flash('message','Something else happened, completely unrelated to Stripe');
                // return '2';

                $code= 'Payment Error';
                $msg='Something else happened, completely unrelated to Stripe';
                $data=array('cardError'=>'2','code'=>$code,'message'=>$msg);
                return $data;

            }

        }
        $customer = new Customer();
        $customer->firstName = $r->firstname;
        $customer->lastName = $r->lastname;
        $customer->email = $r->email;
        $customer->phone = $r->phone;
        $customer->address = $r->address;
        $customer->city = $r->city;
        $customer->zip = $r->zip;
        $customer->status = $r->status;
        $customer->save();
        $order = new Order();
        $order->fkresturantId = $resid;
        $order->fkcustomerId = $customer->customerId;
        $order->delfee = $delfee;
        $order->orderTime = date("Y-m-d H:m:s");
        $order->orderStatus = "Pending";
        $order->orderType = Session::get('ordertype');
        $order->paymentType = Session::get('paymentType');
        $order->save();
        $shipaddress = new Shipaddress();
        $shipaddress->addressDetails = $r->address;
        $shipaddress->city = $r->city;
        $shipaddress->zip = $r->zip;
        $shipaddress->fkcustomerId = $customer->customerId;
        $shipaddress->fkorderId = $order->orderId;
        $shipaddress->save();
        foreach ($cartCollection as $cc){
            $orderitem =  new Orderitems();
            $orderitem->fkorderId = $order->orderId;
            $orderitem->fkitemsizeId = $cc->attributes->size;
            $orderitem->quantity = $cc->quantity;
            $orderitem->price = $cc->price;
            $orderitem->save();
        }

        //For Rating Restaurant
        if($r->rating){
            $rating=new Rating;
            $rating->customerId=$customer->customerId;
            $rating->restaurantId=$resid;
            $rating->rating=$r->rating;
            $rating->save();

        }
        $orderInfo = Order::select('order.delfee','order.orderId','order.orderTime', 'order.paymentType','order.orderType', 'customer.firstName',
            'customer.lastName','customer.phone','customer.email','shipaddress.addressDetails','shipaddress.city','shipaddress.zip','shipaddress.country',
            'resturant.name as resName','resturant.phoneNumber as resPhone','resturant.minOrder as resMinOrder','resturant.delfee as resDelfee','resturant.email as resMail')
            ->where('order.orderId', $order->orderId)
            ->leftJoin('customer','customer.customerId','=','order.fkcustomerId')
            ->leftJoin('shipaddress','shipaddress.fkorderId','=','order.orderId')
            ->leftJoin('resturant','resturant.resturantId','=','order.fkresturantId')
            ->get();

        foreach ($orderInfo as $mailInfo){
            $customerMail=$mailInfo->email;
            $customerFirstName=$mailInfo->firstName;
            $customerLastName=$mailInfo->lastName;
            $restaurantMail=$mailInfo->resMail;
            $restaurantName=$mailInfo->resName;
        }

        $orderItemInfo = Orderitems::select('orderitem.quantity','orderitem.price','itemsize.itemsizeName', 'item.itemName','item.itemDetails')
            ->where('orderitem.fkorderId', $order->orderId)
            ->leftJoin('itemsize','itemsize.itemsizeId','=','orderitem.fkitemsizeId')
            ->leftJoin('item','item.itemId','=','itemsize.item_itemId')
            ->get();


        Cart::clear();
        Session::forget('ordertype');
        Session::forget('paymentType');

        try{

            Mail::send('invoiceMail',['orderInfo' => $orderInfo,'orderItemInfo'=>$orderItemInfo], function($message) use ($customerMail,$customerFirstName, $customerLastName)
            {
                $message->from('support@findhalal.de', 'FindHalal');
                $message->to($customerMail, $customerFirstName.' '.$customerLastName)->subject('New Order From FindHalal');
            });
            Mail::send('invoiceMailForFindhalal',['orderInfo' => $orderInfo,'orderItemInfo'=>$orderItemInfo], function($message)
            {
                $message->from('support@findhalal.de', 'FindHalal');
                $message->to(FindhalalNewOrderMail, 'Findhalal Order')->subject('New Order From FindHalal');
            });
            Mail::send('invoiceMailForRestaurant',['orderInfo' => $orderInfo,'orderItemInfo'=>$orderItemInfo], function($message) use ($restaurantMail,$restaurantName)
            {
                $message->from('support@findhalal.de', 'FindHalal');
                $message->to($restaurantMail, $restaurantName)->subject('New Order From FindHalal');
            });


            return 1;

        }catch (\Exception $ex) {
            return 0;
        }
    }



    public function checkOrderType(){

        $cartitem = Cart::getContent();
        if($cartitem->isEmpty()){
            //Session::flash('message','Cart Is Empty');
            return '2';
        }

        if (Session::get('ordertype')=='Takeout' || Session::get('ordertype')=='Delivery'){

            return '1';
        }else{
            return '0';
        }

    }
    public function takeout(){
        Session::put('ordertype', "Takeout");
    }
    public function delivery(){
        Session::put('ordertype', "Delivery");
    }
    public function Cash(){
        Session::put('paymentType', "Cash");
    }
    public function Card(){
        Session::put('paymentType', "Card");
    }
}