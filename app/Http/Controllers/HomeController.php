<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resturant;
use App\Purchase;
use DB;

class HomeController extends Controller
{
    //

    public function index(){

//        Top 6 sellers
//        SELECT `restaurantId`,SUM(`total`) as totalcost FROM `purchase` GROUP BY `restaurantId` order BY totalcost desc LIMIT 6
        $purchase=Purchase::select('purchase.restaurantId',DB::raw('SUM(purchase.total) as totalcost'))
            ->groupBy('restaurantId')
            ->orderBy('totalcost','desc')
            ->limit(6)
            ->get();
        $resID=array();
        foreach ($purchase as $p){
            array_push($resID,$p->restaurantId);
        }
        $topRestaurants=Resturant::select('resturantId','name','image','address')->whereIn('resturantId',$resID)->get();


//       End Top sellers

        return view('welcome')
            ->with('topRestaurants',$topRestaurants);

    }
}
