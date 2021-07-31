<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
 */
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/validate-user', 'HomeController@checkUserRole');

/*=====================================ADMIN=====================================*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function () {
    Route::get('/', 'Admin\DashboardController@index');
    /*
    |---------------------------------
    | Employee Management Routes Here     |
    |---------------------------------
     */
    Route::group(['prefix' => 'employee-management'], function () {
        Route::get('/', 'Admin\EmployeeController@index');
        Route::get('employee-data', 'Admin\EmployeeController@employee_data');
        Route::get('create', 'Admin\EmployeeController@create');
        Route::post('/save-employee', 'Admin\EmployeeController@store');
        Route::get('{id}/edit', 'Admin\EmployeeController@edit');
        Route::post('{id}/update', 'Admin\EmployeeController@update');
        Route::get('delete/{id}', 'Admin\EmployeeController@destroy');
    });
    /*
    |------------------------------------------
    | Company Management Routes Here          |
    |------------------------------------------
     */
    Route::group(['prefix' => 'company-management'], function () {
        Route::get('/', 'Admin\ComapanyController@index');
        Route::get('company-data', 'Admin\ComapanyController@company_data');
        Route::get('create', 'Admin\ComapanyController@create');
        Route::post('/save-company', 'Admin\ComapanyController@store');
        Route::get('{id}/edit', 'Admin\ComapanyController@edit');
        Route::post('{id}/update', 'Admin\ComapanyController@update');
        Route::get('{id}/view', 'Admin\ComapanyController@show');
        Route::get('delete/{id}', 'Admin\ComapanyController@destroy');
    });
});


/*=====================================COMPANY=====================================*/
Route::group(['prefix' => 'company', 'middleware' => ['company', 'auth']], function () {
    Route::get('/', 'companies\DashboardController@index');
    /*
    |---------------------------------
    | Employee Management Routes Here    |
    |---------------------------------
     */
    Route::group(['prefix' => 'employee-management'], function () {
        Route::get('/', 'companies\EmployeeManagementController@index');
        Route::get('employee-data', 'companies\EmployeeManagementController@employeeData');
        Route::get('create', 'companies\EmployeeManagementController@create');
        Route::post('/save-employee', 'companies\EmployeeManagementController@store');
        Route::get('{id}/edit', 'companies\EmployeeManagementController@edit');

        Route::post('{id}/update', 'companies\EmployeeManagementController@update');
        Route::get('delete/{id}', 'companies\EmployeeManagementController@destroy');
    });
});
