<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\pages\Page2;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\JournalVoucher;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\PaymentVoucher;
use App\Http\Controllers\ReceiveVoucher;
use App\Http\Controllers\SellController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\PostDatedCheque;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SellReturnController;
use App\Http\Controllers\OtherAccountController;
use App\Http\Controllers\ChartOfAccountController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\GarageController;

// ── Main Pages ──
Route::get('/', [HomePage::class, 'index'])->name('pages-home');
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// ── Locale ──
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// ── Auth ──
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');


// ══════════════════════════════════════
//  Chart of Accounts
// ══════════════════════════════════════
Route::prefix('chart-of-accounts')->group(function () {

  Route::get('/',       [ChartOfAccountController::class, 'index'])->name('chart-of-accounts.index');
  Route::get('/create', [ChartOfAccountController::class, 'create'])->name('chart-of-accounts.create');
  Route::post('/store', [ChartOfAccountController::class, 'store'])->name('chart-of-accounts.store');
  Route::get('/data',   [ChartOfAccountController::class, 'getAccounts'])->name('chart-of-accounts.data');

  Route::prefix('account')->group(function () {

    // ── Contacts ──
    Route::get('/contact',       [AccountController::class, 'index'])->name('chart-of-accounts.account.index');
    Route::post('/contact/store', [AccountController::class, 'store'])->name('chart-of-accounts.account.store');
    Route::get('/sub-accounts',  [AccountController::class, 'getSubAccounts'])->name('chart-of-accounts.sub-accounts');

    // ── Other Accounts ──
    Route::get('/otherAccount',              [OtherAccountController::class, 'index'])->name('chart-of-accounts.account.other.account.index');
    Route::get('/otherAccount/data',         [OtherAccountController::class, 'getOtherAccounts'])->name('chart-of-accounts.account.other.account.data');
    Route::post('/otherAccount/store',       [OtherAccountController::class, 'store'])->name('chart-of-accounts.account.other.account.store');
    Route::get('/otherAccount/sub-accounts', [OtherAccountController::class, 'getSubAccounts'])->name('chart-of-accounts.account.other.sub-accounts');
  });
});


// ══════════════════════════════════════
//  Finance
// ══════════════════════════════════════
Route::prefix('finance')->group(function () {
  Route::get('/paymentvoucher',  [PaymentVoucher::class, 'index'])->name('finance.paymentvoucher.index');
  Route::get('/receivevoucher',  [ReceiveVoucher::class, 'index'])->name('finance.receivevoucher.index');
  Route::get('/journalvoucher',  [JournalVoucher::class, 'index'])->name('finance.journalvoucher.index');
  Route::get('/post-dated-cheque', [PostDatedCheque::class, 'index'])->name('finance.post.dated.cheque.index');
});


// ══════════════════════════════════════
//  Purchase
// ══════════════════════════════════════
Route::prefix('purchase')->group(function () {
  Route::get('/',       [PurchaseController::class, 'index'])->name('purchase.index');
  Route::get('/return', [PurchaseReturnController::class, 'index'])->name('purchase.return');
});


// ══════════════════════════════════════
//  Stock
// ══════════════════════════════════════
Route::prefix('stock')->group(function () {
  Route::get('/inventory',        [InventoryController::class, 'index'])->name('stock.inventory.index');
  Route::post('/inventory/store', [InventoryController::class, 'store'])->name('stock.inventory.store');
  Route::get('/damage',           [DamageController::class, 'index'])->name('stock.damage.index');
});


// ══════════════════════════════════════
//  Sell
// ══════════════════════════════════════
Route::prefix('sell')->group(function () {
  Route::get('/add',    [SellController::class, 'index'])->name('sell.index');
  Route::get('/return', [SellReturnController::class, 'index'])->name('sell.return.index');
});


// ══════════════════════════════════════
//  Setup
// ══════════════════════════════════════
Route::prefix('setup')->group(function () {

  // Units
  Route::get('/unit',             [UnitController::class, 'index'])->name('setup.unit.index');
  Route::post('/unit',            [UnitController::class, 'store'])->name('setup.unit.store');
  Route::get('/unit/{unit}/edit', [UnitController::class, 'edit'])->name('setup.unit.edit');
  Route::put('/unit/{unit}',      [UnitController::class, 'update'])->name('setup.unit.update');
  Route::delete('/unit/{unit}',   [UnitController::class, 'destroy'])->name('setup.unit.destroy');

  // Sizes
  Route::get('/size',             [SizeController::class, 'index'])->name('setup.size.index');
  Route::get('/size/data',        [SizeController::class, 'getData'])->name('setup.size.data');
  Route::post('/size',            [SizeController::class, 'store'])->name('setup.size.store');
  Route::get('/size/{size}/edit', [SizeController::class, 'edit'])->name('setup.size.edit');
  Route::put('/size/{size}',      [SizeController::class, 'update'])->name('setup.size.update');
  Route::delete('/size/{size}',   [SizeController::class, 'destroy'])->name('setup.size.destroy');

  // Garages
  Route::get('/garage',               [GarageController::class, 'index'])->name('setup.garage.index');
  Route::get('/garage/data',          [GarageController::class, 'getData'])->name('setup.garage.data');
  Route::post('/garage',              [GarageController::class, 'store'])->name('setup.garage.store');
  Route::get('/garage/{garage}/edit', [GarageController::class, 'edit'])->name('setup.garage.edit');
  Route::put('/garage/{garage}',      [GarageController::class, 'update'])->name('setup.garage.update');
  Route::delete('/garage/{garage}',   [GarageController::class, 'destroy'])->name('setup.garage.destroy');

  // Cities
  Route::get('/city',             [CityController::class, 'index'])->name('setup.city.index');
  Route::post('/city',            [CityController::class, 'store'])->name('setup.city.store');
  Route::get('/city/{city}/edit', [CityController::class, 'edit'])->name('setup.city.edit');
  Route::put('/city/{city}',      [CityController::class, 'update'])->name('setup.city.update');
  Route::delete('/city/{city}',   [CityController::class, 'destroy'])->name('setup.city.destroy');
});
