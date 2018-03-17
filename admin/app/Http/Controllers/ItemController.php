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
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(){
        $resName=Resturant::select('resturantId','name')->orderBy('name','ASC')->get();

        return view('item.add')
            ->with('resName',$resName);
    }

    public function getItemCatByResId(Request $r){
        $resId=$r->resId;
        $categorys=$r->cat;
        $this->data['category']=Category::select('categoryId','name')->where('fkresturantId',$resId)->orderBy('name','ASC')->get();

        if ($this->data['category'] == "") {
            echo "<option value='' readonly selected>Please Add a Item Category First</option>";
        } else {
            echo "<option value='' selected>Select Item Type</option>";
            foreach ($this->data['category'] as $category) {

                if (!empty($categorys) && $categorys == $category->categoryId ){

                    echo "<option selected value='$category->categoryId'>$category->name</option>";
                }elseif (!empty($categorys)&& $categorys != $category->categoryId){

                    echo "<option  value='$category->categoryId'>$category->name</option>";

                }
                elseif (empty($categorys)){

                    echo "<option value='$category->categoryId'>$category->name</option>";
                }

              //  echo "<option if( $categorys==$category->categoryId ){selected } value='$category->categoryId'>$category->name</option>";

            }
        }



    }

    public function insert(Request $r){

        $rules=[
            'itemName' => 'required|max:45',
            'itemCategory' => 'required|max:11',
            'resturantName' => 'required|max:11',
            'itemStatus' => 'required|max:15',
            'itemDetails'=>'',
            'ItemPicture'=>'required|image|mimes:jpeg,jpg',

        ];
        $messages = [
            // 'dimensions' => 'Image dimention should over 800px',
        ];
        $validator = Validator::make($r->all(), $rules,$messages)->validate();


        $item=new Item;
        $item->itemName=$r->itemName;
        $item->fkcategoryId=$r->itemCategory;
        $item->fkresturantId=$r->resturantName;
        $item->status=$r->itemStatus;
        $item->itemDetails=$r->itemDetails;

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
            $test='<div class="table table-responsive">';
            $test.='<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle orderexmple">';
            foreach ($itemSize as $size){
                $test.='<tr>';
                $test.='<td class="center">'.$size->itemsizeName.'</td>';
                $test.='<td class="center">'.$size->price.'</td>';
                $test.='<td class="center">'.$size->status.'</td>';
                $test.='<td class="center">'.
                    '<a  class="btn btn-info btn-xs" href="'. route('itemSize.edit',$size->itemsizeId).'" data-panel-id="'.$size->itemsizeId.'">
                     <i class="fa fa-edit"></i>
                     </a>'. '</td>';

                $test.='</tr>';
            }
            $test.='</table>';
            $test.='</div>';
            $test.='<a data-panel-id="'.$item->itemId.'" href="'. route('itemSize.add',$item->itemId).'"  style="height:35px; width: 100%; margin:0 auto" class="btn btn-success "><i style="font-size: 25px; margin-top: 1px;" class="fa fa-plus-circle"></i></a>';
            return $test;

        })->make(true);


    }

    public function edit($itemId){



        $items=Item::select('item.image','item.itemName','item.itemDetails','item.itemId','item.status','item.fkresturantId','category.name as catName','item.fkcategoryId')
            ->leftJoin('category', 'category.categoryId', '=', 'item.fkcategoryId')
            ->where('item.itemId',$itemId)->get();

        $resName=Resturant::select('resturantId','name')->orderBy('name','ASC')->get();

        return view('item.edit')
            ->with('resName',$resName)
            ->with('items',$items);
    }

    public function update($itemId,Request $r){

        $rules=[
            'itemName' => 'required|max:45',
            'itemCategory' => 'required|max:11',
            'resturantName' => 'required|max:11',
            'itemStatus' => 'required|max:15',
            'itemDetails'=>'',
            'ItemPicture'=>'image|mimes:jpeg,jpg',

        ];
        $messages = [
            // 'dimensions' => 'Image dimention should over 800px',
        ];
        $validator = Validator::make($r->all(), $rules,$messages)->validate();


        $items=Item::findOrFail($itemId);

        $items->itemName=$r->itemName;
        $items->fkcategoryId=$r->itemCategory;
        $items->fkresturantId=$r->resturantName;
        $items->status=$r->itemStatus;
        $items->itemDetails=$r->itemDetails;


        //Check If the form has Image File
        if($r->hasFile('ItemPicture')){
            $img = $r->file('ItemPicture');

            $filename= $items->itemId.'ItemPicture'.'.'.$img->getClientOriginalExtension();

            $items->image=$filename;

            $location = public_path('ItemImages/'.$filename);
//            Image::make($img)->resize(800,600)->save($location);
            Image::make($img)->save($location);
        }

        $items->save();

        Session::flash('message', 'Item Updated Successfully');
        return back();


    }

    public function editItemSize($id){

        $itemSizes=Itemsize::findOrFail($id);


        return view('item.editItemSize')
            ->with('itemSize',$itemSizes);
    }

    public function updateItemSize($itemSizeId,Request $r){

        $rules=[
            'itemSizeName' => 'required|max:45',
            'itemPrice' => 'required',
            'itemSizeStatus' => 'required|max:15',

        ];
        $messages = [
            // 'dimensions' => 'Image dimention should over 800px',
        ];
        $validator = Validator::make($r->all(), $rules,$messages)->validate();


        $itemSize=Itemsize::findOrFail($itemSizeId);

        $itemSize->itemsizeName=$r->itemSizeName;
        $itemSize->price=$r->itemPrice;
        $itemSize->status=$r->itemSizeStatus;


        $itemSize->save();

        Session::flash('message', 'Item Size Updated Successfully');
        return back();


    }

    public function addItemSize($id){


        return view('item.addItemSize')
            ->with('itemId',$id);
    }

    public function fullImageShow($imageName){

    return view('item.showImage')->with('image',$imageName);
}

    public function insertItemSize($itemId,Request $r){

        $rules=[
            'itemSizeName' => 'required|max:45',
            'itemPrice' => 'required',
            'itemSizeStatus' => 'required|max:15',

        ];
        $messages = [
            // 'dimensions' => 'Image dimention should over 800px',
        ];
        $validator = Validator::make($r->all(), $rules,$messages)->validate();

        $itemSize=new Itemsize;

        $itemSize->item_itemId=$itemId;
        $itemSize->itemsizeName=$r->itemSizeName;
        $itemSize->price=$r->itemPrice;
        $itemSize->status=$r->itemSizeStatus;


        $itemSize->save();

        Session::flash('message', 'Item Size Insert Successfully');
        return back();


    }

    public function deleteItemImage($itemId){


        $items=Item::findOrFail($itemId);

        if (!empty($items->image)) {
            $filePath = public_path('ItemImages/' . $items->image);

            if (file_exists($filePath)) {
                @unlink($filePath);
            }

            $items->image = null;

            $items->save();

            Session::flash('message', 'Item Image Deleted Successfully');
            return back();
        }


    }

    public function showBack(Request $r){

        if (!empty($r->resId) && !empty($r->cat)) {

            Session::flash('resNameFlash', $r->resId);
            Session::flash('catIdFlash', $r->cat);
        }elseif(!empty($r->itemSizeId)){

            $itemSizes=Itemsize::select('item.fkcategoryId','item.fkresturantId')
                ->leftJoin('item', 'item.itemId', '=', 'itemsize.item_itemId')
                ->where('itemsize.itemsizeId',$r->itemSizeId)->get();

            foreach ($itemSizes as $items){

                Session::flash('resNameFlash', $items->fkresturantId);
                Session::flash('catIdFlash', $items->fkcategoryId);

            }



        }


    }
}
