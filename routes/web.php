<?php

use App\Models\Department;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Livewire\TopRatedServicesFilter;
use App\Http\Controllers\Admin\NotiController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ComplainController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TransactionController;

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
    return view('signin');
})
    ->middleware('guest')
    ->name('signin');

Route::get('/home', [AdminController::class, 'home'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');

Route::get('lang/{lang}', [
    'as' => 'lang.switch',
    'uses' => 'App\Http\Controllers\LangController@switchLang',
]);



Route::middleware('auth')->group(function () {



    Route::get('/{page}/edit', [AdminController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::post('/{page}/update/{id}', [AdminController::class, 'update']);
    Route::get('/filter/top-rated-services', [AdminController::class, 'filterTopRatedServices'])
        ->name('filter.top.rated.services');

  

    Route::resource('roles', RoleController::class);
    Route::get('/search', [UserController::class , 'search'])->name('users.search');


    Route::resource('users', UserController::class);
    Route::resource('tasks', TaskController::class);
    Route::post('/tasks/update-status/{task}', [TaskController::class , 'updateStatus'])->name('tasks.update-status');


    Route::controller(DepartmentController::class)->group(function () {
        Route::get( 'departmetns' , 'index')->name('departments.index');
        Route::post('/add-department', 'store')->name('add.department');
        Route::post( 'update-department' , 'update')->name('update.department');
        Route::delete('department/delete/{id}',  'destroy')->name('department.delete');
        Route::get('/get-departments', 'getdepartments')->name('get.departments');
        Route::get('/departments/search', 'search')->name('departments.search');


        });
});

require __DIR__ . '/auth.php';
