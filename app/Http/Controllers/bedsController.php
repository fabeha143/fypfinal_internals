<?php

namespace App\Http\Controllers;
use App\Models\bed_categories;
use App\Models\beds;
use Illuminate\Http\Request;

class bedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $beds = beds::all();
        return view('AdminPanel/Beds/beds',['beds' => $beds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $add_bed_category = bed_categories::select('id','bed_category_name')->get();
        
        $bed_categories = array();
        foreach( $add_bed_category as $addcategory )
        {
            $bed_categories[$addcategory->id] = $addcategory->bed_category_name;
        }
        return view('AdminPanel/Beds/add_beds',compact('bed_categories'));
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
            'bed_name' => 'required',
            'bed_status' => 'required',
            'bed_category_id' => 'required',
            
        ],[],[
            'bed_name' => 'bed name',
            'bed_status' => 'bed status',
            'bed_category_id' => 'bed category',
            
        ]);

        beds::create([
            'bed_name' => $request->bed_name,
            'bed_status' => $request->bed_status,
            'bed_category_id' => $request->bed_category_id,
        ]);
        return redirect(route('bed.index'));
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
        $bed_edit  = beds::where('id' , $id)->first();

        $bed_category_edit = bed_categories::all();

        $bed_category_edits = array();
        foreach( $bed_category_edit as $bed_category )
        {            
            $bed_category_edits[$bed_category->id] = $bed_category->bed_category_name; 
        }

        return view('AdminPanel/Beds/edit_beds',compact('bed_category_edits','bed_edit') );
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
            'bed_name' => 'required',
            'bed_status' => 'required',
            'bed_category_id' => 'required',
            
        ],[],[
            'bed_name' => 'bed name',
            'bed_status' => 'bed status',
            'bed_category_id' => 'bed category',
            
        ]);

        beds::where('id' , $id)->update([
            'bed_name' => $request->bed_name,
            'bed_status' => $request->bed_status,
            'bed_category_id' => $request->bed_category_id,
        ]);
        return redirect(route('bed.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        beds::where('id' , $id)->delete();
        return redirect(route('bed.index'));
    }
}
