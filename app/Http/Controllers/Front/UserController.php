<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class UserController extends Controller
{
    public function showUserName(){
        return "Aida Sobhy";
    }

    //load view
    public function getIndex()
    {
        //pass variable to view
//        return view('welcome')->with(['name'=>'Aida Sobhy','age'=>23]); //this not popular;

        //with array
//        $data=[];
//        $data['name']="Aida Sobhy";
//        $data['id']=5;
//        $data['gender']='Female';
//        return view('welcome',$data);

        //with obj
//        $obj= new \stdClass();
//        $obj->name="Aida Sobhi";
//        $obj->age=23;

        $data=[];
        return view('welcome',compact('data'));
    }

    public function getLandingPage()
    {
        return view('landing');
    }

    public function getAboutUs()
    {
        return view('about');
    }


    public function getContact()
    {
        return view('contact');
    }

}
