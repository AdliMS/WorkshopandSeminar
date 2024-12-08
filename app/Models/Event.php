<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = [
                            'name', 
                            'type',
                            'slug', 
                            'description', 
                            'max_participants',
                            'current_participants',
                            'open_until',
                            'start_time',
                            'end_time',
                            'venue',
                            'online_platform',
                            'online_link',
                            'ticket_price',
                            'category_id',
                            'status_id',
                        ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class);
    }
    
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
    
    public function participant_requirements(): HasMany
    {
        return $this->hasMany(ParticipantRequirement::class);
    }

    // public function status(): BelongsTo
    // {
    //     return $this->belongsTo(EventStatus::class);
    // }
}
