@extends('layouts/main-layout')
@section('content')
        <div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-32">
            <div class="w-full">
                <div class="flex justify-between items-center max-sm:flex-col max-sm:items-start">
                    <div>
                        <h1 class="text-2xl font-semibold">Researchers</h1>
                        <p class="text-gray-400">list of researchers UMM RESEARCH NETWORKS.</p>
                    </div>
                    @if (auth()->user()->role === 'Super Researcher')
                        <a class="bg-lime-400 px-6 py-1 rounded-xl text-slate-900 h-max whitespace-nowrap max-sm:mt-2" href="/researchers/create">Add Researcher</a>
                    @endif
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto" />
                <div id="cofirm-modal" tabindex="-1" class="fixed hidden top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-hidden md:inset-0 h-modal h-screen bg-black bg-opacity-40">
                    <div class="relative w-full h-full max-w-md m-auto top-40">
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-6 text-center">
                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="question">Are you sure you want to delete this researcher ?</h3>
                                <form action="" method="POST" id="delete-researcher" class="inline-flex">
                                    @method('delete')
                                    @csrf
                                    <button  type="submit" class="mt-3 px-8 py-2 text-center w-max hover:bg-red-600 bg-red-700 rounded-full mr-2 text-white">
                                        Yes, I'm sure
                                    </button>
                                </form>
                                <button type="button" class="mt-3 px-8 py-2 text-center w-max hover:bg-gray-200 bg-white border rounded-full" onclick="closeModal()">No, cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 w-full">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 align-middle">
                    @foreach ($researchers as $researcher)
                        <div class="bg-white shadow-sm border rounded-xl">
                            <div
                                class="h-36 bg-hero-pattern bg-cover py-6 rounded-tl-xl rounded-tr-xl bg-bottom"
                                style="background-image: url('images/bg-vector.png')">
                                    
                                <img
                                    @if ($researcher->image)
                                    src="{{ asset('storage/'.$researcher->image) }}"
                                    @else
                                        src="{{  asset('images/avatar.svg') }}"
                                    @endif
                                    alt="Researcher picture"
                                    class="rounded-full w-36 h-36 mx-auto relative top-8 object-cover border-8 bg-white border-white object-top" />
                            </div>
                            <div class="mt-14 p-4">
                                <h5 class="text-lg text-gray-400 text-center">
                                    <a href="/researchers/details/{{ $researcher->id }}">{{$researcher->name }}</a>     
                                    @if (auth()->user()->id === $researcher->id && auth()->user()->role === 'Super Researcher')
                                        (you)
                                    @elseif(auth()->user()->id === $researcher->id && auth()->user()->role === 'Researcher')
                                        (you)
                                    @endif
                                </h5>
                                <p class="text-lg mt-2 text-slate-900 text-center">{{ $researcher->interest }}</p>
                                @if (auth()->user()->role === 'Super Researcher')
                                    <button type="button" onclick="openModal({{ $researcher->id  }}, '{{ $researcher->name  }}')" class="mt-2 px-3 rounded-full py-1 bg-lime-400 flex w-min h-min mx-auto
                                        @if ($researcher->role === 'Super Researcher')
                                            invisible" disabled>
                                        @endif 
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                         Remove
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
        function openModal(id, name){
            document.getElementById('question').innerText = `You are sure to remove Researcher with the name ${name}`
            document.getElementById('delete-researcher').action = `/researchers/destroy/${id}`
            const modal = document.getElementById('cofirm-modal')
            modal.classList.remove('hidden')
        }

        function closeModal(){
            const modal = document.getElementById('cofirm-modal')
            modal.classList.add('hidden')
        }
    </script>
@endsection
