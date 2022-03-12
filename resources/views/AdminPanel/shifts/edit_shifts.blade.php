@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Edit Shifts</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2>Basic Information <small>Description text here...</small> </h2> 
					</div>
                    {{ Form::open(array('url' => route('shift.update', ['shift' => $shiftedit->id]), 'method' => 'put' , 'class' => 'body')) }}
                    <div class="row clearfix">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('shift_name',$shiftedit->shift_name,array('class' => 'form-control', 'placeholder' => 'Shift Name'))}}
                                    </div>
                                    <span class="text-danger">@error('shift_name'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        
                    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::time('shift_from',$shiftedit->shift_from,array('class' => 'form-control', 'placeholder' => 'Shift from'))}}
                                    </div>
                                    <span class="text-danger">@error('shift_from'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::time('shift_to',$shiftedit->shift_to,array('class' => 'form-control', 'placeholder' => 'Shift To'))}}
                                    </div>
                                    <span class="text-danger">@error('shift_to'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('shift_description',$shiftedit->shift_description,array('class' => 'form-control', 'placeholder' => 'Shift Description'))}}
                                    </div>
                                    <span class="text-danger">@error('shift_description'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
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