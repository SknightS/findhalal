<?php
namespace App\Http\Controllers;
use foo\bar;
use Illuminate\Http\Request;
use stdClass;
use Session;
use DB;
use Auth;
use App\Purchase;
use App\Resturant;
use App\Order;
use App\Orderitems;

use PDF;
class ReportController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){
//      Get Every Restaurant Id
        if(!(Auth::user()->fkuserTypeId == User[0])){
            return back();
        }
        $purchases=DB::table('purchase')
            ->select('purchase.restaurantId')
            ->groupBy('purchase.restaurantId')
            ->get();


//       Make object for each restaurant
        $report =array();


        foreach ($purchases as $p){
//          Get All Order Id For Each Restaurant (Cash)
            $cashOrderId=Purchase::select('purchase.fkorderId',DB::raw('SUM(purchase.total) as total'))
                    ->where('purchase.restaurantId',$p->restaurantId)
                    ->where('order.paymentType','Cash')
                    ->leftJoin('order','purchase.fkorderId','order.orderId')
                    ->get();


//          Get All Order Id For Each Restaurant (Card)
            $cardOrderId=Purchase::select('purchase.fkorderId',DB::raw('SUM(purchase.total) as total'))
                ->where('purchase.restaurantId',$p->restaurantId)
                ->where('order.paymentType','Card')
                ->leftJoin('order','purchase.fkorderId','order.orderId')
                ->get();

            $res=Resturant::findOrFail($p->restaurantId);
            $restaurant = new stdClass;
            $restaurant->id=$p->restaurantId;
            $restaurant->name=$res->name;

//           Check Value Empty
            if($cashOrderId[0]){
                $restaurant->cash=$cashOrderId[0]->total;

            }
            else{
                $restaurant->cash=0;
            }
            if($cardOrderId[0]){
                $restaurant->card=$cardOrderId[0]->total;
            }
            else{

                $restaurant->card=0;
            }
            array_push($report, $restaurant);
        }

//        return $report;

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


            $cashOrderId=Purchase::select('purchase.fkorderId',DB::raw('SUM(purchase.total) as total'))
                ->where('purchase.restaurantId',$p->restaurantId)
                ->where('order.paymentType','Cash')
                ->leftJoin('order','purchase.fkorderId','order.orderId')
                ->whereBetween(DB::raw('DATE(order.orderTime)'),[$from,$to])
                ->get();




            $cardOrderId=Purchase::select('purchase.fkorderId',DB::raw('SUM(purchase.total) as total'))
                ->where('purchase.restaurantId',$p->restaurantId)
                ->where('order.paymentType','Card')
                ->leftJoin('order','purchase.fkorderId','order.orderId')
                ->whereBetween(DB::raw('DATE(order.orderTime)'),[$from,$to])
                ->get();



            $res=Resturant::findOrFail($p->restaurantId);
            $restaurant = new stdClass;
            $restaurant->id=$p->restaurantId;
            $restaurant->name=$res->name;



