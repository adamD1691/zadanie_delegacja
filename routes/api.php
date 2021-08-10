<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('employee/add', 'EmployeeController@store');
Route::post('delegation/add', 'DelegationController@store');
Route::get('employee/{identifier}/delegations', 'EmployeeController@getDelegations');
