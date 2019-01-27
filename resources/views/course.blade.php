@extends('layouts.home')

@section('main')

  <h2>{{ $course->title }}</h2>

  <p>{{ $course->description }}</p>

  @foreach ($course->publishedLessons as $lesson)
    {{ $loop->iteration }}. <a href="#">{{ $lesson->title }}</a>
    <p>{{ $lesson->short_text }}</p>
    <hr />
  @endforeach

@endsection
