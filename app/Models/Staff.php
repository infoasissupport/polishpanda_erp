<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $guarded = [];

    protected $casts = [
        'jobs_today' => 'integer',
        'commission' => 'integer',
        'performance' => 'decimal:2',
        'is_active' => 'boolean',
        'joined_at' => 'date',
        // plain "YYYY-MM-DD" in JSON so the browser can't shift the day across timezones
        'date_of_birth' => 'date:Y-m-d',
    ];
}
