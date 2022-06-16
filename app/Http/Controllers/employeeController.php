<?php

namespace App\Http\Controllers;

use App\Models\employee_role;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Hash;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = employee::all();
        return view('AdminPanel/employee/employee',['employee' => $employee]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('AdminPanel/employee/add_employee');
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
            'gender' => 'required',
            'role' => 'required',
            'joining_date' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'address' => 'required',
            'username'=>'required',
            'email'=>'required|email|unique:employee_infos',
            'password'=>'min:8|max:14|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'=>'min:8|max:14'
        ],[],[
            'Fname' => 'first name',
            'lname' => 'last name',
            'gender' => 'gender',
            'role' => 'role',
            'joining_date' => 'joining date',
            'phone' => 'phone',
            'address' => 'address',
            'username'=>'username',
            'email'=>'email',
            'password'=>'password',
            'password_confirmation'=>'password'
        ]);
        employee::create([
            'emp_fname' => $request->Fname,
            'emp_lname' => $request->lname,
            'emp_email' => $request->email,
            'emp_gender' => $request->gender,
            'emp_joining_date' => $request->joining_date,
            'emp_phone' => $request->phone,
            'emp_address' => $request->address,
            'role' => $request->role,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'session_stored' => session('LoggedUser')
        ]);
        return back()->with('success1','Employee Added');
       
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
        $employeeEdit  = employee::where('id' , $id)->first();
        return view('AdminPanel/employee/edit_employee',compact('employeeEdit') );
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
            'gender' => 'required',
            'role' => 'required',
            'joining_date' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'address' => 'required',
            'username'=>'required',
            'email'=>'required|email|unique:employee_infos',
            'password'=>'min:8|max:14|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'=>'min:8|max:14'
        ],[],[
            'Fname' => 'first name',
            'lname' => 'last name',
            'gender' => 'gender',
            'role' => 'role',
            'joining_date' => 'joining date',
            'phone' => 'phone',
            'address' => 'address',
            'email'=>'email',
            'password'=>'password',
            'password_confirmation'=>'password'
        ]);
        employee::where('id' , $id)->update([
            'emp_fname' => $request->Fname,
            'emp_lname' => $request->lname,
            'emp_gender' => $request->gender,
            'emp_joining_date' => $request->joining_date,
            'emp_phone' => $request->phone,
            'emp_address' => $request->address,
            'role' => $request->role,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return redirect(route('employee.index'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        employee::where('id' , $id)->delete();
        return redirect(route('employee.index'));
    }
}
