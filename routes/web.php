<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CampayController;
use Nette\Utils\Html;

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
Route::get('/commands', function(){
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
    Artisan::call('storage:link');
    Artisan::call('config:cache');

});

Route::get('payment/status', [CampayController::class, 'getTransactionStatus'])->name('payment.status');
Route::group(['prefix' => 'admin',], function () {
    Route::get('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login');
    Route::get('/logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, "logout"])->name('admin.logout');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/',  [\App\Http\Livewire\Admin\Dashboard::class, '__invoke'])->name('home');
        Route::get('/dashboard',  [\App\Http\Livewire\Admin\Dashboard::class, '__invoke'])->name('dashboard');
        Route::get('/change-password',  [\App\Http\Livewire\Admin\ChangePassword::class, '__invoke'])->name('change-password');
        Route::get('/update-profile',  [\App\Http\Livewire\Admin\UpdateProfile::class, '__invoke'])->name('update-profile');
        Route::get('/edit-user',  [\App\Http\Livewire\Admin\Users\Edit::class, '__invoke'])->name('edit.user');
        Route::get('/users/{user}',  [\App\Http\Livewire\Admin\Users\Detail::class, '__invoke'])->name('user.detail');
        Route::get('/requests',  [\App\Http\Livewire\Admin\Request\Index::class, '__invoke'])->name('requests');
        Route::get('/users',  [\App\Http\Livewire\Admin\Users\Index::class, '__invoke'])->name('index.user');
        Route::get('/dashboard',  [\App\Http\Livewire\Admin\Dashboard::class, '__invoke'])->name('admin.dashboard');
        Route::get('/schools',  [\App\Http\Livewire\Admin\School\Index::class, '__invoke'])->name('admin.schools');
        Route::get('/schools/{school}',  [\App\Http\Livewire\Admin\School\Details::class, '__invoke'])->name('admin.school.details');
        Route::get('/school/delivrable/{delivrable}',  [\App\Http\Livewire\Admin\School\Delivrable\Details::class, '__invoke'])->name('admin.delivrable.details');
        Route::get('/constants',  [\App\Http\Livewire\Admin\Constant\Index::class, '__invoke'])->name('constant.index');

            Route::get('/categories', [\App\Http\Livewire\Admin\Categories\Index::class, '__invoke'])->name('categories');
            Route::get('/blogs', [\App\Http\Livewire\Admin\Blog\Index::class, '__invoke'])->name('blogs');
            Route::get('/blog/{blog}', [\App\Http\Livewire\Admin\Blog\Detail::class, '__invoke'])->name('blog.detail');
            Route::get('/testimonial', [\App\Http\Livewire\Admin\Testimonial\Index::class, '__invoke'])->name('testimonial');
            Route::get('/pages', [\App\Http\Livewire\Admin\Pages\Index::class, '__invoke'])->name('pages.index');
            Route::get('/faq', [\App\Http\Livewire\Admin\Faq\Index::class, '__invoke'])->name('faqs');
            Route::post('/call', [VoiceController::class, 'initiateCall'])->name('initiate_call');

        // Administrator
        Route::group(['as' => 'admin.'], function () {
            Route::resource('administrator', AdminController::class)->middleware(['permission:manage_administrators']);
            Route::resource('roles', RoleController::class)->middleware(['permission:manage_roles']);
            Route::get('permissions', [RoleController::class, 'permissions'])->name('roles.permissions')->middleware(['permission:manage_roles']);
            Route::get('assign_role',  [RoleController::class, 'rolesView'])->name('roles.assign')->middleware(['permission:manage_roles']);
            Route::post('assign_role',  [RoleController::class, 'rolesStore'])->name('roles.assign.post')->middleware(['permission:manage_roles']);
        });

    });


});


Route::group(['prefix' => 'campay'], function () {
    Route::post('/collect', [CampayController::class, 'collect']);
    Route::get('/transaction-status/{reference}', [CampayController::class, 'getTransactionStatus']);
    Route::post('/withdraw', [CampayController::class, 'withdraw']);
    Route::get('/balance', [CampayController::class, 'getAppBalance']);
    Route::post('/transaction-history', [CampayController::class, 'transactionHistory']);
    Route::post('/generate-payment-url', [CampayController::class, 'generatePaymentUrl']);
});




