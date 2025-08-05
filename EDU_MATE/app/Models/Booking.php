<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'tutor_id',
        'booked_time_start',
        'booked_time_end',
    ];

    /**
     * Get the tutor that owns the booking.
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(CustomUser::class, 'tutor_id');
    }
}
