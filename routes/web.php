<?php
use App\Http\Controllers\PenerimaBantuanController;
use App\Http\Controllers\AssessmentPenerimaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PenerimaBantuanController::class, 'index'])->name('home');
Route::resource('penerima', PenerimaBantuanController::class);
Route::get('penerima/{penerima}/assessment/create', [AssessmentPenerimaController::class, 'create'])->name('assessment.create');
Route::post('penerima/{penerima}/assessment', [AssessmentPenerimaController::class, 'store'])->name('assessment.store');