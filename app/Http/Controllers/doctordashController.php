<?php

namespace App\Http\Controllers;
use App\Models\appointments;
use App\Models\doctor;
use App\Models\patient;
use DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class doctordashController extends Controller
{
    public function login()
    {
        return view('DoctorDashboard.logindoctor');
    }
    public function checkdoctor(Request $request)
    {
        //validate request 
        $request->validate([
            'email'=>'required|email|',
            'password'=>'required|min:8|max:14',
        ]);

        $doctorinfo = doctor::where('doc_email','=',$request->email)->first();
        if(!$doctorinfo){
            return back()->with('fail','We do not recognize you!!');
        }
        else{

            if(Hash::check($request->password, $doctorinfo->doc_password)){
               $request->session()->put('LoggedUser',$doctorinfo->id);
               return redirect(route('/dashboard/doctor'));
            }
            else{
                return back()->with('fail','Incorrect Password');
            }
        }
        
    }
    public function index()
    {
        return view('DoctorDashboard/doctordash');
    }
    public function doc_appointment()
    {
        $data = appointments::where([
            ['status','=','Approved'],
            ['doctor_name',session('LoggedUser')]])->get();
            
        
        return view('DoctorDashboard/doc_appointment',['appoint_data' => $data]);
    }
    public function inpatientlist()
    {

        $patientdata = patient::where([
            ['status', 'Active'],
            ['doctor',session('LoggedUser')]])->get();
        return view('DoctorDashboard/InPatientlist',['patientdata' => $patientdata]);
    }
   
}
    
