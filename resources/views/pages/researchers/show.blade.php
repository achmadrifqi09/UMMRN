@extends('layouts/main-layout')

@section('content')
    <div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-16">

        <div class="h-36 w-screen bg-gray-100">
            <div class="relative top-20 flex px-20 max-md:px-6 max-md:top-24">
                <img 
                 @if ($researcher?->image)
                    src="{{ asset('storage/'.$researcher->image) }}"
                @else
                     src="{{ asset('images/avatar.svg') }}"
                @endif
                alt="researcher image" class="w-36 h-36 object-cover object-top rounded-full max-md:w-32 max-md:h-32 border-8 border-white">
                <div class="flex flex-col items-center justify-center mt-10 ml-4">
                    <div class="pt-1">
                        <h2 class="text-xl font-medium">{{ $researcher?->name }}</h2>
                        <p class="text-gray-500 text-sm">{{ $researcher?->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-36 w-full">
            <hr class="w-full mb-10">
            <h2 class="text-2xl font-medium mt-10">Education</h2>
            <p class="mt-5">
                @if ($cvOfResearcher?->education)
                    {!! $cvOfResearcher->education !!}</p>
                @else
                    Maybe the researcher hasn't filled in yet
                @endif
        </div>
        <div class="mt-10 w-full">
            <hr class="w-full mb-10">
            <h2 class="text-2xl font-medium mt-10">Teaching Experinces</h2>
            <p class="mt-5">
                @if ($cvOfResearcher?->teaching)
                    {!! $cvOfResearcher->teaching !!}</p>
                @else
                    Maybe the researcher hasn't filled in yet
                @endif
        </div>
        <div class="mt-10 w-full">
            <hr class="w-full mb-10">
            <h2 class="text-2xl font-medium mt-10">Organizational Experiences</h2>
            <p class="mt-5">
                @if (!$cvOfResearcher?->organizational)
                    Maybe the researcher hasn't filled in yet
                @else
                    {!! $cvOfResearcher->organizational !!}
                @endif
            </p>
        </div>
        <div class="mt-10 w-full">
            <hr class="w-full mb-10">
            <h2 class="text-2xl font-medium mt-10">Awards</h2>
            <p class="mt-5">
                @if (!$cvOfResearcher?->awards)
                    Maybe the researcher hasn't filled in yet
                @else
                    {!! $cvOfResearcher->awards !!}
                @endif
            </p>
        </div>
        <div class="mt-10 w-full">
            <hr class="w-full mb-10">
            <h2 class="text-2xl font-medium mt-10">Topic</h2>
            <p class="mt-5">
                @if (!$cvOfResearcher?->topic)
                    Maybe the researcher hasn't filled in yet
                @else
                    {!! $cvOfResearcher->topic !!}
                @endif
            </p>
        </div>
        <div class="mt-10 w-full">
            <hr class="w-full mb-10">
            <h2 class="text-2xl font-medium mt-10">Publications</h2>
            <p class="mt-5">
                @if (!$cvOfResearcher?->publications)
                    Maybe the researcher hasn't filled in yet
                @else
                    {!! $cvOfResearcher->publications !!}
                @endif
            </p>
        </div>
    </div>  
@endsection