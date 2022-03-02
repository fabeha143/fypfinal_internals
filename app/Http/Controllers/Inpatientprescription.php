<?php

namespace App\Http\Controllers;
use App\Models\inpatient_prescription;
use App\Models\patient;
use Illuminate\Http\Request;

class Inpatientprescription extends Controller
{
    public function index()
    {
        $patientdata = patient::where([
            ['status', 'Active'],
            ['doctor',session('LoggedUser')]])->get();

        // $prescription = inpatient_prescription::where('patient_id',$id)->get();
        return view('DoctorDashboard/InpatientPrescription',compact('patientdata'));
    }
    public function showPrescription($id)
    {
        $patients  = patient::where('id' , $id)->first();
        $prescriptions  = inpatient_prescription::where('patient_id' , $id)->get();
        return view('DoctorDashboard/Patient_prescriptions',['prescriptions'=>$prescriptions],compact('patients'));
    }
}
