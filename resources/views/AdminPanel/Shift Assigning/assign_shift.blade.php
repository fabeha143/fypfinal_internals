@extends('layouts.master')
@section('content')

<!-- #Float icon -->
<ul id="f-menu" class="mfbc-br mfb-zoomin" data-mfb-toggle="hover">
    <li class="mfbc_wrap">
        <a href="{{ route('assignedshift.create')}}" class="mfbcb-main g-bg-cyan">
            <i class="mfbcm-icon-resting zmdi zmdi-plus"></i>
            <i class="mfbcm-icon-active zmdi zmdi-close"></i>
        </a>
    </li>
</ul>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Assigned Shifts</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Shifts</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Attendant</th>
                                    <th>Shifts</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   @if(count($shiftsAssigned))
                                        @foreach($shiftsAssigned as $list)
                                            <tr>
                                                <td>{{ $list->employees->emp_fname}} {{ $list->employees->emp_lname}}</td>
                                                <td>{{ $list->shifts->shift_name}}</td>
                                                <td>
                                                        {!! Form::open(array('url' => route('assignedshift.destroy', ['assignedshift' => $list->id]), 'method' => 'delete')) !!}		
                                                            {!! Form::submit('Delete', array('class' => 'btn btn-danger openbutton')) !!}
                                                
                                                        {!! Form::close() !!}
                                                </td>
                                              
                                        
                                            </tr>
                                        @endforeach
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
