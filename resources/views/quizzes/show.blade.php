<style>
    /* Global styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fc;
    color: #333;
    margin: 0;
    padding: 0;
}

h1 {
    font-size: 2.5em;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 20px;
}

p {
    font-size: 1.1em;
    text-align: center;
    margin-bottom: 40px;
}

/* Form styling */
form {
    width: 80%;
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.question {
    margin-bottom: 20px;
    padding: 15px;
    background-color: #ecf0f1;
    border-radius: 6px;
}

.question h3 {
    font-size: 1.5em;
    color: #34495e;
    margin-bottom: 10px;
}

.answer {
    margin-bottom: 15px;
    padding: 10px;
    background-color: #ffffff;
    border-radius: 6px;
    border: 1px solid #ddd;
}

.answer input[type="radio"] {
    margin-right: 10px;
    accent-color: #3498db; /* Custom color for radio buttons */
}

.answer label {
    font-size: 1.1em;
    color: #555;
}

.answer:hover {
    background-color: #f8f9fa;
}

/* Button styling */
.btn {
    background-color: #3498db;
    color: white;
    padding: 12px 20px;
    font-size: 1.1em;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #2980b9;
}

.btn:focus {
    outline: none;
}

.results {
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
    border: 1px solid #ddd;
}

.results h2 {
    color: #2c3e50;
}

.results p {
    font-size: 1.1rem;
    color: #34495e;
}

.results strong {
    color: #3498db;
}


</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->title }}</title>
</head>
<body>
@extends('layouts.app')

@section('content')
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>

    @if(isset($correctAnswers))
        <div class="results">
            <h2>Quiz Results</h2>
            <p><strong>Correct Answers: </strong>{{ $correctAnswers }} / {{ $quiz->questions->count() }}</p>
            <p><strong>Incorrect Answers: </strong>{{ $incorrectAnswers }} / {{ $quiz->questions->count() }}</p>
            <p><strong>Your Score: </strong>{{ number_format($score, 2) }}%</p>
        </div>
    @else
        <form method="POST" action="/quizzes/{{ $quiz->id }}/submit">
            @csrf
            @foreach ($quiz->questions as $question)
    <div class="question">
        <h3>{{ $question->title }}</h3>

        @php
            // Vérifiez si la question permet plusieurs réponses
            $isMultipleChoice = $question->allow_multiple_answers;
        @endphp

        @foreach ($question->answers as $answer)
            <div class="answer">
                @if ($isMultipleChoice)
                    <!-- Utilisez des cases à cocher pour les réponses multiples -->
                    <input type="checkbox" name="question[{{ $question->id }}][]" value="{{ $answer->id }}" id="answer_{{ $answer->id }}">
                    <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
                @else
                    <!-- Utilisez des boutons radio pour une seule réponse -->
                    <input type="radio" name="question[{{ $question->id }}]" value="{{ $answer->id }}" id="answer_{{ $answer->id }}">
                    <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
                @endif
            </div>
        @endforeach
    </div>
@endforeach

            <button type="submit" class="btn btn-primary">Submit Answers</button>
        </form>
    @endif
@endsection

</body>
</html>
