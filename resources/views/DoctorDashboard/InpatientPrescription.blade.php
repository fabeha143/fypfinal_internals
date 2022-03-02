@extends('layouts.doctormaster')
@section('contentdoctor')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>In Patient Prescription List</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>In Patient Prescription List</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Doctor Name</th>
                                    <th>Department Name</th>
                                    <th>Ward Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($patientdata))
                                @foreach($patientdata as $list)

                                <tr>
                                    <td>{{ $list->pat_fname}} {{ $list->pat_lname}}</td>
                                    <td>{{ $list->doctors->doc_fname}} {{ $list->doctors->doc_lname}}</td>
                                    <td>{{ $list->departments->dep_name}}</td>
                                    <td>{{ $list->wards->ward_name}}</td>
                                    <td>
                                    {{ Form::open(array('url' => route('showPrescription',['id' => $list->id]), 'method' => 'get' , 'class' => 'body')) }}

                                        <button type="submit" class="btn btn-raised g-bg-cyan">View Prescription</button>
                                    {{ Form::close() }}
                                    </td>
                                    
                                    
                                </tr>
                                @endforeach
                            @endif
                                    
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection()