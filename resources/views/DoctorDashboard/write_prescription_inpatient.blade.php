@extends('layouts.doctormaster')
@section('contentdoctor')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Add Prescription</h2>
            <small class="text-muted">Welcome to Good Health application</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
                        <p>Patient Name: <b>{{ $patients->pat_fname}} {{$patients->pat_lname}}</b></p> 
                        <p>Guardian Name: <b>{{ $patients->guradian_name }}</b></p>
                        <p>Guardian Phone: <b>{{ $patients->guradian_phone }}</b></p> 
                        <p>Addmission Date: <b>{{ $patients->pat_admission_date }}</b></p>
                        <p>Patient Case: <b>{{ $patients->pat_case }}</b></p>
                        <p>Patient Symptoms: <b>{{ $patients->pat_symptoms }}</b></p>
                        
					</div>

                
            <div class="body table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Medicine</th>
                                <th>Type</th>
                                <th>Unit</th>
                                <th>Dose Frequency</th>
                                <th>Dates</th>
                                <th>Morning Time</th>
                                <th>Evening Time</th>
                                <th>Night Time</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($prescription))
                             @foreach($prescription as $list)
                                <tr>
                                    <td>{{ $list->medicine->med_name}}</td>
                                    <td>{{ $list->type}}</td>
                                    <td>{{ $list->unit}}</td>
                                    <td>{{ $list->dose_frequency}}</td>
                                    <td>{{ $list->date}}</td>
                                    <td>{{ $list->morning_time}}</td>
                                    <td>{{ $list->evening_time}}</td>
                                    <td>{{ $list->night_time}}</td>
                                    <td>{{ $list->comment}}</td>
                                    <td>{{ $list->pres_disease}}</td>
                                    
                                    
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{ Form::open(array('url' => route('InpatientPrescriptioncreate'), 'method' => 'post' , 'class' => 'body')) }}
                <p>Add Prescription Details </p>
                    <div class="row clearfix">
                            <div class="col-sm-6">
                            {{ Form::select('medicines',$medicine,'null',['class'=> 'form-control' , 'placeholder' => 'Please Select Medicine' ] )}}
                            </div>
                            <span class="text-danger">@error('medicines'){{ $message }} @enderror</span>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::select('type',array('Tablet' => 'Tablet' , 'Syrup' => 'Syrup'),'null',['class'=> 'form-control' , 'id'=> 'type','placeholder' => 'Please Select Type' ] )}}
                                </div>
                                <span class="text-danger">@error('type'){{ $message }} @enderror</span>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::text('dose_frequency',null,['class'=> 'form-control' , 'placeholder' => 'Please Select Frequency' ] )}}
                                </div>
                                <span class="text-danger">@error('dose_frequency'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::select('unit',array('Ml' => 'Ml' , 'Mg' => 'Mg'),'null',['class'=> 'form-control' , 'id'=>'unit','placeholder' => 'Please Select Unit' ] )}}
                                </div>
                                <span class="text-danger">@error('unit'){{ $message }} @enderror</span>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::time('morning_time',null,['class'=> 'form-control' , 'placeholder' => 'Morning Time'] )}}
                                </div>
                                <span class="text-danger">@error('morning_time'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::time('evening_time',null,['class'=> 'form-control' , 'placeholder' => 'Morning Time'] )}}
                                </div>
                                <span class="text-danger">@error('morning_time'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::time('night_time',null,['class'=> 'form-control' , 'placeholder' => 'Morning Time'] )}}
                                </div>
                                <span class="text-danger">@error('morning_time'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::date('start_date',null,['class'=> 'form-control' , 'placeholder' => 'Morning Time'] )}}
                                </div>
                                <span class="text-danger">@error('start_date'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::date('end_date',null,['class'=> 'form-control' , 'placeholder' => 'Morning Time'] )}}
                                </div>
                                <span class="text-danger">@error('end_date'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group drop-custum">
                                {{ Form::text('comment',null,['class'=> 'form-control' , 'placeholder' => 'Comment'] )}}
                                </div>
                                <span class="text-danger">@error('comment'){{ $message }} @enderror</span>
                            </div>
                                    {{ Form::hidden('patient_id' ,$patients->id)}}
                              
                                    {{ Form::hidden('doctor_id' ,$patients->doctor)}}
                              
                            
                                    {{ Form::hidden('department_id' ,$patients->department) }}
                                    {{ Form::hidden('ward_id' ,$patients->ward) }}
                                    
                            
                            
                            
                                <div class="">
                                    <button type="submit" class="btn btn-raised g-bg-cyan">Add</button>
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </div>
                            
                        </div>
                    {{ Form::close() }}

                    {{ Form::open(array('url' => route('Inpatientprescription'), 'method' => 'get' , 'class' => 'body')) }}

                    <div style="float: right;">

                        <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
                    </div>

                    {{ Form::close() }}

                    </div>
			</div>
		</div>
              
    </div>
</section>

@endsection()