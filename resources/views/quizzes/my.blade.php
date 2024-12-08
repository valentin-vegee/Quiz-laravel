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
    <h1>Mes Quiz</h1>
    <ul>
        @foreach ($quizzes as $quiz)
            <li>{{ $quiz->title }} - <a href="/quizzes/{{ $quiz->id }}">Voir</a></li>
        @endforeach
    </ul>
@endsection
</body>
</html>