<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DataEncoderController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\CSOController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\CSO;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// CSO Representative Login (assuming CSO routes are separate)
Route::get('representative/register', [AuthController::class, 'register'])->name('representative.register');
Route::post('representative/register', [RepresentativeController::class, 'SignUp'])->name('representative.SignUp');
Route::get('representative/login', [RepresentativeController::class, 'showLoginForm'])->name('representative.login');
Route::post('representative/login', [RepresentativeController::class, 'login']);
Route::get('representative/dashboard', [RepresentativeController::class, 'showDashboard'])->name('representative.dashboard');
Route::get('/representative/profile', [RepresentativeController::class, 'viewProfile'])->name('representative.profile');
Route::post('representative/profile', [RepresentativeController::class, 'updateProfile'])->name('representative.updateProfile');
Route::get('representative/changePassword', [RepresentativeController::class, 'showChangePasswordForm'])->name('representative.changePassword');
Route::post('representative/changePassword', [RepresentativeController::class, 'updatePassword'])->name('representative.updatePassword');
Route::get('representative/csoList', [RepresentativeController::class, 'cso'])->name('representative.csoList');
//
Route::get('/', [UserController::class, 'index'])->middleware('auth');


//service controller
Route::get('service/index', [ServiceController::class, 'viewService'])->name('service.index');

Route::get('service/nameChange', [ServiceController::class, 'nameChangeRule'])->name('service.nameChangeRule');
Route::get('service/nameChangeForm', [ServiceController::class, 'viewNameChangeForm'])->name('service.viewNameChangeForm');
Route::post('service/nameChangeForm', [ServiceController::class, 'fillNameChangeForm'])->name('service.fillNameChangeForm');
Route::get('service/name_change/nameChangeRequests', [ServiceController::class, 'viewNameChangeRequest'])->name('service.name_change.viewNameChangeRequest');



Route::get('service/addressChange', [ServiceController::class, 'addressChangeRule'])->name('service.addressChangeRule');
Route::get('service/addressChangeForm', [ServiceController::class, 'addressChangeForm'])->name('service.addressChangeForm');
Route::post('service/addressChangeForm', [ServiceController::class, 'fillAddressChangeForm'])->name('service.fillAddressChangeForm');
Route::get('service/address_change/addressChangeRequests', [ServiceController::class, 'viewAddressChangeRequest'])->name('service.address_change.viewAddressChangeRequest');

Route::get('service/logo_letter', [ServiceController::class, 'support_letter_logo_rule'])->name('service.support_letter_logo_rule');
Route::get('service/logo_letter_form', [ServiceController::class, 'support_letter_logo_form'])->name('service.support_letter_logo_form');
Route::post('service/logo_letter_form', [ServiceController::class, 'fill_support_letter_logo_form'])->name('service.fill_support_letter_logo_form');

Route::get('service/letter/letterRequests', [ServiceController::class, 'viewLetterRequest'])->name('service.letter.viewLetterRequest');


Route::get('service/meeting_letter', [ServiceController::class, 'support_letter_meeting_rule'])->name('service.support_letter_meeting_rule');
Route::get('service/meeting_letter_form', [ServiceController::class, 'support_letter_meeting_form'])->name('service.support_letter_meeting_form');
Route::post('service/meeting_letter_form', [ServiceController::class, 'fill_support_letter_meeting_form'])->name('service.fill_support_letter_meeting_form');






// Admin routes
Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');
    Route::get('/user', [AdminController::class, 'viewUser'])->name('viewUser');
    Route::get('/alluser', [AdminController::class, 'allUser'])->name('allUser');
    Route::get('/changePassword', [AdminController::class, 'changePassword'])->name('changePassword');
    Route::post('/changePassword', [AdminController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/user/addUser', [AdminController::class, 'addUser'])->name('addUser'); // Added route definition
    Route::get('/user/{id}/', [AdminController::class, 'activeDeactive'])->name('status');
    Route::post('/user', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::get('/profile', [AdminController::class, 'viewProfile'])->name('profile'); // Changed method name to 'viewProfile'
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('updateProfile');
});

// Supervisor routes
Route::group(['middleware' => ['auth', 'role:supervisor'], 'prefix' => 'supervisor', 'as' => 'supervisor.'], function () {
    Route::get('/dashboard', [SupervisorController::class, 'showDashboard'])->name('dashboard');
    Route::get('/changePassword', [SupervisorController::class, 'changePassword'])->name('changePassword');
    Route::post('/changePassword', [SupervisorController::class, 'updatePassword'])->name('updatePassword');
    Route::get('/profile', [SupervisorController::class, 'viewProfile'])->name('profile');
    Route::post('/profile', [SupervisorController::class, 'updateProfile'])->name('updateProfile');
    // Other supervisor routes
});
Route::get('Task/index', [TaskController::class, 'viewTask'])->name('Task.index');
Route::post('Task/index', [TaskController::class, 'updateStatus'])->name('Task.updateStatus');


Route::post('registration/index/{id}/', [TaskController::class, 'assign'])->name('registration.assign');
Route::get('registration/index', [RegistrationController::class, 'viewRegistrationRequest'])->name('registration.index.viewRegistrationRequest');

// Expert routes
Route::group(['middleware' => ['auth', 'role:expert']], function () {
    Route::get('/expert/dashboard', [ExpertController::class, 'showDashboard'])->name('expert.dashboard');
    Route::get('/expert/profile', [ExpertController::class, 'viewProfile'])->name('expert.profile');
    Route::POST('expert/profile', [ExpertController::class, 'updateProfile'])->name('expert.updateProfile');
    Route::get('expert/changePassword', [ExpertController::class, 'changePassword'])->name('expert.changePassword');
    Route::POST('expert/changePassword', [ExpertController::class, 'updatePassword'])->name('expert.updatePassword');
});

// DataEncoder routes
Route::group(['middleware' => ['auth', 'role:dataencoder']], function () {
    Route::get('/dataencoder/dashboard', [DataEncoderController::class, 'showDashboard'])->name('dataencoder.dashboard');
    Route::get('/dataencoder/profile', [DataEncoderController::class, 'viewProfile'])->name('dataencoder.profile');
    Route::get('dataencoder/changePassword', [DataEncoderController::class, 'changePassword'])->name('dataencoder.changePassword');
    Route::post('dataencoder/profile', [DataEncoderController::class, 'updateProfile'])->name('dataencoder.updateProfile');
    Route::post('dataencoder/changePassword', [DataEncoderController::class, 'updatePassword'])->name('dataencoder.updatePassword');
    Route::post('dataencoder/Sector', [SectorController::class, 'addSector'])->name('dataencoder.Sector.addSector');
    Route::get('dataencoder/Sector/index', [SectorController::class, 'viewSector'])->name('dataencoder.Sector.index');
    Route::post('dataencoder/Sector/index', [SectorController::class, 'updateSector'])->name('dataencoder.Sector.updateSector');
    Route::get('dataencoder/report/index', [ReportController::class, 'index'])->name('dataencoder.report.index');
});

// Other routes...

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// CSO route
Route::get('registration/foreignrule', [RegistrationController::class, 'foreignRule'])->name('registration.foreignrule');
Route::get('registration/localrule', [RegistrationController::class, 'localRule'])->name('registration.localrule');
Route::get('registration/registrationform', [RegistrationController::class, 'registrationform'])->name('registration.registrationform');
Route::post('registration/registrationform', [CSOController::class, 'request'])->name('registration.request');
Route::get('registration/approval/{id}/', [RegistrationController::class, 'evaluate'])->name('registration.evaluate');
