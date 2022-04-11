<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class BankCash extends Model
{
    use HasFactory;

    use Notifiable;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'account_number',
        'description',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function Transactions()
    {
        return $this->hasMany(\App\Transaction::class, 'bank_cash_id');
    }
}
