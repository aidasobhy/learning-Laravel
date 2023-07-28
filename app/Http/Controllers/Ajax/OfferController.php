<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;
use function response;
use function view;

class OfferController extends Controller
{
    use OfferTrait;

    public function create()
    {
        return view('ajaxoffers.create');
    }

    public function store(OfferRequest $request)
    {
        //save to db using ajax
        $file_name = $this->saveImages($request->photo, 'images/offers');

        $offer = Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'photo' => $file_name,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        if ($offer) {
            return response()->json([
                'status' => true,
                'msg' => 'Saved Successfully'
            ]);
        }
        else {
            return response()->json([
                'status' => false,
                'msg' => 'Error In Saving'
            ]);
        }

    }

    public function all()
    {
        $offers = Offer::select(
            'id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'price',
            'photo',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
        )->get();

        return view('ajaxoffers.all', compact('offers'));
    }

    public function edit(OfferRequest $request)
    {
        $offer=Offer::find($request->offer_id);
        $offer=Offer::select(
            'id',
            'name_ar',
            'name_en',
            'price',
            'photo',
            'details_ar',
            'details_en'
        )->find($request->offer_id);

        return view('ajaxoffers.edit',compact('offer'));
    }

    public function update(OfferRequest $request)

    {

        $offer=Offer::find($request->id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'Error In Update'
            ]);
        }

        $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'Updated Successfully'
        ]);
    }

    public function delete(OfferRequest $request){

        $offer = Offer::find($request -> id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer){
            return response()->json([
                'status' => true,
                'msg' => 'Error In Deleting',
                'id' =>  $request -> id
            ]);;
        }


        $offer->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Offer Deleted Successfully',
            'id' =>  $request -> id
        ]);

    }

}
