@extends('layouts/main-layout') 

@section('content')
    @if (auth()->user()->role === 'Researcher' || auth()->user()->role === 'Super Researcher')
        @include('pages.projects.show-researcher')
    @else
  
         @include('pages.projects.show-student')
    @endif
@endsection
