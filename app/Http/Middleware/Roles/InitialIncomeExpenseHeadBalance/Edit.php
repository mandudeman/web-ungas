<?php

namespace App\Http\Middleware\Roles\InitialIncomeExpenseHeadBalance;

use App\Http\Controllers\RoleManageController;
use Closure;
use Illuminate\Support\Facades\Session;

class Edit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('role_manage.InitialIncomeExpenseHeadBalance.Edit')) { //Edit
            return $next($request);
        } else {
            Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');

            return redirect()->back();
        }
    }
}
