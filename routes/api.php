<?php

use App\Http\Controllers\BctscanReadingController;
use App\Http\Controllers\BfhController;
use App\Http\Controllers\CtrlAnatomicalOutLineFeedController;
use App\Http\Controllers\CtrlAttendJulyController;
use App\Http\Controllers\DiabetsJulayController;
use App\Http\Controllers\EbmAttendanceController;
use App\Http\Controllers\EBMController;
use App\Http\Controllers\EbmExamController;
use App\Http\Controllers\EbtAdvancedAugestController;
use App\Http\Controllers\EmotionalMedicenQrController;
use App\Http\Controllers\FeelingMedcineAttendController;
use App\Http\Controllers\FeelingMedicanController;
use App\Http\Controllers\FetraLiveController;
use App\Http\Controllers\HamlFreeAugController;
use App\Http\Controllers\HowbuildSicknessController;
use App\Http\Controllers\LeadEbtAdvancedController;
use App\Http\Controllers\SeminarEbmController;
use App\Http\Controllers\PregnancyLandAugController;
use App\Http\Controllers\TgFitraOldController;
use App\Http\Controllers\Survay\BrainCtscanFeedBackController;
use App\Http\Controllers\Survay\CtrlOrganicAugController;
use App\Http\Controllers\Survay\FitraAugestController;
use App\Http\Controllers\Survay\PregnancyAugController;
use App\Models\CtrlAttendJuly;
use App\Models\FeelingMedcineAttend;
use App\Models\Survay\CtrlOrganicAug;
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
    //here
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
//routing EBM Exam
Route::controller(EbmExamController::class)->group(function () {
    Route::post('clientInfo', 'usersInfo');
    Route::post('clientAnswers', 'updateExam');
    Route::get('getAllClients', 'getAll');
    Route::get('getClient/{id}', 'getClientById');
});
//routing Haml free event in August
Route::controller(HamlFreeAugController::class)->group(function () {
    Route::post('pergancy-store', 'store');
    Route::get('pergancy-data', 'index');
    Route::get('pergancy-checkChair',  'checkChair');
});
//routing EBT Advanced Level in August
Route::controller(EbtAdvancedAugestController::class)->group(function () {
    Route::post('EBT-Advanced-store', 'store');
    Route::get('EBT-Advanced-data', 'index');
    Route::get('EBT-Advanced-checkChair',  'checkChair');
    Route::post('EBT-Advanced-scanQr/{id}/{key}',  'scanQr');
    Route::get('EBT-Advanced-getScanQr',  'getQr');
});
//routing Survey CTRL Oraginc Augest
Route::controller(CtrlOrganicAugController::class)->group(function () {
    Route::post('survey-CTRLOrgainc-store', 'create');
    Route::get('survey-CTRLOrgainc-data', 'index');
});
//routing Survey Pregnancy Augest
Route::controller(PregnancyAugController::class)->group(function () {
    Route::post('survey-Pregnancy-store', 'create');
    Route::get('survey-Pregnancy-data', 'index');
});
//routing Survey Fitra  Augest
Route::controller(FitraAugestController::class)->group(function () {
    Route::post('survey-fitra-store', 'create');
    Route::get('survey-fitra-data', 'index');
});

//route for land page Pregnancy Landpage Augest
Route::controller(PregnancyLandAugController::class)->group(function () {
    Route::get('pregnancy-landpage-data', 'index');
    Route::post('pregnancy-landpage-store', 'store');
});

//routing EBT Advanced Level in August to get lead
Route::controller(LeadEbtAdvancedController::class)->group(function () {
    Route::post('ebtAdvanced-store', 'store');
    Route::get('ebtAdvanced-retrieve', 'index');
});

Route::controller(BctscanReadingController::class)->group(function () {
    Route::post('BCT-Scan-registration', 'store');
    Route::get('BCT-Scan-retriving', 'index');
});
//Route::controller(HowbuildSicknessController::class)->group(function () {
//    Route::post('sickness-registration', 'store');
//    Route::get('sickness-retriving', 'index');
//});
Route::controller(HowbuildSicknessController::class)->group(function () {
    Route::post('sickness-registration', 'store');
    Route::get('sickness-retriving', 'index');
    Route::get('sickness-checkChair',  'checkChair');
    Route::post('sickness-scanQr/{id}/{key}',  'scanQr');
    Route::get('sickness-getScanQr',  'getQr');
});

Route::controller(TgFitraOldController::class)->group(function () {
    Route::post('tgFitra-registration', 'store');
    Route::get('tgFitra-retriving', 'index');
});

Route::get('/bct-feedbacks-data', [BrainCtscanFeedBackController::class, 'index']);
Route::post('/bct-feedbacks-store', [BrainCtscanFeedBackController::class, 'store']);
