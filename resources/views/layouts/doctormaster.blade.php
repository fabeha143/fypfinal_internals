<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Good Health</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/css/bootstrap.min.css"/>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css">
<link rel="stylesheet" href="/plugins/morrisjs/morris.css"/>
<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" href="/plugins/dropzone/dropzone.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Custom Css -->
<link rel="stylesheet" href="/css/main.css"/>
<link rel="manifest" href="/manifest.json">
@laravelPWA
</head>

<body class="theme-cyan">
<!-- <div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-cyan">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div> -->

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- #Float icon -->



<!-- Top Bar -->
<nav class="navbar clearHeader">
    <div class="col-12">
        <div class="navbar-header"> 
            <a href="javascript:void(0);" class="bars"></a>
           <a class="navbar-brand" href="{{ url('/dashboard/doctor')}}">
            <img style="height:53px" src="/images/favicon.png" alt="logo">
            <span>Good Helth</span> 
        </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/inbox/create')}}" title="Go to Inbox"><i class="zmdi zmdi-email"></i></a></li>
                <li><a href="{{ url('/profile')}}" title="Go to Profile"><i class="zmdi zmdi-account"></i></a></li>
                <li><a href="{{ url('/logout') }}"><i class="zmdi zmdi-sign-in"></i></a></li>
                </li>
        </ul>
    </div>
</nav>
<!-- #Top Bar -->
<section> 
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar"> 
        <!-- User Info -->
        <div class="user-info">
        <div class="admin-image"> 
            
            <img src="/images/doctor.png" alt=""></div>
            <div class="admin-action-info"> <span>Welcome</span>
                <h3>{{$doctordata->doc_fname}}</h3>
                <ul>
                   
                </ul>
            </div>
            <div class="quick-stats">
                <h5>Today Report</h5>
                <ul>
                    <li style="width:50%"><span>{{$appoint_count}}<i>Approved</i></span></li>
                    <li style="width:50%"><span>{{$active_patient}}<i>Active Patient</i></span></li>
                </ul>
            </div>
        </div>
        <!-- #User Info --> 
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li><a href="{{ url('/dashboard/doctor')}}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>  
                <li><a href="{{ url('/AppointmentList')}}"><i class="zmdi zmdi-calendar-check"></i><span>Appointment List</span></a></li> 
                
                <li><a href="{{ url('/inpatientList')}}" ><i class="zmdi zmdi-view-array"></i><span>In Patient List</span> </a>
                </li>        
                <li><a href="{{ url('/Inpatientprescription')}}" ><i class="zmdi zmdi-view-array"></i><span>In Patient Prescription</span> </a>
                </li>                                          
                
                
                
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
</section>

@yield('contentdoctor')

<div class="color-bg"></div>

<script src="/js/index.js"></script>
<script src="/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="/bundles/chartscripts.bundle.js"></script> <!-- Chart Plugins Js -->
<script src="/bundles/sparklinescripts.bundle.js"></script> <!-- Chart Plugins Js -->

<script src="/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="/js/pages/charts/sparkline.min.js"></script>
<script src="/plugins/dropzone/dropzone.js""></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>