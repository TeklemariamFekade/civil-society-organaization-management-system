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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationController as ControllersNotificationController;
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

// Representative Controller route
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


//service controller route

Route::get('service/index', [ServiceController::class, 'viewService'])->name('service.index');
Route::get('service/nameChange', [ServiceController::class, 'nameChangeRule'])->name('service.nameChangeRule');
Route::get('service/nameChangeForm', [ServiceController::class, 'viewNameChangeForm'])->name('service.viewNameChangeForm');
Route::post('service/nameChangeForm', [ServiceController::class, 'fillNameChangeForm'])->name('service.fillNameChangeForm');
Route::get('service/name_change/nameChangeRequests', [ServiceController::class, 'viewNameChangeRequest'])->name('service.name_change.viewNameChangeRequest');
Route::post('service/name_change/nameChangeRequests/{id}/', [TaskController::class, 'assignNameChangeTask'])->name('service.name_change.assignNameChangeTask');

Route::get('service/addressChange', [ServiceController::class, 'addressChangeRule'])->name('service.addressChangeRule');
Route::get('service/addressChangeForm', [ServiceController::class, 'addressChangeForm'])->name('service.addressChangeForm');
Route::post('service/addressChangeForm', [ServiceController::class, 'fillAddressChangeForm'])->name('service.fillAddressChangeForm');
Route::get('service/address_change/addressChangeRequests', [ServiceController::class, 'viewAddressChangeRequest'])->name('service.address_change.viewAddressChangeRequest');
Route::post('service/address_change/addressChangeRequests/{id}/', [TaskController::class, 'assignAddressChangeTask'])->name('service.address_change.assignAddressChangeTask');

Route::get('service/logo_letter', [ServiceController::class, 'support_letter_logo_rule'])->name('service.support_letter_logo_rule');
Route::get('service/logo_letter_form', [ServiceController::class, 'support_letter_logo_form'])->name('service.support_letter_logo_form');
Route::post('service/logo_letter_form', [ServiceController::class, 'fill_support_letter_logo_form'])->name('service.fill_support_letter_logo_form');

Route::get('service/letter/letterRequests', [ServiceController::class, 'viewLetterRequest'])->name('service.letter.viewLetterRequest');
Route::post('service/letter/letterRequests/{id}/', [TaskController::class, 'assignSupportLetterTask'])->name('service.letter.assignSupportLetterTask');

Route::get('service/meeting_letter', [ServiceController::class, 'support_letter_meeting_rule'])->name('service.support_letter_meeting_rule');
Route::get('service/meeting_letter_form', [ServiceController::class, 'support_letter_meeting_form'])->name('service.support_letter_meeting_form');
Route::post('service/meeting_letter_form', [ServiceController::class, 'fill_support_letter_meeting_form'])->name('service.fill_support_letter_meeting_form');

Route::get('Task/dataEncoder/letterIndex/{id}/', [ServiceController::class, 'evaluateSupportLetterRequest'])->name('service.letter.evaluateSupportLetterRequest');
Route::get('Task/dataEncoder/nameChangeIndex/{id}/', [ServiceController::class, 'evaluateNameChangeRequest'])->name('service.name_change.evaluateNameChangeRequest');
Route::get('Task/dataEncoder/addressChangeIndex/{id}/', [ServiceController::class, 'evaluateAddressChangeRequest'])->name('service.address_change.evaluateAddressChangeRequest');
Route::post('service/address_change/evaluateAddressChangeRequest/{id}/', [ServiceController::class, 'approveAddressChange'])->name('service.address_change.approveAddressChange');
Route::post('service/name_change/evaluateNameChangeRequests/{id}/', [ServiceController::class, 'approveNameChange'])->name('service.name_change.approveNameChange');



// give feadback and reply route
Route::post('service/address_change/evaluateAddressChangeRequest/{id}/', [ServiceController::class, 'giveAddressChangeFedBack'])->name('service.address_change.giveAddressChangeFedBack');
Route::post('service/name_change/evaluateNameChangeRequests/{id}/', [ServiceController::class, 'giveNameChangeFedBack'])->name('service.name_change.giveNameChangeFedBack');
Route::post('service/letter/evaluateLetterRequests/{id}/', [ServiceController::class, 'replySupportLetter'])->name('service.letter.replySupportLetter');



// Admin  Controller routes

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



//Task Controller Route

