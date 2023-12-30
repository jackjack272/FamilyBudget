<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// ------------------------ admin pannel 
route::middleware('admin')->group(function(){
    route::get('admin/show','App\Http\Controllers\adminController@show')
    ->name('admin.all_users'); //R // see all users 

    route::get('admin/deleteUser/{id}','App\Http\Controllers\adminController@delete')
        ->name('admin.delete');//D

    route::post('admin/makeAdmin','App\Http\Controllers\adminController@makeAdmin')
        ->name('admin.add');//C new admin

    // give 
    route::get('admin/giveAdmin/{id}','App\Http\Controllers\adminController@giveAdmin')
    ->name('admin.giveAdmin');//C new admin

    // take admin 
    route::get('admin/takeAdmin/{id}','App\Http\Controllers\adminController@takeAdmin')
    ->name('admin.takeAdmin');//C new admin


    route::get('admin/givingTimeOuts/{id}','App\Http\Controllers\adminController@time_out')
    ->name('admin.time_out'); //u // time out users 

    route::get('admin/removeTimeOut/{id}','App\Http\Controllers\adminController@takeOff_time_out')
    ->name('admin.remove_time_out'); //u // time out users 


});

 // dont users to access CUD if their timed_out // only read
// ------------------------ budget 
    route::get('budget/show','App\Http\Controllers\budgetController@show')
    ->name('budget.show'); //R
        
    route::get('budget/totals','App\Http\Controllers\budgetController@showTotalsOnNeeds')
        ->name('budget.totals'); //R

    
    // if user is banned allow them to read only 
route::middleware('banned')->group(function(){
    route::post('budget/add/{id}','App\Http\Controllers\budgetController@create')
        ->name('budget.add'); //C

    route::get('budget/delete/{id}','App\Http\Controllers\budgetController@delete')
        ->name('budget.delete'); //D

    route::get('budget/updateForm/{id}','App\Http\Controllers\budgetController@giveUpdateForm')
        ->name('budget.updateForm'); //Update Form 

    route::post('budget/update/{id}','App\Http\Controllers\budgetController@update')
        ->name('budget.update'); //Update 
});

// ------------------------ categories 
    route::get('categories/show/{id}','App\Http\Controllers\categoriesController@show')
    ->name('categories.show'); //R

route::middleware('banned')->group(function(){
    route::post('categories/add/{id}','App\Http\Controllers\categoriesController@create')
        ->name('categories.add'); //C
    
    route::get('categories/delete/{id}','App\Http\Controllers\categoriesController@delete')
        ->name('categories.delete'); //D

    route::get('categories/updateForm/{id}','App\Http\Controllers\categoriesController@giveUpdateForm')
        ->name('categories.updateForm'); //Update Form 
    route::post('categories/update/{id}','App\Http\Controllers\categoriesController@update')
        ->name('categories.update'); //Update 
});


// ------------------------ item stuff
    route::get('item/show/{id}/{bud_id}','App\Http\Controllers\itemController@show')
        ->name('item.show'); //R

route::middleware('banned')->group(function(){  
    route::post('item/add/{id}','App\Http\Controllers\itemController@create')
        ->name('item.add'); //C
    
    route::get('item/delete/{id}','App\Http\Controllers\itemController@delete')
        ->name('item.delete'); //D

    route::get('item/updateForm/{id}/{cat_id}/{bud_id}','App\Http\Controllers\itemController@giveUpdateForm')
        ->name('item.updateForm'); //Update Form 
        
    route::post('item/update/{id}/{cat_id}/{bud_id}','App\Http\Controllers\itemController@update')
        ->name('item.update'); //Update 
});    

// ------------------------ API stuff
    route::get('api/show','App\Http\Controllers\APIController@callAPI')
    ->name('api.call'); //R

    
//------------------------ welcome page. 
Route::get('/', 'App\Http\Controllers\welcomePageController@SayWelcome')
    ->name('welcome');

Route::get('/SaveNow', 'App\Http\Controllers\welcomePageController@tellSavings')
    ->name('savings');

Route::get('/HaveATrueNorth', 'App\Http\Controllers\welcomePageController@tellNS')
    ->name('trueNorth');


    Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
