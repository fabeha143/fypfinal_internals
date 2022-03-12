<?php

namespace App\Http\Controllers;
use App\Models\shifts;

use Illuminate\Http\Request;

class shiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = shifts::all();
        return view('AdminPanel/shifts/shifts',['shifts' => $shifts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel/shifts/add_shifts');
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
            'shift_name' => 'required',
            'shift_from' => 'required',
            'shift_to' => 'required',
            'shift_description' => 'required',
        ],[],[
            'shift_name'=>'shift name',
            'shift_from' => 'shift from',
            'shift_to' => 'shift to',
            'shift_description' => 'shift description',
        ]);

        shifts::create([
            'shift_name' => $request->shift_name,
            'shift_from' => $request->shift_from,
            'shift_to' => $request->shift_to,
            'shift_description' => $request->shift_description,
        ]);
        return redirect(route('shift.index'));
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
        $shiftedit  = shifts::where('id' , $id)->first();
        return view('AdminPanel/shifts/edit_shifts',['shiftedit' => $shiftedit] );
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
            'shift_name' => 'required',
            'shift_from' => 'required',
            'shift_to' => 'required',
            'shift_description' => 'required',
        ],[],[
            'shift_name'=>'shift name',
            'shift_from' => 'shift from',
            'shift_to' => 'shift to',
            'shift_description' => 'shift description',
        ]);

        shifts::where('id' , $id)->update([
            'shift_name' => $request->shift_name,
            'shift_from' => $request->shift_from,
            'shift_to' => $request->shift_to,
            'shift_description' => $request->shift_description,
        ]);
        return redirect(route('shift.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        shifts::where('id' , $id)->delete();
        return redirect(route('shift.index'));
    }
}
