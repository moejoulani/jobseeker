<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SeekerControllers\SeekersController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ApplicationController;
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

Route::get('/', function () {
    return view('welcome');
})->name('public.home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth','dashboard'])->group(function () {
    Route::group(['prefix'=>'dashboard',], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/create', [PostController::class,'create'])->name('post.create');
    
    Route::post('/addpost',[PostController::class,'store'])->name('post.store');
    Route::get('/index',[PostController::class,'index'])->name('post.index');
    Route::get('/edit/{id}',[PostController::class,'edit'])->name('post.edit');
    Route::put('/update/{id}',[PostController::class,'update'])->name('post.update');
    Route::get('/destroy/{id}',[PostController::class,'destroy'])->name('post.destroy');
    Route::get('/applications',[ApplicationController::class,'index'])->name('application.index');
    Route::post('/application/view/{id}',[ApplicationController::class,'show'])->name('application.show');
    Route::post('/application/changeStatus',[ApplicationController::class,'changeToSeen']);
    });

});

// Route::get('send-mail', function () {

//     $details = [
//         'title' => 'Mail from ItSolutionStuff.com',
//         'body' => 'This is for testing email using smtp'
//     ];
   
//     \Mail::to('mjtech256@gmail.com')->send(new \App\Mail\SendEmail($details));
   
//     dd("Email is Sent.");
// });
Route::middleware(['auth'])->group(function () {


  Route::get('/seekers',[SeekersController::class,'index'])->name('seekers.home'); 
  Route::post('/seekers/getJobs',[SeekersController::class,'getAllJobs']);
  Route::post('/seekers/applyJob/{id}',[SeekersController::class,'jobApply'])->name('seeker.apply');
  Route::post('/seekers/applynow/{id}',[SeekersController::class,'apply'])->name('seeker.app');
  Route::get('/seekers/myApplications',[SeekersController::class,'myApplications'])->name('seeker.myApplications');
  Route::post('/seekers/filterJobs',[SeekersController::class,'filterJobs'])->name('seeker.filterJobs');
  Route::post('/seekers/search',[SeekersController::class,'search'])->name('seeker.search');

});

// Route::group(['prefix'=>'dashboard',], function(){
    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/create', [PostController::class,'create'])->name('post.create');
    // Route::post('/addpost',[PostController::class,'store'])->name('post.store');
    // Route::get('/index',[PostController::class,'index'])->name('post.index');
    // Route::get('/edit/{id}',[PostController::class,'edit'])->name('post.edit');
    // Route::put('/update/{id}',[PostController::class,'update'])->name('post.update');
    // Route::get('/destroy/{id}',[PostController::class,'destroy'])->name('post.destroy');
// });
