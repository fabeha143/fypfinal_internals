@extends('layouts.websitemaster')

@section('websitecontent')
<section class="breadcrumbs" style="background-image: url(images/breadcrumb-bg.jpg)">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offset-lg-3 col-12">
            <div class="breadcrumb-content">
              <h4>Doctors</h4>
              <ul class="breadcrumb-menu">
                <li>
                  <a href="index.html">Home</a
                  ><i class="fas fa-angle-double-right"></i>
                </li>
                <li><a href="#">Doctors</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
   

    <section class="doctors-area doctor-page">
      <div class="container">
          <form method="get" action="{{ route('search') }}">
            @csrf
              
            <div class="row clearfix">
              <div class="col-lg-4 col-sm-12">
                  <div class="form-group">
                      <div class="form-line select2-class">
                        <select name="filter_doc_id"  class="js-example-basic-single">
                          <option value="">Select Doctor</option>
                          @foreach($Doctors as $list)
                              <option value="{{$list->id}}" {{ Request::get('filter_doc_id') == $list->id ? 'selected' : '' }}">{{ $list->doc_fname }} {{ $list->doc_lname }}</option>
                          @endforeach
                        </select>
                      </div>
                      
                  </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                  <div class="form-group">
                    <div class="form-line select2-class">
                      <select name="filter_depart_id" id="role_id" class="js-example-basic-single" >
                        <option value="">Select Speciality</option>
                        @foreach($departmentall as $department)
                            <option value="{{$department->id}}" {{ Request::get('filter_doc_id') == $department->id ? 'selected' : '' }}">{{ $department->dep_name  }}</option>
                        @endforeach
                      </select>
                    </div>
                      
                  </div>
                </div>
                <button class="btn btn-sm btn-success" type="submit" >Search</button>
              </form>
            </div>
        <div class="row">
          @foreach($Doctorall as $doctors)
          <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.1s">

            <div class="single-doctor">
              <div class="doctor-head">
                <img src="images/doctors/1.jpg" alt="#" />
              </div>
              <div class="doctor-content">
                <h5><a href="#">{{ $doctors->doc_fname }} {{ $doctors->doc_lname }}</a></h5>
                <span>{{$doctors->departments->dep_name}}</span>
                <div class="doctor-social">
                  <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                  <a href="#"> <i class="fab fa-twitter"></i> </a>
                  <a href="#"> <i class="fab fa-linkedin-in"></i> </a>
                  <a href="#"> <i class="fab fa-instagram"></i> </a>
                </div>
              </div>
            </div>
          </div>
            @endforeach
      </div>
    </section>
  <style>
  .select2-class select{
    width: 100%;
  }
  </style>
    <script>

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    </script>

@endsection