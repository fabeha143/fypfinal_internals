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
                                    <th>Patient id</th>
                                    <th>Patient Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($query))
                                @foreach($query as $list)
                                    <tr>
                                    <td>{{ $list->id}}</td>
                                    <td>{{ $list->pat_fname}}</td>
                                    <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('/attendant/secondary/prescription',$list->id)}}">View Prescription Schedule</a>
                                    </td>
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
