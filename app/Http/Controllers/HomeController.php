<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Resturant;
use Illuminate\Support\Facades\DB;

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

        return view('welcome')
            ->with('resItems',$resItem)
            ->with('featuredRes',$featuredRes);

    }
}
