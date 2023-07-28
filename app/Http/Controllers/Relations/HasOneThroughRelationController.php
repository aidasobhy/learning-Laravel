<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class HasOneThroughRelationController extends Controller
{
    public function getPatientDoctor()
    {
      $patient=Patient::find(1);
     return $patient->doctor;
    }
}
