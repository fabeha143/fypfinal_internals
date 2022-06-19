<?php

use App\Events\MessageNotification;
use Illuminate\Support\Facades\Route;
use App\Models\inpatient_prescription;
use App\Models\employee;
use App\Notifications\dos_reminder;
use App\Notifications\SlackNotification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Website Routes
Route::view('/ ', 'website/homepage');
Route::view('/Department ', 'website/departmentweb');
Route::view('/service ', 'website/serviceweb');
Route::get('/Doctor', [App\Http\Controllers\OtherController::class,'doctor_show'])->name('Doctor');
// Route::view('/Doctor ', 'website/doctorweb');
Route::view('/DoctorDetail ', 'website/doctorwebDetail');
Route::view('/contactus ', 'website/contactus');
Route::view('/faq ', 'website/faqWeb');
Route::view('/forgetpasswordp ', 'website/forgetpassweb');
Route::get('/search', [App\Http\Controllers\OtherController::class,'search_doctor'])->name('search');


Route::get('/Appointment ', [App\Http\Controllers\AppointmentWebController::class,'index'])->name('/Appointment');
Route::post('/Appointment/create', [App\Http\Controllers\AppointmentWebController::class,'create'])->name('/Appointment/create')->middleware('appointLogin');

Route::get('/loginpatient ',[App\Http\Controllers\LoginWebsiteController::class,'loginWeb'])->name('/loginpatient');
Route::post('/login/patient/check',[App\Http\Controllers\LoginWebsiteController::class,'checkUser'])->name('/login/patient/check');

Route::get('/registerw ', [App\Http\Controllers\LoginWebsiteController::class,'showRegister'])->name('/registerw');
Route::post('save', [App\Http\Controllers\LoginWebsiteController::class,'saveRegister'])->name('save');
Route::get('/logoutweb', [App\Http\Controllers\LoginWebsiteController::class,'logoutweb'])->name('logoutweb');
Route::post('/contactUs/send', [App\Http\Controllers\mailCOntroller::class,'webmail'])->name('/contactUs/send')->middleware('appointLogin');;



//admin routes

Route::post('/login/check',[App\Http\Controllers\loginController::class,'check'])->name('/login/check');



    Route::get('/admin/dashboard', [App\Http\Controllers\adminDashController::class,'index'])->name('/admin/dashboard')->middleware('AuthCheck');

