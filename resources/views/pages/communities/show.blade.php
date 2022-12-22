@extends('layouts/main-layout') 
@section('stylesheet')
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
   <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
   <style>
        details summary::-webkit-details-marker {
            display:none;
        }
        trix-toolbar [data-trix-button-group="file-tools"]{
            display: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
   </style>
@endsection
@section('content')
    <div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-32">
        <div class="w-full">
            <h1 class="text-2xl font-semibold">Comunities Of Practice</h1> 
            <p class="text-gray-400 max-sl:block hidden">Knowledge Management</p>
            <hr class="my-6 border-gray-200 sm:mx-auto" />
            
            <div class="flex items-start max-sm:flex-col">
                <div class="w-3/12 max-sm:w-full max-sm:mb-8 flex flex-col justify-center items-center mr-6 max-sl:hidden">
                    <div class="p-1 border rounded-full border-gray-400 w-max mt-6 max-sm:mt-0">
                        <img 
                        @if ($community?->image)
                            src="{{ asset('storage/'.$community->image) }}"
                        @else
                            src="{{ asset('images/ic-comunities.svg') }}" 
                        @endif
                        alt="avatar" class="w-24 h-24 rounded-full object-cover object-center" />
                    </div>
                    <h1 class="text-md font-medium mt-4 text-center">{{ $community->name }}</h1>
                    <div class="w-full px-2">
                        <h3 class="mt-6 font-medium mb-4">Members :</h3>
                        @foreach ($members as $member) 
                            <p class="py-2 border-b">{{ $member->student->name }}</p>
                        @endforeach
                    </div>    
                </div>
                <div class="w-8/12 mx-auto max-lg:w-full border-l pl-6 max-sl:pl-0 max-sl:border-l-0 min-h-screen">
                    <div class="border p-4 rounded-xl shadow-sm">
                        <form action="/communities/send-topic/{{ $community->id }}" method="POST">
                            @csrf
                            @if (auth()->user()->role === 'Student')
                                <input id="id_student" type="hidden" name="id_student" value="{{ auth()->user()->id }}">
                            @endif
                            <input id="id_researcher" type="hidden" name="id_researcher" value="{{ $community->id_researcher }}">
                            <div class="mt-6">
                                <input id="message" type="hidden" name="message" value="{!! old('message') !!}" >
                                <trix-editor input="message"></trix-editor>
                            </div>
                            <button type="submit" class="py-2 px-3 space-x-3 flex justify-center items-center rounded-xl text-white bg-red-800 mt-2 ml-auto">
                                <span>Send</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    @foreach ($topics as $topic)
                        
                        <div class="my-4 p-4 border rounded-xl shadow-sm">
                            <div class="flex items-center"> 
                                <img 
                                @if ($topic?->id_student)
                                    @if ($topic?->student?->image)
                                        src="{{ asset('storage/'.$topic?->student->image) }}"
                                    @else
                                        src="{{ asset('images/avatar.svg') }}"
                                    @endif
                                @elseif($topic?->researcher?->image)
                                    src="{{ asset('storage/'.$topic?->researcher->image) }}"
                                @else
                                    src="{{ asset('images/avatar.svg') }}"
                                @endif alt="profile" class="h-12 w-12 rounded-full object-cover object-top">
                                <div class="ml-2">
                                    <h2 class="text-md">
                                        @if ($topic?->student?->name)
                                            {{ $topic?->student?->name }}
                                        @else
                                           {{ $topic?->researcher?->name}}
                                        @endif
                                    </h2>
                                    <p class="text-xs text-gray-400">{{ $topic->created_at }}</p>
                                </div>
                            </div>
                            <div class="w-full overflow-x-scroll scrollbar-hide">
                                <p class="text-base text-justify text-gray-800 mt-4">{!! $topic->message !!}</p>
                            </div>
                            <details>
                                <summary class="text-lime-700 mt-6 cursor-pointer flex justify-center border-t border-b p-2 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                    </svg>
                                    Comments
                                </summary>
                                @foreach ($comments as $comment)
                                    @if ($comment?->id_topic == $topic?->id)
                                        <div class="px-4 py-2">
                                            <div class="flex items-center"> 
                                                <img 
                                                    @if ($comment?->id_student)
                                                        @if ($comment?->student?->image)
                                                            src="{{ asset('storage/'.$comment?->student->image) }}"
                                                        @else
                                                            src="{{ asset('images/avatar.svg') }}"
                                                        @endif
                                                    @elseif($comment?->researcher?->image)
                                                        src="{{ asset('storage/'.$comment?->researcher->image) }}"
                                                    @else
                                                        src="{{ asset('images/avatar.svg') }}"
                                                    @endif
                                                    alt="profile" class="h-8 w-8 rounded-full object-cover object-top">
                                                <div class="ml-2 flex flex-col">
                                                    <span class="text-sm">
                                                        @if ($comment?->student?->name)
                                                            {{ $comment?->student?->name }}
                                                        @else
                                                            {{ $comment?->researcher?->name}}
                                                        @endif
                                                    </span>
                                                    <span class="text-xs text-gray-400">{{ $comment?->created_at }}</span>
                                                </div>
                                            </div>
                                            <div class="p-2 mt-2 text-sm text-slate-800 bg-slate-100 rounded-xl max-md:w-auto w-full">
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                <div class="px-4 py-2">
                                    <form action="/communities/send-comment/{{ $community->id }}" class="flex items-center" method="POST">
                                        @csrf
                                        <input type="number" name="id_researcher" hidden value="{{ $community->researcher->id }}">
                                        @if (auth()?->user()?->role === 'Student')
                                            <input type="number" name="id_student" value="{{ auth()?->user()?->id }}" hidden>
                                        @endif
                                        <input type="number" name="id_topic" hidden value="{{ $topic->id }}">
                                        <input
                                            id="comment"
                                            type="text"
                                            placeholder="Write your comment here"
                                            name="comment"
                                            value="{{ old('comment') }}"
                                            class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                                            <button class="bg-lime-400 p-2 rounded-lg text-white items-center ml-2 mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                                                </svg>
                                            </button>
                                    </form>
                                </div>
                            </details>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
