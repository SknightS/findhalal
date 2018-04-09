<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Resturant;

use Illuminate\Support\Facades\DB;

use App\Purchase;



class HomeController extends Controller
{
    //

    public function index(){
        $featuredRes = Resturant::select('resturantId','name','minOrder','image')
            ->where('featureResturant', "1")
            ->get();
        $resItem=Item::select(DB::raw('GROUP_CONCAT(itemName) AS itemNames'),'fkresturantId')->where('status',Status[0])
            ->groupBy('fkresturantId')->get();


       // return $featuredRes;

       // return view('welcome')


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
            ->with('topRestaurants',$topRestaurants)
            ->with('resItems',$resItem)
            ->with('featuredRes',$featuredRes);


    }
}
