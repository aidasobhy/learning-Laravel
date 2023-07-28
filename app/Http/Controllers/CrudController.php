<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Scopes\OfferScope;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{
    use OfferTrait;
    public function __construct()
    {
    }

    public function getOffers()
    {
        return Offer::get();
    }

    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {
        //save photo in  folder

      $file_name=$this->saveImages($request->photo,'images/offers');

        Offer::create([
            'name_ar'    =>$request->name_ar,
            'name_en'    =>$request->name_en,
            'photo'      =>$file_name,
            'price'      =>$request->price,
            'details_ar' =>$request->details_ar,
            'details_en' =>$request->details_en,
       ]);

        return redirect()->
        route('offers.all')
            ->with(['success'=>__('messages.offer add successfully')]);
    }

    public function getAllOffers()
    {
       $offers=Offer::select(
           'id',
           'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
           'price',
           'photo',
           'details_'.LaravelLocalization::getCurrentLocale() . ' as details'
       )->paginate(PAGINATION_COUNT);

        return view('offers.all',compact('offers'));
    }


    public function editOffer($offer_id)
    {
        $offer=Offer::find($offer_id);
        if(!$offer){
           return redirect()->back();
        }

        $offer=Offer::select(
            'id',
            'name_ar',
            'name_en',
            'price',
            'details_ar',
            'details_en'
        )->find($offer_id);

        return view('offers.edit',compact('offer'));
    }

    public function updateOffer(OfferRequest $request,$offer_id)

    {
        //validate
        $offer=Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }
        $offer->update($request->all());
            return redirect()->back()->with(['success'=>__('messages.offer edit success')]);
    }

    public function deleteOffer($offer_id)
    {
          $offer=Offer::find($offer_id);
          if(!$offer)
          {
              return redirect()->
              route('offers.all')->
              with(['error'=>__('messages.error in delete')]);
          }

          $offer->delete();
        return redirect()->
        route('offers.all')->
        with(['success'=>__('messages.success in delete')]);
    }




    public function getInactiveOffers()
    {
        //local scope
        //  return $inActiveOffers=Offer::inactive()->get();


        //global scope
//         return $inActiveOffers=Offer::get();

         //remove global scope
        return $inActiveOffers=Offer::withoutGlobalScope(OfferScope::class)->get();
    }

    //local scope
    public function getInvalidOffers()
    {
        return $invalidOffers=Offer::invalid()->get();
    }

}