Route::get('/login', [App\Http\Controllers\loginController::class,'login'])->name('/login')->middleware('authbackcheck');


    Route::get('/logout', [App\Http\Controllers\loginController::class,'logout'])->name('logout');
    Route::resource('patient','PatientController')->middleware('AuthCheck');
    Route::resource('doctor','doctorController')->middleware('AuthCheck');
    Route::resource('employee','employeeController')->middleware('AuthCheck');
    Route::resource('employeeRole','employee_role_controller')->middleware('AuthCheck');
    Route::resource('department','departmentController')->middleware('AuthCheck');
    Route::resource('medicine','medicineController')->middleware('AuthCheck');
    Route::resource('doseschedule','doselist')->middleware('AuthCheck');
    Route::resource('wards','wardController')->middleware('AuthCheck');
    Route::resource('scheduleshow','attendantSchedule')->middleware('AuthCheck');
    Route::resource('shift','shiftController')->middleware('AuthCheck');
    Route::resource('assignedshift','assign_shift')->middleware('AuthCheck');
    Route::resource('bedcategory','bed_category_Controller')->middleware('AuthCheck');
    Route::resource('bed','bedsController')->middleware('AuthCheck');



    Route::get('/shifts_assigned/see',[App\Http\Controllers\OtherController::class,'index'])->name('shifts_assigned/see');
    Route::get('/shifts_assigned/{id}',[App\Http\Controllers\OtherController::class,'see_attendant'])->name('shifts_assigned');
    Route::post('/schedule/new',[App\Http\Controllers\OtherController::class,'store'])->name('/schedule/new');
    Route::get('/schedule',[App\Http\Controllers\OtherController::class,'assigned_attendantShow'])->name('/schedule');


    Route::get('/register',[App\Http\Controllers\loginController::class,'register'])->name('register')->middleware('AuthCheck');
    Route::post('/register/save',[App\Http\Controllers\loginController::class,'save'])->name('/register/save')->middleware('AuthCheck');
    
    Route::get('/appointment', [App\Http\Controllers\appointmentController::class, 'index'])->name('index')->middleware('AuthCheck');
    Route::get('/approved/{id}', [App\Http\Controllers\appointmentController::class, 'approved'])->name('approved');
    Route::get('/cancel/{id}', [App\Http\Controllers\appointmentController::class, 'cancel'])->name('cancel');
    Route::get('/add/appointment', [App\Http\Controllers\appointmentController::class, 'add_appointment'])->name('/add/appointment');
    Route::post('/appointment/store', [App\Http\Controllers\appointmentController::class, 'store'])->name('/appointment/store');
    
    
    // Route::get('/createschedule', [App\Http\Controllers\scheduleController::class, 'create'])->name('createschedule')->middleware('AuthCheck');
    // Route::post('/addattendant/{id}', [App\Http\Controllers\scheduleController::class, 'store'])->name('addattendant');
    Route::resource('medicinesCategory','med_cat_controller')->middleware('AuthCheck');
    
    //Mail
    Route::get('/inbox/create', [App\Http\Controllers\mailCOntroller::class,'composeMail'])->name('/inbox/create')->middleware('AuthCheck');
    Route::post('/inbox/send', [App\Http\Controllers\mailCOntroller::class,'index'])->name('/inbox/send');
    // Route::get('/inbox/compose/mail' , [App\Http\Controllers\mailCOntroller::class,'index'])->name('/inbox/compose/mail');
    
    Route::resource('disease','diseaseController')->middleware('AuthCheck');
    
    //profile
    
    Route::get('/profile', [App\Http\Controllers\profileController::class,'index'])->name('profile')->middleware('AuthCheck');
    Route::post('/addpost', [App\Http\Controllers\profileController::class,'post'])->name('addpost')->middleware('AuthCheck');
    Route::get('/distroy/{id}', [App\Http\Controllers\profileController::class,'distroy'])->name('distroy');

    Route::post('/security/{id}', [App\Http\Controllers\profileController::class,'updatesettings'])->name('security')->middleware('AuthCheck');
    ///////////////////////////////Admin/////////////////////////////////////////////
    
    
    ///////////////////////////////Doctor/////////////////////////////////////////////
    Route::get('/login/doctor', [App\Http\Controllers\doctordashController::class, 'login'])->name('/login/doctor');
    Route::post('/login/doctor/check',[App\Http\Controllers\doctordashController::class,'checkdoctor'])->name('/login/doctor/check');
    Route::get('/dashboard/doctor', [App\Http\Controllers\doctordashController::class, 'index'])->name('/dashboard/doctor')->middleware('AuthCheck');
    Route::get('/AppointmentList', [App\Http\Controllers\doctordashController::class, 'doc_appointment'])->name('AppointmentList')->middleware('AuthCheck');
    Route::get('/inpatientList', [App\Http\Controllers\doctordashController::class, 'inpatientlist'])->name('inpatientList')->middleware('AuthCheck');
    
    Route::post('/Prescriptioncreate',[App\Http\Controllers\app_prescription_controller::class, 'store'])->name('Prescriptioncreate');
    Route::resource('appprescription','outpatient_prescription_controller')->middleware('AuthCheck');
    
    Route::get('/writePrescriptionpatient/{id}', [App\Http\Controllers\InPatientController::class, 'index'])->name('writePrescriptionpatient')->middleware('AuthCheck');
    Route::post('/InpatientPrescriptioncreate',[App\Http\Controllers\InPatientController::class, 'store'])->name('InpatientPrescriptioncreate');

    Route::post('/delete/prescription/{id}',[App\Http\Controllers\InPatientController::class, 'delete_prescription'])->name('/delete/prescription');
    
    Route::get('/showPrescription/{id}', [App\Http\Controllers\Inpatientprescription::class, 'showPrescription'])->name('showPrescription')->middleware('AuthCheck');
    Route::get('/Inpatientprescription',[App\Http\Controllers\Inpatientprescription::class, 'index'])->name('Inpatientprescription');
    
    // Route::get('/InPatient', [App\Http\Controllers\InPatientController::class, 'index'])->name('InPatient');
    ///////////////////////////////Doctor/////////////////////////////////////////////
    
    ///////////////////////////////Attendant/////////////////////////////////////////////
    Route::get('/attendant/dashboard', [App\Http\Controllers\attendantdashController::class, 'index'])->name('/attendant/dashboard')->middleware('AuthCheck');
    Route::post('/attendantdashstore/{id}', [App\Http\Controllers\attendantdashController::class, 'store'])->name('attendantdashstore');

    Route::get('/attendant/primary/prescription/{id}', [App\Http\Controllers\attendantdashController::class, 'showprimary'])->name('/attendant/primary/prescription')->middleware('AuthCheck');

    Route::get('/attendant/secondary/prescription/{id}', [App\Http\Controllers\attendantdashController::class,'showsecondary'])->name('/attendant/secondary/patientlist')->middleware('AuthCheck');


    Route::get('/attendant/primary/patientlist', [App\Http\Controllers\attendantdashController::class, 'patientList_primary'])->name('/attendant/primary/patientlist')->middleware('AuthCheck');

    Route::get('/attendant/secondary/patientlist', [App\Http\Controllers\attendantdashController::class, 'patientList_secondary'])->name('/attendant/secondary/patientlist')->middleware('AuthCheck');

    Route::post('/attendant/morning/done/{id}', [App\Http\Controllers\attendantdashController::class, 'morning_done'])->name('/attendant/morning/done')->middleware('AuthCheck');
    Route::post('/attendant/evening/done/{id}', [App\Http\Controllers\attendantdashController::class, 'evening_done'])->name('/attendant/evening/done')->middleware('AuthCheck');
    Route::post('/attendant/night/done/{id}', [App\Http\Controllers\attendantdashController::class, 'night_done'])->name('/attendant/night/done')->middleware('AuthCheck');
    

    Route::get('/other', [App\Http\Controllers\OtherController::class, 'other'])->name('other');
    ///////////////////////////////Attendant/////////////////////////////////////////////
    
    //service

    // Route::get('/service/redirect', [App\Http\Controllers\ServiceController::class, 'morning_service'])->name('/service/redirect');
    // Route::get('/event', function(){
    //     event(new MessageNotification('This is Message'));
    // });
    //  Route::get('/listen', function(){
    //     $night_time = inpatient_prescription::whereRaw('night_time + INTERVAL 5 MINUTE <= CURRENT_TIME() AND date = CURRENT_DATE AND night_status = 0')
    //         ->join('patients','patients.id','inpatient_prescriptions.patient_id')
    //         ->join('departments','departments.id','inpatient_prescriptions.department_id')
    //         ->join('wards','wards.id','inpatient_prescriptions.ward_id')
    //         ->get();
    //         if($night_time->count()!=0){
    //             $user1 = employee::select('1')->join('attendant_assigns','attendant_assigns.attendant_primary','=','employees.id')->join('inpatient_prescriptions','attendant_assigns.ward','=','inpatient_prescriptions.ward_id')->first();
    
    //             $user2 = employee::select('employees.id')->join('attendant_assigns','attendant_assigns.attendant_secondary','=','employees.id')->join('inpatient_prescriptions','attendant_assigns.ward','=','inpatient_prescriptions.ward_id')->first();


    //             $new = $night_time;
    //             $user1->notify(new dos_reminder($new));
    //             $user2->notify(new dos_reminder($new));
    //             Notification::send($user1, new SlackNotification($new));
    //             event(new MessageNotification('Night time query executed'));
    //         }
    // });