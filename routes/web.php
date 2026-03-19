<?php
use App\Http\Controllers\EleveAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\NiveauScolaireController;
use App\Http\Controllers\ClasseScolaireController;
use App\Http\Controllers\ActiviteController;

// ============================================
// ROUTES PUBLIQUES
// ============================================
Route::get('/cours', [CoursController::class, 'index']);
Route::get('/activites', [ActiviteController::class, 'index']);
Route::get('/niveaux', [NiveauScolaireController::class, 'index']);
Route::get('/classes', [ClasseScolaireController::class, 'index']);

// Inscription public
Route::get('/inscriptions/create', [InscriptionController::class, 'create']);
Route::post('/inscriptions', [InscriptionController::class, 'store']);

// Login admin
Route::get('/admin/login', [AdminAuthController::class, 'showLogin']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// ============================================
// ROUTES PROTÉGÉES (middleware admin)
// ============================================
Route::middleware('admin')->group(function () {

    // Déconnexion
    Route::post('/admin/logout', [AdminAuthController::class, 'logout']);

    // Activités
    Route::get('/admin/activites', [ActiviteController::class, 'index']);
    Route::get('/admin/activites/create', [ActiviteController::class, 'create']);
    Route::post('/admin/activites', [ActiviteController::class, 'store']);
    Route::get('/admin/activites/{id}/edit', [ActiviteController::class, 'edit']);
    Route::put('/admin/activites/{id}', [ActiviteController::class, 'update']);
    Route::delete('/admin/activites/{id}', [ActiviteController::class, 'destroy']);

    // Inscriptions
    Route::get('/admin/inscriptions', [InscriptionController::class, 'index']);
    Route::put('/admin/inscriptions/{id}/confirmer', [InscriptionController::class, 'confirmer']);
    Route::put('/admin/inscriptions/{id}/refuser', [InscriptionController::class, 'refuser']);
    Route::delete('/admin/inscriptions/{id}', [InscriptionController::class, 'destroy']);

    // Salles
    Route::get('/admin/salles', [SalleController::class, 'index']);
    Route::get('/admin/salles/create', [SalleController::class, 'create']);
    Route::post('/admin/salles', [SalleController::class, 'store']);
    Route::get('/admin/salles/{id}/edit', [SalleController::class, 'edit']);
    Route::put('/admin/salles/{id}', [SalleController::class, 'update']);
    Route::delete('/admin/salles/{id}', [SalleController::class, 'destroy']);

    // Cours
    Route::get('/admin/cours', [CoursController::class, 'index']);
    Route::get('/admin/cours/create', [CoursController::class, 'create']);
    Route::post('/admin/cours', [CoursController::class, 'store']);
    Route::get('/admin/cours/{id}/edit', [CoursController::class, 'edit']);
    Route::put('/admin/cours/{id}', [CoursController::class, 'update']);
    Route::delete('/admin/cours/{id}', [CoursController::class, 'destroy']);

    // Planning
    Route::get('/admin/plannings', [PlanningController::class, 'index']);
    Route::get('/admin/plannings/create', [PlanningController::class, 'create']);
    Route::post('/admin/plannings', [PlanningController::class, 'store']);
    Route::get('/admin/plannings/{id}/edit', [PlanningController::class, 'edit']);
    Route::put('/admin/plannings/{id}', [PlanningController::class, 'update']);
    Route::delete('/admin/plannings/{id}', [PlanningController::class, 'destroy']);

    // Élèves
    Route::get('/admin/eleves', [EleveController::class, 'index']);
    Route::delete('/admin/eleves/{id}', [EleveController::class, 'destroy']);

});



// Routes élève
Route::post('/eleve/register', [EleveAuthController::class, 'register']);
Route::post('/eleve/login', [EleveAuthController::class, 'login']);
Route::post('/eleve/logout', [EleveAuthController::class, 'logout']);
Route::get('/eleve/me', [EleveAuthController::class, 'me']);