<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () { return view('home');});

// Admin Routes
Route::group(['prefix'=>'admin'], function (){

    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.show_login_form');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login');
    Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware'=>'admin'], function (){
        Route::get('/', function () { return view('admin.statistics');});

        Route::resource('admins', 'App\Http\Controllers\Admin\AdminController');
        Route::put('/admins/updateStatus/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'updateStatus'])->name('admins.status');

        Route::resource('users', 'App\Http\Controllers\Admin\UserController');
        Route::put('/users/updateStatus/{admin}', [App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('users.status');

        Route::resource('companies_employees', 'App\Http\Controllers\Admin\CompanyEmployeeController');

        Route::resource('companies', 'App\Http\Controllers\Admin\CompanyController');
        Route::put('/companies/updateStatus/{admin}', [App\Http\Controllers\Admin\CompanyController::class, 'updateStatus'])->name('companies.status');

        Route::resource('banks_employees', 'App\Http\Controllers\Admin\BankEmployeeController');

        Route::resource('banks', 'App\Http\Controllers\Admin\BankController');
        Route::put('/banks/updateStatus/{admin}', [App\Http\Controllers\Admin\BankController::class, 'updateStatus'])->name('banks.status');

        Route::resource('countries', 'App\Http\Controllers\Admin\CountryController');
        Route::put('/countries/updateStatus/{admin}', [App\Http\Controllers\Admin\CountryController::class, 'updateStatus'])->name('countries.status');

        Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
        Route::put('/categories/updateStatus/{admin}', [App\Http\Controllers\Admin\CategoryController::class, 'updateStatus'])->name('categories.status');

        Route::resource('brands', 'App\Http\Controllers\Admin\BrandController');

        Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
        Route::get('gettype/{id}', [App\Http\Controllers\Admin\ProductController::class, 'gettype'])->name('products.gettype');

        Route::resource('currencies', 'App\Http\Controllers\Admin\CurrencyController');
        Route::put('/currencies/updateStatus/{admin}', [App\Http\Controllers\Admin\CurrencyController::class, 'updateStatus'])->name('currencies.status');

        Route::resource('bidders', 'App\Http\Controllers\Admin\BidderController');
        Route::resource('insurances', 'App\Http\Controllers\Admin\InsuranceController');

        Route::resource('biddings', 'App\Http\Controllers\Admin\BiddingController');
        Route::put('/biddings/updateStatus/{bidding}', [App\Http\Controllers\Admin\BiddingController::class, 'updateStatus'])->name('biddings.status');


        Route::resource('contacts', 'App\Http\Controllers\Admin\ContactController')->except(['store','edit','update','destroy','show']);
        Route::put('/contacts/updateStatus/{admin}', [App\Http\Controllers\Admin\ContactController::class, 'updateStatus'])->name('contacts.status');

        Route::resource('settings', 'App\Http\Controllers\Admin\SettingController')->except(['store','edit','destroy','show']);


    });

});

// Bank Routes
Route::group(['prefix'=>'bank'], function (){
    Route::get('/login', [App\Http\Controllers\Bank\Auth\LoginController::class, 'showLoginForm'])->name('bank.show_login_form');
    Route::post('login', [App\Http\Controllers\Bank\Auth\LoginController::class, 'login'])->name('bank.login');
    Route::post('logout', [App\Http\Controllers\Bank\Auth\LoginController::class, 'logout'])->name('bank.logout');

    Route::group(['middleware'=>'bank'], function (){
        Route::get('/', function () { return view('bank.statistics');});

        Route::resource('b_employees', 'App\Http\Controllers\Bank\BankEmployeeController');
        Route::resource('b_biddings', 'App\Http\Controllers\Bank\BiddingController');
        Route::put('/biddings/updateStatus/{bidding}', [App\Http\Controllers\Bank\BiddingController::class, 'updateStatus'])->name('b_biddings.status');

    });
});
// Company Routes
Route::group(['prefix'=>'company'], function (){
    Route::get('/login', [App\Http\Controllers\Company\Auth\LoginController::class, 'showLoginForm'])->name('company.show_login_form');
    Route::post('login', [App\Http\Controllers\Company\Auth\LoginController::class, 'login'])->name('company.login');
    Route::post('logout', [App\Http\Controllers\Company\Auth\LoginController::class, 'logout'])->name('company.logout');

    Route::group(['middleware'=>'company'], function (){
        Route::get('/', function () { return view('company.statistics');});

        Route::resource('c_employees', 'App\Http\Controllers\Company\CompanyEmployeeController');
        Route::resource('c_biddings', 'App\Http\Controllers\Company\BiddingController');
        Route::put('/biddings/updateStatus/{bidding}', [App\Http\Controllers\Company\BiddingController::class, 'updateStatus'])->name('c_biddings.status');

    });
});

// Employee Routes
Route::group(['prefix'=>'employee'], function (){
    Route::get('/login', [App\Http\Controllers\Employee\Auth\LoginController::class, 'showLoginForm'])->name('employee.show_login_form');
    Route::post('login', [App\Http\Controllers\Employee\Auth\LoginController::class, 'login'])->name('employee.login');
    Route::post('logout', [App\Http\Controllers\Employee\Auth\LoginController::class, 'logout'])->name('employee.logout');

    Route::group(['middleware'=>'employee'], function (){
        Route::get('/', [App\Http\Controllers\Employee\BiddingController::class, 'redirect']);

        Route::resource('e_biddings', 'App\Http\Controllers\Employee\BiddingController')
        ->except(['update','edit','store','create','destroy','show']);

    });
});


  route::get('/docs-api',[App\Http\Controllers\Controller::class,'docs']);
  route::get('/api/json_download',[App\Http\Controllers\Controller::class,'download'])->name('postman');
