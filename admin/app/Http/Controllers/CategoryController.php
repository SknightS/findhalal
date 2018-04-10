<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;
use Auth;
use App\Category;
use App\Resturant;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){

        return view('category.show');
    }

    public function getCategoryData(Request $r){
        $categories=Category::leftJoin('resturant','resturant.resturantId','category.fkresturantId')
            ->select('category.categoryId','category.name','category.status','resturant.name as restaurantName')
            ->get();

        $datatables = DataTables::of($categories);
        return $datatables->make(true);
    }

    public function add(){
        $restaurants=Resturant::get();
        return view('category.add')
            ->with('restaurants',$restaurants);
    }
    public function insert(Request $r){
        $category=new Category;
        $category->name=$r->name;
        $category->fkresturantId=$r->id;
        $category->status=$r->status;
        $category->save();

        Session::flash('message', 'Category Added Successfully');
        return back();

    }

    public function edit($id){
        if(!(Auth::user()->fkuserTypeId == User[0])){
            return back();
        }
        $category=Category::findOrFail($id);
        $resturantName=Resturant::select('name')->findOrFail($category->fkresturantId);

        return view('category.edit')
            ->with('category',$category)
            ->with('resturantName',$resturantName);
    }

    public function update(Request $r){

        $category=Category::findOrFail($r->id);
        $category->name=$r->name;
        $category->status=$r->status;
        $category->save();

        Session::flash('message', 'Category Updated Successfully');
        return back();
    }

    public function destroy(Request $r){
        $category=Category::findOrFail($r->id);
        $category->delete();

        Session::flash('message', 'Category Deleted Successfully');
        return back();
    }
}
