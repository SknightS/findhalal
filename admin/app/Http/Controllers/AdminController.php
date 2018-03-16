<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $regiteredUser=10;
        $visitors=10;
        $message=5;
        $subcriber=50;

        return view('index')
            ->with('regiteredUser',$regiteredUser)
            ->with('visitors',$visitors)
            ->with('subcriber',$subcriber)
            ->with('message',$message);
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
