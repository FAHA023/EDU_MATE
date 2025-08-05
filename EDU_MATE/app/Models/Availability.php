<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'time_slot'];

    public function user()
    {
        return $this->belongsTo(CustomUser::class);
    }



}
