<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    //
    protected $table = 'workshops';
    protected $fillable = [
    'name', 
    'description', 
    'max_participants',
    'current_participants',
    'held_date',
    'venue',
    'ticket_price',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(EventStatus::class);
    }
}