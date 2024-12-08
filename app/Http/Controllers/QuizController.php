<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
// Ajoutez ceci au début de votre fichier QuizController.php
use App\Models\Question;



class QuizController extends Controller
{
    public function publicIndex()
    {
        return view('index', ['authenticated' => false]);
    }
    
    public function authenticatedIndex()
    {
        return view('index', ['authenticated' => true]);
    }

    public function index()
    {
        $quizzes = Quiz::all(); // Tous les quiz publics
        return view('quizzes.index', compact('quizzes'));
    }



    public function myQuizzes()
    {
        $quizzes = auth()->user()->quizzes; // Utilise la relation avec l'utilisateur
        return view('quizzes.my', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }
    

    public function show($id)
    {
        // Récupère le quiz avec ses questions et réponses associées
        $quiz = Quiz::with('questions.answers')->findOrFail($id);

        // Retourne la vue avec les données du quiz
        return view('quizzes.show', compact('quiz'));
    }


    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array',
            'questions.*.title' => 'required|string',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*.content' => 'required|string',
        ]);
    
        // Créez le quiz en associant l'utilisateur connecté
        $quiz = Quiz::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => auth()->user()->id, // Ajouter l'ID de l'utilisateur connecté
        ]);
    
        // Enregistrer les questions et les réponses
        foreach ($request->input('questions') as $questionData) {
            // Vérifier si la question autorise plusieurs réponses correctes
            $allowMultipleAnswers = isset($questionData['allow_multiple_answers']) ? true : false;
    
            // Créer la question
            $question = Question::create([
                'title' => $questionData['title'],
                'quiz_id' => $quiz->id,
                'allow_multiple_answers' => $allowMultipleAnswers, // Enregistrer la possibilité de réponses multiples
            ]);
    
            // Enregistrer les réponses de la question
            foreach ($questionData['answers'] as $answerData) {
                $question->answers()->create([
                    'content' => $answerData['content'],
                    'is_correct' => isset($answerData['is_correct']) ? true : false,
                ]);
            }
        }
    
        return redirect()->route('quizzes.show', $quiz->id);
    }
    
    

    public function submit(Request $request, $id)
    {
    $quiz = Quiz::with('questions.answers')->findOrFail($id);
    $correctAnswers = 0;
    $totalQuestions = $quiz->questions->count();

    foreach ($quiz->questions as $question) {
        $selectedAnswerIds = $request->input('question.' . $question->id); // Tableau pour les checkbox

        // Vérifier si plusieurs réponses sont sélectionnées
        $correctAnswersForQuestion = $question->answers()->where('is_correct', 1)->pluck('id')->toArray();

        // Si la question permet plusieurs bonnes réponses
        if (is_array($selectedAnswerIds)) {
            $correctAnswers += count(array_intersect($selectedAnswerIds, $correctAnswersForQuestion));
        } else {
            // Si une seule réponse est sélectionnée, vérifier si elle est correcte
            $selectedAnswer = $question->answers()->find($selectedAnswerIds);
            if ($selectedAnswer && $selectedAnswer->is_correct) {
                $correctAnswers++;
            }
        }
    }

    // Calculer le score
    $score = ($correctAnswers / $totalQuestions) * 100;

    return view('quizzes.show', [
        'quiz' => $quiz,
        'correctAnswers' => $correctAnswers,
        'incorrectAnswers' => $totalQuestions - $correctAnswers,
        'score' => $score
    ]);
    }


  
}
