@extends('layouts/main-layout') 
@section('stylesheet')
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
   <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
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
                        <form action="">
                            <div class="mt-6">
                                <input id="topic" type="hidden" name="topic" value="{!! old('topic') !!}" >
                                <trix-editor input="topic"></trix-editor>
                            </div>
                            <button type="submit" class="py-2 px-3 space-x-3 flex justify-center items-center rounded-xl text-white bg-red-800 mt-2 ml-auto">
                                <span>Send</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="my-4 p-4 border rounded-xl shadow-sm">
                        <div class="flex items-center"> 
                            <img src="{{ asset('images/bg-umm.jpeg') }}" alt="profile" class="h-12 w-12 rounded-full">
                            <div class="ml-2">
                                <h2 class="text-md">Achmad Rifqi</h2>
                                <span class="text-sm text-gray-400">14/02/2022</span>
                            </div>
                        </div>
                        <p class="text-base text-justify text-gray-800 mt-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fuga commodi suscipit eius esse libero repudiandae magnam dolore ex explicabo tempore aut, eveniet quasi, officia laborum unde ad beatae veritatis laboriosam nostrum cupiditate eligendi nam ea! Veritatis adipisci recusandae ratione provident eligendi, ab atque assumenda voluptate placeat eum aliquid harum veniam?</p>
                        <details>
                            <summary class="text-lime-700 mt-6 cursor-pointer flex justify-center border-t border-b p-2 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                </svg>
                                Comments
                            </summary>

                           <div class="px-4 py-2">
                                <div class="flex items-center"> 
                                    <img src="{{ asset('images/bg-umm.jpeg') }}" alt="profile" class="h-8 w-8 rounded-full">
                                    <div class="ml-2 flex flex-col">
                                        <span class="text-sm">Akmal Sukarsa</span>
                                        <span class="text-xs text-gray-400">12/03/2022</span>
                                    </div>
                                </div>
                                <div class="p-2 mt-2 text-sm text-slate-800 bg-slate-100 rounded-xl w-max">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae, fuga!
                                </div>
                           </div>

                           <div class="px-4 py-2">
                                <div class="flex items-center"> 
                                    <img src="{{ asset('images/bg-umm.jpeg') }}" alt="profile" class="h-8 w-8 rounded-full">
                                    <div class="ml-2 flex flex-col">
                                        <span class="text-sm">Akmal Sukarsa</span>
                                        <span class="text-xs text-gray-400">12/03/2022</span>
                                    </div>
                                </div>
                                <div class="p-2 mt-2 text-sm text-slate-800 bg-slate-100 rounded-xl w-max">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing.
                                </div>
                           </div>

                           
                        </details>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
