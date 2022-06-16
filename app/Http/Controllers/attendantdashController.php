<?php

namespace App\Http\Controllers;
use App\Models\attendant_assigns;
use App\Models\inpatient_prescription;
use App\Models\patient;
use App\Models\employee;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

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
        ->join('employees','attendant_assigns.attendant_primary','employees.id')
        ->where('attendant_assigns.attendant_primary', session('LoggedUser'))
        ->get();
        return view('Attendant Dashboard/patients_primary_schedule',compact('query'));
    }
    
    public function showprimary($id)
    {
        $current_date= date("Y-m-d");
        $query = inpatient_prescription::where([['patient_id','=',$id],['date','=',$current_date]])
        ->get();
        
        $patientName = patient::select('id')->where('id',$id)->first();

        return view('Attendant Dashboard/show_parimary',compact('query','patientName'));
    }

    public function patientList_secondary()
    {
        $query = DB::table('patients')
        ->select(['patients.id','patients.pat_fname','bed'])
        ->join('attendant_assigns', 'patients.ward', '=', 'attendant_assigns.ward')
        ->join('employees','attendant_assigns.attendant_secondary','employees.id')
        ->where('attendant_assigns.attendant_secondary', session('LoggedUser'))
        ->get();
        return view('Attendant Dashboard/patients_secondary_schedule',compact('query'));
    }
    public function showsecondary($id)
    {
        $current_date= date("Y-m-d");
        $query = inpatient_prescription::where([['patient_id','=',$id],['date','=',$current_date]])
        ->get();
        
        $patientName = patient::select('id')->where('id',$id)->first();
        return view('Attendant Dashboard/show_secondary',compact('query','patientName'));  
    }
    public function morning_done($id , Request $request)
    {
        $current_date= date("Y-m-d");
        inpatient_prescription::where([['patient_id','=',$id],['date','=',$current_date]])->update([
            'morning_status' => 1,
        ]);
        
        return redirect()->back();
        
    }
    public function evening_done($id , Request $request)
    {
        $current_date= date("Y-m-d");
        inpatient_prescription::where([['patient_id','=',$id],['date','=',$current_date]])->update([
            'evening_status' => 1,
        ]);
        
        return redirect()->back();
        
    }
    public function night_done($id , Request $request)
    {
        $current_date= date("Y-m-d");
        inpatient_prescription::where([['patient_id','=',$id],['date','=',$current_date]])->update([
            'night_status' => 1,
        ]);
        
        return redirect()->back();
        
    }
    
}
