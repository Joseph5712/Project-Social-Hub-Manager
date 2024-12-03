<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'day_of_week', 'time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
