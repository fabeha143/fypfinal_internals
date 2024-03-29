@extends('layouts.doctormaster')
@section('contentdoctor')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Appointment List</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Appointment</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Date Of Birth</th>
                                    <th>Phone Number</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($appoint_data))
                                @foreach($appoint_data as $list)
                                    <tr>
                                        <td>{{ $list->patient_name}}</td>
                                        <td>{{ $list->patient_dob}}</td>
                                        <td>{{ $list->phone_number}}</td>
                                        <td>{{ $list->appointment_date}}</td>
                                        <td>{{ $list->appointment_time}}</td>
                                        <td>{{ $list->status}}</td>
                                        
                                    </tr>
                                
                                @endforeach
                                @else
                            <tr>
                                <td colspan="7">No Data found!!</td>
                            </tr>
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
