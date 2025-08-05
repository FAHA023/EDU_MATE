<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends Model
{
    use HasFactory;

    protected $fillable = ['role', 'name', 'email', 'subject', 'class', 'bio', 'password'];

    public function availability()
    {
        return $this->hasOne(\App\Models\Availability::class, 'tutor_id');
    }
}