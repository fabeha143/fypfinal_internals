@extends('layouts.master')
@section('content')
<ul id="f-menu" class="mfbc-br mfb-zoomin" data-mfb-toggle="hover">
    <li class="mfbc_wrap">
        <a href="{{ route('schedule.create')}}" class="mfbcb-main g-bg-cyan">
            <i class="mfbcm-icon-resting zmdi zmdi-plus"></i>
            <i class="mfbcm-icon-active zmdi zmdi-close"></i>
        </a>
    </li>
</ul>
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
                            @if(count($schedules))
                                @foreach($schedules as $list)
                                <tr>
                                    <td>{{ $list->employees->emp_fname}} {{ $list->employees->emp_lname}}</td>
                                    <td>{{ $list->emplployees_secondary->emp_fname}} {{ $list->emplployees_secondary->emp_lname}}</td>
                                    <td>{{ $list->wards->ward_name}}</td>
                                    <td class="d-flex justify-content-center">
                                        {!! Form::open(array('url' => route('schedule.edit', ['schedule' => $list->id]), 'method' => 'get')) !!}
                                            {!! Form::submit('Edit', array('class' => 'btn btn-primary openbutton')) !!}
                                        {!! Form::close() !!}

                                        {!! Form::open(array('url' => route('schedule.destroy', ['schedule' => $list->id]), 'method' => 'delete')) !!}		
                                            {!! Form::submit('Delete', array('class' => 'btn btn-danger openbutton')) !!}
                                
                                        {!! Form::close() !!}

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
