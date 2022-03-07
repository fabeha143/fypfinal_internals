<?php

namespace App\Http\Controllers;
use App\Models\attendant_assigns;
use App\Models\inpatient_prescription;
use App\Models\patient;
use App\Models\employee;
use Illuminate\Http\Request;
use DB;


class attendantdashController extends Controller
{
    public function index()
    {
        

        return view('Attendant Dashboard/dashboard');
    }
    public function patientList()
    {
        $query = DB::table('employees')
        ->join('attendant_assigns', 'employees.id', '=', 'attendant_assigns.attendant_primary')
        ->join('patients', 'patients.ward', '=', 'attendant_assigns.ward')
        ->where('attendant_assigns.attendant_primary', session('LoggedUser'))
        ->get();
        return view('Attendant Dashboard/patients_schedule',compact('query'));
    }
    public function showprimary($id)
    {
        $current_date= date("Y-m-d");
        $query = inpatient_prescription::where([['patient_id','=',$id],['date','=',$current_date]])->get();
        return view('Attendant Dashboard/show_parimary',compact('query'));
    }
    
}