            if($cashOrderId[0]){
                $restaurant->cash=$cashOrderId[0]->total;

            }
            else{
                $restaurant->cash=0;
            }
            if($cardOrderId[0]){
                $restaurant->card=$cardOrderId[0]->total;
            }
            else{

                $restaurant->card=0;
            }
            array_push($report, $restaurant);
        }

        Session::flash('message', 'Showing Report From '.$from.' to '.$to);

        return view('report.index')
            ->with('report',$report)
            ->with('from',$from)
            ->with('to',$to);
    }

    public function getCardInfo(Request $r){
        $card=Order::select('order.cardBrand as cardBrand',DB::raw('SUM(purchase.total) as total'))
            ->where('fkresturantId',$r->fkresturantId)
            ->leftJoin('purchase','purchase.fkorderId','order.orderId')
            ->where('order.cardBrand','!=',null)
            ->groupBy('order.cardBrand');
        if($r->from && $r->to){
            $card=$card->whereBetween(DB::raw('DATE(orderTime)'),[$r->from,$r->to]);
        }
          $card=$card->get();
        return view('report.cardInfoModal',compact('card'));
//        return $card;
    }


    public function individual($id){
           $restaurantNAme=Resturant::select('name')->findOrFail($id);
           $reportCash=Purchase::select('purchase.fkorderId','purchase.total','purchase.delFee','customer.firstName','order.paymentType','order.orderTime')
                        ->leftJoin('order','purchase.fkorderId','order.orderId')
                        ->leftJoin('customer','order.fkcustomerId','customer.customerId')
                        ->where('order.fkresturantId',$id)
                        ->where('order.paymentType','Cash')
                        ->orderBy('order.orderTime','desc')
                        ->groupBy('purchase.fkorderId')
                        ->get();

           $orderCash =array();
           $orderCard =array();
        foreach ($reportCash as $report){

            $items=Orderitems::select('item.itemName','orderitem.quantity','orderitem.price','itemsize.itemsizeName')
                            ->leftJoin('itemsize','orderitem.fkitemsizeId','itemsize.itemsizeId')
                            ->leftJoin('item','itemsize.item_itemId','item.itemId')
                            ->where('fkorderId',$report->fkorderId)->get();

            $cash = new stdClass;
            $cash->orderId=$report->fkorderId;
            $cash->delFee=$report->delFee;
            $cash->customerName=$report->firstName;
            $cash->paymentType=$report->paymentType;
            $cash->date=$report->orderTime;
            $cash->total=$report->total;
            $cash->items=$items;

            array_push($orderCash, $cash);

            }

           $reportCard=Purchase::select('purchase.fkorderId','purchase.total','purchase.delFee','customer.firstName','order.paymentType','order.orderTime')
               ->leftJoin('order','purchase.fkorderId','order.orderId')
               ->leftJoin('customer','order.fkcustomerId','customer.customerId')
               ->where('order.fkresturantId',$id)
               ->where('order.paymentType','Card')
               ->orderBy('order.orderTime','desc')
               ->groupBy('purchase.fkorderId')
               ->get();



           foreach ($reportCard as $report){
               $items=Orderitems::select('item.itemName','orderitem.quantity','orderitem.price','itemsize.itemsizeName')
                   ->leftJoin('itemsize','orderitem.fkitemsizeId','itemsize.itemsizeId')
                   ->leftJoin('item','itemsize.item_itemId','item.itemId')
                   ->where('fkorderId',$report->fkorderId)->get();

               $cash = new stdClass;
               $cash->orderId=$report->fkorderId;
               $cash->delFee=$report->delFee;
               $cash->customerName=$report->firstName;
               $cash->paymentType=$report->paymentType;
               $cash->date=$report->orderTime;
               $cash->total=$report->total;
               $cash->items=$items;
               array_push($orderCard, $cash);
           }


           return view('report.individual')
                ->with('orderCard',$orderCard)
                ->with('orderCash',$orderCash)
                ->with('restaurantNAme',$restaurantNAme)
                ->with('id',$id);

       }




    public function individualWithDate($id,$start,$end){
        $restaurantNAme=Resturant::select('name')->findOrFail($id);
        $reportCash=Purchase::select('purchase.fkorderId','purchase.total','purchase.delFee','customer.firstName','order.paymentType','order.orderTime')
            ->leftJoin('order','purchase.fkorderId','order.orderId')
            ->leftJoin('customer','order.fkcustomerId','customer.customerId')
            ->where('order.fkresturantId',$id)
            ->where('order.paymentType','Cash')
            ->orderBy('order.orderTime','desc')
            ->groupBy('purchase.fkorderId')
            ->whereBetween(DB::raw('DATE(order.orderTime)'),[$start,$end])
            ->get();

        $orderCash =array();
        $orderCard =array();
        foreach ($reportCash as $report){

            $items=Orderitems::select('item.itemName','orderitem.quantity','orderitem.price','itemsize.itemsizeName')
                ->leftJoin('itemsize','orderitem.fkitemsizeId','itemsize.itemsizeId')
                ->leftJoin('item','itemsize.item_itemId','item.itemId')
                ->where('fkorderId',$report->fkorderId)
                ->get();

            $cash = new stdClass;
            $cash->orderId=$report->fkorderId;
            $cash->delFee=$report->delFee;
            $cash->customerName=$report->firstName;
            $cash->paymentType=$report->paymentType;
            $cash->date=$report->orderTime;
            $cash->total=$report->total;
            $cash->items=$items;

            array_push($orderCash, $cash);

        }

        $reportCard=Purchase::select('purchase.fkorderId','purchase.total','purchase.delFee','customer.firstName','order.paymentType','order.orderTime')
            ->leftJoin('order','purchase.fkorderId','order.orderId')
            ->leftJoin('customer','order.fkcustomerId','customer.customerId')
            ->where('order.fkresturantId',$id)
            ->where('order.paymentType','Card')
            ->orderBy('order.orderTime','desc')
            ->groupBy('purchase.fkorderId')
            ->whereBetween(DB::raw('DATE(order.orderTime)'),[$start,$end])
            ->get();



        foreach ($reportCard as $report){
            $items=Orderitems::select('item.itemName','orderitem.quantity','orderitem.price','itemsize.itemsizeName')
                ->leftJoin('itemsize','orderitem.fkitemsizeId','itemsize.itemsizeId')
                ->leftJoin('item','itemsize.item_itemId','item.itemId')
                ->where('fkorderId',$report->fkorderId)->get();

            $cash = new stdClass;
            $cash->orderId=$report->fkorderId;
            $cash->delFee=$report->delFee;
            $cash->customerName=$report->firstName;
            $cash->paymentType=$report->paymentType;
            $cash->date=$report->orderTime;
            $cash->total=$report->total;
            $cash->items=$items;
            array_push($orderCard, $cash);
        }


        return view('report.individual')
            ->with('orderCard',$orderCard)
            ->with('orderCash',$orderCash)
            ->with('restaurantNAme',$restaurantNAme)
            ->with('id',$id)
            ->with('start',$start)
            ->with('end',$end);
        }

        public function generatePdf(Request $r){
            $restaurant=Resturant::findOrFail($r->id);
            $fromDate="";
            $toDate="";
            if($r->startDate && $r->endDate) {
                $fromDate = $r->startDate;
                $toDate = $r->endDate;
            }

            $report=Order::select('purchase.fkorderId','order.fkresturantId','order.invoiceNumber','orderStatus','purchase.total','purchase.delFee','order.paymentType','order.orderTime')
                ->leftJoin('purchase','purchase.fkorderId','order.orderId')
                ->leftJoin('customer','order.fkcustomerId','customer.customerId')
                ->where('order.fkresturantId',$r->id);
            if($r->startDate && $r->endDate){
                $report= $report->whereBetween(DB::raw('DATE(order.orderTime)'),[$r->startDate,$r->endDate]);
            }

            $report= $report->get();

            $pdf = PDF::loadView('report.pdf',compact('report','restaurant','fromDate','toDate'));
            $pdf->save('public/pdf/Verkaufsbericht.pdf'); // Saving Pdf To Server
            return "Verkaufsbericht.pdf";
        }



}