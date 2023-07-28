<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $num=[1,1,7,9,2,2];
        $coll=collect($num);
//        return $coll->avg();

//        return $coll->count();

//        return $coll->countBy();


//        return $coll->duplicates();
//        $data=collect(['name','age']);
//        $res=$data->combine(['Ali',33]);
//        return $res;



    }


    public function allOffers()
    {

        //each =>make loop on collection and allow to add or remove column
        $offers=Offer::get();
////        return $offers;
//
//        $offers->each(function ($offer){
//             unset($offer->name_ar);
//             unset($offer->details_ar);
//             return $offer;
//        });
//        return $offers;

        $offers=collect($offers);
//        return $offers;

        //filter
//       $res= $offers->filter(function ($value,$key){
//          return  $value['status']==0;
//
//        });
//       return array_values($res->all());

        //transform
               $res= $offers->transform(function ($value,$key){
          return 'Name is: '.  $value['name_ar'];

        });
       return array_values($res->all());
    }


}
