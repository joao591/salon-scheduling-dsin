<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicoController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::resource('agendamentos', AgendamentoController::class);
    Route::get('/agendamentos/create', [AgendamentoController::class, 'create'])->name('agendamentos.create');
    Route::post('/agendamentos/create', [AgendamentoController::class, 'store'])->name('agendamentos.create');
    Route::get('agendamentos/listar', [AgendamentoController::class, 'listarTodos'])->name('agendamentos.listar');
    Route::get('agendamentos/{id}', [AgendamentoController::class, 'index'])->name('agendamentos.index');
    Route::get('agendamentos/{id}/editar', [AgendamentoController::class, 'edit'])->name('agendamentos.edit');
    Route::put('agendamentos/{id}', [AgendamentoController::class, 'update'])->name('agendamentos.update');
    Route::patch('agendamentos/{id}/confirmar', [AgendamentoController::class, 'confirmar'])->name('agendamentos.confirmar');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}/editar', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::resource('servicos', ServicoController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
