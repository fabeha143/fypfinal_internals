<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departments;
use App\Models\doctor;
use Doctors;
use Illuminate\Support\Facades\Hash;

class doctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = doctor::all();
        return view('AdminPanel/doctor/doctor',['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = departments::select('id','dep_name')->get();
        
        $department = array();
        foreach( $items as $item )
        {
            $department[$item->id] = $item->dep_name;
        }


        
        return view('AdminPanel/doctor/add_doctor',compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Fname' => 'required',
            'lname' => 'required',
            'dateofbirth' => 'required',
            'gender' => 'required',
            'doc_department' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'email' => 'required|email',
            'password' => 'min:8|max:14|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8|max:14',
            'address' => 'required',
            'doc_biography' => 'required',
            'files.*' => 'mimes:doc,pdf,docx,zip'
    ],[],[
        'Fname'=>'First Name',
        'lname' => 'Last Name',
        'dateofbirth' => 'Date Of Birth',
        'gender' => 'Gender',
        'doc_department' => 'Department',
        'phone' => 'Phone Number',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'password confirmation',
        'address' => 'Address',
        'doc_biography' => 'Biography',
    ]);
        if($files = $request->file('files')){
            foreach($files as $file){
                $reImage = time() .rand(1,100). '.' .$file->extension();
                $dest = public_path('Doc_files');
                $file->move($dest,$reImage);
                $imageData[] = $reImage;
                
            }
            doctor::create([
                'doc_fname' => $request->Fname,
                'doc_lname' => $request->lname,
                'doc_date_of_birth' => $request->dateofbirth,
                'doc_gender' => $request->gender,
                'doc_department' => $request->doc_department,
                'doc_phone' => $request->phone,
                'doc_email' => $request->email,
                'doc_password' => Hash::make($request->password),
                'doc_address' => $request->address,
                'doc_biography' => $request->doc_biography,
                'doc_files' => implode('|',$imageData),
               
            ]);
        }
        return redirect(route('doctor.index'));
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
        $doctoredit  = doctor::where('id' , $id)->first();

        $dep_name = departments::all();
        $department_data = array();

        foreach( $dep_name as $departments )
        {            
            $department_data[$departments->id] = $departments->dep_name; 
        }
        return view('AdminPanel/doctor/edit_doctor',compact('doctoredit','department_data'));
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
        $this->validate($request, [
            'Fname' => 'required',
            'lname' => 'required',
            'dateofbirth' => 'required',
            'gender' => 'required',
            'doc_department' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'email' => 'required|email',
            'password' => 'min:8|max:14|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8|max:14',
            'address' => 'required',
            'doc_biography' => 'required',
            'files.*' => 'mimes:doc,pdf,docx,zip'
            ],[],[
                'Fname'=>'First Name',
                'lname' => 'Last Name',
                'dateofbirth' => 'Date Of Birth',
                'gender' => 'Gender',
                'doc_department' => 'Department',
                'phone' => 'Phone Number',
                'email' => 'Email',
                'password' => 'Password',
                'password_confirmation' => 'password confirmation',
                'address' => 'Address',
                'doc_biography' => 'Biography',
            ]);
        if($files = $request->file('files')){
            foreach($files as $file){
                $reImage = time() .rand(1,100). '.' .$file->extension();
                $dest = public_path('Doc_files');
                $file->move($dest,$reImage);
                $imageData[] = $reImage;
                
            }
        
        doctor::where('id' , $id)->update([
                'doc_fname' => $request->Fname,
                'doc_lname' => $request->lname,
                'doc_date_of_birth' => $request->dateofbirth,
                'doc_gender' => $request->gender,
                'doc_department' => $request->doc_department,
                'doc_phone' => $request->phone,
                'doc_email' => $request->email,
                'doc_email' => $request->email,
                'doc_password' => Hash::make($request->password),
                'doc_address' => $request->address,
                'doc_biography' => $request->doc_biography,
                'doc_files' => implode('|',$imageData),
        ]);
    }
        return redirect(route('doctor.index'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        doctor::where('id' , $id)->delete();
        return redirect(route('doctor.index'));
    }
}