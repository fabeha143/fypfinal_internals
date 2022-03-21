@extends('layouts.master')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Add Bed Category</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="header">
						<h2>Basic Information <small>Description text here...</small> </h2> 
					</div>
                    {{ Form::open(array('url' => route('bedcategory.update', ['bedcategory' => $bedEdit->id]), 'method' => 'put' , 'class' => 'body')) }}
                        <div class="row clearfix">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('bed_category_name',$bedEdit->bed_category_name,array('class' => 'form-control', 'placeholder' => 'Bed Category Name'))}}
                                    </div>
                                    <span class="text-danger">@error('bed_category_name'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::select('ward_id', $wardEdit,'null',['class'=> 'form-control' , 'placeholder' => 'Please Select Ward' ]) }}
                                    </div>
                                    <span class="text-danger">@error('ward_id'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('bed_category_details',$bedEdit->bed_category_details,array('class' => 'form-control', 'placeholder' => 'Bed Category Details'))}}
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