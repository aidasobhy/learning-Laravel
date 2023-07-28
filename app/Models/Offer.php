<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table='offers';
    protected $fillable=['name_ar','name_en','photo','price','details_ar','details_en','status','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];



    //global scope
//    protected static function boot()
//    {
//        parent::boot();
//
//        static::addGlobalScope(new OfferScope());
//    }

    //local scope

//    public function scopeInactive()
//    {
//        return $this->where('status',0);
//    }

    public function scopeInvalid()
    {
        return $this->where('status',0)->whereNull('details_en');
    }


    //Mutators


    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = strtoupper($value);
    }

}
