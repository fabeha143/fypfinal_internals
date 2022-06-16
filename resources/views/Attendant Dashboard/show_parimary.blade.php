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
                                    <th>Medicine</th>
                                    <th>Dose Frequency</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Morning Time</th>
                                    <th>Evening Time</th>
                                    <th>Night Time</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($query))
                                @foreach($query as $list)
                                    <tr>
                                    <td>{{ $list->medicine->med_name}}</td>
                                    <td>{{ $list->dose_frequency}}</td>
                                    <td>{{ $list->unit}}</td>
                                    <td>{{ $list->date}}</td>
                                    <td>{{ $list->morning_time}}</td>
                                    <td>{{ $list->evening_time}}</td>
                                    <td>{{ $list->night_time}}</td>
                                    <td>{{ $list->comment}}</td>
                                    <td>
                                        
                                    </td>
                                    <tr>
                                @endforeach
                            @else
                            <td colspan="14">No Data found!!</td>
                            @endif
                            </tr> 
                               
                            </tbody>
                        </table>
                            {!! Form::open(array('url' => route('/attendant/morning/done', $patientName->id), 'method' => 'post' ,'style' => 'margin-bottom:10px;')) !!}
                                {!! Form::submit('Morning Dose', array('class' => 'btn btn-sm btn-primary openbutton')) !!}
                            {!! Form::close() !!}

                            {!! Form::open(array('url' => route('/attendant/evening/done', $patientName->id), 'method' => 'post' ,'style' => 'margin-bottom:10px;')) !!}		
                                {!! Form::submit('Evening Dose', array('class' => 'btn btn-sm btn-primary openbutton')) !!}
                    
                            {!! Form::close() !!}

                            {!! Form::open(array('url' => route('/attendant/night/done',$patientName->id), 'method' => 'post')) !!}		
                                {!! Form::submit('Night Dose', array('class' => 'btn btn-sm btn-primary openbutton')) !!}
                    
                            {!! Form::close() !!}
                    </div>
                    
                </div>

            
        </div>
    </div>
</section>



@endsection()
