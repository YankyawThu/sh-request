<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MeetingRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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
Route::middleware(['auth'])->group(function() {
    // MeetingController
    Route::get('/', [MeetingRequestController::class , 'upcoming'])->name('/');
    Route::get('/live', [MeetingRequestController::class , 'live']);
    Route::get('/end', [MeetingRequestController::class , 'end']);
    Route::get('/meeting-request-form', function () {
        return Inertia::render('MeetingForm', ['title' => 'Meeting Request']);
    });
    Route::post('/check-date',[MeetingRequestController::class, 'checkDate']);
    Route::post('/create',[MeetingRequestController::class, 'createReq']);
    Route::get('/view/{id}', [MeetingRequestController::class, 'view']);
    Route::get('/approve/{id}', [MeetingRequestController::class, 'approve'])->name('approve');
    Route::post('/edit/{id}', [MeetingRequestController::class, 'edit']);
    Route::get('/delete/{id}', [MeetingRequestController::class, 'delete']);

    // UserController
    Route::post('/create-user' , [UserController::class , 'create_user']);
    Route::get('/check-approve/{id}' , [UserController::class , 'approve_req']);
    Route::get('/get_noti' , [UserController::class , 'notiList']);
});
