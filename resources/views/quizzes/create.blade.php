<style>
    /* Style général pour la page */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #2c3e50;
    margin-top: 40px;
}

h2 {
    font-size: 1.5rem;
    color: #34495e;
    margin-top: 20px;
}

h3 {
    font-size: 1.2rem;
    margin-top: 20px;
    color: #34495e;
}

h4 {
    font-size: 1rem;
    color: #7f8c8d;
    margin-top: 10px;
}

/* Mise en page du formulaire */
form {
    max-width: 800px;
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
    color: #34495e;
    display: block;
    margin-bottom: 5px;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group input:focus, .form-group textarea:focus {
    border-color: #3498db;
    outline: none;
}

.form-group textarea {
    resize: vertical;
    height: 120px;
}

/* Style des sections de questions */
.question-block {
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 6px;
    margin-bottom: 20px;
}

.question-block h3 {
    font-size: 1.1rem;
    margin-top: 0;
}

.question-block .form-group {
    margin-bottom: 15px;
}

.question-block .form-group label {
    font-size: 0.9rem;
}

/* Style des cases à cocher (réponse correcte) */
.question-block .form-group input[type="checkbox"] {
    margin-right: 10px;
}

/* Bouton de soumission */
button[type="submit"] {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 12px 24px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 4px;
    margin-top: 20px;
    width: 100%;
}

button[type="submit"]:hover {
    background-color: #2980b9;
}

/* Erreur de validation */
input:invalid, textarea:invalid {
    border-color: red;
}

input:valid, textarea:valid {
    border-color: green;
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
    <h1>Create a Quiz</h1>
    <form method="POST" action="{{ route('quizzes.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Quiz Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Quiz Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <h2>Questions</h2>
        @for ($i = 0; $i < 10; $i++)
            <div class="question-block">
                <h3>Question {{ $i + 1 }}</h3>
                <div class="form-group">
                    <label for="questions[{{ $i }}][title]">Question Title</label>
                    <input type="text" name="questions[{{ $i }}][title]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="questions[{{ $i }}][allow_multiple_answers]">Allow Multiple Answers</label>
                    <input type="checkbox" name="questions[{{ $i }}][allow_multiple_answers]" value="1">
                    <small>(Check if this question allows multiple correct answers)</small>
                </div>

                <h4>Answers</h4>
                @for ($j = 0; $j < 4; $j++)
                    <div class="form-group">
                        <label for="questions[{{ $i }}][answers][{{ $j }}][content]">Answer {{ $j + 1 }}</label>
                        <input type="text" name="questions[{{ $i }}][answers][{{ $j }}][content]" class="form-control" required>
                        <label>
                            <input type="checkbox" name="questions[{{ $i }}][answers][{{ $j }}][is_correct]" value="1">
                            Correct Answer
                        </label>
                    </div>
                @endfor
            </div>
        @endfor

        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
@endsection


</body>
</html>