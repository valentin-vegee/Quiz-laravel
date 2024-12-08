<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswersController extends Controller
{
     // Ajoute une réponse à une question
     public function store(Request $request, Question $question)
     {
         $validated = $request->validate([
             'content' => 'required|string',
             'is_correct' => 'required|boolean',
         ]);
 
         $answer = $question->answers()->create($validated);
 
         return response()->json($answer, 201);
     }
 
     // Met à jour une réponse
     public function update(Request $request, Answer $answer)
     {
         $validated = $request->validate([
             'content' => 'string',
             'is_correct' => 'boolean',
         ]);
 
         $answer->update($validated);
 
         return response()->json($answer);
     }
 
     // Supprime une réponse
     public function destroy(Answer $answer)
     {
         $answer->delete();
 
         return response()->json(['message' => 'Réponse supprimée avec succès.']);
     }
}
