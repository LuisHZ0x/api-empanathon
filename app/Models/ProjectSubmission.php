<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectSubmission extends Model
{
    protected $table = 'project_submissions';
    protected $primaryKey = 'submission_id';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'team_id',
        'project_name',
        'description',
        'github_link',
        'used_technologies',
        'project_type',
        'submission_date',
        'score',
        'submission_status',
        'judge_comments',
    ];

    // Campos que deben ser tratados como fechas
    protected $dates = ['submission_date'];

    // Relación: Una entrega de proyecto pertenece a un equipo
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }

    // Opcional: Serialización personalizada
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}