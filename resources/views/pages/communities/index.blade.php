@extends('layouts/main-layout') 
@section('content')
    @if (auth()->user()->role === 'Researcher' || auth()->user()->role === 'Super Researcher')
        @include('pages.communities.index-researcher')
    @else
         @include('pages.communities.index-student')
    @endif
@endsection
