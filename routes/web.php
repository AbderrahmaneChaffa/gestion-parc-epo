<?php

use App\Http\Controllers\EquipementController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProfileController;
use App\Models\Equipement;
use App\Models\Movement;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    // Récupérer les équipements en alerte
    $alertesStock = Equipement::whereColumn('quantite_en_stock', '<=', 'seuil_alerte')->get();
    // Les 5 derniers mouvements pour l'historique
    $derniersMouvements = Movement::with('equipment')->latest()->take(5)->get();

    return view('dashboard', compact('alertesStock', 'derniersMouvements'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('equipments', EquipementController::class);
    Route::resource('movements', MovementController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
