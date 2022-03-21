@extends('layouts.master')
@section('content')
<section class="content home">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Assigned Attendant</h2>
            <small class="text-muted">Welcome to Good Health</small>
        </div>
        
        
        <div class="row clearfix">
        @if(count($shiftsall))
            @foreach($shiftsall as $list)
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon"><a href="{{ route('shifts_assigned',$list->id)}}"> <i class="zmdi zmdi-account col-blue"></i></a></div>
                    <div class="content">
                        <div class="text">{{ $list->shift_name }}</div>
                        <div class="number"></div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
            
        </div>
    </div>
</section>

@endsection()
