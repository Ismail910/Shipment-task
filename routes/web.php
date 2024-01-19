<?php

use App\Http\Controllers\JournalEntityController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();




Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');
    Route::get('/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
    Route::post('/shipments', [ShipmentController::class, 'store'])->name('shipments.store');
    Route::get('/shipments/{shipment}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
    Route::put('/shipments/{shipment}', [ShipmentController::class, 'update'])->name('shipments.update');
    Route::delete('/shipments/{shipment}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');
    Route::get('/journal-entities', [JournalEntityController::class, 'index'])->name('journal-entities.index');
    Route::get('/journal-entities/{journalEntity}', [JournalEntityController::class, 'show'])->name('journal-entities.show');
    Route::get('/journal-entities/create', [JournalEntityController::class, 'create'])->name('journal-entities.create');
    Route::post('/journal-entities', [JournalEntityController::class, 'store'])->name('journal-entities.store');
    Route::get('/journal-entities/{journalEntity}/edit', [JournalEntityController::class, 'edit'])->name('journal-entities.edit');
    Route::put('/journal-entities/{journalEntity}', [JournalEntityController::class, 'update'])->name('journal-entities.update');
    Route::delete('/journal-entities/{journalEntity}', [JournalEntityController::class, 'destroy'])->name('journal-entities.destroy');
});


