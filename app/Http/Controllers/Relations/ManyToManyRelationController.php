<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class ManyToManyRelationController extends Controller
{
     public function getDoctorsServices()
     {
          //get doctors and services that make it
         $doctor=Doctor::with(['services'=>function($q){
             $q->select('services.id','name');
         }])->find(3);
         return $doctor;
     }

     public function getServicesDoctors()
     {
         //return service and doctor that present this service
         $service=Service::with(['doctors'=>function($q){
             $q->select('doctors.id','name','title');
         }])->find(1);
         return $service;
     }


     public function getDoctorsServicesById($doctor_id)
     {
         $doctor=Doctor::find($doctor_id);
         $services=$doctor->services;  //services of doctors

         $doctors=Doctor::select('id','name')->get();
         $allServices=Service::select('id','name')->get();
         return view('doctors.services',compact('services','doctors','allServices'));
     }


     public function saveService(Request $request)
     {

        $doctor=Doctor::find($request->doctor_id);
         if(!$doctor)
         {
             return abort('404');
         }

//        $doctor->services()->attach($request->service_id); //save many to many relation

//         $doctor->services()->sync($request->service_id); //save many to many relation

         $doctor->services()->syncWithoutDetaching($request->service_id); //save many to many relation


         return  redirect()->route('doctors.services',$request->doctor_id);
     }

     public function getDoctors()
     {
         $doctors=Doctor::select('name','gender')->get();
         return $doctors;
     }
}
