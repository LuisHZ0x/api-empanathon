<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'team_id';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'team_name',
        'invitation_code',
        'experience_level',
        'motivation',
        'team_status',
    ];

    // Campos que deben ser tratados como fechas
    protected $dates = ['registration_date'];

    // Relación: Un equipo tiene muchos participantes
    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class, 'team_id', 'team_id');
    }

    // Relación: Un equipo tiene una sola entrega de proyecto
    public function projectSubmission(): HasOne
    {
        return $this->hasOne(ProjectSubmission::class, 'team_id', 'team_id');
    }

    // Opcional: Serialización personalizada
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}