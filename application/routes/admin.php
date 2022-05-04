<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\DegreeController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\RecruitController;
use App\Http\Controllers\Admin\SpecializeController;
use App\Http\Controllers\Admin\typeofemployeesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserActivityController;
use App\Http\Controllers\User\UserSessionController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Authorization\RoleController;
use App\Http\Controllers\Authorization\PermissionController;
use App\Http\Controllers\Demo\FormController;
use App\Http\Controllers\Demo\MailController;
use App\Http\Controllers\Employee;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\User\SaveInfomation;
use App\Http\Controllers\Wage;
use App\Http\Controllers\Work;
use Illuminate\Support\Facades\Route;


Route::get('ajax-form-submit', [FormController::class, 'index'])->name('ajax-form-submit');
Route::post('save-form', [FormController::class, 'store'])->name('save-form');


Route::get('ung-vien/ung-tuyen-ho-so', [SaveInfomation::class, 'saveinfo'])->name('ung-vien.ung-tuyen-ho-so');
Route::post('ung-vien/ung-tuyen-ho-so/store', [SaveInfomation::class, 'store'])->name('saveinfo.store');
Route::get('display-user', [UserController::class, 'list_ip'])->name('display_user');

Route::get('success', [SuccessController::class, 'success'])->name('admin.success');


Route::get('error', [ErrorController::class, 'error'])->name('admin.error');

