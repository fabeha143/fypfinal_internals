<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\employee_info;
use App\Models\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function index()
    {
        $data = ['LoggedUserInfo'=>employee_info::where('id','=',session('LoggedUser'))->first()];
        $posts = profile::all()->where('user_id',session('LoggedUser'));
        return view('Profile/profile',$data,compact('posts'));
    }
    public function post(Request $request)
    {
       profile::create([
           'posts' => $request->post,
           'user_id' => session('LoggedUser')

       ]);
       return redirect()->back()->with('message','Operation Successful !');
       
    }
    public function distroy($id)
    {
        profile::where('id' , $id)->delete();
        return redirect()->back();
    }
    public function updatesettings(Request $request,$id)
    {
        $request->validate([
            'username'=>'required',
            'email'=>'required|email',
            'password'=>'min:8|max:14|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'=>'min:8|max:14'
        ]);

        employee_info::where('id' , $id)->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return back()->with('success','Settings Updated');;
    }
}
 