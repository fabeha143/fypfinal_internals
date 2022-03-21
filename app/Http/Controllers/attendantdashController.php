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
    public function patientList_primary()
    {
        $query = DB::table('patients')
        ->select(['patients.id','patients.pat_fname','bed'])
        ->join('attendant_assigns', 'patients.ward', '=', 'attendant_assigns.ward')
        ->where('attendant_assigns.attendant_primary', session('LoggedUser'))
        ->get();
        return view('Attendant Dashboard/patients_primary_schedule',compact('query'));
    }
    public function showprimary($id)
    {
        $current_date= date("Y-m-d");
        $query = inpatient_prescription::where([['patient_id','=',$id],['date','=',$current_date]])
        ->get();
        
        $patientName = patient::select('pat_fname')->where('id',$id)->get();
        return view('Attendant Dashboard/show_parimary',compact('query','patientName'));
    }

    public function patientList_secondary()
    {
        $query = DB::table('patients')
        ->select(['patients.id','patients.pat_fname','bed'])
        ->join('attendant_assigns', 'patients.ward', '=', 'attendant_assigns.ward')
        ->where('attendant_assigns.attendant_secondary', session('LoggedUser'))
        ->get();
        return view('Attendant Dashboard/patients_secondary_schedule',compact('query'));
    }
    public function showsecondary($id)
    {
        $current_date= date("Y-m-d");
        $query = inpatient_prescription::where([['patient_id','=',$id],['date','=',$current_date]])
        ->get();
        
        $patientName = patient::select('pat_fname')->where('id',$id)->get();
        return view('Attendant Dashboard/show_secondary',compact('query','patientName'));
    }
    
}