Route::get('demo/sendmail', [MailController::class, 'sendmail'])->name('demo.sendmail');

Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('employee', [Employee::class, 'list'])->name('employee.index');
    Route::get('employee/department/{slug}', [Employee::class, 'filer'])->name('employee.department.filer');

    Route::get('wage', [Wage::class, 'list'])->name('wage.index');

    Route::get('work', [Work::class, 'list'])->name('work.index');
    //dashbaord
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:dashboard.viewAny');

    Route::get('tuyen-dung/list', [RecruitController::class, 'list'])->name('recruit.list');

    Route::get('tuyen-dung/xuat-excel', [UserController::class, 'export'])->name('recruit.export');

    Route::post('tuyen-dung/action', [RecruitController::class, 'action'])->name('recruit.action');
    Route::get('tuyen-dung/show/{id}', [RecruitController::class, 'show'])->name('recruit.show');
    Route::get('tuyen-dung/ung-vien/show/{id}', [RecruitController::class, 'showBrowser'])->name('recruit.showBrowser');
    Route::get('tuyen-dung/edit/{id}', [RecruitController::class, 'edit'])->name('recruit.edit');
    Route::get('tuyen-dung/editCandidate/{id}', [RecruitController::class, 'editCandidate'])->name('recruit.editCandidate');
    Route::post('tuyen-dung/update/{id}', [RecruitController::class, 'update'])->name('recruit.update');
    Route::post('tuyen-dung/updateCandidate/{id}', [RecruitController::class, 'updateCandidate'])->name('recruit.updateCandidate');

    // Admin department
    Route::get('admin/department', [DepartmentController::class, 'list'])->name('admin.department.index');
    Route::get('admin/department/add', [DepartmentController::class, 'create'])->name('admin.department.add');
    Route::post('admin/department/store', [DepartmentController::class, 'store'])->name('admin.department.store');
    Route::get('admin/department/delete/{id}', [DepartmentController::class, 'delete'])->name('admin.department.delete');
    Route::post('admin/department/action', [DepartmentController::class, 'action'])->name('admin.department.action');
    Route::get('admin/department/edit/{id}', [DepartmentController::class, 'edit'])->name('admin.department.edit');
    Route::post('admin/department/update/{id}', [DepartmentController::class, 'update'])->name('admin.department.update');
    Route::get('admin/department/unactive/{id}', [DepartmentController::class, 'unactive'])->name('admin.department.unactive');
    Route::get('admin/department/active/{id}', [DepartmentController::class, 'active'])->name('admin.department.active');

    // Admin position
    Route::get('admin/position', [positionController::class, 'list'])->name('admin.position.index');
    Route::get('admin/position/add', [positionController::class, 'create'])->name('admin.position.add');
    Route::post('admin/position/store', [positionController::class, 'store'])->name('admin.position.store');
    Route::get('admin/position/delete/{id}', [positionController::class, 'delete'])->name('admin.position.delete');
    Route::post('admin/position/action', [positionController::class, 'action'])->name('admin.position.action');
    Route::get('admin/position/edit/{id}', [positionController::class, 'edit'])->name('admin.position.edit');
    Route::post('admin/position/update/{id}', [positionController::class, 'update'])->name('admin.position.update');

    // Admin level
    Route::get('admin/level', [levelController::class, 'list'])->name('admin.level.index');
    Route::get('admin/level/add', [levelController::class, 'create'])->name('admin.level.add');
    Route::post('admin/level/store', [levelController::class, 'store'])->name('admin.level.store');
    Route::get('admin/level/delete/{id}', [levelController::class, 'delete'])->name('admin.level.delete');
    Route::post('admin/level/action', [levelController::class, 'action'])->name('admin.level.action');
    Route::get('admin/level/edit/{id}', [levelController::class, 'edit'])->name('admin.level.edit');
    Route::post('admin/level/update/{id}', [levelController::class, 'update'])->name('admin.level.update');

    // Admin specialize
    Route::get('admin/specialize', [specializeController::class, 'list'])->name('admin.specialize.index');
    Route::get('admin/specialize/add', [specializeController::class, 'create'])->name('admin.specialize.add');
    Route::post('admin/specialize/store', [specializeController::class, 'store'])->name('admin.specialize.store');
    Route::get('admin/specialize/delete/{id}', [specializeController::class, 'delete'])->name('admin.specialize.delete');
    Route::post('admin/specialize/action', [specializeController::class, 'action'])->name('admin.specialize.action');
    Route::get('admin/specialize/edit/{id}', [specializeController::class, 'edit'])->name('admin.specialize.edit');
    Route::post('admin/specialize/update/{id}', [specializeController::class, 'update'])->name('admin.specialize.update');

    // Admin degree
    Route::get('admin/degree', [degreeController::class, 'list'])->name('admin.degree.index');
    Route::get('admin/degree/add', [degreeController::class, 'create'])->name('admin.degree.add');
    Route::post('admin/degree/store', [degreeController::class, 'store'])->name('admin.degree.store');
    Route::get('admin/degree/delete/{id}', [degreeController::class, 'delete'])->name('admin.degree.delete');
    Route::post('admin/degree/action', [degreeController::class, 'action'])->name('admin.degree.action');
    Route::get('admin/degree/edit/{id}', [degreeController::class, 'edit'])->name('admin.degree.edit');
    Route::post('admin/degree/update/{id}', [degreeController::class, 'update'])->name('admin.degree.update');


    // Admin typeofemployee
    Route::get('admin/typeofemployees', [typeofemployeesController::class, 'list'])->name('admin.typeofemployees.index');
    Route::get('admin/typeofemployees/add', [typeofemployeesController::class, 'create'])->name('admin.typeofemployees.add');
    Route::post('admin/typeofemployees/store', [typeofemployeesController::class, 'store'])->name('admin.typeofemployees.store');
    Route::get('admin/typeofemployees/delete/{id}', [typeofemployeesController::class, 'delete'])->name('admin.typeofemployees.delete');
    Route::post('admin/typeofemployees/action', [typeofemployeesController::class, 'action'])->name('admin.typeofemployees.action');
    Route::get('admin/typeofemployees/edit/{id}', [typeofemployeesController::class, 'edit'])->name('admin.typeofemployees.edit');
    Route::post('admin/typeofemployees/update/{id}', [typeofemployeesController::class, 'update'])->name('admin.typeofemployees.update');


    //users
    Route::resource('users', UserController::class);
    Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::post('users/action', [UserController::class, 'action'])->name('users.action');
    Route::post('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('users/{id}/change_password', [UserController::class, 'change_password'])->name('users.change_password');

    //profile
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/change_password', [ProfileController::class, 'change_password'])->name('profile.change_password');

    Route::get('profile/activities', [UserActivityController::class, 'show'])->name('profile.activity');
    Route::delete('profile/activities/{id}', [UserActivityController::class, 'destroy'])->name('profile.activity.destroy');

    Route::get('profile/sessions', [UserSessionController::class, 'show'])->name('profile.session');
    Route::delete('profile/sessions/{id}', [UserSessionController::class, 'destroy'])->name('profile.session.destroy');

    /**
     * Roles & Permissions
     */
    Route::resource('roles', RoleController::class)->except('show');
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('permissions/list', [PermissionController::class, 'list'])->name('admin.permission.list');
    Route::get('permissions/edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
    Route::get('permissions/delete/{id}', [PermissionController::class, 'delete'])->name('admin.permission.delete');
    Route::post('permissions/update/{id}', [PermissionController::class, 'updatePermission'])->name('admin.permission.update');
    Route::post('permissions/action', [PermissionController::class, 'action'])->name('admin.permission.action');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('admin.permission.create');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('admin.permission.store');
    Route::post('permissions', [PermissionController::class, 'update'])->name('permissions.update');

    //settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::get('settings/auth', [SettingController::class, 'auth'])->name('settings.auth');
    Route::get('settings/notifications', [SettingController::class, 'notifications'])->name('settings.notifications');
    Route::get('settings/mail', [SettingController::class, 'mail'])->name('settings.mail');
    Route::post('settings/mail', [SettingController::class, 'update_mail'])->name('settings.update_mail');

    // activity
    Route::get('activities', [ActivityController::class, 'index'])->name('activity.index');
});
