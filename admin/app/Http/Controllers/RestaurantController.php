<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Yajra\DataTables\DataTables;
use Image;
use DB;
use App\Resturant;
use App\Resturanttime;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(){

        return view('restaurant.add');
    }


    public function insert(Request $r){
        $this->validate($r,[
            'name' => 'required|max:45',
            'status' => 'required|max:10',
            'details' => 'required|max:1100',
            'minOrder' => 'required|max:11',
            'delfee'=>'required|max:20',
            'address'=>'required|max:1000',
            'city'=>'required|max:45',
            'zip'=>'required|max:45',
            'country'=>'required|max:45',
            'featureRes'=>'nullable|max:1',

        ]);

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
        $restaurant->email=$r->email;
        $restaurant->phoneNumber=$r->phone;
        if ($r->featureRes){
            $restaurant->featureResturant=$r->featureRes;
        }
        else{
            $restaurant->featureResturant="0";
        }

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
        $runTime->day='Saturday';
        $runTime->opentime=$r->satOpen;
        $runTime->closetime=$r->satClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='Sunday';
        $runTime->opentime=$r->sunOpen;
        $runTime->closetime=$r->sunClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='Monday';
        $runTime->opentime=$r->monOpen;
        $runTime->closetime=$r->monClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='Tuesday';
        $runTime->opentime=$r->tueOpen;
        $runTime->closetime=$r->tueClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='Wednesday';
        $runTime->opentime=$r->wedOpen;
        $runTime->closetime=$r->wedClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='Thursday';
        $runTime->opentime=$r->thuOpen;
        $runTime->closetime=$r->thuClose;
        $runTime->fkresturantId=$restaurant->resturantId;
        $runTime->save();

        $runTime=new Resturanttime;
        $runTime->day='Friday';
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
        $resturants=Resturant::select('resturantId','name','details','address','city','zip','country','minOrder','delfee','status')
            ->get();

        $datatables = DataTables::of($resturants);

        return $datatables->make(true);

    }

    public function edit($id){
        if(!(Auth::user()->fkuserTypeId == User[0])){
            return back();
        }
        $restaurant=Resturant::findOrFail($id);

        $saturday=Resturanttime::where('fkresturantId',$id)
                                ->where('day','Saturday')->first();

        $sunday=Resturanttime::where('fkresturantId',$id)
            ->where('day','Sunday')->first();

        $monday=Resturanttime::where('fkresturantId',$id)
            ->where('day','Monday')->first();

        $tuesday=Resturanttime::where('fkresturantId',$id)
            ->where('day','Tuesday')->first();

        $wednesday=Resturanttime::where('fkresturantId',$id)
            ->where('day','Wednesday')->first();

        $thursday=Resturanttime::where('fkresturantId',$id)
            ->where('day','Thursday')->first();

        $friday=Resturanttime::where('fkresturantId',$id)
            ->where('day','Friday')->first();




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
        $restaurant->email=$r->email;
        $restaurant->phoneNumber=$r->phone;

        if ($r->featureRes){
            $restaurant->featureResturant=$r->featureRes;
        }
        else{
            $restaurant->featureResturant="0";
        }

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
        $runTime->day='Saturday';
        $runTime->opentime=$r->satOpen;
        $runTime->closetime=$r->satClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->sunId);
        $runTime->day='Sunday';
        $runTime->opentime=$r->sunOpen;
        $runTime->closetime=$r->sunClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->monId);
        $runTime->day='Monday';
        $runTime->opentime=$r->monOpen;
        $runTime->closetime=$r->monClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->tueId);
        $runTime->day='Tuesday';
        $runTime->opentime=$r->tueOpen;
        $runTime->closetime=$r->tueClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->wedId);
        $runTime->day='Wednesday';
        $runTime->opentime=$r->wedOpen;
        $runTime->closetime=$r->wedClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->thuId);
        $runTime->day='Thursday';
        $runTime->opentime=$r->thuOpen;
        $runTime->closetime=$r->thuClose;
        $runTime->save();

        $runTime=Resturanttime::findOrFail($r->friId);
        $runTime->day='Friday';
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
