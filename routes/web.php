<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    SupervisorController,
    ExpertController,
    AuthController,
    DataEncoderController,
    RepresentativeController,
    SectorController,
    CSOController,
    ReportController,
    TaskController,
    ServiceController,
    UserController,
    NotificationController,
    RegistrationController
};

// Welcome page route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Login routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Representative Registration and Login
Route::get('/representative/register', [RepresentativeController::class, 'register'])->name('representative.register');
Route::post('/representative/register', [RepresentativeController::class, 'SignUp'])->name('representative.SignUp');

Route::get('/representative/login', [RepresentativeController::class, 'showLoginForm'])->name('representative.login');
Route::post('/representative/login', [RepresentativeController::class, 'login'])->name('representative.login');
Route::post('/representative/logout', [RepresentativeController::class, 'logout'])->name('representative.logout');

// Representative Routes
Route::middleware(['auth:representative'])->group(function () {
    Route::get('/representative/dashboard', [RepresentativeController::class, 'showDashboard'])->name('representative.dashboard');
    Route::get('/representative/profile', [RepresentativeController::class, 'viewProfile'])->name('representative.profile');
    Route::put('/representative/profile', [RepresentativeController::class, 'updateProfile'])->name('representative.updateProfile');
    Route::get('/representative/changePassword', [RepresentativeController::class, 'showChangePasswordForm'])->name('representative.changePassword');
    Route::post('/representative/changePassword', [RepresentativeController::class, 'updatePassword'])->name('representative.updatePassword');
    Route::get('/representative/csoList', [RepresentativeController::class, 'cso'])->name('representative.csoList');
});

// Role-based dashboard redirection

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::get('/admin/user', [AdminController::class, 'viewUser'])->name('admin.viewUser');
    Route::get('/admin/alluser', [AdminController::class, 'allUser'])->name('admin.allUser');
    Route::get('/admin/changePassword', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/admin/changePassword', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
    Route::post('/admin/user/addUser', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::get('/admin/user/{id}/', [AdminController::class, 'activeDeactive'])->name('admin.status');
    Route::post('/admin/user', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::get('/admin/profile', [AdminController::class, 'viewProfile'])->name('admin.profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('updateProfile');
});

Route::middleware(['auth', 'role:supervisor'])->group(function () {
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'showDashboard'])->name('supervisor.dashboard');
    Route::get('/supervisor/profile', [SupervisorController::class, 'viewProfile'])->name('supervisor.profile');
    Route::post('/supervisor/profile', [SupervisorController::class, 'updateProfile'])->name('supervisor.updateProfile');
    Route::get('/supervisor/changePassword', [SupervisorController::class, 'changePassword'])->name('supervisor.changePassword');
    Route::post('/supervisor/changePassword', [SupervisorController::class, 'updatePassword'])->name('supervisor.updatePassword');
});

Route::middleware(['auth', 'role:expert'])->group(function () {
    Route::get('/expert/dashboard', [ExpertController::class, 'showDashboard'])->name('expert.dashboard');
    Route::get('/expert/profile', [ExpertController::class, 'viewProfile'])->name('expert.profile');
    Route::post('/expert/profile', [ExpertController::class, 'updateProfile'])->name('expert.updateProfile');
    Route::get('/expert/changePassword', [ExpertController::class, 'changePassword'])->name('expert.changePassword');
    Route::post('/expert/changePassword', [ExpertController::class, 'updatePassword'])->name('expert.updatePassword');
});

Route::middleware(['auth', 'role:dataencoder'])->group(function () {
    Route::get('/dataencoder/dashboard', [DataEncoderController::class, 'showDashboard'])->name('dataencoder.dashboard');
    Route::get('/dataencoder/profile', [DataEncoderController::class, 'viewProfile'])->name('dataencoder.profile');
    Route::get('/dataencoder/changePassword', [DataEncoderController::class, 'changePassword'])->name('dataencoder.changePassword');
    Route::post('/dataencoder/changePassword', [DataEncoderController::class, 'updatePassword'])->name('dataencoder.updatePassword');
    Route::post('/dataencoder/profile', [DataEncoderController::class, 'updateProfile'])->name('dataencoder.updateProfile');
    Route::post('/dataencoder/Sector', [SectorController::class, 'addSector'])->name('dataencoder.Sector.addSector');
    Route::get('/dataencoder/Sector/index', [SectorController::class, 'viewSector'])->name('dataencoder.Sector.index');
    Route::post('/dataencoder/Sector/index', [SectorController::class, 'updateSector'])->name('dataencoder.Sector.updateSector');
    Route::get('/dataencoder/report/index', [ReportController::class, 'index'])->name('dataencoder.report.index');
});



