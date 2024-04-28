<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    //
    protected $table = 'reader';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'r_department_id',
        'r_class_id',
        'r_code_card',
        'r_name',
        'r_gender',
        'r_birthday',
        'r_address',
        'r_avatar',
        'r_phone',
        'r_number_violations',
        'r_card_created_date',
        'r_card_expiry_date',
        'r_status',
        'r_card_status',
        'created_at',
        'updated_at',
        'method'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'r_department_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(Classs::class, 'r_class_id', 'id');
    }
}
