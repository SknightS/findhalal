<?php

namespace App\Http\Controllers;

use App\Order;
use App\Orderitems;
use Session;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){

        return view('order.show');
    }
    public function get(Request $r){

        $orders=Order::select('orderId','orderTime','orderStatus','paymentType')
//            ->where('orderStatus',oderStatus[0])
            ->orderBy('orderId','DESC')->get();
        $datatables = DataTables::of($orders);

        return $datatables->addColumn('action', function ($order) {

            $orderItems=Orderitems::select('orderitem.orderItemId','orderitem.fkitemsizeId','orderitem.quantity','orderitem.price','itemsize.itemsizeName','item.itemName')
                ->where('orderitem.fkorderId',$order->orderId)
                ->leftJoin('itemsize', 'itemsize.itemsizeId', '=', 'orderitem.fkitemsizeId')
                ->leftJoin('item', 'item.itemId', '=', 'itemsize.item_itemId')
                ->get();

            $test='<div class="table table-responsive">';
            $test.='<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle orderexmple">';
            foreach ($orderItems as $orderItem){
                $test.='<tr>';
                $test.='<td class="center">'.$orderItem->itemName.'</td>';
                $test.='<td class="center">'.$orderItem->itemsizeName.'</td>';
                $test.='<td class="center">'.$orderItem->quantity.'</td>';
                $test.='<td class="center">'.$orderItem->price.'</td>';
                $test.='</tr>';
            }
            $test.='</table>';
            $test.='</div>';
            return $test;

        })->make(true);
    }

    public function cancelledOrder(Request $r){

        $orderId=$r->orderId;
        $orders=Order::findOrFail($orderId);
        $orders->orderStatus=oderStatus[2];
        $orders->save();

        Session::flash('message', 'Order Status Updated Successfully');

    }
    public function deliveredOrder(Request $r){

        $orderId=$r->orderId;
        $orders=Order::findOrFail($orderId);
        $orders->orderStatus=oderStatus[3];
        $orders->save();

        Session::flash('message', 'Order Status Updated Successfully');

    }
    public function acceptedOrder(Request $r){

        $orderId=$r->orderId;
        $orders=Order::findOrFail($orderId);
        $orders->orderStatus=oderStatus[1];
        $orders->save();

        Session::flash('message', 'Order Status Updated Successfully');

    }

    public function orderInfo(Request $r){

        $orderId=$r->orderId;
        $orders=Order::Select('order.orderId','resturant.name as resName','resturant.minOrder','resturant.image as resImage','resturant.delfee','resturant.address as resAddress',
            'resturant.city as resCity','resturant.zip as resZip','resturant.country as resCountry','customer.firstName','customer.lastName','customer.email','customer.phone',
            'shipaddress.addressDetails','shipaddress.city as addressCity','shipaddress.zip as addressZip','shipaddress.country as addressCountry')
            ->leftJoin('resturant', 'resturant.resturantId', '=', 'order.fkresturantId')
            ->leftJoin('customer', 'customer.customerId', '=', 'order.fkcustomerId')
            ->leftJoin('shipaddress', 'shipaddress.fkcustomerId', '=', 'order.fkcustomerId')
            ->where('order.orderId',$orderId)->get();

        return view('order.orderInfo')->with('orderinfo',$orders);

    }
}
