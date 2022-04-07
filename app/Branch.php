<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class Branch extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'location',
        'description',

        'create_by',
        'update_by',
        'delete_by'
    ];

    public function Transaction()
    {
        return $this->hasMany('App\Transaction','branch_id');
    }


}
