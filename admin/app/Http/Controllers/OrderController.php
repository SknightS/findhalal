<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Itemsize;
use App\Order;
use App\Orderitems;
use App\Purchase;
use App\Resturant;
use Session;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function show(){

        return view('order.show');
    }
    public function get(Request $r){

        $orders=Order::select('orderId','orderTime','orderStatus','delfee','paymentType');

            if($r->dayCount == "full"){
                Session::flash('message', 'Showing Full Order List');

            }
            elseif ($r->dayCount=="day30"){
                Session::flash('message', 'Showing Last 30 Days List');
                $orders->where('orderTime', '>=', Carbon::now()->subDays(30));
            }else{
                $orders->where('orderTime', '>=', Carbon::now()->subDays(30));
            }

        $orders=$orders->orderBy('orderId','DESC')->get();


        $datatables = DataTables::of($orders);


        return $datatables->addColumn('action', function ($order) {

//            foreach ($orders as $orderss){
//                $status=$orderss->orderStatus;
//                $delfee=$orderss->delfee;
//            }

                $status=$order->orderStatus;
                $delfee=$order->delfee;
//            }


            $orderItems=Orderitems::select('orderitem.orderItemId','orderitem.fkitemsizeId','orderitem.quantity','orderitem.price','itemsize.itemsizeName','item.itemName')
                ->where('orderitem.fkorderId',$order->orderId)
                ->leftJoin('itemsize', 'itemsize.itemsizeId', '=', 'orderitem.fkitemsizeId')
                ->leftJoin('item', 'item.itemId', '=', 'itemsize.item_itemId')
                ->get();

            $test='<div class="table table-responsive">';
            $test.='<table class="table table-striped table-bordered table-hover valign-middle">';
            $test.='<thead>';
            $test.='<tr>';
            $test.='<th class="center">Name</th>';
            $test.='<th class="center">Size</th>';
            $test.='<th class="center">Quantity</th>';
            $test.='<th class="center">Price</th>';
            if($status != oderStatus[2] && $status != oderStatus[3]){
                $test.='<th class="center">Action</th>';
            }

            $test.='</tr>';
            $test.='</thead>';
            $test.='<tbody>';

            $total=0;
            $Ftotal=0;
            foreach ($orderItems as $orderItem) {
                $test .= '<tr>';
                $test .= '<td class="center">' . $orderItem->itemName . '</td>';
                $test .= '<td class="center">' . $orderItem->itemsizeName . '</td>';
                $test .= '<td class="center">' . $orderItem->quantity . '</td>';
                $test .= '<td class="center">' . $price=($orderItem->quantity * $orderItem->price) . '</td>';
                $total=((float)$total+(float)$price);
                if ($status != oderStatus[2] && $status != oderStatus[3]) {
                    $test .= '<td class="center">' .
                        '<a  class="btn btn-info btn-xs" href="' . route('orderItem.edit', $orderItem->orderItemId) . '" data-panel-id="' . $orderItem->orderItemId . '">

                     <i class="fa fa-edit"></i>
                     </a>' . '&nbsp <a  class="btn btn-danger btn-xs" href="' . route('orderItem.distroy', $orderItem->orderItemId) . '" data-panel-id="' . $orderItem->orderItemId . '">
                     <i class="fa fa-trash"></i>
                     </a>'.'</td>';
                }

                $test .= '</tr>';

            }
            $test .= '<tr>';
            $delivaryFee=0;
            if (!empty($delfee)){
                $test .='<td style="color: red" colspan="3">'.'Total =( DeliveryFee:'.$delivaryFee=$delfee.')'.'</td>';
            }else{
                $test .='<td style="color: red" colspan="3">'.'Total ='.'</td>';
            }
            $test.='<td style="color: red" colspan="1">'.$Ftotal=($total+(float)$delivaryFee).'</td>';

            if ($status != oderStatus[2] && $status != oderStatus[3]) {
                $test .= '<td style="color: red" colspan="1">'.'<a data-panel-id="' . $order->orderId . '" href="' . route('orderItem.add', $order->orderId) . '"  style="height:35px; width: 100%; margin:0 auto" class="btn btn-success "><i style="font-size: 25px;" class="fa fa-plus-circle"></i></a>'.'</td>';
            }

            $test .= '</tr>';
            $test.='<tbody>';
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

        $orderItems=Orderitems::select('orderitem.orderItemId','orderitem.quantity','orderitem.price')
                            ->where('orderitem.fkorderId',$orders->orderId)->get();
        $total=0;$price=0;$finalTotal=0;
        foreach ($orderItems as $Items){

            $price=($Items->quantity *$Items->price);
            $total=$total+$price;
        }

        $purchase=new Purchase;

        $purchase->fkorderId=$orders->orderId;
        $purchase->purchasetime=date(now());
        $purchase->delFee=$orders->delfee;
        $purchase->orderFee=$total;
        $purchase->total=$finalTotal=($total+$orders->delfee);
        $purchase->restaurantId=$orders->fkresturantId;

        $purchase->save();

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
        $orders=Order::Select('order.orderId','order.orderType','resturant.name as resName','resturant.minOrder','resturant.email as resEmail','resturant.phoneNumber as resPhone','resturant.image as resImage','resturant.delfee','resturant.address as resAddress',
            'resturant.city as resCity','resturant.zip as resZip','resturant.country as resCountry','customer.firstName','customer.lastName','customer.email','customer.phone',
            'shipaddress.addressDetails','shipaddress.city as addressCity','shipaddress.zip as addressZip','shipaddress.country as addressCountry')
            ->leftJoin('resturant', 'resturant.resturantId', '=', 'order.fkresturantId')
            ->leftJoin('customer', 'customer.customerId', '=', 'order.fkcustomerId')
            ->leftJoin('shipaddress', 'shipaddress.fkorderId', '=', 'order.orderId')
            ->where('order.orderId',$orderId)
            ->get();


        return view('order.orderInfo')
            ->with('orderinfo',$orders);

    }

    public function orderItemEdit($orderItemId){

        $orderItem=Orderitems::select('orderitem.orderItemId','orderitem.quantity','orderitem.price','itemsize.itemsizeName','item.itemName')
            ->where('orderitem.orderItemId',$orderItemId)
            ->leftJoin('itemsize', 'itemsize.itemsizeId', '=', 'orderitem.fkitemsizeId')
            ->leftJoin('item', 'item.itemId', '=', 'itemsize.item_itemId')
            ->get();

        return view('order.editOrderItem')->with('orderItem',$orderItem);

    }

    public function orderItemUpdate($orderItemId,Request $r){

        $orderItem=Orderitems::findOrFail($orderItemId);
        $orderItem->quantity=$r->itemQuantity;
        $orderItem->save();

        Session::flash('message', 'Order Item Quantity Updated Successfully');
        return back();


    }

    public function addOrderItem($orderId){

        $order=Order::select('resturant.name as resName')
            ->leftJoin('resturant', 'resturant.resturantId', '=', 'order.fkresturantId')
            ->where('order.orderId',$orderId)->get();
        $category=Category::select('category.categoryId','category.name as CategoryName')
            ->leftJoin('order', 'order.fkresturantId', '=', 'category.fkresturantId')
            ->where('order.orderId',$orderId)
            ->where('category.status',Status[0])
            ->get();

        return view('order.addOrderItem')
            ->with('categories',$category)
            ->with('orders',$order)
            ->with('orderId',$orderId);


    }

    public function getItemByCategory(Request $r){

        $catId=$r->catId;
        $this->data['item']=Item::select('item.itemId','item.itemName')
            ->where('item.fkcategoryId',$catId)
            ->where('item.status',Status[0])
            ->orderBy('item.itemName','ASC')->get();

        if ($this->data['item'] == "") {
            echo "<option value='' readonly selected>Please Select Category First</option>";
        } else {
            echo "<option value='' selected>Select Item</option>";
            foreach ($this->data['item'] as $item) {
                echo "<option  value='$item->itemId'>$item->itemName</option>";
            }
        }


    }
    public function getitemSizeByCategory(Request $r){

        $itemId=$r->itemId;
        $this->data['itemSize']=Itemsize::select('itemsize.itemsizeId','itemsize.itemsizeName')
            ->where('itemsize.item_itemId',$itemId)
            ->where('itemsize.status',Status[0])
            ->orderBy('itemsize.itemsizeName','ASC')->get();

        if ($this->data['itemSize'] == "") {
            echo "<option value='' readonly selected>This Item is Empty</option>";
        } else {
            echo "<option value='' selected>Select Item Size</option>";
            foreach ($this->data['itemSize'] as $itemSize) {
                echo "<option  value='$itemSize->itemsizeId'>$itemSize->itemsizeName</option>";
            }
        }


    }
    public function getpriceByItemSize(Request $r){

        $sizeId=$r->sizeId;
        $Itemsize=Itemsize::findOrFail($sizeId);
        echo $Itemsize->price;


    }

    public function insertOrderItem($orderId,Request $r){

        $orderItem=new Orderitems;

        $orderItem->fkorderId=$orderId;
        $orderItem->fkitemsizeId=$r->itemSize;
        $orderItem->quantity=$r->itemQuantity;
        $orderItem->price=$r->itemPrice;

        $orderItem->save();

        Session::flash('message', 'Order Item Inserted Successfully');

        return back();

    }
    public function deleteOrderItem($orderItemId){

        $orderItem=Orderitems::findOrFail($orderItemId);
        $orderItem->delete();

        Session::flash('message', 'Order Item Deleted Successfully');

        return back();


    }

    public function placeOrder(){

        return redirect('../');


    }

    /* extra*/

    public function addNewOrder(){

        $resName=Resturant::select('resturantId','name')
            ->where('status',Status[0])
            ->orderBy('name','ASC')->get();

        return view('order.addNewOrder')
            ->with('resturants',$resName);


    }
    public function insertNewOrder(Request $r){

        $order=new Order;

        $order->fkresturantId=$r->resturantName;
        if ($r->customerId){
            $order->fkcustomerId=$r->customerId;
        }else{
            $order->fkcustomerId=null;
        }

        $order->orderTime=date(now());

        $order->orderStatus=oderStatus[0];
        $order->paymentType="Cash";

        $inserted=$order->save();
        if ($inserted) {

            $orderItems = new Orderitems;

            $orderItems->fkorderId = $order->orderId;
            $orderItems->fkitemsizeId = $r->itemSize;
            $orderItems->price = $r->itemPrice;
            $orderItems->quantity = $r->itemQuantity;

            $orderItems->save();
            Session::flash('message', 'Order Added Successfully');
        }else{
            Session::flash('message', 'Something Went Wrong');
        }

        return back();

    }

    public function getItemCatByResId(Request $r){
        $resId=$r->resId;

        $this->data['category']=Category::select('categoryId','name')->where('fkresturantId',$resId)->orderBy('name','ASC')->get();

        if ($this->data['category'] == "") {
            echo "<option value='' readonly selected>Please Add a Item Category First</option>";
        } else {
            echo "<option value='' selected>Select Item Type</option>";
            foreach ($this->data['category'] as $category) {

                echo "<option value='$category->categoryId'>$category->name</option>";


            }
        }



    }
}