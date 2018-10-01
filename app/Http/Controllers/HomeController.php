<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;
use App\Resturant;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Purchase;
use App\Rating;
use DB;


class HomeController extends Controller
{
    //

    public function index(){
        $featuredRes = Resturant::select('resturantId','name','image', 'zipcode.zip as zipcodeZip', 'zipcode.delfee as zipcodeDelfee')
            ->leftjoin('zipcode','fkresturantId','resturantId')
            ->leftjoin('city','fkcityId','cityId')
            ->where('featureResturant', "1")
            ->where('status',Status[0])
            ->get();
//        $resItem=Item::select(DB::raw('GROUP_CONCAT(itemName) AS itemNames'),'fkresturantId')->where('status',Status[0])
//            ->groupBy('fkresturantId')->get();
        $resCategory=Category::select(DB::raw('GROUP_CONCAT(category.name SEPARATOR " ") AS resCategoryName'),'fkresturantId')
            ->where('category.status',Status[0])
            ->groupBy('fkresturantId')->get();

        $featuredResCategory=Category::select('category.name')
            ->leftJoin('resturant', 'resturant.resturantId', '=', 'category.fkresturantId')
            ->where('resturant.featureResturant',"1")
            ->where('resturant.status',Status[0])
            ->where('category.status',Status[0])
            ->groupBy('category.name')->get();

        //return $featuredRes;




//        Top 6 sellers
//        SELECT `restaurantId`,SUM(`total`) as totalcost FROM `purchase` GROUP BY `restaurantId` order BY totalcost desc LIMIT 6
        $purchase=Purchase::select('purchase.restaurantId',DB::raw('SUM(purchase.total) as totalcost'))
            ->groupBy('restaurantId')
            ->orderBy('totalcost','desc')
            ->limit(6)
            ->get();
        $resID=array();
        foreach ($purchase as $p){
            array_push($resID,$p->restaurantId);
        }


        $topRestaurants=Resturant::select('resturantId','name','image','address','zipcode.zip as zipcodeZip', 'zipcode.delfee as zipcodeDelfee')
            ->leftjoin('zipcode','fkresturantId','resturantId')
            ->leftjoin('city','fkcityId','cityId')
            ->whereIn('resturantId',$resID)
            ->get();


        $resRating=Rating::select('restaurantId',DB::raw('COUNT(ratingId) as totalRating'),DB::raw('AVG(rating) as avgRating'))->groupBy('restaurantId')->get();

       // return $resRating ;


//       End Top sellers

        return view('welcome')
            ->with('topRestaurants',$topRestaurants)
//            ->with('resItems',$resItem)
            ->with('resCategory',$resCategory)
            ->with('featuredResCategory',$featuredResCategory)
            ->with('restaurantRating', $resRating)
            ->with('featuredRes',$featuredRes);


    }


    public function contact(Request $r){


        $firstname = $r->fname;
        $lastname = $r->lname;



        Mail::send('contactmail',['contactInfo' => $r], function($message) use ($firstname , $lastname)
        {
            $message->from('support@findhalal.de', 'FindHalal');
            $message->to(FindhalalMail, $firstname.' '.$lastname)->subject('Contact');
        });

    }
}
