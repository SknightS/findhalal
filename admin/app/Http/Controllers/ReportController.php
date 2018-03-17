<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use DB;
use App\Purchase;
use App\Resturant;
use App\Order;

class ReportController extends Controller
{
    public function index(){
        $purchases=DB::table('purchase')
                    ->select('purchase.restaurantId',DB::raw('SUM(purchase.total) as total'),DB::raw('SUM(purchase.orderFee) as totalOrder'))
                    ->groupBy('purchase.restaurantId')
            ->get();

//        SELECT SUM(orderitem.price) FROM `orderitem`
//        WHERE `fkorderId` in (SELECT orderId FROM `order` where fkresturantId=6 and paymentType='cash')

        $report =array();

        foreach ($purchases as $p){
            $cash=DB::table('orderitem')
                ->select(DB::raw('SUM(orderitem.price) as price'))
                ->whereIn('fkorderId', function($query) use ($p)
                {
                    $query->select('orderId')
                        ->from('order')
                        ->where('fkresturantId',$p->restaurantId)
                        ->where('paymentType','cash')
                        ->whereDate('orderTime','2018-03-16');
                })
                ->get();

            $card=DB::table('orderitem')
                ->select(DB::raw('SUM(orderitem.price) as price'))
                ->whereIn('fkorderId', function($query) use ($p)
                {
                    $query->select('orderId')
                        ->from('order')
                        ->where('fkresturantId',$p->restaurantId)
                        ->where('paymentType','card')
                        ->whereDate('orderTime','2018-03-16');
                })
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


//        v
//        $u->userName=$user->firstName;
//        $u->typeId=$user->typeId;
//        $u->leadMined=$leadMinedThisWeek;
//        $u->called=$calledThisWeek;
//        $u->highPosibilities=$highPosibilitiesThisWeek;
//        $u->t=$t;
    }
}
