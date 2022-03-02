<?php

namespace App\Http\Controllers;
use App\Models\disease;
use Illuminate\Http\Request;

class diseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disease = disease::all();
        return view('AdminPanel/disease/disease',['disease' => $disease]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel/disease/add_disease');
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
            'dis_name' => 'required',
            'dis_description' => 'required',
        ],[],[
            'dis_name'=>'Disease name',
            'dis_description' => 'Disease description',
        ]);

        disease::create([
            'dis_name' => $request->dis_name,
            'dis_description' => $request->dis_description,
        ]);
        return redirect(route('disease.index'));
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
        $diseaseedit  = disease::where('id' , $id)->first();
        return view('AdminPanel/disease/edit_disease',['diseaseedit' => $diseaseedit] );
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
            'dis_name' => 'required',
            'dis_description' => 'required',
        ],[],[
            'dis_name'=>'Disease name',
            'dis_description' => 'Disease description',
        ]);
        disease::where('id' , $id)->update([

            'dis_name' => $request->dis_name,
            'dis_description' => $request->dis_description,
        ]);
        return redirect(route('disease.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        disease::where('id' , $id)->delete();
        return redirect(route('disease.index'));
    }
}
