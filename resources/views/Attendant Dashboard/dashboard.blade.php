@extends('layouts.attandantmaster')
@section('contentattendant')
<section class="content home">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Dashboard</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="{{ url('/attendant/primary/patientlist') }}"> <i class="zmdi zmdi-account col-blue"></i></a></div>
                    <div class="content">
                        <div class="text">Primary Wards</div>
                        <div class="number"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="{{ url('/attendant/secondary/patientlist') }}"><i class="zmdi zmdi-account col-green"></i></a> </div>
                    <div class="content">
                        <div class="text">Secondary Ward</div>
                        <div class="number"></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection()
