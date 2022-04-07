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

    dd("Cache is cleared");
});


Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', 'Auth\LoginController@logout');

    //    Dashboard
    Route::get('/', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);

    //    profile
    Route::get('/profile', [
        'uses' => 'ProfileController@index',
        'as' => 'profile'
    ]);

    Route::post('/profile/update/{id}', [
        'uses' => 'ProfileController@update',
        'as' => 'profile.update'
    ]);


    //    User
    Route::get('/user', [
        'uses' => 'UsersController@index',
        'as' => 'user'
    ])->middleware('user.module_show');

    Route::get('/user/create', [
        'uses' => 'UsersController@create',
        'as' => 'user.create'
    ])->middleware('user.create');

    Route::post('/user/store', [
        'uses' => 'UsersController@store',
        'as' => 'user.store'
    ])->middleware('user.create');


    Route::get('/user/edit/{id}', [
        'uses' => 'UsersController@edit',
        'as' => 'user.edit'
    ])->middleware('user.edit');

    Route::post('/user/update/{id}', [
        'uses' => 'UsersController@update',
        'as' => 'user.update'
    ])->middleware('user.edit');

    Route::get('/user/show/{id}', [
        'uses' => 'UsersController@show',
        'as' => 'user.show'
    ]);

    Route::get('/user/destroy/{id}', [
        'uses' => 'UsersController@destroy',
        'as' => 'user.destroy'
    ])->middleware('user.delete');

    Route::get('/user/trashed', [
        'uses' => 'UsersController@trashed',
        'as' => 'user.trashed'
    ])->middleware('user.trash_show');

    Route::post('/user/trashed/show', [
        'uses' => 'UsersController@trashedShow',
        'as' => 'user.trashed.show'
    ]);


    Route::get('/user/restore/{id}', [
        'uses' => 'UsersController@restore',
        'as' => 'user.restore'
    ])->middleware('user.restore');

    Route::get('/user/kill/{id}', [
        'uses' => 'UsersController@kill',
        'as' => 'user.kill'
    ])->middleware('user.permanently_delete');

    Route::get('/user/active/search', [
        'uses' => 'UsersController@activeSearch',
        'as' => 'user.active.search'
    ]);

    Route::get('/user/trashed/search', [
        'uses' => 'UsersController@trashedSearch',
        'as' => 'user.trashed.search'
    ]);

    Route::get('/user/active/action', [
        'uses' => 'UsersController@activeAction',
        'as' => 'user.active.action'
    ]);

    Route::get('/user/trashed/action', [
        'uses' => 'UsersController@trashedAction',
        'as' => 'user.trashed.action'
    ]);


    Route::post('users/password', [
        'uses' => 'ProfileController@changePassword',
        'as' => 'users.password'
    ]);

    //    User End

    //    Settings

    Route::get('/settings/general', [
        'uses' => 'SettingsController@general_show',
        'as' => 'settings.general'
    ])->middleware('settings.all');

    Route::post('/settings/general/update', [
        'uses' => 'SettingsController@general_update',
        'as' => 'settings.general.update'
    ]);


    Route::get('/settings/system', [
        'uses' => 'SettingsController@system_show',
        'as' => 'settings.system'
    ])->middleware('settings.show');

    Route::post('/settings/system/update', [
        'uses' => 'SettingsController@system_update',
        'as' => 'settings.system.update'
    ]);


    //    Role Manage
    Route::get('/role-manage', [
        'uses' => 'RoleManageController@index',
        'as' => 'role-manage'
    ])->middleware('role.module_show');

    Route::get('/role-manage/show/{id}', [
        'uses' => 'RoleManageController@show',
        'as' => 'role-manage.show'
    ])->middleware('role.show');

    Route::get('/role-manage/create', [
        'uses' => 'RoleManageController@create',
        'as' => 'role-manage.create'
    ])->middleware('role.create');

    Route::post('/role-manage/store', [
        'uses' => 'RoleManageController@store',
        'as' => 'role-manage.store'
    ])->middleware('role.create');


    Route::get('/role-manage/edit/{id}', [
        'uses' => 'RoleManageController@edit',
        'as' => 'role-manage.edit'
    ])->middleware('role.edit');
    Route::post('/role-manage/update/{id}', [
        'uses' => 'RoleManageController@update',
        'as' => 'role-manage.update'
    ])->middleware('role.edit');


    Route::get('/role-manage/destroy/{id}', [
        'uses' => 'RoleManageController@destroy',
        'as' => 'role-manage.destroy'
    ])->middleware('role.delete');

    Route::get('/role-manage/pdf/{id}', [
        'uses' => 'RoleManageController@pdf',
        'as' => 'role-manage.pdf'
    ])->middleware('role.pdf');


    Route::get('/role-manage/trashed', [
        'uses' => 'RoleManageController@trashed',
        'as' => 'role-manage.trashed'
    ])->middleware('role.trash_show');


    Route::get('/role-manage/restore/{id}', [
        'uses' => 'RoleManageController@restore',
        'as' => 'role-manage.restore'
    ])->middleware('role.restore');


    Route::get('/role-manage/kill/{id}', [
        'uses' => 'RoleManageController@kill',
        'as' => 'role-manage.kill'
    ])->middleware('role.permanently_delete');

    Route::get('/role-manage/active/search', [
        'uses' => 'RoleManageController@activeSearch',
        'as' => 'role-manage.active.search'
    ]);

    Route::get('/role-manage/trashed/search', [
        'uses' => 'RoleManageController@trashedSearch',
        'as' => 'role-manage.trashed.search'
    ]);

    Route::get('/role-manage/active/action', [
        'uses' => 'RoleManageController@activeAction',
        'as' => 'role-manage.active.action'
    ])->middleware('role.delete');

    Route::get('/role-manage/trashed/action', [
        'uses' => 'RoleManageController@trashedAction',
        'as' => 'role-manage.trashed.action'
    ]);

    //    role-manage End


    //    Branch Manage
    Route::get('/branch', [
        'uses' => 'BranchController@index',
        'as' => 'branch'
    ])->middleware('branch.module_show');

    Route::get('/branch/show/{id}', [
        'uses' => 'BranchController@show',
        'as' => 'branch.show'
    ])->middleware('branch.show');

    Route::get('/branch/create', [
        'uses' => 'BranchController@create',
        'as' => 'branch.create'
    ])->middleware('branch.create');

    Route::post('/branch/store', [
        'uses' => 'BranchController@store',
        'as' => 'branch.store'
    ])->middleware('branch.create');


    Route::get('/branch/edit/{id}', [
        'uses' => 'BranchController@edit',
        'as' => 'branch.edit'
    ])->middleware('branch.edit');
    Route::post('/branch/update/{id}', [
        'uses' => 'BranchController@update',
        'as' => 'branch.update'
    ])->middleware('branch.edit');


    Route::get('/branch/destroy/{id}', [
        'uses' => 'BranchController@destroy',
        'as' => 'branch.destroy'
    ])->middleware('branch.delete');

    Route::get('/branch/pdf/{id}', [
        'uses' => 'BranchController@pdf',
        'as' => 'branch.pdf'
    ])->middleware('branch.pdf');


    Route::get('/branch/trashed', [
        'uses' => 'BranchController@trashed',
        'as' => 'branch.trashed'
    ])->middleware('branch.trash_show');


    Route::get('/branch/restore/{id}', [
        'uses' => 'BranchController@restore',
        'as' => 'branch.restore'
    ])->middleware('branch.restore');


    Route::get('/branch/kill/{id}', [
        'uses' => 'BranchController@kill',
        'as' => 'branch.kill'
    ])->middleware('branch.permanently_delete');

    Route::get('/branch/active/search', [
        'uses' => 'BranchController@activeSearch',
        'as' => 'branch.active.search'
    ]);

    Route::get('/branch/trashed/search', [
        'uses' => 'BranchController@trashedSearch',
        'as' => 'branch.trashed.search'
    ]);

    Route::get('/branch/active/action', [
        'uses' => 'BranchController@activeAction',
        'as' => 'branch.active.action'
    ])->middleware('branch.delete');

    Route::get('/branch/trashed/action', [
        'uses' => 'BranchController@trashedAction',
        'as' => 'branch.trashed.action'
    ]);
    //    Branch Manage End


    //    Ledger  Start

    //   Type Start
    Route::get('/ledger/type', [
        'uses' => 'IncomeExpenseTypeController@index',
        'as' => 'income_expense_type'
    ])->middleware('income_expense_type.all');

    Route::get('/ledger/type/show/{id}', [
        'uses' => 'IncomeExpenseTypeController@show',
        'as' => 'income_expense_type.show'
    ])->middleware('income_expense_type.show');

    Route::get('/ledger/type/create', [
        'uses' => 'IncomeExpenseTypeController@create',
        'as' => 'income_expense_type.create'
    ])->middleware('income_expense_type.create');

    Route::post('/ledger/type/store', [
        'uses' => 'IncomeExpenseTypeController@store',
        'as' => 'income_expense_type.store'
    ])->middleware('income_expense_type.create');

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

    Route::get('/ledger/type/pdf/{id}', [
        'uses' => 'IncomeExpenseTypeController@pdf',
        'as' => 'income_expense_type.pdf'
    ])->middleware('income_expense_type.pdf');


    Route::get('/ledger/type/trashed', [
        'uses' => 'IncomeExpenseTypeController@trashed',
        'as' => 'income_expense_type.trashed'
    ])->middleware('income_expense_type.trash_show');


    Route::get('/ledger/type/restore/{id}', [
        'uses' => 'IncomeExpenseTypeController@restore',
        'as' => 'income_expense_type.restore'
    ])->middleware('income_expense_type.restore');


    Route::get('/ledger/type/kill/{id}', [
        'uses' => 'IncomeExpenseTypeController@kill',
        'as' => 'income_expense_type.kill'
    ])->middleware('income_expense_type.permanently_delete');

    Route::get('/ledger/type/active/search', [
        'uses' => 'IncomeExpenseTypeController@activeSearch',
        'as' => 'income_expense_type.active.search'
    ]);

    Route::get('/ledger/type/trashed/search', [
        'uses' => 'IncomeExpenseTypeController@trashedSearch',
        'as' => 'income_expense_type.trashed.search'
    ]);

    Route::get('/ledger/type/active/action', [
        'uses' => 'IncomeExpenseTypeController@activeAction',
        'as' => 'income_expense_type.active.action'
    ])->middleware('income_expense_type.delete');

    Route::get('/ledger/type/trashed/action', [
        'uses' => 'IncomeExpenseTypeController@trashedAction',
        'as' => 'income_expense_type.trashed.action'
    ]);

    // Type End


    //   Group Start
    Route::get('/ledger/group', [
        'uses' => 'IncomeExpenseGroupController@index',
        'as' => 'income_expense_group'
    ])->middleware('income_expense_group.all');

    Route::get('/ledger/group/show/{id}', [
        'uses' => 'IncomeExpenseGroupController@show',
        'as' => 'income_expense_group.show'
    ])->middleware('income_expense_group.show');

    Route::get('/ledger/group/create', [
        'uses' => 'IncomeExpenseGroupController@create',
        'as' => 'income_expense_group.create'
    ])->middleware('income_expense_group.create');

    Route::post('/ledger/group/store', [
        'uses' => 'IncomeExpenseGroupController@store',
        'as' => 'income_expense_group.store'
    ])->middleware('income_expense_group.create');


    Route::get('/ledger/group/edit/{id}', [
        'uses' => 'IncomeExpenseGroupController@edit',
        'as' => 'income_expense_group.edit'
    ])->middleware('income_expense_group.edit');
    Route::post('/ledger/group/update/{id}', [
        'uses' => 'IncomeExpenseGroupController@update',
        'as' => 'income_expense_group.update'
    ])->middleware('income_expense_group.edit');


    Route::get('/ledger/group/destroy/{id}', [
        'uses' => 'IncomeExpenseGroupController@destroy',
        'as' => 'income_expense_group.destroy'
    ])->middleware('income_expense_group.delete');

    Route::get('/ledger/group/pdf/{id}', [
        'uses' => 'IncomeExpenseGroupController@pdf',
        'as' => 'income_expense_group.pdf'
    ])->middleware('income_expense_group.pdf');


    Route::get('/ledger/group/trashed', [
        'uses' => 'IncomeExpenseGroupController@trashed',
        'as' => 'income_expense_group.trashed'
    ])->middleware('income_expense_group.trash_show');


    Route::get('/ledger/group/restore/{id}', [
        'uses' => 'IncomeExpenseGroupController@restore',
        'as' => 'income_expense_group.restore'
    ])->middleware('income_expense_group.restore');


    Route::get('/ledger/group/kill/{id}', [
        'uses' => 'IncomeExpenseGroupController@kill',
        'as' => 'income_expense_group.kill'
    ])->middleware('income_expense_group.permanently_delete');

    Route::get('/ledger/group/active/search', [
        'uses' => 'IncomeExpenseGroupController@activeSearch',
        'as' => 'income_expense_group.active.search'
    ]);

    Route::get('/ledger/group/trashed/search', [
        'uses' => 'IncomeExpenseGroupController@trashedSearch',
        'as' => 'income_expense_group.trashed.search'
    ]);

    Route::get('/ledger/group/active/action', [
        'uses' => 'IncomeExpenseGroupController@activeAction',
        'as' => 'income_expense_group.active.action'
    ])->middleware('income_expense_group.delete');

    Route::get('/ledger/group/trashed/action', [
        'uses' => 'IncomeExpenseGroupController@trashedAction',
        'as' => 'income_expense_group.trashed.action'
    ]);

    // Group End


    //    ledger - name Start
    Route::get('/ledger/name', [
        'uses' => 'IncomeExpenseHeadController@index',
        'as' => 'income_expense_head'
    ])->middleware('income_expense_head.all');

    Route::get('/ledger/name/show/{id}', [
        'uses' => 'IncomeExpenseHeadController@show',
        'as' => 'income_expense_head.show'
    ])->middleware('income_expense_head.show');

    Route::get('/ledger/name/create', [
        'uses' => 'IncomeExpenseHeadController@create',
        'as' => 'income_expense_head.create'
    ])->middleware('income_expense_head.create');

    Route::post('/ledger/name/store', [
        'uses' => 'IncomeExpenseHeadController@store',
        'as' => 'income_expense_head.store'
    ])->middleware('income_expense_head.create');


    Route::get('/ledger/name/edit/{id}', [
        'uses' => 'IncomeExpenseHeadController@edit',
        'as' => 'income_expense_head.edit'
    ])->middleware('income_expense_head.edit');
    Route::post('/ledger/name/update/{id}', [
        'uses' => 'IncomeExpenseHeadController@update',
        'as' => 'income_expense_head.update'
    ])->middleware('income_expense_head.edit');


    Route::get('/ledger/name/destroy/{id}', [
        'uses' => 'IncomeExpenseHeadController@destroy',
        'as' => 'income_expense_head.destroy'
    ])->middleware('income_expense_head.delete');

    Route::get('/ledger/name/pdf/{id}', [
        'uses' => 'IncomeExpenseHeadController@pdf',
        'as' => 'income_expense_head.pdf'
    ])->middleware('income_expense_head.pdf');


    Route::get('/ledger/name/trashed', [
        'uses' => 'IncomeExpenseHeadController@trashed',
        'as' => 'income_expense_head.trashed'
    ])->middleware('income_expense_head.trash_show');


    Route::get('/ledger/name/restore/{id}', [
        'uses' => 'IncomeExpenseHeadController@restore',
        'as' => 'income_expense_head.restore'
    ])->middleware('income_expense_head.restore');


    Route::get('/ledger/name/kill/{id}', [
        'uses' => 'IncomeExpenseHeadController@kill',
        'as' => 'income_expense_head.kill'
    ])->middleware('income_expense_head.permanently_delete');

    Route::get('/ledger/name/active/search', [
        'uses' => 'IncomeExpenseHeadController@activeSearch',
        'as' => 'income_expense_head.active.search'
    ]);

    Route::get('/ledger/name/trashed/search', [
        'uses' => 'IncomeExpenseHeadController@trashedSearch',
        'as' => 'income_expense_head.trashed.search'
    ]);

    Route::get('/ledger/name/active/action', [
        'uses' => 'IncomeExpenseHeadController@activeAction',
        'as' => 'income_expense_head.active.action'
    ])->middleware('income_expense_head.delete');

    Route::get('/ledger/name/trashed/action', [
        'uses' => 'IncomeExpenseHeadController@trashedAction',
        'as' => 'income_expense_head.trashed.action'
    ]);

    // ledger name End


    //    Ledger  End


    //    Bank Cash Start
    Route::get('/bank-cash', [
        'uses' => 'BankCashController@index',
        'as' => 'bank_cash'
    ])->middleware('bank_cash.all');

    Route::get('/bank-cash/show/{id}', [
        'uses' => 'BankCashController@show',
        'as' => 'bank_cash.show'
    ])->middleware('bank_cash.show');

    Route::get('/bank-cash/create', [
        'uses' => 'BankCashController@create',
        'as' => 'bank_cash.create'
    ])->middleware('bank_cash.create');

    Route::post('/bank-cash/store', [
        'uses' => 'BankCashController@store',
        'as' => 'bank_cash.store'
    ])->middleware('bank_cash.create');


    Route::get('/bank-cash/edit/{id}', [
        'uses' => 'BankCashController@edit',
        'as' => 'bank_cash.edit'
    ])->middleware('bank_cash.edit');

    Route::post('/bank-cash/update/{id}', [
        'uses' => 'BankCashController@update',
        'as' => 'bank_cash.update'
    ])->middleware('bank_cash.edit');


    Route::get('/bank-cash/destroy/{id}', [
        'uses' => 'BankCashController@destroy',
        'as' => 'bank_cash.destroy'
    ])->middleware('bank_cash.delete');

    Route::get('/bank-cash/pdf/{id}', [
        'uses' => 'BankCashController@pdf',
        'as' => 'bank_cash.pdf'
    ])->middleware('bank_cash.pdf');


    Route::get('/bank-cash/trashed', [
        'uses' => 'BankCashController@trashed',
        'as' => 'bank_cash.trashed'
    ])->middleware('bank_cash.trash_show');


    Route::get('/bank-cash/restore/{id}', [
        'uses' => 'BankCashController@restore',
        'as' => 'bank_cash.restore'
    ])->middleware('bank_cash.restore');


    Route::get('/bank-cash/kill/{id}', [
        'uses' => 'BankCashController@kill',
        'as' => 'bank_cash.kill'
    ])->middleware('bank_cash.permanently_delete');

    Route::get('/bank-cash/active/search', [
        'uses' => 'BankCashController@activeSearch',
        'as' => 'bank_cash.active.search'
    ]);

    Route::get('/bank-cash/trashed/search', [
        'uses' => 'BankCashController@trashedSearch',
        'as' => 'bank_cash.trashed.search'
    ]);

    Route::get('/bank-cash/active/action', [
        'uses' => 'BankCashController@activeAction',
        'as' => 'bank_cash.active.action'
    ])->middleware('bank_cash.delete');

    Route::get('/bank-cash/trashed/action', [
        'uses' => 'BankCashController@trashedAction',
        'as' => 'bank_cash.trashed.action'
    ]);

    // Bank Cash End


    //    initial_income_expense_head_balance Start
    Route::get('/initial-ledger-balance', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@index',
        'as' => 'initial_income_expense_head_balance'
    ])->middleware('initial_income_expense_head_balance.all');

    Route::get('/initial-ledger-balance/show/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@show',
        'as' => 'initial_income_expense_head_balance.show'
    ])->middleware('initial_income_expense_head_balance.show');

    Route::get('/initial-ledger-balance/create', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@create',
        'as' => 'initial_income_expense_head_balance.create'
    ])->middleware('initial_income_expense_head_balance.create');

    Route::post('/initial-income-expense-head-balance/store', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@store',
        'as' => 'initial_income_expense_head_balance.store'
    ])->middleware('initial_income_expense_head_balance.create');


    Route::get('/initial-ledger-balance/edit/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@edit',
        'as' => 'initial_income_expense_head_balance.edit'
    ])->middleware('initial_income_expense_head_balance.edit');

    Route::post('/initial-ledger-balance/update/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@update',
        'as' => 'initial_income_expense_head_balance.update'
    ])->middleware('initial_income_expense_head_balance.edit');


    Route::get('/initial-ledger-balance/destroy/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@destroy',
        'as' => 'initial_income_expense_head_balance.destroy'
    ])->middleware('initial_income_expense_head_balance.delete');

    Route::get('/initial-ledger-balance/pdf/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@pdf',
        'as' => 'initial_income_expense_head_balance.pdf'
    ])->middleware('initial_income_expense_head_balance.pdf');


    Route::get('/initial-ledger-balance/trashed', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashed',
        'as' => 'initial_income_expense_head_balance.trashed'
    ])->middleware('initial_income_expense_head_balance.trash_show');


    Route::get('/initial-income-expense-head-balance/restore/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@restore',
        'as' => 'initial_income_expense_head_balance.restore'
    ])->middleware('initial_income_expense_head_balance.restore');


    Route::get('/initial-income-expense-head-balance/kill/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@kill',
        'as' => 'initial_income_expense_head_balance.kill'
    ])->middleware('initial_income_expense_head_balance.permanently_delete');

    Route::get('/initial-income-expense-head-balance/active/search', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@activeSearch',
        'as' => 'initial_income_expense_head_balance.active.search'
    ]);

    Route::get('/initial-income-expense-head-balance/trashed/search', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashedSearch',
        'as' => 'initial_income_expense_head_balance.trashed.search'
    ]);

    Route::get('/initial-income-expense-head-balance/active/action', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@activeAction',
        'as' => 'initial_income_expense_head_balance.active.action'
    ])->middleware('initial_income_expense_head_balance.delete');

    Route::get('/initial-income-expense-head-balance/trashed/action', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashedAction',
        'as' => 'initial_income_expense_head_balance.trashed.action'
    ]);

    // initial_income_expense_head_balance End


    //    initial_bank_cash_balance Start
    Route::get('/initial-bank-cash-balance', [
        'uses' => 'InitialBankCashBalanceController@index',
        'as' => 'initial_bank_cash_balance'
    ])->middleware('initial_bank_cash_balance.all');

    Route::get('/initial-bank-cash-balance/show/{id}', [
        'uses' => 'InitialBankCashBalanceController@show',
        'as' => 'initial_bank_cash_balance.show'
    ])->middleware('initial_bank_cash_balance.show');

    Route::get('/initial-bank-cash-balance/create', [
        'uses' => 'InitialBankCashBalanceController@create',
        'as' => 'initial_bank_cash_balance.create'
    ])->middleware('initial_bank_cash_balance.create');

    Route::post('/initial-bank-cash-balance/store', [
        'uses' => 'InitialBankCashBalanceController@store',
        'as' => 'initial_bank_cash_balance.store'
    ])->middleware('initial_bank_cash_balance.create');


    Route::get('/initial-bank-cash-balance/edit/{id}', [
        'uses' => 'InitialBankCashBalanceController@edit',
        'as' => 'initial_bank_cash_balance.edit'
    ])->middleware('initial_bank_cash_balance.edit');

    Route::post('/initial-bank-cash-balance/update/{id}', [
        'uses' => 'InitialBankCashBalanceController@update',
        'as' => 'initial_bank_cash_balance.update'
    ])->middleware('initial_bank_cash_balance.edit');


    Route::get('/initial-bank-cash-balance/destroy/{id}', [
        'uses' => 'InitialBankCashBalanceController@destroy',
        'as' => 'initial_bank_cash_balance.destroy'
    ])->middleware('initial_bank_cash_balance.delete');

    Route::get('/initial-bank-cash-balance/pdf/{id}', [
        'uses' => 'InitialBankCashBalanceController@pdf',
        'as' => 'initial_bank_cash_balance.pdf'
    ])->middleware('initial_bank_cash_balance.pdf');


    Route::get('/initial-bank-cash-balance/trashed', [
        'uses' => 'InitialBankCashBalanceController@trashed',
        'as' => 'initial_bank_cash_balance.trashed'
    ])->middleware('initial_bank_cash_balance.trash_show');


    Route::get('/initial-bank-cash-balance/restore/{id}', [
        'uses' => 'InitialBankCashBalanceController@restore',
        'as' => 'initial_bank_cash_balance.restore'
    ])->middleware('initial_bank_cash_balance.restore');


    Route::get('/initial-bank-cash-balance/kill/{id}', [
        'uses' => 'InitialBankCashBalanceController@kill',
        'as' => 'initial_bank_cash_balance.kill'
    ])->middleware('initial_bank_cash_balance.permanently_delete');

    Route::get('/initial-bank-cash-balance/active/search', [
        'uses' => 'InitialBankCashBalanceController@activeSearch',
        'as' => 'initial_bank_cash_balance.active.search'
    ]);

    Route::get('/initial-bank-cash-balance/trashed/search', [
        'uses' => 'InitialBankCashBalanceController@trashedSearch',
        'as' => 'initial_bank_cash_balance.trashed.search'
    ]);

    Route::get('/initial-bank-cash-balance/active/action', [
        'uses' => 'InitialBankCashBalanceController@activeAction',
        'as' => 'initial_bank_cash_balance.active.action'
    ])->middleware('initial_bank_cash_balance.delete');

    Route::get('/initial-bank-cash-balance/trashed/action', [
        'uses' => 'InitialBankCashBalanceController@trashedAction',
        'as' => 'initial_bank_cash_balance.trashed.action'
    ]);

    // initial_bank_cash_balance End


    //  DrVoucher Start
    Route::get('/dr-voucher', [
        'uses' => 'DrVoucherController@index',
        'as' => 'dr_voucher'
    ])->middleware('dr_voucher.all');

    Route::get('/dr-voucher/show/{id}', [
        'uses' => 'DrVoucherController@show',
        'as' => 'dr_voucher.show'
    ])->middleware('dr_voucher.show');

    Route::get('/dr-voucher/create', [
        'uses' => 'DrVoucherController@create',
        'as' => 'dr_voucher.create'
    ])->middleware('dr_voucher.create');

    Route::post('/dr-voucher/store', [
        'uses' => 'DrVoucherController@store',
        'as' => 'dr_voucher.store'
    ])->middleware('dr_voucher.create');


    Route::get('/dr-voucher/edit/{id}', [
        'uses' => 'DrVoucherController@edit',
        'as' => 'dr_voucher.edit'
    ])->middleware('dr_voucher.edit');

    Route::post('/dr-voucher/update/{id}', [
        'uses' => 'DrVoucherController@update',
        'as' => 'dr_voucher.update'
    ])->middleware('dr_voucher.edit');


    Route::get('/dr-voucher/destroy/{id}', [
        'uses' => 'DrVoucherController@destroy',
        'as' => 'dr_voucher.destroy'
    ])->middleware('dr_voucher.delete');

    Route::get('/dr-voucher/pdf/{id}', [
        'uses' => 'DrVoucherController@pdf',
        'as' => 'dr_voucher.pdf'
    ])->middleware('dr_voucher.pdf');


    Route::get('/dr-voucher/trashed', [
        'uses' => 'DrVoucherController@trashed',
        'as' => 'dr_voucher.trashed'
    ])->middleware('dr_voucher.trash_show');


    Route::get('/dr-voucher/restore/{id}', [
        'uses' => 'DrVoucherController@restore',
        'as' => 'dr_voucher.restore'
    ])->middleware('dr_voucher.restore');


    Route::get('/dr-voucher/kill/{id}', [
        'uses' => 'DrVoucherController@kill',
        'as' => 'dr_voucher.kill'
    ])->middleware('dr_voucher.permanently_delete');

    Route::get('/dr-voucher/active/search', [
        'uses' => 'DrVoucherController@activeSearch',
        'as' => 'dr_voucher.active.search'
    ]);

    Route::get('/dr-voucher/trashed/search', [
        'uses' => 'DrVoucherController@trashedSearch',
        'as' => 'dr_voucher.trashed.search'
    ]);

    Route::get('/dr-voucher/active/action', [
        'uses' => 'DrVoucherController@activeAction',
        'as' => 'dr_voucher.active.action'
    ])->middleware('dr_voucher.delete');

    Route::get('/dr-voucher/trashed/action', [
        'uses' => 'DrVoucherController@trashedAction',
        'as' => 'dr_voucher.trashed.action'
    ]);

    // DrVoucher End


    //  cr_voucher Start
    Route::get('/cr-voucher', [
        'uses' => 'CrVoucherController@index',
        'as' => 'cr_voucher'
    ])->middleware('cr_voucher.all');

    Route::get('/cr-voucher/show/{id}', [
        'uses' => 'CrVoucherController@show',
        'as' => 'cr_voucher.show'
    ])->middleware('cr_voucher.show');

    Route::get('/cr-voucher/create', [
        'uses' => 'CrVoucherController@create',
        'as' => 'cr_voucher.create'
    ])->middleware('cr_voucher.create');

    Route::post('/cr-voucher/store', [
        'uses' => 'CrVoucherController@store',
        'as' => 'cr_voucher.store'
    ])->middleware('cr_voucher.create');


    Route::get('/cr-voucher/edit/{id}', [
        'uses' => 'CrVoucherController@edit',
        'as' => 'cr_voucher.edit'
    ])->middleware('cr_voucher.edit');

    Route::post('/cr-voucher/update/{id}', [
        'uses' => 'CrVoucherController@update',
        'as' => 'cr_voucher.update'
    ])->middleware('cr_voucher.edit');


    Route::get('/cr-voucher/destroy/{id}', [
        'uses' => 'CrVoucherController@destroy',
        'as' => 'cr_voucher.destroy'
    ])->middleware('cr_voucher.delete');

    Route::get('/cr-voucher/pdf/{id}', [
        'uses' => 'CrVoucherController@pdf',
        'as' => 'cr_voucher.pdf'
    ])->middleware('cr_voucher.pdf');


    Route::get('/cr-voucher/trashed', [
        'uses' => 'CrVoucherController@trashed',
        'as' => 'cr_voucher.trashed'
    ])->middleware('cr_voucher.trash_show');


    Route::get('/cr-voucher/restore/{id}', [
        'uses' => 'CrVoucherController@restore',
        'as' => 'cr_voucher.restore'
    ])->middleware('cr_voucher.restore');


    Route::get('/cr-voucher/kill/{id}', [
        'uses' => 'CrVoucherController@kill',
        'as' => 'cr_voucher.kill'
    ])->middleware('cr_voucher.permanently_delete');

    Route::get('/cr-voucher/active/search', [
        'uses' => 'CrVoucherController@activeSearch',
        'as' => 'cr_voucher.active.search'
    ]);

    Route::get('/cr-voucher/trashed/search', [
        'uses' => 'CrVoucherController@trashedSearch',
        'as' => 'cr_voucher.trashed.search'
    ]);

    Route::get('/cr-voucher/active/action', [
        'uses' => 'CrVoucherController@activeAction',
        'as' => 'cr_voucher.active.action'
    ])->middleware('cr_voucher.delete');

    Route::get('/cr-voucher/trashed/action', [
        'uses' => 'CrVoucherController@trashedAction',
        'as' => 'cr_voucher.trashed.action'
    ]);

    // cr_voucher End


    //  jnl_voucher Start
    Route::get('/journal-voucher', [
        'uses' => 'JournalVoucherController@index',
        'as' => 'jnl_voucher'
    ])->middleware('jnl_voucher.all');

    Route::get('/journal-voucher/show/{id}', [
        'uses' => 'JournalVoucherController@show',
        'as' => 'jnl_voucher.show'
    ])->middleware('jnl_voucher.show');

    Route::get('/journal-voucher/create', [
        'uses' => 'JournalVoucherController@create',
        'as' => 'jnl_voucher.create'
    ])->middleware('jnl_voucher.create');

    Route::post('/journal-voucher/store', [
        'uses' => 'JournalVoucherController@store',
        'as' => 'jnl_voucher.store'
    ])->middleware('jnl_voucher.create');


    Route::get('/journal-voucher/edit/{id}', [
        'uses' => 'JournalVoucherController@edit',
        'as' => 'jnl_voucher.edit'
    ])->middleware('jnl_voucher.edit');

    Route::post('/journal-voucher/update/{id}', [
        'uses' => 'JournalVoucherController@update',
        'as' => 'jnl_voucher.update'
    ])->middleware('jnl_voucher.edit');


    Route::get('/journal-voucher/destroy/{id}', [
        'uses' => 'JournalVoucherController@destroy',
        'as' => 'jnl_voucher.destroy'
    ])->middleware('jnl_voucher.delete');

    Route::get('/journal-voucher/pdf/{id}', [
        'uses' => 'JournalVoucherController@pdf',
        'as' => 'jnl_voucher.pdf'
    ])->middleware('jnl_voucher.pdf');


    Route::get('/journal-voucher/trashed', [
        'uses' => 'JournalVoucherController@trashed',
        'as' => 'jnl_voucher.trashed'
    ])->middleware('jnl_voucher.trash_show');


    Route::get('/journal-voucher/restore/{id}', [
        'uses' => 'JournalVoucherController@restore',
        'as' => 'jnl_voucher.restore'
    ])->middleware('jnl_voucher.restore');


    Route::get('/journal-voucher/kill/{id}', [
        'uses' => 'JournalVoucherController@kill',
        'as' => 'jnl_voucher.kill'
    ])->middleware('jnl_voucher.permanently_delete');

    Route::get('/journal-voucher/active/search', [
        'uses' => 'JournalVoucherController@activeSearch',
        'as' => 'jnl_voucher.active.search'
    ]);

    Route::get('/journal-voucher/trashed/search', [
        'uses' => 'JournalVoucherController@trashedSearch',
        'as' => 'jnl_voucher.trashed.search'
    ]);

    Route::get('/journal-voucher/active/action', [
        'uses' => 'JournalVoucherController@activeAction',
        'as' => 'jnl_voucher.active.action'
    ])->middleware('jnl_voucher.delete');

    Route::get('/journal-voucher/trashed/action', [
        'uses' => 'JournalVoucherController@trashedAction',
        'as' => 'jnl_voucher.trashed.action'
    ]);

    // jnl_voucher End


    //  contra_voucher Start
    Route::get('/contra-voucher', [
        'uses' => 'ContraVoucherController@index',
        'as' => 'contra_voucher'
    ])->middleware('contra_voucher.all');

    Route::get('/contra-voucher/show/{id}', [
        'uses' => 'ContraVoucherController@show',
        'as' => 'contra_voucher.show'
    ])->middleware('contra_voucher.show');

    Route::get('/contra-voucher/create', [
        'uses' => 'ContraVoucherController@create',
        'as' => 'contra_voucher.create'
    ])->middleware('contra_voucher.create');

    Route::post('/contra-voucher/store', [
        'uses' => 'ContraVoucherController@store',
        'as' => 'contra_voucher.store'
    ])->middleware('contra_voucher.create');


    Route::get('/contra-voucher/edit/{id}', [
        'uses' => 'ContraVoucherController@edit',
        'as' => 'contra_voucher.edit'
    ])->middleware('contra_voucher.edit');

    Route::post('/contra-voucher/update/{id}', [
        'uses' => 'ContraVoucherController@update',
        'as' => 'contra_voucher.update'
    ])->middleware('contra_voucher.edit');


    Route::get('/contra-voucher/destroy/{id}', [
        'uses' => 'ContraVoucherController@destroy',
        'as' => 'contra_voucher.destroy'
    ])->middleware('contra_voucher.delete');

    Route::get('/contra-voucher/pdf/{id}', [
        'uses' => 'ContraVoucherController@pdf',
        'as' => 'contra_voucher.pdf'
    ])->middleware('contra_voucher.pdf');


    Route::get('/contra-voucher/trashed', [
        'uses' => 'ContraVoucherController@trashed',
        'as' => 'contra_voucher.trashed'
    ])->middleware('contra_voucher.trash_show');


    Route::get('/contra-voucher/restore/{id}', [
        'uses' => 'ContraVoucherController@restore',
        'as' => 'contra_voucher.restore'
    ])->middleware('contra_voucher.restore');


    Route::get('/contra-voucher/kill/{id}', [
        'uses' => 'ContraVoucherController@kill',
        'as' => 'contra_voucher.kill'
    ])->middleware('contra_voucher.permanently_delete');

    Route::get('/contra-voucher/active/search', [
        'uses' => 'ContraVoucherController@activeSearch',
        'as' => 'contra_voucher.active.search'
    ]);

    Route::get('/contra-voucher/trashed/search', [
        'uses' => 'ContraVoucherController@trashedSearch',
        'as' => 'contra_voucher.trashed.search'
    ]);

    Route::get('/contra-voucher/active/action', [
        'uses' => 'ContraVoucherController@activeAction',
        'as' => 'contra_voucher.active.action'
    ])->middleware('contra_voucher.delete');

    Route::get('/contra-voucher/trashed/action', [
        'uses' => 'ContraVoucherController@trashedAction',
        'as' => 'contra_voucher.trashed.action'
    ]);

    // contra_voucher End


    //    Accounts Report Start

    //    ledger

    Route::get('/reports/accounts/ledger', [
        'uses' => 'AccountsReportController@ledger_index',
        'as' => 'reports.accounts.ledger'
    ])->middleware('report.ledger.all');


    Route::post('/reports/accounts/ledger/branch-wise/report', [
        'uses' => 'AccountsReportController@ledger_branch_wise_report',
        'as' => 'reports_accounts_ledger.branch_wise.report'
    ])->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/income-expense-head-wise/report', [
        'uses' => 'AccountsReportController@ledger_income_expense_head_wise_report',
        'as' => 'reports_accounts_ledger.income_expense_head_wise.report'
    ])->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/bank-cash-wise/report', [
        'uses' => 'AccountsReportController@ledger_bank_cash_wise_report',
        'as' => 'reports_accounts_ledger.bank_cash_wise.report'
    ])->middleware('report.ledger.all');


    //    Trial Balance
    Route::get('/reports/accounts/trial-balance', [
        'uses' => 'Reports\Accounts\TrialBalanceController@index',
        'as' => 'reports.accounts.trial_balance'
    ])->middleware('report.TrialBalance.all');

    Route::post('/reports/accounts/trial-balance/report', [
        'uses' => 'Reports\Accounts\TrialBalanceController@branch_wise',
        'as' => 'reports.accounts.trial_balance.branch_wise.report'
    ])->middleware('report.TrialBalance.all');

    //    Cost Of Revenue Manage
    Route::get('/reports/accounts/cost-of-revenue', [
        'uses' => 'Reports\Accounts\CostOfRevenueController@index',
        'as' => 'reports.accounts.cost_of_revenue'
    ])->middleware('report.CostOfRevenue.all');

    Route::post('/reports/accounts/cost-of-revenue/report', [
        'uses' => 'Reports\Accounts\CostOfRevenueController@branch_wise',
        'as' => 'reports.accounts.cost_of_revenue.report'
    ])->middleware('report.CostOfRevenue.all');


    //    Profit & Loss Account
    Route::get('/reports/accounts/profit-or-loss-account', [
        'uses' => 'Reports\Accounts\ProfitAndLossAccountController@index',
        'as' => 'reports.accounts.profit_or_loss_account'
    ])->middleware('report.ProfitOrLossAccount.all');

    Route::post('/reports/accounts/profit-or-loss-account/report', [
        'uses' => 'Reports\Accounts\ProfitAndLossAccountController@branch_wise',
        'as' => 'reports.accounts.profit_or_loss_account.report'
    ])->middleware('report.ProfitOrLossAccount.all');

    //    Retained Earnings
    Route::get('/reports/accounts/retained-earnings', [
        'uses' => 'Reports\Accounts\RetainedEarningsController@index',
        'as' => 'reports.accounts.retained_earnings'
    ])->middleware('report.RetainedEarning.all');

    Route::post('/reports/accounts/retained-earnings/report', [
        'uses' => 'Reports\Accounts\RetainedEarningsController@branch_wise',
        'as' => 'reports.accounts.retained_earnings.report'
    ])->middleware('report.RetainedEarning.all');


    //    Fixed Asset Schedule
    Route::get('/reports/accounts/fixed-asset-schedule', [
        'uses' => 'Reports\Accounts\FixedAssetScheduleController@index',
        'as' => 'reports.accounts.fixed_asset_schedule'
    ])->middleware('report.FixedAssetsSchedule.all');

    Route::post('/reports/accounts/fixed-asset-schedule/report', [
        'uses' => 'Reports\Accounts\FixedAssetScheduleController@branch_wise',
        'as' => 'reports.accounts.fixed_asset_schedule.report'
    ])->middleware('report.FixedAssetsSchedule.all');


    //  Balance sheet
    Route::get('/reports/accounts/balance-sheet', [
        'uses' => 'Reports\Accounts\BalanceSheetController@index',
        'as' => 'reports.accounts.balance_sheet'
    ])->middleware('report.StatementOfFinancialPosition.all');

    Route::post('/reports/accounts/balance-sheet/report', [
        'uses' => 'Reports\Accounts\BalanceSheetController@branch_wise',
        'as' => 'reports.accounts.balance_sheet.report'
    ])->middleware('report.StatementOfFinancialPosition.all');


    //  Cash Flow
    Route::get('/reports/accounts/cash-flow', [
        'uses' => 'Reports\Accounts\CashFlowController@index',
        'as' => 'reports.accounts.cash_flow'
    ]);

    Route::post('/reports/accounts/cash-flow/report', [
        'uses' => 'Reports\Accounts\CashFlowController@branch_wise',
        'as' => 'reports.accounts.cash_flow.report'
    ]);


    //  Receive Payment
    Route::get('/reports/accounts/receive-payment', [
        'uses' => 'Reports\Accounts\ReceivePaymentController@index',
        'as' => 'reports.accounts.receive_payment'
    ])->middleware('report.ReceiveAndPayment.all');

    Route::post('/reports/accounts/receive-payment/report', [
        'uses' => 'Reports\Accounts\ReceivePaymentController@branch_wise',
        'as' => 'reports.accounts.receive_payment.report'
    ])->middleware('report.ReceiveAndPayment.all');


    //  Notes start
    Route::get('/reports/accounts/notes', [
        'uses' => 'Reports\Accounts\NotesController@index',
        'as' => 'reports.accounts.notes'
    ])->middleware('report.Notes.all');

    Route::post('/reports/accounts/notes/type_wise/report', [
        'uses' => 'Reports\Accounts\NotesController@type_wise',
        'as' => 'reports.accounts.notes.type_wise.report'
    ])->middleware('report.Notes.all');

    Route::post('/reports/accounts/notes/group_wise/report', [
        'uses' => 'Reports\Accounts\NotesController@group_wise',
        'as' => 'reports.accounts.notes.group_wise.report'
    ])->middleware('report.Notes.all');


    //    Notes End

    //    Accounts Report End


    //    General Report Start

    //    Branch Start

    Route::get('/reports/general/branch', [
        'uses' => 'Reports\General\GeneralReportController@branch',
        'as' => 'reports.general.branch'
    ])->middleware('report.general_report.branch.all');

    Route::post('/reports/general/branch/report', [
        'uses' => 'Reports\General\GeneralReportController@branch_report',
        'as' => 'reports.general.branch.report'
    ]);


    //    Branch End


    //    Ledger Start

    Route::get('/reports/general/ledger', [
        'uses' => 'Reports\General\GeneralReportController@ledger_type',
        'as' => 'reports.general.ledger.type'
    ])->middleware('report.general_report.ledger.all');

    Route::post('/reports/general/ledger/type/report', [
        'uses' => 'Reports\General\GeneralReportController@ledger_type_report',
        'as' => 'reports.general.ledger.type.report'
    ]);


    Route::post('/reports/general/ledger/group/report', [
        'uses' => 'Reports\General\GeneralReportController@ledger_group_report',
        'as' => 'reports.general.ledger.group.report'
    ]);

    Route::post('/reports/general/ledger/name/report', [
        'uses' => 'Reports\General\GeneralReportController@ledger_name_report',
        'as' => 'reports.general.ledger.name.report'
    ]);


    //    Ledger End

    //    Bank Cash Start
    Route::get('/reports/general/bank-cash', [
        'uses' => 'Reports\General\GeneralReportController@bank_cash',
        'as' => 'reports.general.bank_cash'
    ])->middleware('report.general_report.BankCash.all');

    Route::post('/reports/general/ledger/bank-cash/report', [
        'uses' => 'Reports\General\GeneralReportController@bank_cash_report',
        'as' => 'reports.general.bank_cash.report'
    ]);
    //    Bank Cash End


    //    Voucher start
    Route::get('/reports/general/voucher', [
        'uses' => 'Reports\General\GeneralReportController@voucher',
        'as' => 'reports.general.voucher'
    ])->middleware('report.general_report.Voucher.all');


    Route::post('/reports/general/voucher/report', [
        'uses' => 'Reports\General\GeneralReportController@voucher_report',
        'as' => 'reports.general.voucher.report'
    ]);
    //    Voucher start

    //    General Report End


});
