<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    //
    protected $table = 'workshops';
    protected $fillable = [
    'name', 
    'slug', 
    'description', 
    'max_participants',
    'open_until',
    'start_time',
    'end_time',
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

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function participant_requirements(): HasMany
    {
        return $this->hasMany(ParticipantRequirement::class);
    }
}
