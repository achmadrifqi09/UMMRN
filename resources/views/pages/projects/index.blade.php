@extends('layouts/main-layout') 
@section('content')
    @if (auth()->user()->role === 'Researcher' || auth()->user()->role === 'Super Researcher')
        @include('pages.projects.index-researcher')
    @else
         @include('pages.projects.index-student')
    @endif
@endsection
