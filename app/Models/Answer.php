<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    protected $fillable = [
        'content',       // Contenu de la réponse
        'is_correct',    // Indique si la réponse est correcte
        'question_id',   // ID de la question associée
    ];

}
