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
                        @if(count($prescriptions))
                             @foreach($prescriptions as $list)
                                <tr>
                                    <td>{{ $list->medicines}}</td>
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
                         
    </div>
</section>

@endsection()