<?php

namespace App\Http\Controllers;
use App\Models\patient;
use App\Models\doctor;
use App\Models\ward;
use App\Models\departments;
use Illuminate\Http\Request;



class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       $patients = patient::all();
        return view('AdminPanel/patient/patientdetail',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //for doctor foreign key
        $items = doctor::select('id','doc_fname')->get();
        
        $doctorName = array();
        foreach( $items as $item )
        {
            $doctorName[$item->id] = $item->doc_fname;
        }

         //for department foreign key
        $departs = departments::select('id','dep_name')->get();
        
        $departname = array();
        foreach( $departs as $depart )
        {
            $departname[$depart->id] = $depart->dep_name;
        }

         //for ward foreign key
        $wardsname = ward::select('id','ward_name')->get();
        
        $wardnamelist = array();
        foreach( $wardsname as $ward )
        {
            $wardnamelist[$ward->id] = $ward->ward_name;
        }
        
        return view('AdminPanel/patient/add_patient',compact('doctorName','departname','wardnamelist'));
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Fname' => 'required',
            'lname' => 'required',
            'guradian_name' => 'required',
            'guradian_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'date_of_birth' => 'required',
            'addmission_date' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'pat_category' => 'required',
            'pat_case' => 'required',
            'pat_symptoms' => 'required',
            'ward' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'doctor' => 'required',
            'department' => 'required',
            'status' => 'required',
            
        ],[],[
            'Fname' => 'first name',
            'lname' => 'last name',
            'guradian_name' => 'Guardian Name',
            'guradian_phone' => 'Guardian Phone',
            'date_of_birth' => 'date of birth',
            'addmission_date' => 'addmission date',
            'email' => 'email',
            'gender' => 'gender',
            'pat_category' => 'patient category',
            'pat_case' => 'Case',
            'pat_symptoms' => 'Symptoms',
            'address' => 'address',
            'ward' => 'Ward Name',
            'phone' => 'phone',
            'doctor' => 'doctor',
            'department' => 'department',
            'status' => 'status',
        ]);
        patient::create([
            'pat_fname' => $request->Fname,
            'pat_lname' => $request->lname,
            'guradian_name' => $request->guradian_name,
            'guradian_phone' => $request->guradian_phone,
            'pat_phone' => $request->phone,
            'pat_admission_date' => $request->addmission_date,
            'pat_gender' => $request->gender,
            'pat_category' => $request->pat_category,
            'pat_case' =>  $request->pat_case,
            'pat_symptoms' => $request->pat_symptoms,
            'pat_email' => $request->email,
            'pat_address' => $request->address,
            'pat_date_of_birth' => $request->date_of_birth,
            'ward' => $request->ward,
            'doctor' => $request->doctor,
            'department' => $request->department,
            'status' => $request->status,
        ]);
        return redirect(route('patient.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient_edit  = patient::where('id' , $id)->first();

        $items = doctor::select('id','doc_fname')->get();
        $doctorName = array();
        foreach( $items as $item )
        {
            $doctorName[$item->id] = $item->doc_fname;
        }

        $dep_name = departments::all();
        $department_data = array();

        foreach( $dep_name as $departments )
        {            
            $department_data[$departments->id] = $departments->dep_name; 
        }

        return view('AdminPanel/patient/edit_patient',compact('patient_edit','department_data','doctorName') );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Fname' => 'required',
            'lname' => 'required',
            'date_of_birth' => 'required',
            'addmission_date' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'pat_category' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'doctor' => 'required',
            'department' => 'required',
            'status' => 'required',
            
        ],[],[
            'Fname' => 'first name',
            'lname' => 'last name',
            'date_of_birth' => 'date of birth',
            'addmission_date' => 'addmission date',
            'email' => 'email',
            'gender' => 'gender',
            'pat_category' => 'patient category',
            'address' => 'address',
            'phone' => 'phone',
            'doctor' => 'doctor',
            'department' => 'department',
            'status' => 'status',
        ]);
        patient::where('id' , $id)->update([
            'pat_fname' => $request->Fname,
            'pat_lname' => $request->lname,
            'pat_phone' => $request->phone,
            'pat_admission_date' => $request->addmission_date,
            'pat_gender' => $request->gender,
            'pat_category' => $request->pat_category,
            'pat_email' => $request->email,
            'pat_address' => $request->address,
            'pat_date_of_birth' => $request->date_of_birth,
            'status' => $request->status,
        ]);
        return redirect(route('patient.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        patient::where('id' , $id)->delete();
        return redirect(route('patient.index'));
    }
}
