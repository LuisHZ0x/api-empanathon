<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    protected $table = 'participants';
    protected $primaryKey = 'participant_id';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'major',
        'team_id',
        'is_leader',
    ];

    // Campos que deben ser tratados como fechas
    protected $dates = ['registration_date'];

    // Relación: Un participante pertenece a un equipo
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }

    // Opcional: Ocultar campos sensibles (ej. email) al serializar
    protected $hidden = ['email', 'phone'];

    // Opcional: Serialización personalizada
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}