<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\EdashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dishes', [FrontController::class, 'dishes'])->name('dishes');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Routy - zamówienia
Route::middleware(['auth:sanctum', 'verified'])->get('/orders', [OrderController::class, 'index'])->name('orders');
Route::middleware(['auth:sanctum', 'verified'])->get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::middleware(['auth:sanctum', 'verified'])->get('/orders/{order}', [OrderController::class, 'show']);

//Zgloszenie zamowienia

Route::middleware(['auth:sanctum', 'verified'])->get('/orders/{order}/report', [ReportController::class, 'report']);
Route::middleware(['auth:sanctum', 'verified'])->post('/orders/{order}/report/store', [ReportController::class, 'storeReport'])->name('orders.report.store');

// Adresy dostaw
Route::middleware(['auth:sanctum', 'verified'])->get('/addresses', [AddressController::class, 'index'])->name('addresses');
Route::middleware(['auth:sanctum', 'verified'])->get('/address/create', [AddressController::class, 'create'])->name('address.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/address/store', [AddressController::class, 'store'])->name('address.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/addresses/{address}/edit', [AddressController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->patch('/addresses/{address}', [AddressController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->get('/addresses/{address}/delete', [AddressController::class, 'delete']);

// DASHBOARD PRACOWNICZY

Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard', [EdashboardController::class, 'index'])->name('edashboard.index');

//Zarzadzanie zamowieniami

Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/orders', [EdashboardController::class, 'orders_today'])->name('edashboard.orders_today');
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/orders/all', [EdashboardController::class, 'orders_all'])->name('edashboard.orders_all');

Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/orders/{order}/edit', [EdashboardController::class, 'edit_order'])->name('edashboard.edit_order');

//zarzadzanie zgloszeniami
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/reports', [EdashboardController::class, 'reports'])->name('edashboard.reports');
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/reports/{report}/edit', [EdashboardController::class, 'edit_report'])->name('edashboard.edit_report');

//zarzadzanie pracownikami

Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/employees', [EmployeeController::class, 'index'])->name('edashboard.employees');
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('edashboard.employees.edit');


//zarzadzanie rolami
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/roles', [RoleController::class, 'index'])->name('edashboard.roles');
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/role/create', [RoleController::class, 'create'])->name('edashboard.role.create');
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->post('edashboard/role/store', [RoleController::class, 'store'])->name('edashboard.role.store');
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/roles/{role}/edit', [RoleController::class, 'edit'])->name('edashboard.roles.edit');
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->patch('/edashboard/roles/{role}', [RoleController::class, 'update']);

//zarzadzanie zmiana
Route::middleware(['auth:sanctum', 'verified', 'isInAdminGroup'])->get('/edashboard/shifts', [ShiftController::class, 'index'])->name('edashboard.shifts');



