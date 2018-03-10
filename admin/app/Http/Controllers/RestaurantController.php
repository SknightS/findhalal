<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
//use DataTables;
use Yajra\DataTables\DataTables;
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
        $resturants=Resturant::get();

        $datatables = DataTables::of($resturants);

        return $datatables->make(true);

    }

    public function edit($id){
        $restaurant=Resturant::findOrFail($id);

        return view('restaurant.edit')->with('restaurant',$restaurant);
    }

    public function update(Request $r){
        $restaurant=Resturant::findOrFail($r->id);
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

        Session::flash('message', 'Restaurant Updated Successfully');
        return back();

        return $r;
    }

    public function destroy(Request $r){

        return $r;
    }
}
