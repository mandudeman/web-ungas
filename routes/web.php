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

use Illuminate\Support\Facades\Artisan;

Route::get('config-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');

    dd('Cache is cleared');
});

Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('logout', 'Auth\LoginController@logout');

    //    Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    //    profile
    Route::get('/profile', 'ProfileController@index')->name('profile');

    Route::post('/profile/update/{id}', 'ProfileController@update')->name('profile.update');

    //    User
    Route::get('/user', 'UsersController@index')->name('user')->middleware('user.module_show');

    Route::get('/user/create', 'UsersController@create')->name('user.create')->middleware('user.create');

    Route::post('/user/store', 'UsersController@store')->name('user.store')->middleware('user.create');

    Route::get('/user/edit/{id}', 'UsersController@edit')->name('user.edit')->middleware('user.edit');

    Route::post('/user/update/{id}', 'UsersController@update')->name('user.update')->middleware('user.edit');

    Route::get('/user/show/{id}', 'UsersController@show')->name('user.show');

    Route::get('/user/destroy/{id}', 'UsersController@destroy')->name('user.destroy')->middleware('user.delete');

    Route::get('/user/trashed', 'UsersController@trashed')->name('user.trashed')->middleware('user.trash_show');

    Route::post('/user/trashed/show', 'UsersController@trashedShow')->name('user.trashed.show');

    Route::get('/user/restore/{id}', 'UsersController@restore')->name('user.restore')->middleware('user.restore');

    Route::get('/user/kill/{id}', 'UsersController@kill')->name('user.kill')->middleware('user.permanently_delete');

    Route::get('/user/active/search', 'UsersController@activeSearch')->name('user.active.search');

    Route::get('/user/trashed/search', 'UsersController@trashedSearch')->name('user.trashed.search');

    Route::get('/user/active/action', 'UsersController@activeAction')->name('user.active.action');

    Route::get('/user/trashed/action', 'UsersController@trashedAction')->name('user.trashed.action');

    Route::post('users/password', 'ProfileController@changePassword')->name('users.password');

    //    User End

    //    Settings

    Route::get('/settings/general', 'SettingsController@general_show')->name('settings.general')->middleware('settings.all');

    Route::post('/settings/general/update', 'SettingsController@general_update')->name('settings.general.update');

    Route::get('/settings/system', 'SettingsController@system_show')->name('settings.system')->middleware('settings.show');

    Route::post('/settings/system/update', 'SettingsController@system_update')->name('settings.system.update');

    //    Role Manage
    Route::get('/role-manage', 'RoleManageController@index')->name('role-manage')->middleware('role.module_show');

    Route::get('/role-manage/show/{id}', 'RoleManageController@show')->name('role-manage.show')->middleware('role.show');

    Route::get('/role-manage/create', 'RoleManageController@create')->name('role-manage.create')->middleware('role.create');

    Route::post('/role-manage/store', 'RoleManageController@store')->name('role-manage.store')->middleware('role.create');

    Route::get('/role-manage/edit/{id}', 'RoleManageController@edit')->name('role-manage.edit')->middleware('role.edit');
    Route::post('/role-manage/update/{id}', 'RoleManageController@update')->name('role-manage.update')->middleware('role.edit');

    Route::get('/role-manage/destroy/{id}', 'RoleManageController@destroy')->name('role-manage.destroy')->middleware('role.delete');

    Route::get('/role-manage/pdf/{id}', 'RoleManageController@pdf')->name('role-manage.pdf')->middleware('role.pdf');

    Route::get('/role-manage/trashed', 'RoleManageController@trashed')->name('role-manage.trashed')->middleware('role.trash_show');

    Route::get('/role-manage/restore/{id}', 'RoleManageController@restore')->name('role-manage.restore')->middleware('role.restore');

    Route::get('/role-manage/kill/{id}', 'RoleManageController@kill')->name('role-manage.kill')->middleware('role.permanently_delete');

    Route::get('/role-manage/active/search', 'RoleManageController@activeSearch')->name('role-manage.active.search');

    Route::get('/role-manage/trashed/search', 'RoleManageController@trashedSearch')->name('role-manage.trashed.search');

    Route::get('/role-manage/active/action', 'RoleManageController@activeAction')->name('role-manage.active.action')->middleware('role.delete');

    Route::get('/role-manage/trashed/action', 'RoleManageController@trashedAction')->name('role-manage.trashed.action');

    //    role-manage End

    //    Branch Manage
    Route::get('/branch', 'BranchController@index')->name('branch')->middleware('branch.module_show');

    Route::get('/branch/show/{id}', 'BranchController@show')->name('branch.show')->middleware('branch.show');

    Route::get('/branch/create', 'BranchController@create')->name('branch.create')->middleware('branch.create');

    Route::post('/branch/store', 'BranchController@store')->name('branch.store')->middleware('branch.create');

    Route::get('/branch/edit/{id}', 'BranchController@edit')->name('branch.edit')->middleware('branch.edit');
    Route::post('/branch/update/{id}', 'BranchController@update')->name('branch.update')->middleware('branch.edit');

    Route::get('/branch/destroy/{id}', 'BranchController@destroy')->name('branch.destroy')->middleware('branch.delete');

    Route::get('/branch/pdf/{id}', 'BranchController@pdf')->name('branch.pdf')->middleware('branch.pdf');

    Route::get('/branch/trashed', 'BranchController@trashed')->name('branch.trashed')->middleware('branch.trash_show');

    Route::get('/branch/restore/{id}', 'BranchController@restore')->name('branch.restore')->middleware('branch.restore');

    Route::get('/branch/kill/{id}', 'BranchController@kill')->name('branch.kill')->middleware('branch.permanently_delete');

    Route::get('/branch/active/search', 'BranchController@activeSearch')->name('branch.active.search');

    Route::get('/branch/trashed/search', 'BranchController@trashedSearch')->name('branch.trashed.search');

    Route::get('/branch/active/action', 'BranchController@activeAction')->name('branch.active.action')->middleware('branch.delete');

    Route::get('/branch/trashed/action', 'BranchController@trashedAction')->name('branch.trashed.action');
    //    Branch Manage End

    //    Ledger  Start

    //   Type Start
    Route::get('/ledger/type', 'IncomeExpenseTypeController@index')->name('income_expense_type')->middleware('income_expense_type.all');

    Route::get('/ledger/type/show/{id}', 'IncomeExpenseTypeController@show')->name('income_expense_type.show')->middleware('income_expense_type.show');

    Route::get('/ledger/type/create', 'IncomeExpenseTypeController@create')->name('income_expense_type.create')->middleware('income_expense_type.create');

    Route::post('/ledger/type/store', 'IncomeExpenseTypeController@store')->name('income_expense_type.store')->middleware('income_expense_type.create');

    /*
    Route::get('/ledger/type/edit/{id}', [
        'uses' => 'IncomeExpenseTypeController@edit',
        'as' => 'income_expense_type.edit'
    ])->middleware('income_expense_type.edit');
    Route::post('/ledger/type/update/{id}', [
        'uses' => 'IncomeExpenseTypeController@update',
        'as' => 'income_expense_type.update'
    ])->middleware('income_expense_type.edit');


    Route::get('/ledger/type/destroy/{id}', [
        'uses' => 'IncomeExpenseTypeController@destroy',
        'as' => 'income_expense_type.destroy'
    ])->middleware('income_expense_type.delete');

    */

    Route::get('/ledger/type/pdf/{id}', 'IncomeExpenseTypeController@pdf')->name('income_expense_type.pdf')->middleware('income_expense_type.pdf');

    Route::get('/ledger/type/trashed', 'IncomeExpenseTypeController@trashed')->name('income_expense_type.trashed')->middleware('income_expense_type.trash_show');

    Route::get('/ledger/type/restore/{id}', 'IncomeExpenseTypeController@restore')->name('income_expense_type.restore')->middleware('income_expense_type.restore');

    Route::get('/ledger/type/kill/{id}', 'IncomeExpenseTypeController@kill')->name('income_expense_type.kill')->middleware('income_expense_type.permanently_delete');

    Route::get('/ledger/type/active/search', 'IncomeExpenseTypeController@activeSearch')->name('income_expense_type.active.search');

    Route::get('/ledger/type/trashed/search', 'IncomeExpenseTypeController@trashedSearch')->name('income_expense_type.trashed.search');

    Route::get('/ledger/type/active/action', 'IncomeExpenseTypeController@activeAction')->name('income_expense_type.active.action')->middleware('income_expense_type.delete');

    Route::get('/ledger/type/trashed/action', 'IncomeExpenseTypeController@trashedAction')->name('income_expense_type.trashed.action');

    // Type End

    //   Group Start
    Route::get('/ledger/group', 'IncomeExpenseGroupController@index')->name('income_expense_group')->middleware('income_expense_group.all');

    Route::get('/ledger/group/show/{id}', 'IncomeExpenseGroupController@show')->name('income_expense_group.show')->middleware('income_expense_group.show');

    Route::get('/ledger/group/create', 'IncomeExpenseGroupController@create')->name('income_expense_group.create')->middleware('income_expense_group.create');

    Route::post('/ledger/group/store', 'IncomeExpenseGroupController@store')->name('income_expense_group.store')->middleware('income_expense_group.create');

    Route::get('/ledger/group/edit/{id}', 'IncomeExpenseGroupController@edit')->name('income_expense_group.edit')->middleware('income_expense_group.edit');
    Route::post('/ledger/group/update/{id}', 'IncomeExpenseGroupController@update')->name('income_expense_group.update')->middleware('income_expense_group.edit');

    Route::get('/ledger/group/destroy/{id}', 'IncomeExpenseGroupController@destroy')->name('income_expense_group.destroy')->middleware('income_expense_group.delete');

    Route::get('/ledger/group/pdf/{id}', 'IncomeExpenseGroupController@pdf')->name('income_expense_group.pdf')->middleware('income_expense_group.pdf');

    Route::get('/ledger/group/trashed', 'IncomeExpenseGroupController@trashed')->name('income_expense_group.trashed')->middleware('income_expense_group.trash_show');

    Route::get('/ledger/group/restore/{id}', 'IncomeExpenseGroupController@restore')->name('income_expense_group.restore')->middleware('income_expense_group.restore');

    Route::get('/ledger/group/kill/{id}', 'IncomeExpenseGroupController@kill')->name('income_expense_group.kill')->middleware('income_expense_group.permanently_delete');

    Route::get('/ledger/group/active/search', 'IncomeExpenseGroupController@activeSearch')->name('income_expense_group.active.search');

    Route::get('/ledger/group/trashed/search', 'IncomeExpenseGroupController@trashedSearch')->name('income_expense_group.trashed.search');

    Route::get('/ledger/group/active/action', 'IncomeExpenseGroupController@activeAction')->name('income_expense_group.active.action')->middleware('income_expense_group.delete');

    Route::get('/ledger/group/trashed/action', 'IncomeExpenseGroupController@trashedAction')->name('income_expense_group.trashed.action');

    // Group End

    //    ledger - name Start
    Route::get('/ledger/name', 'IncomeExpenseHeadController@index')->name('income_expense_head')->middleware('income_expense_head.all');

    Route::get('/ledger/name/show/{id}', 'IncomeExpenseHeadController@show')->name('income_expense_head.show')->middleware('income_expense_head.show');

    Route::get('/ledger/name/create', 'IncomeExpenseHeadController@create')->name('income_expense_head.create')->middleware('income_expense_head.create');

    Route::post('/ledger/name/store', 'IncomeExpenseHeadController@store')->name('income_expense_head.store')->middleware('income_expense_head.create');

    Route::get('/ledger/name/edit/{id}', 'IncomeExpenseHeadController@edit')->name('income_expense_head.edit')->middleware('income_expense_head.edit');
    Route::post('/ledger/name/update/{id}', 'IncomeExpenseHeadController@update')->name('income_expense_head.update')->middleware('income_expense_head.edit');

    Route::get('/ledger/name/destroy/{id}', 'IncomeExpenseHeadController@destroy')->name('income_expense_head.destroy')->middleware('income_expense_head.delete');

    Route::get('/ledger/name/pdf/{id}', 'IncomeExpenseHeadController@pdf')->name('income_expense_head.pdf')->middleware('income_expense_head.pdf');

    Route::get('/ledger/name/trashed', 'IncomeExpenseHeadController@trashed')->name('income_expense_head.trashed')->middleware('income_expense_head.trash_show');

    Route::get('/ledger/name/restore/{id}', 'IncomeExpenseHeadController@restore')->name('income_expense_head.restore')->middleware('income_expense_head.restore');

    Route::get('/ledger/name/kill/{id}', 'IncomeExpenseHeadController@kill')->name('income_expense_head.kill')->middleware('income_expense_head.permanently_delete');

    Route::get('/ledger/name/active/search', 'IncomeExpenseHeadController@activeSearch')->name('income_expense_head.active.search');

    Route::get('/ledger/name/trashed/search', 'IncomeExpenseHeadController@trashedSearch')->name('income_expense_head.trashed.search');

    Route::get('/ledger/name/active/action', 'IncomeExpenseHeadController@activeAction')->name('income_expense_head.active.action')->middleware('income_expense_head.delete');

    Route::get('/ledger/name/trashed/action', 'IncomeExpenseHeadController@trashedAction')->name('income_expense_head.trashed.action');

    // ledger name End

    //    Ledger  End

    //    Bank Cash Start
    Route::get('/bank-cash', 'BankCashController@index')->name('bank_cash')->middleware('bank_cash.all');

    Route::get('/bank-cash/show/{id}', 'BankCashController@show')->name('bank_cash.show')->middleware('bank_cash.show');

    Route::get('/bank-cash/create', 'BankCashController@create')->name('bank_cash.create')->middleware('bank_cash.create');

    Route::post('/bank-cash/store', 'BankCashController@store')->name('bank_cash.store')->middleware('bank_cash.create');

    Route::get('/bank-cash/edit/{id}', 'BankCashController@edit')->name('bank_cash.edit')->middleware('bank_cash.edit');

    Route::post('/bank-cash/update/{id}', 'BankCashController@update')->name('bank_cash.update')->middleware('bank_cash.edit');

    Route::get('/bank-cash/destroy/{id}', 'BankCashController@destroy')->name('bank_cash.destroy')->middleware('bank_cash.delete');

    Route::get('/bank-cash/pdf/{id}', 'BankCashController@pdf')->name('bank_cash.pdf')->middleware('bank_cash.pdf');

    Route::get('/bank-cash/trashed', 'BankCashController@trashed')->name('bank_cash.trashed')->middleware('bank_cash.trash_show');

    Route::get('/bank-cash/restore/{id}', 'BankCashController@restore')->name('bank_cash.restore')->middleware('bank_cash.restore');

    Route::get('/bank-cash/kill/{id}', 'BankCashController@kill')->name('bank_cash.kill')->middleware('bank_cash.permanently_delete');

    Route::get('/bank-cash/active/search', 'BankCashController@activeSearch')->name('bank_cash.active.search');

    Route::get('/bank-cash/trashed/search', 'BankCashController@trashedSearch')->name('bank_cash.trashed.search');

    Route::get('/bank-cash/active/action', 'BankCashController@activeAction')->name('bank_cash.active.action')->middleware('bank_cash.delete');

    Route::get('/bank-cash/trashed/action', 'BankCashController@trashedAction')->name('bank_cash.trashed.action');

    // Bank Cash End

    //    initial_income_expense_head_balance Start
    Route::get('/initial-ledger-balance', 'InitialIncomeExpenseHeadBalanceController@index')->name('initial_income_expense_head_balance')->middleware('initial_income_expense_head_balance.all');

    Route::get('/initial-ledger-balance/show/{id}', 'InitialIncomeExpenseHeadBalanceController@show')->name('initial_income_expense_head_balance.show')->middleware('initial_income_expense_head_balance.show');

    Route::get('/initial-ledger-balance/create', 'InitialIncomeExpenseHeadBalanceController@create')->name('initial_income_expense_head_balance.create')->middleware('initial_income_expense_head_balance.create');

    Route::post('/initial-income-expense-head-balance/store', 'InitialIncomeExpenseHeadBalanceController@store')->name('initial_income_expense_head_balance.store')->middleware('initial_income_expense_head_balance.create');

    Route::get('/initial-ledger-balance/edit/{id}', 'InitialIncomeExpenseHeadBalanceController@edit')->name('initial_income_expense_head_balance.edit')->middleware('initial_income_expense_head_balance.edit');

    Route::post('/initial-ledger-balance/update/{id}', 'InitialIncomeExpenseHeadBalanceController@update')->name('initial_income_expense_head_balance.update')->middleware('initial_income_expense_head_balance.edit');

    Route::get('/initial-ledger-balance/destroy/{id}', 'InitialIncomeExpenseHeadBalanceController@destroy')->name('initial_income_expense_head_balance.destroy')->middleware('initial_income_expense_head_balance.delete');

    Route::get('/initial-ledger-balance/pdf/{id}', 'InitialIncomeExpenseHeadBalanceController@pdf')->name('initial_income_expense_head_balance.pdf')->middleware('initial_income_expense_head_balance.pdf');

    Route::get('/initial-ledger-balance/trashed', 'InitialIncomeExpenseHeadBalanceController@trashed')->name('initial_income_expense_head_balance.trashed')->middleware('initial_income_expense_head_balance.trash_show');

    Route::get('/initial-income-expense-head-balance/restore/{id}', 'InitialIncomeExpenseHeadBalanceController@restore')->name('initial_income_expense_head_balance.restore')->middleware('initial_income_expense_head_balance.restore');

    Route::get('/initial-income-expense-head-balance/kill/{id}', 'InitialIncomeExpenseHeadBalanceController@kill')->name('initial_income_expense_head_balance.kill')->middleware('initial_income_expense_head_balance.permanently_delete');

    Route::get('/initial-income-expense-head-balance/active/search', 'InitialIncomeExpenseHeadBalanceController@activeSearch')->name('initial_income_expense_head_balance.active.search');

    Route::get('/initial-income-expense-head-balance/trashed/search', 'InitialIncomeExpenseHeadBalanceController@trashedSearch')->name('initial_income_expense_head_balance.trashed.search');

    Route::get('/initial-income-expense-head-balance/active/action', 'InitialIncomeExpenseHeadBalanceController@activeAction')->name('initial_income_expense_head_balance.active.action')->middleware('initial_income_expense_head_balance.delete');

    Route::get('/initial-income-expense-head-balance/trashed/action', 'InitialIncomeExpenseHeadBalanceController@trashedAction')->name('initial_income_expense_head_balance.trashed.action');

    // initial_income_expense_head_balance End

    //    initial_bank_cash_balance Start
    Route::get('/initial-bank-cash-balance', 'InitialBankCashBalanceController@index')->name('initial_bank_cash_balance')->middleware('initial_bank_cash_balance.all');

    Route::get('/initial-bank-cash-balance/show/{id}', 'InitialBankCashBalanceController@show')->name('initial_bank_cash_balance.show')->middleware('initial_bank_cash_balance.show');

    Route::get('/initial-bank-cash-balance/create', 'InitialBankCashBalanceController@create')->name('initial_bank_cash_balance.create')->middleware('initial_bank_cash_balance.create');

    Route::post('/initial-bank-cash-balance/store', 'InitialBankCashBalanceController@store')->name('initial_bank_cash_balance.store')->middleware('initial_bank_cash_balance.create');

    Route::get('/initial-bank-cash-balance/edit/{id}', 'InitialBankCashBalanceController@edit')->name('initial_bank_cash_balance.edit')->middleware('initial_bank_cash_balance.edit');

    Route::post('/initial-bank-cash-balance/update/{id}', 'InitialBankCashBalanceController@update')->name('initial_bank_cash_balance.update')->middleware('initial_bank_cash_balance.edit');

    Route::get('/initial-bank-cash-balance/destroy/{id}', 'InitialBankCashBalanceController@destroy')->name('initial_bank_cash_balance.destroy')->middleware('initial_bank_cash_balance.delete');

    Route::get('/initial-bank-cash-balance/pdf/{id}', 'InitialBankCashBalanceController@pdf')->name('initial_bank_cash_balance.pdf')->middleware('initial_bank_cash_balance.pdf');

    Route::get('/initial-bank-cash-balance/trashed', 'InitialBankCashBalanceController@trashed')->name('initial_bank_cash_balance.trashed')->middleware('initial_bank_cash_balance.trash_show');

    Route::get('/initial-bank-cash-balance/restore/{id}', 'InitialBankCashBalanceController@restore')->name('initial_bank_cash_balance.restore')->middleware('initial_bank_cash_balance.restore');

    Route::get('/initial-bank-cash-balance/kill/{id}', 'InitialBankCashBalanceController@kill')->name('initial_bank_cash_balance.kill')->middleware('initial_bank_cash_balance.permanently_delete');

    Route::get('/initial-bank-cash-balance/active/search', 'InitialBankCashBalanceController@activeSearch')->name('initial_bank_cash_balance.active.search');

    Route::get('/initial-bank-cash-balance/trashed/search', 'InitialBankCashBalanceController@trashedSearch')->name('initial_bank_cash_balance.trashed.search');

    Route::get('/initial-bank-cash-balance/active/action', 'InitialBankCashBalanceController@activeAction')->name('initial_bank_cash_balance.active.action')->middleware('initial_bank_cash_balance.delete');

    Route::get('/initial-bank-cash-balance/trashed/action', 'InitialBankCashBalanceController@trashedAction')->name('initial_bank_cash_balance.trashed.action');

    // initial_bank_cash_balance End

    //  DrVoucher Start
    Route::get('/dr-voucher', 'DrVoucherController@index')->name('dr_voucher')->middleware('dr_voucher.all');

    Route::get('/dr-voucher/show/{id}', 'DrVoucherController@show')->name('dr_voucher.show')->middleware('dr_voucher.show');

    Route::get('/dr-voucher/create', 'DrVoucherController@create')->name('dr_voucher.create')->middleware('dr_voucher.create');

    Route::post('/dr-voucher/store', 'DrVoucherController@store')->name('dr_voucher.store')->middleware('dr_voucher.create');

    Route::get('/dr-voucher/edit/{id}', 'DrVoucherController@edit')->name('dr_voucher.edit')->middleware('dr_voucher.edit');

    Route::post('/dr-voucher/update/{id}', 'DrVoucherController@update')->name('dr_voucher.update')->middleware('dr_voucher.edit');

    Route::get('/dr-voucher/destroy/{id}', 'DrVoucherController@destroy')->name('dr_voucher.destroy')->middleware('dr_voucher.delete');

    Route::get('/dr-voucher/pdf/{id}', 'DrVoucherController@pdf')->name('dr_voucher.pdf')->middleware('dr_voucher.pdf');

    Route::get('/dr-voucher/trashed', 'DrVoucherController@trashed')->name('dr_voucher.trashed')->middleware('dr_voucher.trash_show');

    Route::get('/dr-voucher/restore/{id}', 'DrVoucherController@restore')->name('dr_voucher.restore')->middleware('dr_voucher.restore');

    Route::get('/dr-voucher/kill/{id}', 'DrVoucherController@kill')->name('dr_voucher.kill')->middleware('dr_voucher.permanently_delete');

    Route::get('/dr-voucher/active/search', 'DrVoucherController@activeSearch')->name('dr_voucher.active.search');

    Route::get('/dr-voucher/trashed/search', 'DrVoucherController@trashedSearch')->name('dr_voucher.trashed.search');

    Route::get('/dr-voucher/active/action', 'DrVoucherController@activeAction')->name('dr_voucher.active.action')->middleware('dr_voucher.delete');

    Route::get('/dr-voucher/trashed/action', 'DrVoucherController@trashedAction')->name('dr_voucher.trashed.action');

    // DrVoucher End

    //  cr_voucher Start
    Route::get('/cr-voucher', 'CrVoucherController@index')->name('cr_voucher')->middleware('cr_voucher.all');

    Route::get('/cr-voucher/show/{id}', 'CrVoucherController@show')->name('cr_voucher.show')->middleware('cr_voucher.show');

    Route::get('/cr-voucher/create', 'CrVoucherController@create')->name('cr_voucher.create')->middleware('cr_voucher.create');

    Route::post('/cr-voucher/store', 'CrVoucherController@store')->name('cr_voucher.store')->middleware('cr_voucher.create');

    Route::get('/cr-voucher/edit/{id}', 'CrVoucherController@edit')->name('cr_voucher.edit')->middleware('cr_voucher.edit');

    Route::post('/cr-voucher/update/{id}', 'CrVoucherController@update')->name('cr_voucher.update')->middleware('cr_voucher.edit');

    Route::get('/cr-voucher/destroy/{id}', 'CrVoucherController@destroy')->name('cr_voucher.destroy')->middleware('cr_voucher.delete');

    Route::get('/cr-voucher/pdf/{id}', 'CrVoucherController@pdf')->name('cr_voucher.pdf')->middleware('cr_voucher.pdf');

    Route::get('/cr-voucher/trashed', 'CrVoucherController@trashed')->name('cr_voucher.trashed')->middleware('cr_voucher.trash_show');

    Route::get('/cr-voucher/restore/{id}', 'CrVoucherController@restore')->name('cr_voucher.restore')->middleware('cr_voucher.restore');

    Route::get('/cr-voucher/kill/{id}', 'CrVoucherController@kill')->name('cr_voucher.kill')->middleware('cr_voucher.permanently_delete');

    Route::get('/cr-voucher/active/search', 'CrVoucherController@activeSearch')->name('cr_voucher.active.search');

    Route::get('/cr-voucher/trashed/search', 'CrVoucherController@trashedSearch')->name('cr_voucher.trashed.search');

    Route::get('/cr-voucher/active/action', 'CrVoucherController@activeAction')->name('cr_voucher.active.action')->middleware('cr_voucher.delete');

    Route::get('/cr-voucher/trashed/action', 'CrVoucherController@trashedAction')->name('cr_voucher.trashed.action');

    // cr_voucher End

    //  jnl_voucher Start
    Route::get('/journal-voucher', 'JournalVoucherController@index')->name('jnl_voucher')->middleware('jnl_voucher.all');

    Route::get('/journal-voucher/show/{id}', 'JournalVoucherController@show')->name('jnl_voucher.show')->middleware('jnl_voucher.show');

    Route::get('/journal-voucher/create', 'JournalVoucherController@create')->name('jnl_voucher.create')->middleware('jnl_voucher.create');

    Route::post('/journal-voucher/store', 'JournalVoucherController@store')->name('jnl_voucher.store')->middleware('jnl_voucher.create');

    Route::get('/journal-voucher/edit/{id}', 'JournalVoucherController@edit')->name('jnl_voucher.edit')->middleware('jnl_voucher.edit');

    Route::post('/journal-voucher/update/{id}', 'JournalVoucherController@update')->name('jnl_voucher.update')->middleware('jnl_voucher.edit');

    Route::get('/journal-voucher/destroy/{id}', 'JournalVoucherController@destroy')->name('jnl_voucher.destroy')->middleware('jnl_voucher.delete');

    Route::get('/journal-voucher/pdf/{id}', 'JournalVoucherController@pdf')->name('jnl_voucher.pdf')->middleware('jnl_voucher.pdf');

    Route::get('/journal-voucher/trashed', 'JournalVoucherController@trashed')->name('jnl_voucher.trashed')->middleware('jnl_voucher.trash_show');

    Route::get('/journal-voucher/restore/{id}', 'JournalVoucherController@restore')->name('jnl_voucher.restore')->middleware('jnl_voucher.restore');

    Route::get('/journal-voucher/kill/{id}', 'JournalVoucherController@kill')->name('jnl_voucher.kill')->middleware('jnl_voucher.permanently_delete');

    Route::get('/journal-voucher/active/search', 'JournalVoucherController@activeSearch')->name('jnl_voucher.active.search');

    Route::get('/journal-voucher/trashed/search', 'JournalVoucherController@trashedSearch')->name('jnl_voucher.trashed.search');

    Route::get('/journal-voucher/active/action', 'JournalVoucherController@activeAction')->name('jnl_voucher.active.action')->middleware('jnl_voucher.delete');

    Route::get('/journal-voucher/trashed/action', 'JournalVoucherController@trashedAction')->name('jnl_voucher.trashed.action');

    // jnl_voucher End

    //  contra_voucher Start
    Route::get('/contra-voucher', 'ContraVoucherController@index')->name('contra_voucher')->middleware('contra_voucher.all');

    Route::get('/contra-voucher/show/{id}', 'ContraVoucherController@show')->name('contra_voucher.show')->middleware('contra_voucher.show');

    Route::get('/contra-voucher/create', 'ContraVoucherController@create')->name('contra_voucher.create')->middleware('contra_voucher.create');

    Route::post('/contra-voucher/store', 'ContraVoucherController@store')->name('contra_voucher.store')->middleware('contra_voucher.create');

    Route::get('/contra-voucher/edit/{id}', 'ContraVoucherController@edit')->name('contra_voucher.edit')->middleware('contra_voucher.edit');

    Route::post('/contra-voucher/update/{id}', 'ContraVoucherController@update')->name('contra_voucher.update')->middleware('contra_voucher.edit');

    Route::get('/contra-voucher/destroy/{id}', 'ContraVoucherController@destroy')->name('contra_voucher.destroy')->middleware('contra_voucher.delete');

    Route::get('/contra-voucher/pdf/{id}', 'ContraVoucherController@pdf')->name('contra_voucher.pdf')->middleware('contra_voucher.pdf');

    Route::get('/contra-voucher/trashed', 'ContraVoucherController@trashed')->name('contra_voucher.trashed')->middleware('contra_voucher.trash_show');

    Route::get('/contra-voucher/restore/{id}', 'ContraVoucherController@restore')->name('contra_voucher.restore')->middleware('contra_voucher.restore');

    Route::get('/contra-voucher/kill/{id}', 'ContraVoucherController@kill')->name('contra_voucher.kill')->middleware('contra_voucher.permanently_delete');

    Route::get('/contra-voucher/active/search', 'ContraVoucherController@activeSearch')->name('contra_voucher.active.search');

    Route::get('/contra-voucher/trashed/search', 'ContraVoucherController@trashedSearch')->name('contra_voucher.trashed.search');

    Route::get('/contra-voucher/active/action', 'ContraVoucherController@activeAction')->name('contra_voucher.active.action')->middleware('contra_voucher.delete');

    Route::get('/contra-voucher/trashed/action', 'ContraVoucherController@trashedAction')->name('contra_voucher.trashed.action');

    // contra_voucher End

    //    Accounts Report Start

    //    ledger

    Route::get('/reports/accounts/ledger', 'AccountsReportController@ledger_index')->name('reports.accounts.ledger')->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/branch-wise/report', 'AccountsReportController@ledger_branch_wise_report')->name('reports_accounts_ledger.branch_wise.report')->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/income-expense-head-wise/report', 'AccountsReportController@ledger_income_expense_head_wise_report')->name('reports_accounts_ledger.income_expense_head_wise.report')->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/bank-cash-wise/report', 'AccountsReportController@ledger_bank_cash_wise_report')->name('reports_accounts_ledger.bank_cash_wise.report')->middleware('report.ledger.all');

    //    Trial Balance
    Route::get('/reports/accounts/trial-balance', 'Reports\Accounts\TrialBalanceController@index')->name('reports.accounts.trial_balance')->middleware('report.TrialBalance.all');

    Route::post('/reports/accounts/trial-balance/report', 'Reports\Accounts\TrialBalanceController@branch_wise')->name('reports.accounts.trial_balance.branch_wise.report')->middleware('report.TrialBalance.all');

    //    Cost Of Revenue Manage
    Route::get('/reports/accounts/cost-of-revenue', 'Reports\Accounts\CostOfRevenueController@index')->name('reports.accounts.cost_of_revenue')->middleware('report.CostOfRevenue.all');

    Route::post('/reports/accounts/cost-of-revenue/report', 'Reports\Accounts\CostOfRevenueController@branch_wise')->name('reports.accounts.cost_of_revenue.report')->middleware('report.CostOfRevenue.all');

    //    Profit & Loss Account
    Route::get('/reports/accounts/profit-or-loss-account', 'Reports\Accounts\ProfitAndLossAccountController@index')->name('reports.accounts.profit_or_loss_account')->middleware('report.ProfitOrLossAccount.all');

    Route::post('/reports/accounts/profit-or-loss-account/report', 'Reports\Accounts\ProfitAndLossAccountController@branch_wise')->name('reports.accounts.profit_or_loss_account.report')->middleware('report.ProfitOrLossAccount.all');

    //    Retained Earnings
    Route::get('/reports/accounts/retained-earnings', 'Reports\Accounts\RetainedEarningsController@index')->name('reports.accounts.retained_earnings')->middleware('report.RetainedEarning.all');

    Route::post('/reports/accounts/retained-earnings/report', 'Reports\Accounts\RetainedEarningsController@branch_wise')->name('reports.accounts.retained_earnings.report')->middleware('report.RetainedEarning.all');

    //    Fixed Asset Schedule
    Route::get('/reports/accounts/fixed-asset-schedule', 'Reports\Accounts\FixedAssetScheduleController@index')->name('reports.accounts.fixed_asset_schedule')->middleware('report.FixedAssetsSchedule.all');

    Route::post('/reports/accounts/fixed-asset-schedule/report', 'Reports\Accounts\FixedAssetScheduleController@branch_wise')->name('reports.accounts.fixed_asset_schedule.report')->middleware('report.FixedAssetsSchedule.all');

    //  Balance sheet
    Route::get('/reports/accounts/balance-sheet', 'Reports\Accounts\BalanceSheetController@index')->name('reports.accounts.balance_sheet')->middleware('report.StatementOfFinancialPosition.all');

    Route::post('/reports/accounts/balance-sheet/report', 'Reports\Accounts\BalanceSheetController@branch_wise')->name('reports.accounts.balance_sheet.report')->middleware('report.StatementOfFinancialPosition.all');

    //  Cash Flow
    Route::get('/reports/accounts/cash-flow', 'Reports\Accounts\CashFlowController@index')->name('reports.accounts.cash_flow');

    Route::post('/reports/accounts/cash-flow/report', 'Reports\Accounts\CashFlowController@branch_wise')->name('reports.accounts.cash_flow.report');

    //  Receive Payment
    Route::get('/reports/accounts/receive-payment', 'Reports\Accounts\ReceivePaymentController@index')->name('reports.accounts.receive_payment')->middleware('report.ReceiveAndPayment.all');

    Route::post('/reports/accounts/receive-payment/report', 'Reports\Accounts\ReceivePaymentController@branch_wise')->name('reports.accounts.receive_payment.report')->middleware('report.ReceiveAndPayment.all');

    //  Notes start
    Route::get('/reports/accounts/notes', 'Reports\Accounts\NotesController@index')->name('reports.accounts.notes')->middleware('report.Notes.all');

    Route::post('/reports/accounts/notes/type_wise/report', 'Reports\Accounts\NotesController@type_wise')->name('reports.accounts.notes.type_wise.report')->middleware('report.Notes.all');

    Route::post('/reports/accounts/notes/group_wise/report', 'Reports\Accounts\NotesController@group_wise')->name('reports.accounts.notes.group_wise.report')->middleware('report.Notes.all');

    //    Notes End

    //    Accounts Report End

    //    General Report Start

    //    Branch Start

    Route::get('/reports/general/branch', 'Reports\General\GeneralReportController@branch')->name('reports.general.branch')->middleware('report.general_report.branch.all');

    Route::post('/reports/general/branch/report', 'Reports\General\GeneralReportController@branch_report')->name('reports.general.branch.report');

    //    Branch End

    //    Ledger Start

    Route::get('/reports/general/ledger', 'Reports\General\GeneralReportController@ledger_type')->name('reports.general.ledger.type')->middleware('report.general_report.ledger.all');

    Route::post('/reports/general/ledger/type/report', 'Reports\General\GeneralReportController@ledger_type_report')->name('reports.general.ledger.type.report');

    Route::post('/reports/general/ledger/group/report', 'Reports\General\GeneralReportController@ledger_group_report')->name('reports.general.ledger.group.report');

    Route::post('/reports/general/ledger/name/report', 'Reports\General\GeneralReportController@ledger_name_report')->name('reports.general.ledger.name.report');

    //    Ledger End

    //    Bank Cash Start
    Route::get('/reports/general/bank-cash', 'Reports\General\GeneralReportController@bank_cash')->name('reports.general.bank_cash')->middleware('report.general_report.BankCash.all');

    Route::post('/reports/general/ledger/bank-cash/report', 'Reports\General\GeneralReportController@bank_cash_report')->name('reports.general.bank_cash.report');
    //    Bank Cash End

    //    Voucher start
    Route::get('/reports/general/voucher', 'Reports\General\GeneralReportController@voucher')->name('reports.general.voucher')->middleware('report.general_report.Voucher.all');

    Route::post('/reports/general/voucher/report', 'Reports\General\GeneralReportController@voucher_report')->name('reports.general.voucher.report');
    //    Voucher start

    //    General Report End
});
