<?php

use App\Http\Controllers\Api\ControllerHopitaux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcoleController;
use App\Http\Controllers\Api\LyceeController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\CommuneController;
use App\Http\Controllers\Api\VillageController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\Api\DepartementController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('regions', [RegionController::class, 'createRegion']);
Route::get('regions', [RegionController::class, 'getRegion']);
Route::get('regions/{code}', [RegionController::class, 'getRegionByCode']);
Route::put('regions/{code}/update', [RegionController::class, 'updateRegionByCode']);
Route::delete('region/{code}/delete', [RegionController::class, 'deleteRegion']);
Route::get('regions/{regionId}/departements', [RegionController::class, 'getAllRegionDepartements']);
// Route::get('regions/{regionCode}/departements/departementId', [RegionController::class, 'getOneRegionDepartement']);

Route::get('location/{code}', [RegionController::class, 'getLocationByCode']);

Route::post('departements', [DepartementController::class, 'createDepartement']);
Route::get('departements', [DepartementController::class, 'getDepartement']);
Route::get('departements/{code}', [DepartementController::class, 'getDepartementByCode']);
Route::patch('departements/{code}/update', [DepartementController::class, 'updateDepartementByCode']);
Route::delete('departements/{code}/delete', [DepartementController::class, 'deleteDepartement']);
Route::get('departements/{departementId}/arrondissements', [DepartementController::class, 'getAllDepartementArrondissements']);


Route::get('arrondissements', [ArrondissementController::class, 'getArrondissement']);
Route::post('arrondissements', [ArrondissementController::class, 'createArrondissement']);
Route::get('arrondissements/{code}', [ArrondissementController::class, 'getArrondissementByCode']);
Route::get('arrondissements/{communeId}/communes', [ArrondissementController::class, 'getAllArrondondissementCommunes']);
Route::delete('arrondissements/{code}', [ArrondissementController::class, 'destroyArrondissement']);
Route::put('/arrondissements/{code}', [ArrondissementController::class, 'editArrondissement']);

Route::post('communes', [CommuneController::class, 'createCommune']);
Route::get('communes', [CommuneController::class, 'getCommune']);
Route::get('communes/{code}', [CommuneController::class, 'getCommuneByCode']);
Route::get('communes/{id}/villages', [CommuneController::class, 'getAllCommuneVillages']);
Route::get('communes/{id}/ecoles', [CommuneController::class, 'getAllCommuneEcoles']);
Route::get('communes/{id}/lycees', [CommuneController::class, 'getAllCommuneLycees']);
Route::get('communes/{id}/hopitaux', [CommuneController::class, 'getAllCommuneHopitaux']);
Route::patch('communes/{code}/update', [CommuneController::class, 'updateCommune']);
Route::delete('communes/{code}/delete', [CommuneController::class, 'deleteCommune']);

Route::get('villages', [VillageController::class, 'getVillage']);
Route::post('villages', [VillageController::class, 'createVillage']);
Route::get('villages/{code}', [VillageController::class, 'getVillageByCodes']);
Route::put('villages/{code}', [VillageController::class, 'updateVillage']);
Route::delete('villages/{code}', [VillageController::class, 'destroyVillage']);

Route::get('ecoles', [EcoleController::class, 'getEcole']);
Route::get('ecoles', [EcoleController::class, 'createEcole']);

Route::get('hopitals', [ControllerHopitaux::class, 'getHopitaux']);
Route::post('hopitals', [ControllerHopitaux::class, 'createHopital']);
Route::get('hopitals/{id}', [ControllerHopitaux::class, 'getHopitalById']);
Route::put('hopitals/{id}', [ControllerHopitaux::class, 'updateHopital']);
Route::delete('hopitals/{id}', [ControllerHopitaux::class, 'deleteHopital']);

Route::post('lycees', [LyceeController::class, 'createLycee']);
Route::get('lycees', [LyceeController::class, 'getLycee']);
Route::get('lycees/{code}', [LyceeController::class, 'getLyceeByCodes']);
Route::put('lycees/{code}', [LyceeController::class, 'updateLyceeByCodes']);
Route::delete('lycees/{code}', [LyceeController::class, 'destroyLycee']);
