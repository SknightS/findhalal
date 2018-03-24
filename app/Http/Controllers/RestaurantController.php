<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Itemsize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resturant;
use Darryldecode\Cart\Facades\CartFacade as Cart;
class RestaurantController extends Controller
{

    public function Restaurants(Request $r){


        $searchresult = Resturant::where('status','Active')
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

        $itemsize = Itemsize::select('*')
            ->where('status', 'Active')
            ->get();

        $cartCollection = Cart::getContent();

        return view('restaurants.profile')
            ->with('category', $catagory)
            ->with('restaurant', $restaurant)
            ->with('resid', $resid)
            ->with('itemsize', $itemsize)
            ->with('cartitem', $cartCollection);

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

    public function getItemByCategory(Request $r){
        $resid = $r->resid;
        $catid = $r->catid;

        $catagory = Category::select('*')
            ->where('fkresturantId', $resid)
            ->where('categoryId', $catid)

            ->get();
        $item = Item::select('item.*' ,'itemsize.*' )
            ->leftJoin('itemsize','itemsize.itemsizeId','=','itemsize.item_itemId')
            ->leftJoin('resturant','item.fkresturantId','=','resturant.resturantId')
            ->where('item.fkresturantId',$resid)
            ->where('item.fkcategoryId',$catid)
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

    public function addCart(Request $r){


        $itemid = $r->itemid;
        $item =  Item::select('item.*', 'itemsize.*')
            ->leftJoin('itemsize','itemsize.item_itemId','=','item.itemid')
            ->where('itemid', $itemid)
            ->limit(1)
            ->get();

        foreach ($item as $it){
            Cart::add(array(
                'id' => $it->itemId,
                'name' => $it->itemName,
                'price' => $it->price,
                'quantity' => 1,
                'attributes' => array(
                    'size' =>  $it->itemsizeId
                )
            ));
        }

    }

    //cartid and itemid is same
    public function updateItemSize(Request $r){
        $itemsize = $r->itemsize;
        $cartid = $r->cartid;
        $itemsize = Itemsize::select('*')
                    ->where('item_itemId',$cartid)
                    ->where('itemsizeId',$itemsize)
                    ->first();

        Cart::update($cartid, array(
            'price' => $itemsize->price, // new item name
            'attributes' => array(
                'size' =>  $itemsize->itemsizeId
            ) // new item price, price can also be a string format like so: '98.67'
        ));
    }

    public function updateItemQty(Request $r){
        $qty = $r->qty;
        $cartid = $r->cartid;

        Cart::update($cartid, array(
            'quantity' => $qty,

        ));
    }


}