Route::get('Task/dataEncoder/addressChangeIndex', [TaskController::class, 'viewAddressChangeTask'])->name('Task.dataEncoder.viewAddressChangeTask');
Route::get('Task/dataEncoder/letterIndex', [TaskController::class, 'viewLetterTask'])->name('Task.dataEncoder.viewLetterTask');
Route::get('Task/dataEncoder/nameChangeIndex', [TaskController::class, 'viewNameChangeTask'])->name('Task.dataEncoder.viewNameChangeTask');

Route::get('Task/expert/index', [TaskController::class, 'viewExpertTask'])->name('Task.expert.index');
Route::post('Task/index', [TaskController::class, 'updateStatus'])->name('Task.updateStatus');
Route::post('registration/index/{id}/', [TaskController::class, 'assignRegistrationTask'])->name('registration.assignRegistrationTask');




// Expert Controller  routes

Route::group(['middleware' => ['auth', 'role:expert']], function () {
    Route::get('/expert/dashboard', [ExpertController::class, 'showDashboard'])->name('expert.dashboard');
    Route::get('/expert/profile', [ExpertController::class, 'viewProfile'])->name('expert.profile');
    Route::POST('expert/profile', [ExpertController::class, 'updateProfile'])->name('expert.updateProfile');
    Route::get('expert/changePassword', [ExpertController::class, 'changePassword'])->name('expert.changePassword');
    Route::POST('expert/changePassword', [ExpertController::class, 'updatePassword'])->name('expert.updatePassword');
});



// DataEncoder Controller  routes

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
Route::get('representative/register', [AuthController::class, 'register'])->name('representative.register');

// Registration Controller route
Route::get('registration/foreignrule', [RegistrationController::class, 'foreignRule'])->name('registration.foreignrule');
Route::get('registration/localrule', [RegistrationController::class, 'localRule'])->name('registration.localrule');
Route::get('registration/registrationform', [RegistrationController::class, 'registrationform'])->name('registration.registrationform');
Route::post('registration/registrationform', [CSOController::class, 'request'])->name('registration.request');
Route::get('registration/evaluateRegistration/{id}/', [RegistrationController::class, 'evaluateRegistration'])->name('registration.evaluateRegistration');
Route::get('registration/index', [RegistrationController::class, 'viewRegistrationRequest'])->name('registration.index.viewRegistrationRequest');



Route::post('registration/evaluateRegistration/{id}/', [RegistrationController::class, 'approveRegistration'])->name('registration.approveRegistration');
Route::post('registration/evaluateRegistration/{id}/', [RegistrationController::class, 'giveRegistrationFedBack'])->name('registration.giveRegistrationFedBack');




// view notification route

Route::get('notifications/dateEncoderNotification', [NotificationController::class, 'viewDataEncoderNotification'])->name('notification.viewDataEncoderNotification');
Route::get('notifications/expertNotification', [NotificationController::class, 'viewExpertNotification'])->name('notification.viewExpertNotification');
Route::get('notifications/supervisorNotification', [NotificationController::class, 'viewSupervisorNotification'])->name('notification.viewSupervisorNotification');
Route::get('notifications/representativeNotification', [NotificationController::class, 'viewRepresentativeNotification'])->name('notification.viewRepresentativeNotification');

//  View detail notification route

Route::get('notifications/notificationDetail/{id}/', [NotificationController::class, 'notificationDetail'])->name('notification.notificationDetail');
Route::get('notifications/dataEncoderDetailNotification/{id}/', [NotificationController::class, 'dataEncoderNotificationDetail'])->name('notification.dataEncoderNotificationDetail');
Route::get('notifications/expertDetailNotification/{id}/', [NotificationController::class, 'expertNotificationDetail'])->name('notification.expertNotificationDetail');
Route::get('notifications/supervisorNotificationDetail/{id}/', [NotificationController::class, 'supervisorNotificationDetail'])->name('notification.supervisorNotificationDetail');
//Delete notification route
Route::delete('notifications/notificationDetail/{notification}/', [NotificationController::class, 'deleteRepresentativeNotification'])->name('notification.deleteRepresentativeNotification');
Route::delete('notifications/dataEncoderDetailNotification/{notification}/', [NotificationController::class, 'deleteDataEncoderNotification'])->name('notification.deleteDataEncoderNotification');
Route::delete('notifications/expertDetailNotification/{notification}/', [NotificationController::class, 'deleteExpertNotification'])->name('notification.deleteExpertNotification');
Route::delete('notifications/supervisorNotificationDetail/{notification}/', [NotificationController::class, 'deleteSupervisorNotification'])->name('notification.deleteSupervisorNotification');
