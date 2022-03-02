<?php

namespace App\Http\Controllers;
use App\Models\patient;
use App\Models\medicines;
use App\Models\inpatient_prescription;
use Illuminate\Http\Request;
use Psy\Command\WhereamiCommand;

class InPatientController extends Controller
{
    public function index($id)
    {   
        $docid = patient::select('doctor')->where('id',$id)->get();
        $departid = patient::select('department')->where('id',$id)->get();
        $ward = patient::select('ward')->where('id',$id)->get();

        $patients  = patient::where('id' , $id)->first();

        $prescription = inpatient_prescription::where('patient_id',$id)->get();


        $items = medicines::select('id','med_name')->get();
        $medicine = array();
        foreach( $items as $item )
        {
            $medicine[$item->id] = $item->med_name;
        }
       
        return view('DoctorDashboard/write_prescription_inpatient',['patients' => $patients],compact('medicine','prescription'));
       
    }
    public function store(Request $request)
    {
        $request->validate([
            'medicines' => 'required',
            'type' => 'required',
            'unit' =>'required',
            'dose_frequency' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'comment' => 'required',
        ],[],[
            'medicines' => 'medicine',
            'type' => 'Type',
            'unit' =>'unit',
            'dose_frequency' => 'Dose Frequency',
            'start_date' => 'start date',
            'end_date' => 'end date',
            'comment' => 'comment',
        ]);

        
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $list = array();
        for ( $i = $start_date; $i <= $end_date; $i++ ){

            $stop_date = date('Y-m-d', strtotime($i));
            inpatient_prescription::create([
                'medicines' => $request->medicines,
                'type' => $request->type,
                'unit' =>$request->unit,
                'dose_frequency' => $request->dose_frequency,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'date' => $stop_date,
                'morning_time'=>$request->morning_time,
                'evening_time'=>$request->evening_time,
                'night_time'=>$request->night_time,
                'comment' => $request->comment,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id,
                'department_id' => $request->department_id,
                'ward_id'=>$request->ward_id,
            ]);
        }
        return back()->with('success','Prescription Added');
    
       
      
    }
    public function showPrescription($id)
    {
        $patients  = patient::where('id' , $id)->first();
        $patientsPres  = inpatient_prescription::where('patient_id' , $id)->first();
        return view('DoctorDashboard/Patient_prescriptions',['patientsPres'=>$patientsPres],compact('patients','patientsPres'));
    }
}
