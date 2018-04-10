<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users=User::select('firstName','lastName','email','fkuserTypeId')->get();

        return view('user.index')
                    ->with('users',$users);
    }

    public function create(Request $r){

        $user=new User();
        $user->firstName=$r->firstName;
        $user->lastName=$r->lastName;
        $user->email=$r->email;
        $user->fkuserTypeId=User[1];
        $user->password=Hash::make($r->password);
        $user->save();

        return back();
    }
}
