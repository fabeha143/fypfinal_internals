@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Add Appointment</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2>Basic Information <small>Description text here...</small> </h2> 
					</div>
                    {{ Form::open(array('route' => '/appointment/store' , 'method' => 'POST' , 'class' => 'body')) }}
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    
                    @if(Session::get('fail'))
                        <div class="alert alert-success">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                        <div class="row clearfix">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('patient_name',null,array('class' => 'form-control', 'placeholder' => 'Name'))}}
                                    </div>
                                    <span class="text-danger">@error('bed_category_name'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('phone_number',null,array('class' => 'form-control', 'placeholder' => 'Phone Number'))}}
                                    </div>
                                    <span class="text-danger">@error('ward_id'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::date('patient_dob',null,array('class' => 'form-control', 'placeholder' => 'Date Of Birth'))}}
                                    </div>
                                    <span class="text-danger">@error('bed_category_details'){{ $message }} @enderror</span>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::select('department', $department,'null',['class'=> 'form-control' , 'placeholder' => 'Please Select Department' ]) }}
                                    </div>
                                    <span class="text-danger">@error('bed_category_details'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row clearfix">                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::select('doctor_name', $doctorsdata,'null',['class'=> 'form-control' , 'placeholder' => 'Please Select Doctor' ]) }}
                                    </div>
                                    <span class="text-danger">@error('bed_category_details'){{ $message }} @enderror</span>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::date('appointment_date',null,array('class' => 'form-control', 'placeholder' => 'Appointment Date'))}}
                                    </div>
                                    <span class="text-danger">@error('bed_category_details'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row clearfix">                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::time('appointment_time',null,array('class' => 'form-control', 'placeholder' => 'Appointment Time'))}}
                                    </div>
                                    <span class="text-danger">@error('bed_category_details'){{ $message }} @enderror</span>
                                </div>
                                
                            </div>
                            
                            <div class="">
                                <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    {{ Form::close() }}
				</div>
			</div>
		</div>
              
    </div>
</section>

@endsection()