<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Session;
use App\Task;

use Analytics;
use Spatie\Analytics\Period;

use App\Libraries\GoogleAnalytics;




class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $task=Task::orderBy('taskId','desc')
                ->limit(6)
                ->get();
        $regiteredUser=10;

        $message=5;
        $subcriber=50;


//fetch visitors and page views for currentdate
        $analyticsData_one = Analytics::fetchTotalVisitorsAndPageViews(Period::days(0));
        $this->data['dates'] = $analyticsData_one->pluck('date');
        $visitors = $analyticsData_one->pluck('visitors');
        $pageViews = $analyticsData_one->pluck('pageViews');

/* from documention*/
        //fetch the most visited pages for today and the past week
      // $testData1= Analytics::fetchMostVisitedPages(Period::days(7));

        //fetch visitors and page views for the past week
       // $testData2= Analytics::fetchVisitorsAndPageViews(Period::days(7));

        /*-------------*/

        /* this is necessary if needed */
         $analyticsData_two = Analytics::fetchVisitorsAndPageViews(Period::days(14));
         $this->data['two_dates'] = $analyticsData_two->pluck('date');
         $this->data['two_visitors'] = $analyticsData_two->pluck('visitors')->count();
         $this->data['two_pageTitle'] = $analyticsData_two->pluck('pageTitle')->count();

         $analyticsData_three = Analytics::fetchMostVisitedPages(Period::days(14));
         $this->data['three_url'] = $analyticsData_three->pluck('url');
         $this->data['three_pageTitle'] = $analyticsData_three->pluck('pageTitle');
         $this->data['three_pageViews'] = $analyticsData_three->pluck('pageViews');

        $this->data['browserjson'] = GoogleAnalytics::topbrowsers();

        $result = GoogleAnalytics::country();
        $this->data['country'] = $result->pluck('country');
        $this->data['country_sessions'] = $result->pluck('sessions');

//        return $analyticsData_two;

//    return $analyticsData_two;

        return view('index')
            ->with('regiteredUser',$regiteredUser)
            ->with('visitors',$visitors)
            ->with('subcriber',$subcriber)
            ->with('message',$message)
            ->with('tasks',$task)
            ->with('last14days',$analyticsData_two);
    }

    public function settings(){

        return view('settings');
    }

    public function changePass(Request $r){
        $user=User::findOrFail(Auth::user()->userId);
        $currentPass= Hash::make($r->oldPass);
        $newPass=Hash::make($r->newPass);
        if(Hash::check($r->oldPass, $user->password)){
            $user->password=$newPass;
            $user->save();
             Session::flash('message', 'Password changes successfully');
            return back();
        }
        Session::flash('message', 'Password did not match');
        return back();
    }


}
