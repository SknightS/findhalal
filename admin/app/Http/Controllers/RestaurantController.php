<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
//use DataTables;
use Yajra\DataTables\DataTables;
use Image;
use DB;
use App\Resturant;
use App\Resturanttime;

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

        if($r->hasFile('image')){
            $img = $r->file('image');
            $filename= $restaurant->resturantId.'RestaurantPicture'.'.'.$img->getClientOriginalExtension();
            $restaurant->image=$filename;
            $restaurant->save();
            $location = public_path('RestaurantImages/'.$filename);
//            Image::make($img)->resize(800,600)->save($location);
            Image::make($img)->save($location);
        }


        //Adding run time
        $runTime=new Resturanttime;
        $runTime->day='saturday';
        $runTime->opentime=$r->satOpen;
        $runTime->closetime=$r->satClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='sunday';
        $runTime->opentime=$r->sunOpen;
        $runTime->closetime=$r->sunClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='monday';
        $runTime->opentime=$r->monOpen;
        $runTime->closetime=$r->monClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='tuesday';
        $runTime->opentime=$r->tueOpen;
        $runTime->closetime=$r->tueClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='wednesday';
        $runTime->opentime=$r->wedOpen;
        $runTime->closetime=$r->wedClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='thursday';
        $runTime->opentime=$r->thuOpen;
        $runTime->closetime=$r->thuClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='friday';
        $runTime->opentime=$r->friOpen;
        $runTime->closetime=$r->friClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();




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

        $saturday=Resturanttime::where('fkresturantId',$id)
                                ->where('day','saturday')->first();

        $sunday=Resturanttime::where('fkresturantId',$id)
            ->where('day','sunday')->first();

        $monday=Resturanttime::where('fkresturantId',$id)
            ->where('day','monday')->first();

        $tuesday=Resturanttime::where('fkresturantId',$id)
            ->where('day','tuesday')->first();

        $wednesday=Resturanttime::where('fkresturantId',$id)
            ->where('day','wednesday')->first();

        $thursday=Resturanttime::where('fkresturantId',$id)
            ->where('day','thursday')->first();

        $friday=Resturanttime::where('fkresturantId',$id)
            ->where('day','friday')->first();




        return view('restaurant.edit')
            ->with('restaurant',$restaurant)
            ->with('saturday',$saturday)
            ->with('sunday',$sunday)
            ->with('monday',$monday)
            ->with('tuesday',$tuesday)
            ->with('wednesday',$wednesday)
            ->with('thursday',$thursday)
            ->with('friday',$friday);
    }

    public function update(Request $r){
        $restaurant=Resturant::findOrFail($r->id);
        $restaurant->name=$r->name;
        $restaurant->details=$r->details;
        $restaurant->minOrder=$r->minOrder;
        $restaurant->delfee=$r->delfee;
        $restaurant->status=$r->status;
        $restaurant->address=$r->address;
        $restaurant->city=$r->city;
        $restaurant->zip=$r->zip;
        $restaurant->country=$r->country;

        //Check If the form has Image File
        if($r->hasFile('image')){
            $img = $r->file('image');
            if($restaurant->image !=null){//If there was any image before
                $filename= $restaurant->image.'.'.$img->getClientOriginalExtension();
                }
            else{
                $filename= $restaurant->resturantId.'RestaurantPicture'.'.'.$img->getClientOriginalExtension();
            }
            $restaurant->image=$filename;

            $location = public_path('RestaurantImages/'.$filename);
//            Image::make($img)->resize(800,600)->save($location);
            Image::make($img)->save($location);
        }
        $restaurant->save();





        //Updating run time
        $runTime=Resturanttime::findOrFail($r->satId);
        $runTime->day='saturday';
        $runTime->opentime=$r->satOpen;
        $runTime->closetime=$r->satClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->sunId);
        $runTime->day='sunday';
        $runTime->opentime=$r->sunOpen;
        $runTime->closetime=$r->sunClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->monId);
        $runTime->day='monday';
        $runTime->opentime=$r->monOpen;
        $runTime->closetime=$r->monClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->tueId);
        $runTime->day='tuesday';
        $runTime->opentime=$r->tueOpen;
        $runTime->closetime=$r->tueClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->wedId);
        $runTime->day='wednesday';
        $runTime->opentime=$r->wedOpen;
        $runTime->closetime=$r->wedClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->thuId);
        $runTime->day='thursday';
        $runTime->opentime=$r->thuOpen;
        $runTime->closetime=$r->thuClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->friId);
        $runTime->day='friday';
        $runTime->opentime=$r->friOpen;
        $runTime->closetime=$r->friClose;
        $runTime->save();




        Session::flash('message', 'Restaurant Updated Successfully');
        return back();


    }

    public function destroy(Request $r){

        DB::table('resturanttime')->where('fkresturantId',$r->id)->delete();
        DB::table('category')->where('fkresturantId',$r->id)->delete();
        DB::table('item')->where('fkresturantId',$r->id)->delete();

        $restaurant=Resturant::findOrFail($r->id);

        if($restaurant->image!=null){
            File::delete('RestaurantImages/'.$restaurant->image);
        }
        $restaurant->delete();

        Session::flash('message', 'Restaurant Deleted Successfully');
        return back();

    }
}
