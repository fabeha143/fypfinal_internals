<?php

namespace App\Http\Controllers;
use App\Models\appointments;
use Illuminate\Http\Request;
use App\Models\medicines;
use App\Models\departments;
use App\Models\doctor;
use Laravel\Ui\Presets\React;

class appointmentController extends Controller
{
    public function index()
    {
        $appointments = appointments::all();
        return view('AdminPanel/appointment/appointment',['appointments' => $appointments]);
    }
    public function add_appointment()
    {
        $items = departments::select('id','dep_name')->get();
        $department = array();
        foreach( $items as $item )
        {
            $department[$item->id] = $item->dep_name;
        }
        
        $doctors = doctor::select('id','doc_fname')->get();
        $doctorsdata = array();
        foreach( $doctors as $doctor )
        {
            $doctorsdata[$doctor->id] = $doctor->doc_fname;
        }
       return view('AdminPanel/appointment/add_appointment',compact('department','doctorsdata'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'patient_name'=>'required',
            'patient_dob' =>'required',
            'appointment_date' => 'required',
            'appointment_time' =>'required',
            'department' => 'required',
            'doctor_name' => 'required',
            'phone_number'=>'required',
        ]);
        appointments::create([
            'patient_name' => $request->patient_name,
            'patient_dob' => $request->patient_dob,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'department' => $request->department,
            'doctor_name' => $request->doctor_name,
            'phone_number'=>$request->phone_number,
        ]);
        return redirect()->back()->with('success','Appointment added');
    }
    public function approved($id)
    {
        $data = appointments::find($id);
        $data->status='Approved';
        $data->save();
        return redirect()->back();
    }
    public function cancel($id)
    {
        $data = appointments::find($id);
        $data->status='Cancel';
        $data->save();
        return redirect()->back();
    }
}
