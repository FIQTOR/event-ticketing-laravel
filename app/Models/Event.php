<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'address',
        'organizer',
        'price',
        'event_date',
        'layouts',
        'thumbnail',
        'isTopPopular'
    ];
}
