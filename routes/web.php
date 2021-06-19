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
        Route::get('/',[App\Http\Controllers\Admin\StatisticsController::class,'index']);
        //Route::get('/', function () { return view('admin.statistics');});
        Route::get('select2-autocomplete-ajax', 'App\Http\Controllers\Admin\CompanyController@dataAjax');

        Route::resource('admins', 'App\Http\Controllers\Admin\AdminController');
        Route::put('/admins/updateStatus/{admin}', [App\Http\Controllers\Admin\AdminController::class, 'updateStatus'])->name('admins.status');

        Route::resource('users', 'App\Http\Controllers\Admin\UserController');
        Route::put('/users/updateStatus/{admin}', [App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('users.status');

        Route::resource('companies_employees', 'App\Http\Controllers\Admin\CompanyEmployeeController');

        Route::resource('companies', 'App\Http\Controllers\Admin\CompanyController');
        Route::put('/companies/updateStatus/{admin}', [App\Http\Controllers\Admin\CompanyController::class, 'updateStatus'])->name('companies.status');

        Route::resource('features', 'App\Http\Controllers\Admin\FeatureController');
        Route::put('/features/updateStatus/{admin}', [App\Http\Controllers\Admin\FeatureController::class, 'updateStatus'])->name('features.status');


        Route::resource('traders', 'App\Http\Controllers\Admin\TraderController');
        Route::put('/traders/updateStatus/{admin}', [App\Http\Controllers\Admin\TraderController::class, 'updateStatus'])->name('traders.status');


        Route::resource('banks_employees', 'App\Http\Controllers\Admin\BankEmployeeController');
        Route::resource('employees', 'App\Http\Controllers\Admin\EmployeeController');

        Route::resource('banks', 'App\Http\Controllers\Admin\BankController');
        Route::put('/banks/updateStatus/{admin}', [App\Http\Controllers\Admin\BankController::class, 'updateStatus'])->name('banks.status');

        Route::resource('countries', 'App\Http\Controllers\Admin\CountryController');
        Route::put('/countries/updateStatus/{admin}', [App\Http\Controllers\Admin\CountryController::class, 'updateStatus'])->name('countries.status');

        Route::resource('cities', 'App\Http\Controllers\Admin\CityController');
        Route::put('/cities/updateStatus/{city}', [App\Http\Controllers\Admin\CityController::class, 'updateStatus'])->name('cities.status');

        Route::resource('models', 'App\Http\Controllers\Admin\ModelController');
        Route::resource('model_years', 'App\Http\Controllers\Admin\ModelYearController');

        Route::resource('regions', 'App\Http\Controllers\Admin\RegionController');
        Route::put('/regions/updateStatus/{city}', [App\Http\Controllers\Admin\RegionController::class, 'updateStatus'])->name('regions.status');


        Route::resource('brands', 'App\Http\Controllers\Admin\BrandController');
        Route::resource('insurances_slides', 'App\Http\Controllers\Admin\InsurancesSlidesController');

        Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
        //Route::get('gettype/{id}', [App\Http\Controllers\Admin\ProductController::class, 'gettype'])->name('products.gettype');

        Route::resource('bidders', 'App\Http\Controllers\Admin\BidderController')->except(['edit','store','update','create']);
        Route::resource('insurances', 'App\Http\Controllers\Admin\InsuranceController');

        Route::resource('biddings', 'App\Http\Controllers\Admin\BiddingController');
        Route::put('/biddings/updateStatus/{bidding}', [App\Http\Controllers\Admin\BiddingController::class, 'updateStatus'])->name('biddings.status');
        Route::get('myform/ajax/{id}', [App\Http\Controllers\Admin\BiddingController::class, 'subBrand'])->name('myform.ajax');
        Route::get('myform2/ajax/{id}', [App\Http\Controllers\Admin\BiddingController::class, 'subBrand2'])->name('myform2.ajax');

        Route::resource('orders', 'App\Http\Controllers\Admin\OrderController');
        Route::put('/orders/updateStatus/{bidding}', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');

        Route::resource('contacts', 'App\Http\Controllers\Admin\ContactController')->except(['store','edit','update','destroy','show']);
        Route::put('/contacts/updateStatus/{admin}', [App\Http\Controllers\Admin\ContactController::class, 'updateStatus'])->name('contacts.status');

        Route::resource('settings', 'App\Http\Controllers\Admin\SettingController')->except(['store','edit','destroy','show']);


    });

});

// Trader Routes
Route::group(['prefix'=>'trader'], function (){
    Route::get('/login', [App\Http\Controllers\Trader\Auth\LoginController::class, 'showLoginForm'])->name('trader.show_login_form');
    Route::post('login', [App\Http\Controllers\Trader\Auth\LoginController::class, 'login'])->name('trader.login');
    Route::post('logout', [App\Http\Controllers\Trader\Auth\LoginController::class, 'logout'])->name('trader.logout');

    Route::group(['middleware'=>'trader'], function (){
        Route::get('/', function () { return view('trader.statistics');});

        Route::resource('c_employees', 'App\Http\Controllers\Trader\EmployeeController');
        Route::resource('c_biddings', 'App\Http\Controllers\Trader\BiddingController');
        Route::put('/biddings/updateStatus/{bidding}', [App\Http\Controllers\Trader\BiddingController::class, 'updateStatus'])->name('c_biddings.status');

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
