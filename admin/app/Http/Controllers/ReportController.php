<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use stdClass;
use Session;
use DB;
use App\Purchase;
use App\Resturant;
use App\Order;
use App\Orderitems;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $purchases=DB::table('purchase')
            ->select('purchase.restaurantId',DB::raw('SUM(purchase.total) as total'),DB::raw('SUM(purchase.orderFee) as totalOrder'))
            ->groupBy('purchase.restaurantId')
            ->get();
//        SELECT SUM(orderitem.price) FROM `orderitem`
//        WHERE `fkorderId` in (SELECT orderId FROM `order` where fkresturantId=6 and paymentType='cash')
        $report =array();

        foreach ($purchases as $p){
            $cashOrderId=Purchase::select('purchase.fkorderId')
                    ->leftJoin('order','purchase.restaurantId','order.fkresturantId')
                    ->where('purchase.restaurantId',$p->restaurantId)
                    ->where('order.paymentType','Cash')
                    ->get();


            $cardOrderId=Purchase::select('purchase.fkorderId')
                ->leftJoin('order','purchase.restaurantId','order.fkresturantId')
                ->where('purchase.restaurantId',$p->restaurantId)
                ->where('order.paymentType','Card')
                ->get();





            $cash=DB::table('orderitem')
                ->select(DB::raw('SUM(orderitem.price) as price'))
                ->whereIn('fkorderId',$cashOrderId)
                ->get();



            $card=DB::table('orderitem')
                ->select(DB::raw('SUM(orderitem.price) as price'))
                ->whereIn('fkorderId',$cardOrderId )
                ->get();
            $res=Resturant::findOrFail($p->restaurantId);
            $restaurant = new stdClass;
            $restaurant->id=$p->restaurantId;
            $restaurant->name=$res->name;
            if($cash[0]->price ==null){
                $restaurant->cash=0;
            }
            else{
                $restaurant->cash=$cash[0]->price;
            }
            if($card[0]->price ==null){
                $restaurant->card=0;
            }
            else{
                $restaurant->card=$card[0]->price;
            }
            array_push($report, $restaurant);
        }


        return view('report.index')
            ->with('report',$report);
    }

    public function searchByDate(Request $r){
         $from= date('Y-m-d',strtotime($r->from));
         $to=date('Y-m-d',strtotime($r->to));

        $purchases=DB::table('purchase')
            ->select('purchase.restaurantId',DB::raw('SUM(purchase.total) as total'),DB::raw('SUM(purchase.orderFee) as totalOrder'))
            ->groupBy('purchase.restaurantId')
            ->get();
//        SELECT SUM(orderitem.price) FROM `orderitem`
//        WHERE `fkorderId` in (SELECT orderId FROM `order` where fkresturantId=6 and paymentType='cash')
        $report =array();
        foreach ($purchases as $p){

            $cashOrderId=Purchase::select('purchase.fkorderId')
                ->leftJoin('order','purchase.restaurantId','order.fkresturantId')
                ->where('purchase.restaurantId',$p->restaurantId)
                ->where('order.paymentType','Cash')
                ->whereBetween(DB::raw('DATE(order.orderTime)'),[$from,$to])
                ->get();


            $cardOrderId=Purchase::select('purchase.fkorderId')
                ->leftJoin('order','purchase.restaurantId','order.fkresturantId')
                ->where('purchase.restaurantId',$p->restaurantId)
                ->where('order.paymentType','Card')
                ->whereBetween(DB::raw('DATE(order.orderTime)'),[$from,$to])
                ->get();


            $cash=DB::table('orderitem')
                ->select(DB::raw('SUM(orderitem.price) as price'))
                ->whereIn('fkorderId',$cashOrderId)
                ->get();

            $card=DB::table('orderitem')
                ->select(DB::raw('SUM(orderitem.price) as price'))
                ->whereIn('fkorderId',$cardOrderId)
                ->get();

            $res=Resturant::findOrFail($p->restaurantId);
            $restaurant = new stdClass;
            $restaurant->id=$p->restaurantId;
            $restaurant->name=$res->name;
            if($cash[0]->price ==null){
                $restaurant->cash=0;
            }
            else{
                $restaurant->cash=$cash[0]->price;
            }
            if($card[0]->price ==null){
                $restaurant->card=0;
            }
            else{
                $restaurant->card=$card[0]->price;
            }
            array_push($report, $restaurant);
        }

        Session::flash('message', 'Showing Report From '.$from.' to '.$to);

        return view('report.index')
            ->with('report',$report);
    }


       public function individual($id){
           $restaurantNAme=Resturant::select('name')->findOrFail($id);
           $reportCash=Purchase::select('purchase.fkorderId','purchase.delFee','customer.firstName','order.paymentType','order.orderTime')
                        ->leftJoin('order','purchase.fkorderId','order.orderId')
                        ->leftJoin('customer','order.fkcustomerId','customer.customerId')
                        ->where('order.fkresturantId',$id)
                        ->where('order.paymentType','cash')
                        ->orderBy('order.orderTime','desc')
                        ->get();

           $orderCash =array();
           $orderCard =array();
        foreach ($reportCash as $report){

            $items=Orderitems::select('item.itemName','orderitem.quantity','orderitem.price')
                            ->leftJoin('itemsize','orderitem.fkitemsizeId','itemsize.itemsizeId')
                            ->leftJoin('item','itemsize.item_itemId','item.itemId')
                            ->where('fkorderId',$report->fkorderId)->get();

            $cash = new stdClass;

            $cash->orderId=$report->fkorderId;
            $cash->delFee=$report->delFee;
            $cash->customerName=$report->firstName;
            $cash->paymentType=$report->paymentType;
            $cash->date=$report->orderTime;
            $cash->items=$items;

            array_push($orderCash, $cash);

            }

           $reportCard=Purchase::select('purchase.fkorderId','purchase.delFee','customer.firstName','order.paymentType','order.orderTime')
               ->leftJoin('order','purchase.fkorderId','order.orderId')
               ->leftJoin('customer','order.fkcustomerId','customer.customerId')
               ->where('order.fkresturantId',$id)
               ->where('order.paymentType','card')
               ->orderBy('order.orderTime','desc')
               ->get();



           foreach ($reportCard as $report){
               $items=Orderitems::select('item.itemName','orderitem.quantity','orderitem.price')
                   ->leftJoin('itemsize','orderitem.fkitemsizeId','itemsize.itemsizeId')
                   ->leftJoin('item','itemsize.item_itemId','item.itemId')
                   ->where('fkorderId',$report->fkorderId)->get();

               $cash = new stdClass;

               $cash->orderId=$report->fkorderId;
               $cash->delFee=$report->delFee;
               $cash->customerName=$report->firstName;
               $cash->paymentType=$report->paymentType;
               $cash->date=$report->orderTime;
               $cash->items=$items;

               array_push($orderCard, $cash);

           }




            return view('report.individual')
                ->with('orderCard',$orderCard)
                ->with('orderCash',$orderCash)
                ->with('restaurantNAme',$restaurantNAme);

       }




}