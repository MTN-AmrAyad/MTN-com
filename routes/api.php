<?php

use App\Http\Controllers\BfhController;
use App\Http\Controllers\CtrlAnatomicalOutLineFeedController;
use App\Http\Controllers\CtrlAttendJulyController;
use App\Http\Controllers\DiabetsJulayController;
use App\Http\Controllers\EbmAttendanceController;
use App\Http\Controllers\EBMController;
use App\Http\Controllers\EmotionalMedicenQrController;
use App\Http\Controllers\FeelingMedcineAttendController;
use App\Http\Controllers\FeelingMedicanController;
use App\Http\Controllers\FetraLiveController;
use App\Http\Controllers\SeminarEbmController;
use App\Models\CtrlAttendJuly;
use App\Models\FeelingMedcineAttend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::controller(EBMController::class)->group(function () {
    Route::post('ebmAttendance',  'store');
    Route::get('ebmAttendance',  'index');
});


Route::controller(EbmAttendanceController::class)->group(function () {
    Route::post('ebmAttendance',  'store');
    Route::get('ebmAttendance',  'index');
});
Route::controller(FetraLiveController::class)->group(function () {
    Route::post('fetra-live',  'store');
    Route::get('fetra-live',  'index');
});

Route::controller(BfhController::class)->group(function () {
    Route::post('balance-healing',  'store');
    Route::get('balance-healing',  'index');
});

Route::controller(CtrlAnatomicalOutLineFeedController::class)->group(function () {
    Route::post('Anatomical-outLine-Feed',  'store');
    Route::get('Anatomical-outLine-Feed',  'index');
});
Route::controller(FeelingMedicanController::class)->group(function () {
    Route::post('feelingMedican-fetraLive',  'store');
    Route::get('feelingMedican-fetraLive',  'index');
});
Route::controller(FeelingMedcineAttendController::class)->group(function () {
    // Route::post('feelingMedican-fetraLive-getTicket',  'getTicket');
    Route::post('reservation',  'store');
    Route::get('checkChair',  'checkChair');
});
Route::controller(SeminarEbmController::class)->group(function () {
    // Route::post('feelingMedican-fetraLive-getTicket',  'getTicket');
    Route::post('seminarEBM',  'store');
    Route::get('seminarEBM',  'index');
});
Route::controller(CtrlAttendJulyController::class)->group(function () {
    // Route::post('feelingMedican-fetraLive-getTicket',  'getTicket');
    Route::post('CTRL-storeData',  'store');
    Route::get('CTRL-getData',  'index');
    Route::get('CTRL-checkChair',  'checkChair');
});
Route::controller(EmotionalMedicenQrController::class)->group(function () {
    Route::post('emotional-qr-store',  'store');
    Route::get('emotional-qr-   ',  'index');
});
Route::controller(DiabetsJulayController::class)->group(function () {
    Route::post('diabets-store',  'store');
    Route::get('diabets-get',  'index');
});
