<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    //
    use HasFactory;

    protected $table = 'seminars';
    protected $fillable = [
                            'name', 
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
}
