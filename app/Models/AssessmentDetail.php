<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentDetail extends Model
{
    protected $guarded = ['id'];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}