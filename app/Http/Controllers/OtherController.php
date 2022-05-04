<?php

namespace App\Http\Controllers;
use App\Models\shifts;
use App\Models\ward;
use App\Models\assign_shifts;
use App\Models\attendant_assigns;
use App\Models\inpatient_prescription;
use App\Models\employee;
use Illuminate\Http\Request;
use App\Events\MessageNotification;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use \Illuminate\Notifications\Notifiable;
use App\Notifications\dos_reminder;
use App\Notifications\SlackNotification;
use Monolog\Handler\Slack\SlackRecord;


class OtherController extends Controller
{
    public function index()
    {
        $shiftsall = shifts::all();
        return view('AdminPanel/assignedAttendant',compact('shiftsall'));
    }
    public function see_attendant($id)
    {
        //ward
        $wards = ward::select('id','ward_name')->get();
        $ward_name = array();
        foreach( $wards as $ward )
        {
            $ward_name[$ward->id] = $ward->ward_name;
        }
        //attendant
        $users = assign_shifts::select('attendant')->where('shift',$id)->get();

        $query = DB::table('employees')
        ->join('assign_shifts', 'assign_shifts.attendant', '=', 'employees.id')
        ->where([['assign_shifts.shift', $id],['employees.role','=','Attendant']])
        ->get();
        $emp_name = array();
        foreach( $query as $item )
        {
            $emp_name[$item->attendant] = $item->emp_fname;
        }
        return view('AdminPanel/Dose Scheduling/show_schedule_attendant_create',compact('emp_name','ward_name'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'attendant_primary' => 'required',
            'attendant_secondary' => 'required',
            'ward' => 'required',
            
    ],[],[
        'attendant_primary'=>'attendant name',
        'attendant_secondary' => 'attendant name',
        'ward' => 'ward',
        
    ]);
        
            attendant_assigns::create([
                'attendant_primary' => $request->attendant_primary,
                'attendant_secondary' => $request->attendant_secondary,
                'ward' => $request->ward,
            ]);
            return back()->with('success2','Attendant Assigned');

    }
    public function assigned_attendantShow()
    {
        $attendant_assignsshow = attendant_assigns::all();
        return view('AdminPanel/Dose Scheduling/show_schedule',compact('attendant_assignsshow'));
    }
    public function destroy($id)
    {
        attendant_assigns::where('id' , $id)->delete();
        return back();
    }
    public function other(){
        $user = employee::find('1');
        $new = employee::all();
        Notification::send($user, new SlackNotification($new));
        
             
    }
}
