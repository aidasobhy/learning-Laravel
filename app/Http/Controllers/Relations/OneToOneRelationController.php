<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class OneToOneRelationController extends Controller
{
    public function hasOne()
    {
        $user = User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(4);

//        $phone=$user->phone;
//        return $user->phone->phone;
        return response()->json($user);

    }

    public function hasOneReverse()
    {
        $phone = Phone::with(['user' => function ($q) {
            $q->select('id', 'name');
        }])->find(1);

        $phone->makeVisible(['user_id']);
//         $phone->makeHidden(['code']);
        return $phone;
    }


    public function getUserHasPhone()
    {
        return User::whereHas('phone')->get();

    }

    public function getUserHasPhoneWithCode()
    {
        return User::whereHas('phone',function ($q){
            $q->where('code',02);
        })->get();
    }

    public function getUserNotHasPhone()
    {
            return User::whereDoesntHave('phone')->get();
    }

}
