<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app') <!-- Héritage de la mise en page principale -->


@section('content')
    <h1>Welcome to QuizApp!</h1>
    <p>
        @if($authenticated ?? false)
            You are logged in. Explore your quizzes or create a new one.
        @else
            Please login or register to create and manage your quizzes.
        @endif
    </p>
<!-- Définition de la section 'content' -->
    <h1>Liste des Quiz</h1>
    <ul>
        @foreach ($quizzes as $quiz)
            <li>{{ $quiz->title }} - <a href="/quizzes/{{ $quiz->id }}">Voir</a></li>
        @endforeach
    </ul>
@endsection

</body>
</html>