<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionsController extends Controller
{
 // Met à jour une question
 public function update(Request $request, Question $question)
 {
     // Vérifie si l'utilisateur peut mettre à jour la question (via la Policy)
     $this->authorize('update', $question);

     // Met à jour les champs autorisés
     $question->update($request->only('title'));

     return response()->json(['message' => 'Question mise à jour avec succès.']);
 }

 // Supprime une question
 public function destroy(Question $question)
 {
     // Vérifie si l'utilisateur peut supprimer la question (via la Policy)
     $this->authorize('delete', $question);

     // Supprime la question
     $question->delete();

     return response()->json(['message' => 'Question supprimée avec succès.']);
 }

    // Liste toutes les questions
    public function index()
    {
        $questions = Question::with('answers')->get();
        return response()->json($questions);
    }

    // Crée une nouvelle question
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $question = Question::create([
            'title' => $validated['title'],
            'user_id' => auth()->id(), // Associe la question à l'utilisateur authentifié
        ]);

        return response()->json($question, 201);
    }

}
