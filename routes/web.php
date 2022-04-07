<?php

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

use App\Http\Controllers\AccountsReportController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\BankCashController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ContraVoucherController;
use App\Http\Controllers\CrVoucherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrVoucherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeExpenseGroupController;
use App\Http\Controllers\IncomeExpenseHeadController;
use App\Http\Controllers\IncomeExpenseTypeController;
use App\Http\Controllers\InitialBankCashBalanceController;
use App\Http\Controllers\InitialIncomeExpenseHeadBalanceController;
use App\Http\Controllers\JournalVoucherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reports;
use App\Http\Controllers\RoleManageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('config-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');

    dd('Cache is cleared');
});

Auth::routes();

//Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('logout', [Auth\LoginController::class, 'logout']);

    //    Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //    profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    //    User
    Route::get('/user', [UsersController::class, 'index'])->name('user')->middleware('user.module_show');

    Route::get('/user/create', [UsersController::class, 'create'])->name('user.create')->middleware('user.create');

    Route::post('/user/store', [UsersController::class, 'store'])->name('user.store')->middleware('user.create');

    Route::get('/user/edit/{id}', [UsersController::class, 'edit'])->name('user.edit')->middleware('user.edit');

    Route::post('/user/update/{id}', [UsersController::class, 'update'])->name('user.update')->middleware('user.edit');

    Route::get('/user/show/{id}', [UsersController::class, 'show'])->name('user.show');

    Route::get('/user/destroy/{id}', [UsersController::class, 'destroy'])->name('user.destroy')->middleware('user.delete');

    Route::get('/user/trashed', [UsersController::class, 'trashed'])->name('user.trashed')->middleware('user.trash_show');

    Route::post('/user/trashed/show', [UsersController::class, 'trashedShow'])->name('user.trashed.show');

    Route::get('/user/restore/{id}', [UsersController::class, 'restore'])->name('user.restore')->middleware('user.restore');

    Route::get('/user/kill/{id}', [UsersController::class, 'kill'])->name('user.kill')->middleware('user.permanently_delete');

    Route::get('/user/active/search', [UsersController::class, 'activeSearch'])->name('user.active.search');

    Route::get('/user/trashed/search', [UsersController::class, 'trashedSearch'])->name('user.trashed.search');

    Route::get('/user/active/action', [UsersController::class, 'activeAction'])->name('user.active.action');

    Route::get('/user/trashed/action', [UsersController::class, 'trashedAction'])->name('user.trashed.action');

    Route::post('users/password', [ProfileController::class, 'changePassword'])->name('users.password');

    //    User End

    //    Settings

    Route::get('/settings/general', [SettingsController::class, 'general_show'])->name('settings.general')->middleware('settings.all');

    Route::post('/settings/general/update', [SettingsController::class, 'general_update'])->name('settings.general.update');

    Route::get('/settings/system', [SettingsController::class, 'system_show'])->name('settings.system')->middleware('settings.show');

    Route::post('/settings/system/update', [SettingsController::class, 'system_update'])->name('settings.system.update');

    //    Role Manage
    Route::get('/role-manage', [RoleManageController::class, 'index'])->name('role-manage')->middleware('role.module_show');

    Route::get('/role-manage/show/{id}', [RoleManageController::class, 'show'])->name('role-manage.show')->middleware('role.show');

    Route::get('/role-manage/create', [RoleManageController::class, 'create'])->name('role-manage.create')->middleware('role.create');

    Route::post('/role-manage/store', [RoleManageController::class, 'store'])->name('role-manage.store')->middleware('role.create');

    Route::get('/role-manage/edit/{id}', [RoleManageController::class, 'edit'])->name('role-manage.edit')->middleware('role.edit');
    Route::post('/role-manage/update/{id}', [RoleManageController::class, 'update'])->name('role-manage.update')->middleware('role.edit');

    Route::get('/role-manage/destroy/{id}', [RoleManageController::class, 'destroy'])->name('role-manage.destroy')->middleware('role.delete');

    Route::get('/role-manage/pdf/{id}', [RoleManageController::class, 'pdf'])->name('role-manage.pdf')->middleware('role.pdf');

    Route::get('/role-manage/trashed', [RoleManageController::class, 'trashed'])->name('role-manage.trashed')->middleware('role.trash_show');

    Route::get('/role-manage/restore/{id}', [RoleManageController::class, 'restore'])->name('role-manage.restore')->middleware('role.restore');

    Route::get('/role-manage/kill/{id}', [RoleManageController::class, 'kill'])->name('role-manage.kill')->middleware('role.permanently_delete');

    Route::get('/role-manage/active/search', [RoleManageController::class, 'activeSearch'])->name('role-manage.active.search');

    Route::get('/role-manage/trashed/search', [RoleManageController::class, 'trashedSearch'])->name('role-manage.trashed.search');

    Route::get('/role-manage/active/action', [RoleManageController::class, 'activeAction'])->name('role-manage.active.action')->middleware('role.delete');

    Route::get('/role-manage/trashed/action', [RoleManageController::class, 'trashedAction'])->name('role-manage.trashed.action');

    //    role-manage End

    //    Branch Manage
    Route::get('/branch', [BranchController::class, 'index'])->name('branch')->middleware('branch.module_show');

    Route::get('/branch/show/{id}', [BranchController::class, 'show'])->name('branch.show')->middleware('branch.show');

    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create')->middleware('branch.create');

    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store')->middleware('branch.create');

    Route::get('/branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit')->middleware('branch.edit');
    Route::post('/branch/update/{id}', [BranchController::class, 'update'])->name('branch.update')->middleware('branch.edit');

    Route::get('/branch/destroy/{id}', [BranchController::class, 'destroy'])->name('branch.destroy')->middleware('branch.delete');

    Route::get('/branch/pdf/{id}', [BranchController::class, 'pdf'])->name('branch.pdf')->middleware('branch.pdf');

    Route::get('/branch/trashed', [BranchController::class, 'trashed'])->name('branch.trashed')->middleware('branch.trash_show');

    Route::get('/branch/restore/{id}', [BranchController::class, 'restore'])->name('branch.restore')->middleware('branch.restore');

    Route::get('/branch/kill/{id}', [BranchController::class, 'kill'])->name('branch.kill')->middleware('branch.permanently_delete');

    Route::get('/branch/active/search', [BranchController::class, 'activeSearch'])->name('branch.active.search');

    Route::get('/branch/trashed/search', [BranchController::class, 'trashedSearch'])->name('branch.trashed.search');

    Route::get('/branch/active/action', [BranchController::class, 'activeAction'])->name('branch.active.action')->middleware('branch.delete');

    Route::get('/branch/trashed/action', [BranchController::class, 'trashedAction'])->name('branch.trashed.action');
    //    Branch Manage End

    //    Ledger  Start

    //   Type Start
    Route::get('/ledger/type', [IncomeExpenseTypeController::class, 'index'])->name('income_expense_type')->middleware('income_expense_type.all');

    Route::get('/ledger/type/show/{id}', [IncomeExpenseTypeController::class, 'show'])->name('income_expense_type.show')->middleware('income_expense_type.show');

    Route::get('/ledger/type/create', [IncomeExpenseTypeController::class, 'create'])->name('income_expense_type.create')->middleware('income_expense_type.create');

    Route::post('/ledger/type/store', [IncomeExpenseTypeController::class, 'store'])->name('income_expense_type.store')->middleware('income_expense_type.create');

    /*
    Route::get('/ledger/type/edit/{id}', [
        'uses' => [IncomeExpenseTypeController::class, 'edit'],
        'as' => 'income_expense_type.edit'
    ])->middleware('income_expense_type.edit');
    Route::post('/ledger/type/update/{id}', [
        'uses' => [IncomeExpenseTypeController::class, 'update'],
        'as' => 'income_expense_type.update'
    ])->middleware('income_expense_type.edit');


    Route::get('/ledger/type/destroy/{id}', [
        'uses' => [IncomeExpenseTypeController::class, 'destroy'],
        'as' => 'income_expense_type.destroy'
    ])->middleware('income_expense_type.delete');

    */

    Route::get('/ledger/type/pdf/{id}', [IncomeExpenseTypeController::class, 'pdf'])->name('income_expense_type.pdf')->middleware('income_expense_type.pdf');

    Route::get('/ledger/type/trashed', [IncomeExpenseTypeController::class, 'trashed'])->name('income_expense_type.trashed')->middleware('income_expense_type.trash_show');

    Route::get('/ledger/type/restore/{id}', [IncomeExpenseTypeController::class, 'restore'])->name('income_expense_type.restore')->middleware('income_expense_type.restore');

    Route::get('/ledger/type/kill/{id}', [IncomeExpenseTypeController::class, 'kill'])->name('income_expense_type.kill')->middleware('income_expense_type.permanently_delete');

    Route::get('/ledger/type/active/search', [IncomeExpenseTypeController::class, 'activeSearch'])->name('income_expense_type.active.search');

    Route::get('/ledger/type/trashed/search', [IncomeExpenseTypeController::class, 'trashedSearch'])->name('income_expense_type.trashed.search');

    Route::get('/ledger/type/active/action', [IncomeExpenseTypeController::class, 'activeAction'])->name('income_expense_type.active.action')->middleware('income_expense_type.delete');

    Route::get('/ledger/type/trashed/action', [IncomeExpenseTypeController::class, 'trashedAction'])->name('income_expense_type.trashed.action');

    // Type End

    //   Group Start
    Route::get('/ledger/group', [IncomeExpenseGroupController::class, 'index'])->name('income_expense_group')->middleware('income_expense_group.all');

    Route::get('/ledger/group/show/{id}', [IncomeExpenseGroupController::class, 'show'])->name('income_expense_group.show')->middleware('income_expense_group.show');

    Route::get('/ledger/group/create', [IncomeExpenseGroupController::class, 'create'])->name('income_expense_group.create')->middleware('income_expense_group.create');

    Route::post('/ledger/group/store', [IncomeExpenseGroupController::class, 'store'])->name('income_expense_group.store')->middleware('income_expense_group.create');

    Route::get('/ledger/group/edit/{id}', [IncomeExpenseGroupController::class, 'edit'])->name('income_expense_group.edit')->middleware('income_expense_group.edit');
    Route::post('/ledger/group/update/{id}', [IncomeExpenseGroupController::class, 'update'])->name('income_expense_group.update')->middleware('income_expense_group.edit');

    Route::get('/ledger/group/destroy/{id}', [IncomeExpenseGroupController::class, 'destroy'])->name('income_expense_group.destroy')->middleware('income_expense_group.delete');

    Route::get('/ledger/group/pdf/{id}', [IncomeExpenseGroupController::class, 'pdf'])->name('income_expense_group.pdf')->middleware('income_expense_group.pdf');

    Route::get('/ledger/group/trashed', [IncomeExpenseGroupController::class, 'trashed'])->name('income_expense_group.trashed')->middleware('income_expense_group.trash_show');

    Route::get('/ledger/group/restore/{id}', [IncomeExpenseGroupController::class, 'restore'])->name('income_expense_group.restore')->middleware('income_expense_group.restore');

    Route::get('/ledger/group/kill/{id}', [IncomeExpenseGroupController::class, 'kill'])->name('income_expense_group.kill')->middleware('income_expense_group.permanently_delete');

    Route::get('/ledger/group/active/search', [IncomeExpenseGroupController::class, 'activeSearch'])->name('income_expense_group.active.search');

    Route::get('/ledger/group/trashed/search', [IncomeExpenseGroupController::class, 'trashedSearch'])->name('income_expense_group.trashed.search');

    Route::get('/ledger/group/active/action', [IncomeExpenseGroupController::class, 'activeAction'])->name('income_expense_group.active.action')->middleware('income_expense_group.delete');

    Route::get('/ledger/group/trashed/action', [IncomeExpenseGroupController::class, 'trashedAction'])->name('income_expense_group.trashed.action');

    // Group End

    //    ledger - name Start
    Route::get('/ledger/name', [IncomeExpenseHeadController::class, 'index'])->name('income_expense_head')->middleware('income_expense_head.all');

    Route::get('/ledger/name/show/{id}', [IncomeExpenseHeadController::class, 'show'])->name('income_expense_head.show')->middleware('income_expense_head.show');

    Route::get('/ledger/name/create', [IncomeExpenseHeadController::class, 'create'])->name('income_expense_head.create')->middleware('income_expense_head.create');

    Route::post('/ledger/name/store', [IncomeExpenseHeadController::class, 'store'])->name('income_expense_head.store')->middleware('income_expense_head.create');

    Route::get('/ledger/name/edit/{id}', [IncomeExpenseHeadController::class, 'edit'])->name('income_expense_head.edit')->middleware('income_expense_head.edit');
    Route::post('/ledger/name/update/{id}', [IncomeExpenseHeadController::class, 'update'])->name('income_expense_head.update')->middleware('income_expense_head.edit');

    Route::get('/ledger/name/destroy/{id}', [IncomeExpenseHeadController::class, 'destroy'])->name('income_expense_head.destroy')->middleware('income_expense_head.delete');

    Route::get('/ledger/name/pdf/{id}', [IncomeExpenseHeadController::class, 'pdf'])->name('income_expense_head.pdf')->middleware('income_expense_head.pdf');

    Route::get('/ledger/name/trashed', [IncomeExpenseHeadController::class, 'trashed'])->name('income_expense_head.trashed')->middleware('income_expense_head.trash_show');

    Route::get('/ledger/name/restore/{id}', [IncomeExpenseHeadController::class, 'restore'])->name('income_expense_head.restore')->middleware('income_expense_head.restore');

    Route::get('/ledger/name/kill/{id}', [IncomeExpenseHeadController::class, 'kill'])->name('income_expense_head.kill')->middleware('income_expense_head.permanently_delete');

    Route::get('/ledger/name/active/search', [IncomeExpenseHeadController::class, 'activeSearch'])->name('income_expense_head.active.search');

    Route::get('/ledger/name/trashed/search', [IncomeExpenseHeadController::class, 'trashedSearch'])->name('income_expense_head.trashed.search');

    Route::get('/ledger/name/active/action', [IncomeExpenseHeadController::class, 'activeAction'])->name('income_expense_head.active.action')->middleware('income_expense_head.delete');

    Route::get('/ledger/name/trashed/action', [IncomeExpenseHeadController::class, 'trashedAction'])->name('income_expense_head.trashed.action');

    // ledger name End

    //    Ledger  End

    //    Bank Cash Start
    Route::get('/bank-cash', [BankCashController::class, 'index'])->name('bank_cash')->middleware('bank_cash.all');

    Route::get('/bank-cash/show/{id}', [BankCashController::class, 'show'])->name('bank_cash.show')->middleware('bank_cash.show');

    Route::get('/bank-cash/create', [BankCashController::class, 'create'])->name('bank_cash.create')->middleware('bank_cash.create');

    Route::post('/bank-cash/store', [BankCashController::class, 'store'])->name('bank_cash.store')->middleware('bank_cash.create');

    Route::get('/bank-cash/edit/{id}', [BankCashController::class, 'edit'])->name('bank_cash.edit')->middleware('bank_cash.edit');

    Route::post('/bank-cash/update/{id}', [BankCashController::class, 'update'])->name('bank_cash.update')->middleware('bank_cash.edit');

    Route::get('/bank-cash/destroy/{id}', [BankCashController::class, 'destroy'])->name('bank_cash.destroy')->middleware('bank_cash.delete');

    Route::get('/bank-cash/pdf/{id}', [BankCashController::class, 'pdf'])->name('bank_cash.pdf')->middleware('bank_cash.pdf');

    Route::get('/bank-cash/trashed', [BankCashController::class, 'trashed'])->name('bank_cash.trashed')->middleware('bank_cash.trash_show');

    Route::get('/bank-cash/restore/{id}', [BankCashController::class, 'restore'])->name('bank_cash.restore')->middleware('bank_cash.restore');

    Route::get('/bank-cash/kill/{id}', [BankCashController::class, 'kill'])->name('bank_cash.kill')->middleware('bank_cash.permanently_delete');

    Route::get('/bank-cash/active/search', [BankCashController::class, 'activeSearch'])->name('bank_cash.active.search');

    Route::get('/bank-cash/trashed/search', [BankCashController::class, 'trashedSearch'])->name('bank_cash.trashed.search');

    Route::get('/bank-cash/active/action', [BankCashController::class, 'activeAction'])->name('bank_cash.active.action')->middleware('bank_cash.delete');

    Route::get('/bank-cash/trashed/action', [BankCashController::class, 'trashedAction'])->name('bank_cash.trashed.action');

    // Bank Cash End

    //    initial_income_expense_head_balance Start
    Route::get('/initial-ledger-balance', [InitialIncomeExpenseHeadBalanceController::class, 'index'])->name('initial_income_expense_head_balance')->middleware('initial_income_expense_head_balance.all');

    Route::get('/initial-ledger-balance/show/{id}', [InitialIncomeExpenseHeadBalanceController::class, 'show'])->name('initial_income_expense_head_balance.show')->middleware('initial_income_expense_head_balance.show');

    Route::get('/initial-ledger-balance/create', [InitialIncomeExpenseHeadBalanceController::class, 'create'])->name('initial_income_expense_head_balance.create')->middleware('initial_income_expense_head_balance.create');

    Route::post('/initial-income-expense-head-balance/store', [InitialIncomeExpenseHeadBalanceController::class, 'store'])->name('initial_income_expense_head_balance.store')->middleware('initial_income_expense_head_balance.create');

    Route::get('/initial-ledger-balance/edit/{id}', [InitialIncomeExpenseHeadBalanceController::class, 'edit'])->name('initial_income_expense_head_balance.edit')->middleware('initial_income_expense_head_balance.edit');

    Route::post('/initial-ledger-balance/update/{id}', [InitialIncomeExpenseHeadBalanceController::class, 'update'])->name('initial_income_expense_head_balance.update')->middleware('initial_income_expense_head_balance.edit');

    Route::get('/initial-ledger-balance/destroy/{id}', [InitialIncomeExpenseHeadBalanceController::class, 'destroy'])->name('initial_income_expense_head_balance.destroy')->middleware('initial_income_expense_head_balance.delete');

    Route::get('/initial-ledger-balance/pdf/{id}', [InitialIncomeExpenseHeadBalanceController::class, 'pdf'])->name('initial_income_expense_head_balance.pdf')->middleware('initial_income_expense_head_balance.pdf');

    Route::get('/initial-ledger-balance/trashed', [InitialIncomeExpenseHeadBalanceController::class, 'trashed'])->name('initial_income_expense_head_balance.trashed')->middleware('initial_income_expense_head_balance.trash_show');

    Route::get('/initial-income-expense-head-balance/restore/{id}', [InitialIncomeExpenseHeadBalanceController::class, 'restore'])->name('initial_income_expense_head_balance.restore')->middleware('initial_income_expense_head_balance.restore');

    Route::get('/initial-income-expense-head-balance/kill/{id}', [InitialIncomeExpenseHeadBalanceController::class, 'kill'])->name('initial_income_expense_head_balance.kill')->middleware('initial_income_expense_head_balance.permanently_delete');

    Route::get('/initial-income-expense-head-balance/active/search', [InitialIncomeExpenseHeadBalanceController::class, 'activeSearch'])->name('initial_income_expense_head_balance.active.search');

    Route::get('/initial-income-expense-head-balance/trashed/search', [InitialIncomeExpenseHeadBalanceController::class, 'trashedSearch'])->name('initial_income_expense_head_balance.trashed.search');

    Route::get('/initial-income-expense-head-balance/active/action', [InitialIncomeExpenseHeadBalanceController::class, 'activeAction'])->name('initial_income_expense_head_balance.active.action')->middleware('initial_income_expense_head_balance.delete');

    Route::get('/initial-income-expense-head-balance/trashed/action', [InitialIncomeExpenseHeadBalanceController::class, 'trashedAction'])->name('initial_income_expense_head_balance.trashed.action');

    // initial_income_expense_head_balance End

    //    initial_bank_cash_balance Start
    Route::get('/initial-bank-cash-balance', [InitialBankCashBalanceController::class, 'index'])->name('initial_bank_cash_balance')->middleware('initial_bank_cash_balance.all');

    Route::get('/initial-bank-cash-balance/show/{id}', [InitialBankCashBalanceController::class, 'show'])->name('initial_bank_cash_balance.show')->middleware('initial_bank_cash_balance.show');

    Route::get('/initial-bank-cash-balance/create', [InitialBankCashBalanceController::class, 'create'])->name('initial_bank_cash_balance.create')->middleware('initial_bank_cash_balance.create');

    Route::post('/initial-bank-cash-balance/store', [InitialBankCashBalanceController::class, 'store'])->name('initial_bank_cash_balance.store')->middleware('initial_bank_cash_balance.create');

    Route::get('/initial-bank-cash-balance/edit/{id}', [InitialBankCashBalanceController::class, 'edit'])->name('initial_bank_cash_balance.edit')->middleware('initial_bank_cash_balance.edit');

    Route::post('/initial-bank-cash-balance/update/{id}', [InitialBankCashBalanceController::class, 'update'])->name('initial_bank_cash_balance.update')->middleware('initial_bank_cash_balance.edit');

    Route::get('/initial-bank-cash-balance/destroy/{id}', [InitialBankCashBalanceController::class, 'destroy'])->name('initial_bank_cash_balance.destroy')->middleware('initial_bank_cash_balance.delete');

    Route::get('/initial-bank-cash-balance/pdf/{id}', [InitialBankCashBalanceController::class, 'pdf'])->name('initial_bank_cash_balance.pdf')->middleware('initial_bank_cash_balance.pdf');

    Route::get('/initial-bank-cash-balance/trashed', [InitialBankCashBalanceController::class, 'trashed'])->name('initial_bank_cash_balance.trashed')->middleware('initial_bank_cash_balance.trash_show');

    Route::get('/initial-bank-cash-balance/restore/{id}', [InitialBankCashBalanceController::class, 'restore'])->name('initial_bank_cash_balance.restore')->middleware('initial_bank_cash_balance.restore');

    Route::get('/initial-bank-cash-balance/kill/{id}', [InitialBankCashBalanceController::class, 'kill'])->name('initial_bank_cash_balance.kill')->middleware('initial_bank_cash_balance.permanently_delete');

    Route::get('/initial-bank-cash-balance/active/search', [InitialBankCashBalanceController::class, 'activeSearch'])->name('initial_bank_cash_balance.active.search');

    Route::get('/initial-bank-cash-balance/trashed/search', [InitialBankCashBalanceController::class, 'trashedSearch'])->name('initial_bank_cash_balance.trashed.search');

    Route::get('/initial-bank-cash-balance/active/action', [InitialBankCashBalanceController::class, 'activeAction'])->name('initial_bank_cash_balance.active.action')->middleware('initial_bank_cash_balance.delete');

    Route::get('/initial-bank-cash-balance/trashed/action', [InitialBankCashBalanceController::class, 'trashedAction'])->name('initial_bank_cash_balance.trashed.action');

    // initial_bank_cash_balance End

    //  DrVoucher Start
    Route::get('/dr-voucher', [DrVoucherController::class, 'index'])->name('dr_voucher')->middleware('dr_voucher.all');

    Route::get('/dr-voucher/show/{id}', [DrVoucherController::class, 'show'])->name('dr_voucher.show')->middleware('dr_voucher.show');

    Route::get('/dr-voucher/create', [DrVoucherController::class, 'create'])->name('dr_voucher.create')->middleware('dr_voucher.create');

    Route::post('/dr-voucher/store', [DrVoucherController::class, 'store'])->name('dr_voucher.store')->middleware('dr_voucher.create');

    Route::get('/dr-voucher/edit/{id}', [DrVoucherController::class, 'edit'])->name('dr_voucher.edit')->middleware('dr_voucher.edit');

    Route::post('/dr-voucher/update/{id}', [DrVoucherController::class, 'update'])->name('dr_voucher.update')->middleware('dr_voucher.edit');

    Route::get('/dr-voucher/destroy/{id}', [DrVoucherController::class, 'destroy'])->name('dr_voucher.destroy')->middleware('dr_voucher.delete');

    Route::get('/dr-voucher/pdf/{id}', [DrVoucherController::class, 'pdf'])->name('dr_voucher.pdf')->middleware('dr_voucher.pdf');

    Route::get('/dr-voucher/trashed', [DrVoucherController::class, 'trashed'])->name('dr_voucher.trashed')->middleware('dr_voucher.trash_show');

    Route::get('/dr-voucher/restore/{id}', [DrVoucherController::class, 'restore'])->name('dr_voucher.restore')->middleware('dr_voucher.restore');

    Route::get('/dr-voucher/kill/{id}', [DrVoucherController::class, 'kill'])->name('dr_voucher.kill')->middleware('dr_voucher.permanently_delete');

    Route::get('/dr-voucher/active/search', [DrVoucherController::class, 'activeSearch'])->name('dr_voucher.active.search');

    Route::get('/dr-voucher/trashed/search', [DrVoucherController::class, 'trashedSearch'])->name('dr_voucher.trashed.search');

    Route::get('/dr-voucher/active/action', [DrVoucherController::class, 'activeAction'])->name('dr_voucher.active.action')->middleware('dr_voucher.delete');

    Route::get('/dr-voucher/trashed/action', [DrVoucherController::class, 'trashedAction'])->name('dr_voucher.trashed.action');

    // DrVoucher End

    //  cr_voucher Start
    Route::get('/cr-voucher', [CrVoucherController::class, 'index'])->name('cr_voucher')->middleware('cr_voucher.all');

    Route::get('/cr-voucher/show/{id}', [CrVoucherController::class, 'show'])->name('cr_voucher.show')->middleware('cr_voucher.show');

    Route::get('/cr-voucher/create', [CrVoucherController::class, 'create'])->name('cr_voucher.create')->middleware('cr_voucher.create');

    Route::post('/cr-voucher/store', [CrVoucherController::class, 'store'])->name('cr_voucher.store')->middleware('cr_voucher.create');

    Route::get('/cr-voucher/edit/{id}', [CrVoucherController::class, 'edit'])->name('cr_voucher.edit')->middleware('cr_voucher.edit');

    Route::post('/cr-voucher/update/{id}', [CrVoucherController::class, 'update'])->name('cr_voucher.update')->middleware('cr_voucher.edit');

    Route::get('/cr-voucher/destroy/{id}', [CrVoucherController::class, 'destroy'])->name('cr_voucher.destroy')->middleware('cr_voucher.delete');

    Route::get('/cr-voucher/pdf/{id}', [CrVoucherController::class, 'pdf'])->name('cr_voucher.pdf')->middleware('cr_voucher.pdf');

    Route::get('/cr-voucher/trashed', [CrVoucherController::class, 'trashed'])->name('cr_voucher.trashed')->middleware('cr_voucher.trash_show');

    Route::get('/cr-voucher/restore/{id}', [CrVoucherController::class, 'restore'])->name('cr_voucher.restore')->middleware('cr_voucher.restore');

    Route::get('/cr-voucher/kill/{id}', [CrVoucherController::class, 'kill'])->name('cr_voucher.kill')->middleware('cr_voucher.permanently_delete');

    Route::get('/cr-voucher/active/search', [CrVoucherController::class, 'activeSearch'])->name('cr_voucher.active.search');

    Route::get('/cr-voucher/trashed/search', [CrVoucherController::class, 'trashedSearch'])->name('cr_voucher.trashed.search');

    Route::get('/cr-voucher/active/action', [CrVoucherController::class, 'activeAction'])->name('cr_voucher.active.action')->middleware('cr_voucher.delete');

    Route::get('/cr-voucher/trashed/action', [CrVoucherController::class, 'trashedAction'])->name('cr_voucher.trashed.action');

    // cr_voucher End

    //  jnl_voucher Start
    Route::get('/journal-voucher', [JournalVoucherController::class, 'index'])->name('jnl_voucher')->middleware('jnl_voucher.all');

    Route::get('/journal-voucher/show/{id}', [JournalVoucherController::class, 'show'])->name('jnl_voucher.show')->middleware('jnl_voucher.show');

    Route::get('/journal-voucher/create', [JournalVoucherController::class, 'create'])->name('jnl_voucher.create')->middleware('jnl_voucher.create');

    Route::post('/journal-voucher/store', [JournalVoucherController::class, 'store'])->name('jnl_voucher.store')->middleware('jnl_voucher.create');

    Route::get('/journal-voucher/edit/{id}', [JournalVoucherController::class, 'edit'])->name('jnl_voucher.edit')->middleware('jnl_voucher.edit');

    Route::post('/journal-voucher/update/{id}', [JournalVoucherController::class, 'update'])->name('jnl_voucher.update')->middleware('jnl_voucher.edit');

    Route::get('/journal-voucher/destroy/{id}', [JournalVoucherController::class, 'destroy'])->name('jnl_voucher.destroy')->middleware('jnl_voucher.delete');

    Route::get('/journal-voucher/pdf/{id}', [JournalVoucherController::class, 'pdf'])->name('jnl_voucher.pdf')->middleware('jnl_voucher.pdf');

    Route::get('/journal-voucher/trashed', [JournalVoucherController::class, 'trashed'])->name('jnl_voucher.trashed')->middleware('jnl_voucher.trash_show');

    Route::get('/journal-voucher/restore/{id}', [JournalVoucherController::class, 'restore'])->name('jnl_voucher.restore')->middleware('jnl_voucher.restore');

    Route::get('/journal-voucher/kill/{id}', [JournalVoucherController::class, 'kill'])->name('jnl_voucher.kill')->middleware('jnl_voucher.permanently_delete');

    Route::get('/journal-voucher/active/search', [JournalVoucherController::class, 'activeSearch'])->name('jnl_voucher.active.search');

    Route::get('/journal-voucher/trashed/search', [JournalVoucherController::class, 'trashedSearch'])->name('jnl_voucher.trashed.search');

    Route::get('/journal-voucher/active/action', [JournalVoucherController::class, 'activeAction'])->name('jnl_voucher.active.action')->middleware('jnl_voucher.delete');

    Route::get('/journal-voucher/trashed/action', [JournalVoucherController::class, 'trashedAction'])->name('jnl_voucher.trashed.action');

    // jnl_voucher End

    //  contra_voucher Start
    Route::get('/contra-voucher', [ContraVoucherController::class, 'index'])->name('contra_voucher')->middleware('contra_voucher.all');

    Route::get('/contra-voucher/show/{id}', [ContraVoucherController::class, 'show'])->name('contra_voucher.show')->middleware('contra_voucher.show');

    Route::get('/contra-voucher/create', [ContraVoucherController::class, 'create'])->name('contra_voucher.create')->middleware('contra_voucher.create');

    Route::post('/contra-voucher/store', [ContraVoucherController::class, 'store'])->name('contra_voucher.store')->middleware('contra_voucher.create');

    Route::get('/contra-voucher/edit/{id}', [ContraVoucherController::class, 'edit'])->name('contra_voucher.edit')->middleware('contra_voucher.edit');

    Route::post('/contra-voucher/update/{id}', [ContraVoucherController::class, 'update'])->name('contra_voucher.update')->middleware('contra_voucher.edit');

    Route::get('/contra-voucher/destroy/{id}', [ContraVoucherController::class, 'destroy'])->name('contra_voucher.destroy')->middleware('contra_voucher.delete');

    Route::get('/contra-voucher/pdf/{id}', [ContraVoucherController::class, 'pdf'])->name('contra_voucher.pdf')->middleware('contra_voucher.pdf');

    Route::get('/contra-voucher/trashed', [ContraVoucherController::class, 'trashed'])->name('contra_voucher.trashed')->middleware('contra_voucher.trash_show');

    Route::get('/contra-voucher/restore/{id}', [ContraVoucherController::class, 'restore'])->name('contra_voucher.restore')->middleware('contra_voucher.restore');

    Route::get('/contra-voucher/kill/{id}', [ContraVoucherController::class, 'kill'])->name('contra_voucher.kill')->middleware('contra_voucher.permanently_delete');

    Route::get('/contra-voucher/active/search', [ContraVoucherController::class, 'activeSearch'])->name('contra_voucher.active.search');

    Route::get('/contra-voucher/trashed/search', [ContraVoucherController::class, 'trashedSearch'])->name('contra_voucher.trashed.search');

    Route::get('/contra-voucher/active/action', [ContraVoucherController::class, 'activeAction'])->name('contra_voucher.active.action')->middleware('contra_voucher.delete');

    Route::get('/contra-voucher/trashed/action', [ContraVoucherController::class, 'trashedAction'])->name('contra_voucher.trashed.action');

    // contra_voucher End

    //    Accounts Report Start

    //    ledger

    Route::get('/reports/accounts/ledger', [AccountsReportController::class, 'ledger_index'])->name('reports.accounts.ledger')->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/branch-wise/report', [AccountsReportController::class, 'ledger_branch_wise_report'])->name('reports_accounts_ledger.branch_wise.report')->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/income-expense-head-wise/report', [AccountsReportController::class, 'ledger_income_expense_head_wise_report'])->name('reports_accounts_ledger.income_expense_head_wise.report')->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/bank-cash-wise/report', [AccountsReportController::class, 'ledger_bank_cash_wise_report'])->name('reports_accounts_ledger.bank_cash_wise.report')->middleware('report.ledger.all');

    //    Trial Balance
    Route::get('/reports/accounts/trial-balance', [Reports\Accounts\TrialBalanceController::class, 'index'])->name('reports.accounts.trial_balance')->middleware('report.TrialBalance.all');

    Route::post('/reports/accounts/trial-balance/report', [Reports\Accounts\TrialBalanceController::class, 'branch_wise'])->name('reports.accounts.trial_balance.branch_wise.report')->middleware('report.TrialBalance.all');

    //    Cost Of Revenue Manage
    Route::get('/reports/accounts/cost-of-revenue', [Reports\Accounts\CostOfRevenueController::class, 'index'])->name('reports.accounts.cost_of_revenue')->middleware('report.CostOfRevenue.all');

    Route::post('/reports/accounts/cost-of-revenue/report', [Reports\Accounts\CostOfRevenueController::class, 'branch_wise'])->name('reports.accounts.cost_of_revenue.report')->middleware('report.CostOfRevenue.all');

    //    Profit & Loss Account
    Route::get('/reports/accounts/profit-or-loss-account', [Reports\Accounts\ProfitAndLossAccountController::class, 'index'])->name('reports.accounts.profit_or_loss_account')->middleware('report.ProfitOrLossAccount.all');

    Route::post('/reports/accounts/profit-or-loss-account/report', [Reports\Accounts\ProfitAndLossAccountController::class, 'branch_wise'])->name('reports.accounts.profit_or_loss_account.report')->middleware('report.ProfitOrLossAccount.all');

    //    Retained Earnings
    Route::get('/reports/accounts/retained-earnings', [Reports\Accounts\RetainedEarningsController::class, 'index'])->name('reports.accounts.retained_earnings')->middleware('report.RetainedEarning.all');

    Route::post('/reports/accounts/retained-earnings/report', [Reports\Accounts\RetainedEarningsController::class, 'branch_wise'])->name('reports.accounts.retained_earnings.report')->middleware('report.RetainedEarning.all');

    //    Fixed Asset Schedule
    Route::get('/reports/accounts/fixed-asset-schedule', [Reports\Accounts\FixedAssetScheduleController::class, 'index'])->name('reports.accounts.fixed_asset_schedule')->middleware('report.FixedAssetsSchedule.all');

    Route::post('/reports/accounts/fixed-asset-schedule/report', [Reports\Accounts\FixedAssetScheduleController::class, 'branch_wise'])->name('reports.accounts.fixed_asset_schedule.report')->middleware('report.FixedAssetsSchedule.all');

    //  Balance sheet
    Route::get('/reports/accounts/balance-sheet', [Reports\Accounts\BalanceSheetController::class, 'index'])->name('reports.accounts.balance_sheet')->middleware('report.StatementOfFinancialPosition.all');

    Route::post('/reports/accounts/balance-sheet/report', [Reports\Accounts\BalanceSheetController::class, 'branch_wise'])->name('reports.accounts.balance_sheet.report')->middleware('report.StatementOfFinancialPosition.all');

    //  Cash Flow
    Route::get('/reports/accounts/cash-flow', [Reports\Accounts\CashFlowController::class, 'index'])->name('reports.accounts.cash_flow');

    Route::post('/reports/accounts/cash-flow/report', [Reports\Accounts\CashFlowController::class, 'branch_wise'])->name('reports.accounts.cash_flow.report');

    //  Receive Payment
    Route::get('/reports/accounts/receive-payment', [Reports\Accounts\ReceivePaymentController::class, 'index'])->name('reports.accounts.receive_payment')->middleware('report.ReceiveAndPayment.all');

    Route::post('/reports/accounts/receive-payment/report', [Reports\Accounts\ReceivePaymentController::class, 'branch_wise'])->name('reports.accounts.receive_payment.report')->middleware('report.ReceiveAndPayment.all');

    //  Notes start
    Route::get('/reports/accounts/notes', [Reports\Accounts\NotesController::class, 'index'])->name('reports.accounts.notes')->middleware('report.Notes.all');

    Route::post('/reports/accounts/notes/type_wise/report', [Reports\Accounts\NotesController::class, 'type_wise'])->name('reports.accounts.notes.type_wise.report')->middleware('report.Notes.all');

    Route::post('/reports/accounts/notes/group_wise/report', [Reports\Accounts\NotesController::class, 'group_wise'])->name('reports.accounts.notes.group_wise.report')->middleware('report.Notes.all');

    //    Notes End

    //    Accounts Report End

    //    General Report Start

    //    Branch Start

    Route::get('/reports/general/branch', [Reports\General\GeneralReportController::class, 'branch'])->name('reports.general.branch')->middleware('report.general_report.branch.all');

    Route::post('/reports/general/branch/report', [Reports\General\GeneralReportController::class, 'branch_report'])->name('reports.general.branch.report');

    //    Branch End

    //    Ledger Start

    Route::get('/reports/general/ledger', [Reports\General\GeneralReportController::class, 'ledger_type'])->name('reports.general.ledger.type')->middleware('report.general_report.ledger.all');

    Route::post('/reports/general/ledger/type/report', [Reports\General\GeneralReportController::class, 'ledger_type_report'])->name('reports.general.ledger.type.report');

    Route::post('/reports/general/ledger/group/report', [Reports\General\GeneralReportController::class, 'ledger_group_report'])->name('reports.general.ledger.group.report');

    Route::post('/reports/general/ledger/name/report', [Reports\General\GeneralReportController::class, 'ledger_name_report'])->name('reports.general.ledger.name.report');

    //    Ledger End

    //    Bank Cash Start
    Route::get('/reports/general/bank-cash', [Reports\General\GeneralReportController::class, 'bank_cash'])->name('reports.general.bank_cash')->middleware('report.general_report.BankCash.all');

    Route::post('/reports/general/ledger/bank-cash/report', [Reports\General\GeneralReportController::class, 'bank_cash_report'])->name('reports.general.bank_cash.report');
    //    Bank Cash End

    //    Voucher start
    Route::get('/reports/general/voucher', [Reports\General\GeneralReportController::class, 'voucher'])->name('reports.general.voucher')->middleware('report.general_report.Voucher.all');

    Route::post('/reports/general/voucher/report', [Reports\General\GeneralReportController::class, 'voucher_report'])->name('reports.general.voucher.report');
    //    Voucher start

    //    General Report End
});
