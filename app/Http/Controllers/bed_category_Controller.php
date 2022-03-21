<?php

namespace App\Http\Controllers;
use App\Models\bed_categories;
use App\Models\ward;
use Illuminate\Http\Request;

class bed_category_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bedCategory = bed_categories::all();
        return view('AdminPanel/BedCategories/bed_category',['bedCategory' => $bedCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $addwards = ward::select('id','ward_name')->get();
        
        $ward = array();
        foreach( $addwards as $addward )
        {
            $ward[$addward->id] = $addward->ward_name;
        }
        return view('AdminPanel/BedCategories/add_bed_category',compact('ward'));
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
            'bed_category_name' => 'required',
            'ward_id' => 'required',
            'bed_category_details' => 'required',
            
        ],[],[
            'bed_category_name' => 'bed category name',
            'ward_id' => 'ward',
            'bed_category_details' => 'bed category detail',
            
        ]);

        bed_categories::create([
            'bed_category_name' => $request->bed_category_name,
            'ward_id' => $request->ward_id,
            'bed_category_details' => $request->bed_category_details,
        ]);
        return redirect(route('bedcategory.index'));
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
        
        $bedEdit  = bed_categories::where('id' , $id)->first();

        $ward_edit = ward::all();

        $wardEdit = array();
        foreach( $ward_edit as $ward )
        {            
            $wardEdit[$ward->id] = $ward->ward_name; 
        }

        return view('AdminPanel/BedCategories/edit_bed_category',compact('wardEdit','bedEdit') );
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
            'bed_category_name' => 'required',
            'ward_id' => 'required',
            'bed_category_details' => 'required',
            
        ],[],[
            'bed_category_name' => 'bed category name',
            'ward_id' => 'ward',
            'bed_category_details' => 'bed category detail',
            
        ]);
        bed_categories::where('id' , $id)->update([
            'bed_category_name' => $request->bed_category_name,
            'ward_id' => $request->ward_id,
            'bed_category_details' => $request->bed_category_details,
        ]);
        return redirect(route('bedcategory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        bed_categories::where('id' , $id)->delete();
        return redirect(route('bedcategory.index'));
    }
}
