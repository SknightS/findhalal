<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Itemsize;
use App\Resturant;
use Illuminate\Http\Request;
use Session;

use Image;

use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    public function add(){
        $resName=Resturant::select('resturantId','name')->orderBy('name','ASC')->get();

        return view('item.add')
            ->with('resName',$resName);
    }

    public function getItemCatByResId(Request $r){
        $resId=$r->resId;
        $this->data['category']=Category::select('categoryId','name')->where('fkresturantId',$resId)->orderBy('name','ASC')->get();

        if ($this->data['category'] == "") {
            echo "<option value='' readonly selected>Please Add a Item Category First</option>";
        } else {
            echo "<option value='' selected>Select Item Type</option>";
            foreach ($this->data['category'] as $category) {
                echo "<option value='$category->categoryId'>$category->name</option>";
            }
        }

    }

    public function insert(Request $r){


        $item=new Item;
        $item->itemName=$r->itemName;
        $item->fkcategoryId=$r->itemCategory;
        $item->fkresturantId=$r->resturantName;
        $item->status=$r->itemStatus;

        $item->save();

        if($r->hasFile('ItemPicture')){
            $img = $r->file('ItemPicture');
            $filename= $item->itemId.'ItemPicture'.'.'.$img->getClientOriginalExtension();
            $item->image=$filename;
            $location = public_path('ItemImages/'.$filename);
//            Image::make($img)->resize(800,600)->save($location);
            Image::make($img)->save($location);
        }


        $textbox = $r->textbox;
        $textprice = $r->textprice;
        $itemsizeStatus = $r->itemsizeStatus;

        if(array_filter($textbox)== null && array_filter($textprice) == null) {

            $itemSize=new Itemsize;

            $itemSize->item_itemId=$item->itemId;
            $itemSize->price= $r->itemPrice;
            $itemSize->status=$r->itemStatus;

            $itemSize->save();

        } else {
            for ($i = 0; $i < count($textbox); $i++) {

                    $itemSize=new Itemsize;
                    $itemSize->item_itemId=$item->itemId;
                    $itemSize->price=$textprice[$i];
                    $itemSize->itemsizeName=$textbox[$i];
                    $itemSize->status=$itemsizeStatus[$i];

                    $itemSize->save();
            }
        }
        $item->save();

        Session::flash('message', 'Items Added Successfully');
        return back();
    }

    public function show(){

        $itemSizes=Itemsize::select('itemsizeId','itemsizeName','price','status','item_itemId')->orderBy('itemsizeName','ASC')->get();
        $resName=Resturant::select('resturantId','name')->orderBy('name','ASC')->get();

        return view('item.show')
            ->with('itemSizes',$itemSizes)
            ->with('resName',$resName);
    }

    public function get(Request $r){

        $items=Item::select('image','itemName','itemId','status');

        if ($resId=$r->resId){
            $items->where('item.fkresturantId',$resId);
        }
        if ($itemCat=$r->itemCategory){
            $items->where('item.fkcategoryId',$itemCat);
        }
        $items->orderBy('itemName','ASC')->get();


        $datatables = DataTables::of($items);

        return $datatables->addColumn('action', function ($item) {
            $itemSize=Itemsize::where('item_itemId',$item->itemId)->get();
            $test='<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle orderexmple">';
            foreach ($itemSize as $size){
                $test.='<tr>';
                $test.='<td class="center">'.$size->itemsizeName.'</td>';
                $test.='<td class="center">'.$size->price.'</td>';
                $test.='<td class="center">'.$size->status.'</td>';
                $test.='<td class="center">'.
                    '<button  class="btn btn-info btn-xs"  data-panel-id="'.$size->itemsizeId.'" onclick="selectid1(this)">
                     <i class="fa fa-edit"></i>
                     </button>
                        <button type="button" data-panel-id="'.$size->itemsizeId.'" onclick="selectid4(this)"class="btn btn-danger btn-xs">

                            <i class="fa fa-trash "></i>
                        </button>'.
                    '</td>';

                $test.='</tr>';
            }
            $test.='</table>';
            $test.='<button data-panel-id="'.$item->itemId.'" onclick="selectid5(this)" style="height:35px; width: 100%; margin:0 auto" class="btn btn-success "><i style="font-size: 25px; margin-top: 1px;" class="fa fa-plus-circle"></i></button>';
            return $test;

        })->make(true);

    }
}
