<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'tour_id',
        'guests',
        'total_price',
        'status'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
