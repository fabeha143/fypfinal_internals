<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class ApiController extends Controller
{
    public function employee()
    {
        $employee = employee::all();
        return response()->json($employee);
    }
    public function login()
    {
        return response()->view('AdminPanel.login');
    }
    public function check(Request $request)
    {
        //validate request 
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|',
            'password'=>'required|min:8|max:14',
        ]);
        if ($validator->fails()) {
             return response()->json(["fail"=>true, "validation_error" => $validator->errors()]); 
            }

                $userinfo = employee::where('email','=',$request->email)->first();
                
                if(!$userinfo){
                    return response()->json(['status'=>'fail']);
                }
                else
                {
        
                    if(Hash::check($request->password, $userinfo->password) and $userinfo->role == 'Admin'){
                    //    $request->session()->put('LoggedUser',$userinfo->id);
                       return response()->json(['success'=>true]);
                    }
                    elseif(Hash::check($request->password, $userinfo->password) and $userinfo->role == 'Attendant'){
                        // $request->session()->put('LoggedUser',$userinfo->id);
                        return response()->json(['success'=>true]);
                    }
                    else{
                        return response()->json(['status'=>'fail']);
                    }
                }
        

        
    }

    public function doctor()
    {
        $doctor = doctor::all();
        return response()->json($doctor);
    }
}
