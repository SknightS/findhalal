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
use App\Resturant;
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
            ->get();



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
            ->with('restime', $resttime)
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


        $itemid = $r->itemid;
        $item =  Item::select('itemId','itemName', 'price','itemsizeId', 'delfee', 'resturantId')
            ->leftJoin('itemsize','itemsize.item_itemId','=','item.itemid')
            ->leftJoin('resturant','resturant.resturantId','=','item.fkresturantId')
            ->where('itemid', $itemid)
            ->limit(1)
            ->get();

        foreach ($item as $it){
            Cart::add(array(
                'id' => $it->itemId,
                'name' => $it->itemName,
                'price' => $it->price,
                'quantity' => 1,
                'attributes' => array(
                    'size' =>  $it->itemsizeId,
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
                'size' =>  $itemsize->itemsizeId
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

    public function checkout(){

        $cartitem = Cart::getContent();
        return view('checkout')
            ->with('cartitem', $cartitem);
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

        $shipaddress = new Shipaddress();
        $shipaddress->addressDetails = $r->address;
        $shipaddress->city = $r->city;
        $shipaddress->zip = $r->zip;
        $shipaddress->fkcustomerId = $customer->customerId;
        $shipaddress->save();

        $order = new Order();
        $order->fkresturantId = $resid;
        $order->fkcustomerId = $customer->customerId;
        $order->delfee = $delfee;
        $order->orderTime = date("Y-m-d H:m:s");
        $order->orderStatus = "Pending";
        $order->orderType = Session::get('ordertype');
        $order->paymentType = Session::get('paymentType');
        $order->save();


        foreach ($cartCollection as $cc){
            $orderitem =  new Orderitems();
            $orderitem->fkorderId = $order->orderId;
            $orderitem->fkitemsizeId = $cc->attributes->size;
            $orderitem->quantity = $cc->quantity;
            $orderitem->price = $cc->price;
            $orderitem->save();
        }

        Cart::clear();
        alert()->success('Congrats', 'your order has been placed successfully');
        return redirect("/");
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
