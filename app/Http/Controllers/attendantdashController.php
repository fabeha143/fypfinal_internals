<?php

namespace App\Http\Controllers;
use App\Models\attendant_assigns;
use App\Models\patient;
use Illuminate\Http\Request;
use DB;


class attendantdashController extends Controller
{
    public function index()
    {
        

        return view('Attendant Dashboard/dashboard');
    }
    public function showprimary()
    {
       
        return view('Attendant Dashboard/show_parimary');
    }
    
}
