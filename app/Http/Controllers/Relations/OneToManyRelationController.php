<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class OneToManyRelationController extends Controller
{
   public function getHospitalDoctors()
   {
     $hospitals=Hospital::find(1);  //return data of hospital of id=1

//     return $hospitals->doctors; //return doctors where exist in this hospital

//      return Hospital::with(['doctors'=>function($q){
//          $q->select('name','title','hospital_id');
//      }])->find(1);



//       $doctors= $hospitals->doctors;
//       foreach ($doctors as $doctor)
//       {
//           echo $doctor->name .$doctor->title."<br>";
//       }
//
//            $doctor=Doctor::find(1);
//         return  $doctor->hospital;

   }

   public function hospitals()
   {
      $hospitals=Hospital::select(
         'id',
         'name',
         'address'
       )->get();

      return view('doctors.hospitals',compact('hospitals'));
   }

   public function doctors($hospital_id)
   {
      $hospital=Hospital::find($hospital_id);
      $doctors=$hospital->doctors;
      return view('doctors.doctors',compact('doctors'));
   }

   public function getHospitalHasDoctor()
   {
       //return hospital that has doctors
      $hospitals=Hospital::whereHas('doctors')->get(); //get hospitals has doctors
      return $hospitals;
   }


   public function getHospitalHasOnlyMale()
   {
       //return hospital that has doctors only male
       $hospitals=Hospital::with('doctors')->whereHas('doctors',function ($q){
           $q->where('gender',1);
       })->get();

       return $hospitals;
   }


   public function hospitalsNotHaveDoctors()
   {
       //return hospital that not has doctors
      return Hospital::whereDoesntHave('doctors')->get();
   }

   public function hospitalDelete($hospital_id)
   {
       //delete hospitals and with doctors
      $hospital=Hospital::find($hospital_id);
      if(!$hospital)
      {
          return redirect()->route('hospitals.all')->with(['error'=>'Error In Deleting']);
      }
      else
      {
          $hospital->doctors()->delete();
          $hospital->delete();
          return redirect()->route('hospitals.all')->with(['success'=>'Hospital Deleted Successfully']);
      }
   }
}
