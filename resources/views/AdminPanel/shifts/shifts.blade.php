@extends('layouts.master')
@section('content')

<!-- #Float icon -->
<ul id="f-menu" class="mfbc-br mfb-zoomin" data-mfb-toggle="hover">
    <li class="mfbc_wrap">
        <a href="{{ route('shift.create')}}" class="mfbcb-main g-bg-cyan">
            <i class="mfbcm-icon-resting zmdi zmdi-plus"></i>
            <i class="mfbcm-icon-active zmdi zmdi-close"></i>
        </a>
    </li>
</ul>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Shifts</h2>
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
                                    <th>Shift Name</th>
                                    <th>Shift Time From</th>
                                    <th>Shift Time Till</th>
                                    <th>Shift Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   @if(count($shifts))
                                        @foreach($shifts as $list)
                                            <tr>
                                                <td>{{ $list->shift_name}}</td>
                                                <td>{{ $list->shift_from}}</td>
                                                <td>{{ $list->shift_to}}</td>
                                                <td>{{ $list->shift_description}}</td>
                                                <td>

                                                    {!! Form::open(array('url' => route('shift.edit', ['shift' => $list->id]), 'method' => 'get')) !!}
                                                            {!! Form::submit('Edit', array('class' => 'btn btn-primary openbutton')) !!}
                                                        {!! Form::close() !!}
    
                                                        {!! Form::open(array('url' => route('shift.destroy', ['shift' => $list->id]), 'method' => 'delete')) !!}		
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