// Task routes
Route::get('Task/dataEncoder/addressChangeIndex', [TaskController::class, 'viewAddressChangeTask'])->name('Task.dataEncoder.viewAddressChangeTask');
Route::get('Task/dataEncoder/letterIndex', [TaskController::class, 'viewLetterTask'])->name('Task.dataEncoder.viewLetterTask');
Route::get('Task/dataEncoder/nameChangeIndex', [TaskController::class, 'viewNameChangeTask'])->name('Task.dataEncoder.viewNameChangeTask');
Route::get('Task/expert/index', [TaskController::class, 'viewExpertTask'])->name('Task.expert.index');
Route::post('Task/index', [TaskController::class, 'updateStatus'])->name('Task.updateStatus');
Route::post('registration/index/{id}/', [TaskController::class, 'assignRegistrationTask'])->name('registration.assignRegistrationTask');

// Service routes
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

Route::post('service/name_change/evaluateNameChangeRequest/{id}/', [ServiceController::class, 'approveNameChange'])->name('service.name_change.approveNameChange');
Route::post('service/address_change/evaluateAddressChangeRequest/{id}/', [ServiceController::class, 'giveAddressChangeFedBack'])->name('service.address_change.giveAddressChangeFedBack');
Route::post('service/name_change/evaluateNameChangeRequests/{id}/', [ServiceController::class, 'giveNameChangeFedBack'])->name('service.name_change.giveNameChangeFedBack');
Route::post('service/letter/evaluateLetterRequests/{id}/', [ServiceController::class, 'replySupportLetter'])->name('service.letter.replySupportLetter');


// Notification routes
Route::get('notifications/dateEncoderNotification', [NotificationController::class, 'viewDataEncoderNotification'])->name('notification.viewDataEncoderNotification');
Route::get('notifications/expertNotification', [NotificationController::class, 'viewExpertNotification'])->name('notification.viewExpertNotification');
Route::get('notifications/supervisorNotification', [NotificationController::class, 'viewSupervisorNotification'])->name('notification.viewSupervisorNotification');
Route::get('notifications/representativeNotification', [NotificationController::class, 'viewRepresentativeNotification'])->name('notification.viewRepresentativeNotification');
Route::get('notifications/notificationDetail/{id}/', [NotificationController::class, 'notificationDetail'])->name('notification.notificationDetail');
Route::get('notifications/dataEncoderDetailNotification/{id}/', [NotificationController::class, 'dataEncoderNotificationDetail'])->name('notification.dataEncoderNotificationDetail');
Route::get('notifications/expertDetailNotification/{id}/', [NotificationController::class, 'expertNotificationDetail'])->name('notification.expertNotificationDetail');
Route::get('notifications/supervisorNotificationDetail/{id}/', [NotificationController::class, 'supervisorNotificationDetail'])->name('notification.supervisorNotificationDetail');
Route::delete('notifications/notificationDetail/{notification}/', [NotificationController::class, 'deleteRepresentativeNotification'])->name('notification.deleteRepresentativeNotification');
Route::delete('notifications/dataEncoderDetailNotification/{notification}/', [NotificationController::class, 'deleteDataEncoderNotification'])->name('notification.deleteDataEncoderNotification');
Route::delete('notifications/expertDetailNotification/{notification}/', [NotificationController::class, 'deleteExpertNotification'])->name('notification.deleteExpertNotification');
Route::delete('notifications/supervisorNotificationDetail/{notification}/', [NotificationController::class, 'deleteSupervisorNotification'])->name('notification.deleteSupervisorNotification');

// Registration routes
Route::get('registration/foreignrule', [RegistrationController::class, 'foreignRule'])->name('registration.foreignrule');
Route::get('registration/localrule', [RegistrationController::class, 'localRule'])->name('registration.localrule');
Route::get('registration/registrationform', [RegistrationController::class, 'registrationform'])->name('registration.registrationform');
Route::post('registration/registrationform', [CSOController::class, 'request'])->name('registration.request');
Route::get('registration/evaluateRegistration/{id}/', [RegistrationController::class, 'evaluateRegistration'])->name('registration.evaluateRegistration');
Route::get('registration/index', [RegistrationController::class, 'viewRegistrationRequest'])->name('registration.index.viewRegistrationRequest');

Route::post('registration/evaluateRegistration/{id}/', [RegistrationController::class, 'approveRegistration'])->name('registration.approveRegistration');
Route::post('registration/evaluateRegistration/{id}/', [RegistrationController::class, 'giveRegistrationFedBack'])->name('registration.giveRegistrationFedBack');
