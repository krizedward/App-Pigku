<?php

use App\Http\Controllers\TSaldoController;
use App\Http\Controllers\TIncomeController;
use App\Http\Controllers\TTemporderController;
use App\Http\Controllers\TTempexpenseController;
use App\Http\Controllers\TExpenseController;
use App\Http\Controllers\TOrderController;
use App\Http\Controllers\TMenuController;
use App\Http\Controllers\MKategoriController;
use App\Http\Controllers\MRoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MPaymentController;
use App\Http\Controllers\TTempmenudetailController;
use App\Http\Controllers\TMenuPaketController;
use App\Http\Controllers\TPenggunaController;
use App\Http\Controllers\BRoleMenuController;
use App\Http\Controllers\BMenuController;
use App\Http\Controllers\TSaleController;
use App\Http\Controllers\TCashierController;
use App\Http\Controllers\TOrderOldController;
use App\Http\Controllers\TNotaController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect('/login');
    // return view('dashboard.main');  // Redirect ke URL lokal
    // return redirect('/dashboard/main');  // Redirect ke URL lokal DashboardController
    // return redirect('/t_order/pilih-tanggal');  // Redirect ke URL lokal DashboardController
});

// Dashboard utama
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.main');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // master role
    Route::get('/master-role', [MRoleController::class, 'index'])->name('master-role.index');
    Route::get('/master-role/create', [MRoleController::class, 'create'])->name('master-role.create');
    Route::post('/master-role/create', [MRoleController::class, 'store'])->name('master-role.store');
    Route::delete('/master-role/{id}/destroy', [MRoleController::class, 'destroy'])->name('master-role.destroy');
    Route::get('/master-role/{id}/edit', [MRoleController::class, 'edit'])->name('master-role.edit');
    Route::put('/master-role/{id}/update', [MRoleController::class, 'update'])->name('master-role.update');

    // pengguna
    Route::get('/pengguna', [TPenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/create', [TPenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna/store', [TPenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}/edit', [TPenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}/update', [TPenggunaController::class, 'update'])->name('pengguna.update');
    Route::get('/pengguna/{id}/show', [TPenggunaController::class, 'show'])->name('pengguna.show');    
    Route::delete('/pengguna/{id}/destroy', [TPenggunaController::class, 'destroy'])->name('pengguna.destroy');

    // new
    Route::get('/master-kategori', [MKategoriController::class, 'index'])->name('master-kategori.index');
    Route::get('/master-kategori/create', [MKategoriController::class, 'create'])->name('master-kategori.create');
    Route::post('/master-kategori/store', [MKategoriController::class, 'store'])->name('master-kategori.store');
    Route::delete('/master-kategori/{id}/destroy', [MKategoriController::class, 'destroy'])->name('master-kategori.destroy');

    Route::get('/menu', [TMenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [TMenuController::class, 'create'])->name('menu.create');
    Route::post('/menu/store', [TMenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{id}/edit', [TMenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{id}/update', [TMenuController::class, 'update'])->name('menu.update');
    Route::get('/menu/{id}/show', [TMenuController::class, 'show'])->name('menu.show');    
    Route::delete('/menu/{id}/destroy', [TMenuController::class, 'destroy'])->name('menu.destroy');

    Route::get('/paket-menu/{id}/show', [TMenuPaketController::class, 'show'])->name('paket.menu.show');

    // Route::get('/order', [TOrderController::class, 'index'])->name('order.index');
    // Route::get('/order/create', [TOrderController::class, 'create'])->name('order.create');
    // Route::post('/order/store', [TOrderController::class, 'store'])->name('order.store');
    // Route::get('/order/{id}/edit', [TOrderController::class, 'edit'])->name('order.edit');
    // Route::delete('/order/{id}/destroy', [TOrderController::class, 'destroy'])->name('order.destroy');

    Route::get('/order', [TOrderOldController::class, 'index'])->name('order.index');
    Route::get('/order/create', [TOrderOldController::class, 'create'])->name('order.create');
    Route::post('/order/store', [TOrderOldController::class, 'store'])->name('order.store');
    Route::get('/order/{id}/edit', [TOrderOldController::class, 'edit'])->name('order.edit');
    Route::delete('/order/{id}/destroy', [TOrderOldController::class, 'destroy'])->name('order.destroy');

    Route::get('/sale/pilih-tanggal', [TSaleController::class, 'pilihTanggal'])->name('t_sale.pilih');
    Route::post('/sale/store', [TSaleController::class, 'store'])->name('t_sale.store');
    Route::get('/sale/list/{date}', [TSaleController::class, 'listByDate'])->name('t_sale.list');

    Route::get('/t_order/pilih-tanggal', [TOrderOldController::class, 'pilihTanggal'])->name('t_order.pilih');
    Route::get('/t_order/list/{date}', [TOrderOldController::class, 'listByDate'])->name('t_order.list');
    Route::get('/t_order/list/{date}/create', [TOrderOldController::class, 'listCreate'])->name('t_order.create');

    // Route::get('/t_order/pilih-tanggal', [TOrderController::class, 'pilihTanggal'])->name('t_order.pilih');
    // Route::get('/t_order/list/{date}', [TOrderController::class, 'listByDate'])->name('t_order.list');
    // Route::get('/t_order/list/{date}/create', [TOrderController::class, 'listCreate'])->name('t_order.create');

    Route::post('/temp-order/store', [TTemporderController::class, 'store'])->name('temporder.store');
    Route::post('/temp-order/reset', [TTemporderController::class, 'reset'])->name('temporder.reset');
    Route::delete('/temp-order/{id}/destroy', [TTemporderController::class, 'destroy'])->name('temporder.destroy');

    Route::get('/pengeluaran', [TExpenseController::class, 'index'])->name('expense.index');
    Route::get('/pengeluaran/create', [TExpenseController::class, 'create'])->name('expense.create');
    Route::post('/pengeluaran/store', [TExpenseController::class, 'store'])->name('expense.store');
    Route::get('/list/pengeluaran/{date}', [TExpenseController::class, 'listByDate'])->name('expense.list');
    Route::get('/list/pengeluaran/{date}/create', [TExpenseController::class, 'listCreate'])->name('expense.list.create');

    Route::post('/temp-expense/store', [TTempexpenseController::class, 'store'])->name('tempexpense.store');
    Route::delete('/temp-expense/{id}/destroy', [TTempexpenseController::class, 'destroy'])->name('tempexpense.destroy');

    Route::get('/income', [TIncomeController::class, 'index'])->name('income.index');
    Route::get('/income/create', [TIncomeController::class, 'create'])->name('income.create');

    Route::get('/master-payment', [MPaymentController::class, 'index'])->name('master-payment.index');
    Route::get('/master-payment/create', [MPaymentController::class, 'create'])->name('master-payment.create');

    Route::get('/saldo', [TSaldoController::class, 'index'])->name('saldo.index');
    Route::get('/saldo/create', [TSaldoController::class, 'create'])->name('saldo.create');

    Route::post('/temp-menu-detail/store', [TTempmenudetailController::class, 'store'])->name('tempmenudetail.store');
    Route::delete('/temp-menu-detail/{id}/destroy', [TTempmenudetailController::class, 'destroy'])->name('tempmenudetail.destroy');

    // akses [b_role_menu]
    Route::get('/akses', [BRoleMenuController::class, 'index'])->name('akses.index');
    Route::get('/akses/{id}/detail', [BRoleMenuController::class, 'detail'])->name('akses.detail');
    Route::get('/akses/create', [BRoleMenuController::class, 'create'])->name('akses.create');
    Route::post('/akses/store', [BRoleMenuController::class, 'store'])->name('akses.store');
    Route::delete('/akses/{id}/destroy', [BRoleMenuController::class, 'destroy'])->name('akses.destroy');
    // Route::patch('/akses/toggle/{menu_id}/{role_id}', [BRoleMenuController::class, 'toggle'])->name('akses.toggle');
    Route::patch('/akses/toggle/{role_id}/{menu_id}', [BRoleMenuController::class, 'toggle'])->name('akses.toggle');

    // master menu [b_menu]
    Route::get('/master-menu', [BMenuController::class, 'index'])->name('master-menu.index');
    Route::get('/master-menu/create', [BMenuController::class, 'create'])->name('master-menu.create');
    Route::post('/master-menu/store', [BMenuController::class, 'store'])->name('master-menu.store');
    Route::delete('/master-menu/{id}/destroy', [BMenuController::class, 'destroy'])->name('master-menu.destroy');
    Route::patch('/master-menu/toggle/{id}', [BMenuController::class, 'toggle'])->name('master-menu.toggle');

    // kasir
    Route::get('/kasir', [TCashierController::class, 'index'])->name('cashier.index');
    Route::post('/kasir/store', [TCashierController::class, 'store'])->name('cashier.store');

    // nota
    Route::get('/nota', [TNotaController::class, 'index'])->name('nota.index');
    Route::get('/nota/{id}/detail', [TNotaController::class, 'detail'])->name('nota.detail');
    Route::get('/nota/filter', [TNotaController::class, 'filter'])->name('nota.filter');
    Route::get('/nota/{id}/edit', [TNotaController::class, 'edit'])->name('nota.edit');
    Route::put('/nota/{id}/update', [TNotaController::class, 'update'])->name('nota.update');
    Route::delete('/nota/{id}/destroy', [TNotaController::class, 'destroy'])->name('nota.destroy');
});

// old
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/create', [BarangController::class, 'create']);
Route::post('/barang/store', [BarangController::class, 'store']);

Route::get('/kategori', function() {
    return 'kategori';
});

require __DIR__.'/auth.php';