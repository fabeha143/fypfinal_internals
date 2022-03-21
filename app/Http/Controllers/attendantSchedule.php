<?php

namespace App\Http\Controllers;

use App\Models\attendant_assigns;
use App\Models\assign_shifts;
use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\ward;
use DateTime;
use DB;

class attendantSchedule extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = attendant_assigns::all();
        return view('AdminPanel/Dose Scheduling/show_schedule',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //for employee
        $items = employee::select('id','emp_fname')->where('role','Attendant')->get();
        $employee_name = array();

        foreach( $items as $item )
        {
            $employee_name[$item->id] = $item->emp_fname;
        }

        //for wards
        $wards = ward::select('id','ward_name')->get();
        $ward_name = array();
        foreach( $wards as $ward )
        {
            $ward_name[$ward->id] = $ward->ward_name;
        }
        return view('AdminPanel/Dose Scheduling/create_sched',compact('employee_name','ward_name'));
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
        return redirect(route('schedule.index'));
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
        $editAttandent  = attendant_assigns::where('id' , $id)->first();

        $items = employee::select('id','emp_fname')->where('role','Attendant')->get();
        $employee_name = array();
        foreach( $items as $item )
        {
            $employee_name[$item->id] = $item->emp_fname;
        }

        //for wards
        $wards = ward::select('id','ward_name')->get();
        $ward_name = array();
        foreach( $wards as $ward )
        {
            $ward_name[$ward->id] = $ward->ward_name;
        }
        return view('AdminPanel/Dose Scheduling/edit_schedule',['editAttandent' => $editAttandent],compact('employee_name','ward_name') );
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
            'attendant_primary' => 'required',
            'attendant_secondary' => 'required',
            'ward' => 'required',
            
    ],[],[
        'attendant_primary'=>'attendant name',
        'attendant_secondary' => 'attendant name',
        'ward' => 'ward',
        
    ]);
        
    attendant_assigns::where('id' , $id)->update([
                'attendant_primary' => $request->attendant_primary,
                'attendant_secondary' => $request->attendant_secondary,
                'ward' => $request->ward,
            ]);
        return redirect(route('scheduleshow.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        attendant_assigns::where('id' , $id)->delete();
        return redirect(route('scheduleshow.index'));
    }
}
