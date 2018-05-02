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

        Cart::update($cartid, array(
            'price' => $itemsize->price, // new item name
            'attributes' => array(
                'size' =>  $itemsize->itemsizeId,
                'delfee' => Cart::getContent($cartid)->attributes->delfee,
                'resid' => Cart::getContent($cartid)->attributes->resid
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


        $restaurantInfo=Resturant::findOrFail($resid);
        $totalPrice=Cart::getTotal();

        if($totalPrice>$restaurantInfo->minOrder){
            $totalPrice=$totalPrice;
            $delfee=0;
        }
        else{
            $totalPrice+=$delfee;
        }
//        return $totalPrice;

        if($r->stripeToken){
//            return $r->stripeToken;
            try {
                \Stripe\Stripe::setApiKey("sk_live_VhQBr29tOJwtEimukjSn2NEe");
                // Token is created using Checkout or Elements!
                // Get the payment token ID submitted by the form:
                $token = $r->stripeToken;
                $charge = \Stripe\Charge::create([
                    'amount'=>$totalPrice*100,
                    'currency' => 'EUR',
                    'description' => 'Example charge',
                    'source' => $token,
                ]);
//                dd('Success Payment');
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
                Session::flash('message','Too many requests made to the API too quickly');
                return 'error';

            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
                Session::flash('message','Invalid parameters were supplied to Stripes API');
                return 'error';
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                Session::flash('message','Authentication with Stripe\'s API failed');
                return 'error';
                // (maybe you changed API keys recently)
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
                Session::flash('message','Network communication with Stripe failed');
                return 'error';
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                Session::flash('message','Display a very generic error to the user, and maybe send');
                return 'error';

            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                Session::flash('message','Something else happened, completely unrelated to Stripe');
                return 'error';
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
            'customer.lastName','customer.phone','customer.email','shipaddress.addressDetails','shipaddress.city','shipaddress.zip','shipaddress.country')
            ->where('order.orderId', $order->orderId)
            ->leftJoin('customer','customer.customerId','=','order.fkcustomerId')
            ->leftJoin('shipaddress','shipaddress.fkorderId','=','order.orderId')
            ->get();
        foreach ($orderInfo as $mailInfo){
            $customerMail=$mailInfo->email;
            $customerFirstName=$mailInfo->firstName;
            $customerLastName=$mailInfo->lastName;
        }

        $orderItemInfo = Orderitems::select('orderitem.quantity','orderitem.price','itemsize.itemsizeName', 'item.itemName','item.itemDetails')
            ->where('orderitem.fkorderId', $order->orderId)
            ->leftJoin('itemsize','itemsize.itemsizeId','=','orderitem.fkitemsizeId')
            ->leftJoin('item','item.itemId','=','itemsize.item_itemId')
            ->get();


        $t=Mail::send('invoiceMail',['orderInfo' => $orderInfo,'orderItemInfo'=>$orderItemInfo], function($message) use ($customerMail,$customerFirstName, $customerLastName)
        {
            $message->from('2f3192259a-02c01b@inbox.mailtrap.io', 'FindHalal');
            $message->to('mujtaba.rumi1@gmail.com', 'rumi')->subject('New Order');
        });
        if ($t){

//            alert()->success('Congrats', 'your order has been placed successfully');
//            return redirect("/");
            return 1;

        }else {
            return 0;
        }

      //  Cart::clear();

//        alert()->success('Congrats', 'your order has been placed successfully');
//        return redirect("/");

        // return back();
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
        Session::put('ordertype', "Card");
    }
}