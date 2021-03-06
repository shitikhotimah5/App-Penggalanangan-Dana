<?php

use App\Http\Controllers\{
    CampaignController,
    CategoryController,
    DashboardController
};
use Illuminate\Support\Facades\Route;

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
});


Route::group([
    'middleware' => ['auth', 'role:admin,donatur']
], function () {
    //
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Khusus Admin
    Route::group([
        'middleware' => 'role:admin'
    ], function () {
        //
        Route::resource('/category', CategoryController::class);

        Route::get('/campaign/data', [CampaignController::class, 'data'])->name('campaign.data');
        Route::get('/campaign/detail/{id}', [CampaignController::class, 'detail'])->name('campaign.detail');
        Route::resource('/campaign', CampaignController::class)->except('create', 'edit');
    });

    // Route Khusus Donatur
    Route::group([
        'middleware' => 'role:donatur'
    ], function () {
        //
    });
});
