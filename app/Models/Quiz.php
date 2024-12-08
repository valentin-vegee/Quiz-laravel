<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // Définir la table associée au modèle (si elle est différente du nom du modèle en minuscules)
    protected $table = 'quizzes';

    // Définir les colonnes qui peuvent être massivement assignées (pour éviter des failles de sécurité)
    protected $fillable = [
        'title',
        'description',
        'user_id', // L'ID de l'utilisateur qui a créé le quiz
    ];

    /**
     * Relation avec l'utilisateur (un quiz appartient à un utilisateur)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les questions (un quiz peut avoir plusieurs questions)
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
