<?php

namespace App\Http\Controllers;
use App\Models\ward;
use Illuminate\Http\Request;

class wardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wards = ward::all();
        return view('AdminPanel/wards/ward',['wards' => $wards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel/wards/add_ward');
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
            'ward_name' => 'required',
            'ward_description' => 'required',
        ],[],[
            'ward_name'=>'Ward name',
            'ward_description' => 'Ward description',
        ]);

        ward::create([
            'ward_name' => $request->ward_name,
            'ward_description' => $request->ward_description,
        ]);
        return redirect(route('wards.index'));
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
        $wardedit  = ward::where('id' , $id)->first();
        return view('AdminPanel/wards/edit_ward',['wardedit' => $wardedit] );
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
            'ward_name' => 'required',
            'ward_description' => 'required',
        ],[],[
            'ward_name'=>'Ward name',
            'ward_description' => 'Ward description',
        ]);

        ward::where('id' , $id)->update([
            'ward_name' => $request->ward_name,
            'ward_description' => $request->ward_description,
        ]);
        return redirect(route('wards.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ward::where('id' , $id)->delete();
        return redirect(route('wards.index'));
    }
}
