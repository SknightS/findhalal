<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DataTables;
use App\Resturant;

class RestaurantController extends Controller
{
    public function add(){

        return view('restaurant.add');
    }


    public function insert(Request $r){
        $restaurant=new Resturant;
        $restaurant->name=$r->name;
        $restaurant->details=$r->details;
        $restaurant->minOrder=$r->minOrder;
//        $restaurant->image=$r->image;
        $restaurant->delfee=$r->delfee;
        $restaurant->status=$r->status;
        $restaurant->address=$r->address;
        $restaurant->city=$r->city;
        $restaurant->zip=$r->zip;
        $restaurant->country=$r->country;
        $restaurant->save();

        Session::flash('message', 'Restaurant Added Successfully');
        return back();
    }


    public function show(){

        return view('restaurant.show');
    }

    public function get(Request $r){
        $resturants=Resturant::select('name','details','address','city','zip','country','minOrder','delfee','status')->get();

        $datatables = DataTables::of($resturants);

        return $datatables->make(true);

    }
}
