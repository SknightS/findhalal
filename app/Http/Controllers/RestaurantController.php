<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Itemsize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resturant;

class RestaurantController extends Controller
{
    //


    public function Restaurants(Request $r){


        $searchresult = Resturant::where('status', 'Active')
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
        $catagory = Category::select('*')
            ->where('fkresturantId', $resid)
            ->get();

        return view('restaurants.profile')
            ->with('category', $catagory)
            ->with('restaurant', $restaurant)
            ->with('resid', $resid);

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
}
