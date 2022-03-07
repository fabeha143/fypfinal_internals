@extends('layouts.attandantmaster')
@section('contentattendant')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Dose Scheduling</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Dose Scheduling</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Medicine</th>
                                    <th>Dose Frequency</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Morning Time</th>
                                    <th>Evening Time</th>
                                    <th>Night Time</th>
                                    <th>Morning Dose Giving</th>
                                    <th>Evening Dose Giving</th>
                                    <th>Night Dose Giving</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($query))
                                @foreach($query as $list)
                                    <tr>
                                    <td>{{ $list->patient_id}}</td>
                                    <td>{{ $list->medicines}}</td>
                                    <td>{{ $list->dose_frequency}}</td>
                                    <td>{{ $list->unit}}</td>
                                    <td>{{ $list->date}}</td>
                                    <td>{{ $list->morning_time}}</td>
                                    <td>{{ $list->evening_time}}</td>
                                    <td>{{ $list->night_time}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $list->comment}}</td>
                                    <tr>
                                @endforeach
                            @else
                            <td colspan="14">No Data found!!</td>
                            @endif
                            </tr>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection()
