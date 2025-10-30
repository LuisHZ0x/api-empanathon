<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'event_id';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'event_name',
        'start_date',
        'secret_theme',
        'event_status',
    ];

    // Campos que deben ser tratados como fechas
    protected $dates = ['start_date', 'updated_at'];

    // Opcional: Serialización personalizada (si lo necesitas)
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
