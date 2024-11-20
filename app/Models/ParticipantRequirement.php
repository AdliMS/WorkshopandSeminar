<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParticipantRequirement extends Model
{
    use HasFactory;
    //
    protected $table = 'participant_requirements';
    protected $fillable = ['name'];

    public function seminar(): BelongsTo 
    {
        return $this->belongsTo(Seminar::class);
    }
    
    public function workshop(): BelongsTo 
    {
        return $this->belongsTo(Workshop::class);
    }
    
}
