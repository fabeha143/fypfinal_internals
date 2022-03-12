@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Assign Shifts</h2>
            <small class="text-muted">Welcome to Good Health application</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2>Basic Information <small>Description text here...</small> </h2> 
					</div>
                    {{ Form::open(array('route' => 'assignedshift.store' , 'method' => 'POST' , 'class' => 'body')) }}
                    @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="row clearfix">
                              
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::select('attendant',$employee_name,null,['class'=> 'form-control' , 'placeholder' => 'Please Select Attendant' ] )}}
                                </div>
                                <span class="text-danger">@error('attendant'){{ $message }} @enderror</span>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::select('shift',$shift_name,null,['class'=> 'form-control' , 'placeholder' => 'Please Select Shift' ] )}}
                                </div>
                                <span class="text-danger">@error('shift'){{ $message }} @enderror</span>
                            </div>
                                                          
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
              
    </div>
</section>

@endsection()