@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Attendant Scheduling</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Attendant Scheduling</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Attendant Primary</th>
                                    <th>Attendant Secondary</th>
                                    <th>Ward</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($attendant_assignsshow))
                                @foreach($attendant_assignsshow as $list)
                                <tr>
                                    <td>{{ $list->employees->emp_fname}} {{ $list->employees->emp_lname}}</td>
                                    <td>{{ $list->emplployees_secondary->emp_fname}} {{ $list->emplployees_secondary->emp_lname}}</td>
                                    <td>{{ $list->wards->ward_name}}</td>
                                    <td class="d-flex justify-content-center">
                                    <a class="btn btn-danger btn-sm" href="{{ url('/schedule/delete',$list->id)}}">Delete</a>

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
