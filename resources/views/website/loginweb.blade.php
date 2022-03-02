@extends('layouts.websitemaster')

@section('websitecontent')
<section class="breadcrumbs" style="background-image: url(images/breadcrumb-bg.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3 col-12">
        <div class="breadcrumb-content">
          <h4>Login</h4>
          <ul class="breadcrumb-menu">
            <li>
              <a href="index.html">Home</a><i class="fas fa-angle-double-right"></i>
            </li>
            <li><a href="#">Login</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="register-area">
  <div class="container">
    <div class="row">
      <div class="
              col-lg-6
              offset-lg-3
              col-md-8
              offset-md-2
              col-12
              wow
              fadeInUp
            " data-wow-delay="0.3s">
        <div class="account-box">
          <div class="account-box-head">
            <h2>Login Your Account</h2>
            <p>
              It is a long established fact that a reader will be distracted
            </p>
          </div>
          <div class="account-form">
            <form action="{{ route('/login/patient/check')}}" method="POST">
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
              @csrf
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Email Address *</label>
                    <input type="Email" name="email" placeholder="Email" />
                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Password *</label>
                    <input class="password" type="Password" name="password" placeholder="Password"/>
                    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="account-button">
                      <button type="submit" class="theme-btn">Login</button>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="login-bottom-content bottom-content">
                    <h6>
                      <a href="{{ url('/forgetpasswordp') }}">Forgot Password?</a>
                    </h6>
                    <p>
                      Don’t have an account?
                      <a href="{{ url('/registerw')}}">Register.</a>
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





@endsection