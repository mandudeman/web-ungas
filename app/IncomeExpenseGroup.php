<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class IncomeExpenseGroup extends Model
{
    use HasFactory;

    use Notifiable;
    use SoftDeletes;

    protected $fillable = [

        'name',
        'code',

        'created_by',
        'updated_by',
        'deleted_by',

    ];


    public function IncomeExpenseHeads()
    {
        return $this->hasMany(\App\IncomeExpenseHead::class, 'income_expense_group_id');
    }
}
