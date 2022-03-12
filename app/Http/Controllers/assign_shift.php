<?php

namespace App\Http\Controllers;

use App\Models\shifts;
use App\Models\employee;
use App\Models\assign_shifts;
use Illuminate\Http\Request;

class assign_shift extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shiftsAssigned = assign_shifts::all();
        return view('AdminPanel/Shift Assigning/assign_shift',compact('shiftsAssigned'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //employee
        $items = employee::select('id','emp_fname')->where('role','Attendant')->get();
        $employee_name = array();
        foreach( $items as $item )
        {
            $employee_name[$item->id] = $item->emp_fname;
        }

         //for wards
         $shift = shifts::select('id','shift_name')->get();
         $shift_name = array();
         foreach( $shift as $list )
         {
             $shift_name[$list->id] = $list->shift_name;
         }
         return view('AdminPanel/Shift Assigning/add_assign_shift',compact('employee_name','shift_name'));
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
            'attendant' => 'required',
            'shift' => 'required',
            
    ],[],[
        'attendant'=>'attendant name',
        'shift' => 'shift',
        
    ]);
        
    assign_shifts::create([
                'attendant' => $request->attendant,
                'shift' => $request->shift,
            ]);
        return redirect(route('assignedshift.index'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        assign_shifts::where('id' , $id)->delete();
        return redirect(route('assignedshift.index'));//
    }
}
