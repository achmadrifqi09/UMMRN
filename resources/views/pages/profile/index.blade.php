@extends('layouts/main-layout')
@section('content')
   <div class="min-h-screen max-md:px-6 px-20 pt-32">
      <div class="flex justify-between items-center">

         <h1 class="text-2xl font-semibold">Profile</h1>
         @if (auth()->user()->role === 'Super Researcher')
            <a class="bg-lime-400 px-6 py-1 rounded-xl text-slate-900 h-max whitespace-nowrap max-sm:mt-2" href="/curriculum-vintae/create">Add CV</a>
         @endif
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto" />
      <div id="modal" tabindex="-1" class="fixed hidden top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-hidden md:inset-0 h-modal h-screen bg-black bg-opacity-40">
            <div class="relative w-full h-full max-w-md m-auto top-40">
               <div class="relative bg-white rounded-lg shadow">
                  <div class="p-6">
                     <form action="" method="POST" enctype="multipart/form-data" id="update-picture">
                        @csrf
                        <div class="mt-6">
                           <label class="text-gray-500" for="image">Change Profile Picture</label>
                           <input class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" id="image" type="file" name="image" accept="image/*">
                           <p id="helper-text" class="mt-2 text-sm text-gray-500">Maximum file size 1024KB/1MB</p>
                        </div>
                        <button  type="submit" class="mt-6 px-8 py-2 text-center w-max hover:bg-lime-500 bg-lime-400 rounded-full">
                           Save Picture
                        </button>
                        <button type="button" class="mt-3 px-8 py-2 text-center w-max hover:bg-gray-200 bg-white border rounded-full" onclick="closeModal()">No, cancel</button>
                     </form>
                     
                  </div>
               </div>
            </div>
         </div>
      <div class="flex items-start max-sm:flex-col">
         <div
               class="w-3/12 max-sm:w-full max-sm:mb-8 flex flex-col justify-center items-center mr-6 ">
               <div class="p-1 border rounded-full border-gray-400 w-max">
                  <img
                        @if ($userData->image)
                           src="{{  'storage/'.$userData->image }}"
                        @else
                           src="{{  asset('images/avatar.svg') }}"
                        @endif
                     alt="avatar"
                     class="w-24 h-24 rounded-full object-cover object-top"
                  />
               </div>
               <div class="flex mt-4 flex-col">
                  <button class="px-5 py-1 bg-lime-400 rounded-xl text-sm" onclick="openModal({{ $userData->id }}, '{{ $userData->role }}')">
                     Change
                  </button>
               </div>
         </div>
         <form class="w-8/12 mx-auto max-lg:w-full border-l pl-6 max-sm:pl-0 max-sm:border-l-0">
               <div>
                  <label for="name" class="text-gray-400">Name</label>
                  <input
                     id="name"
                     type="text"
                     value="{{ $userData->name}}"
                     disabled
                     class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                  />
               </div>
               @if ($userRole === 'Researcher' || $userRole === 'Super Researcher')
                  <div class="mt-6">
                     <label for="interest" class="text-gray-400">Interest</label>
                     <input
                        id="interest"
                        type="text"
                           value="{{ $userData->interest}}"
                        disabled
                        class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                     />
                  </div>
               @endif
               <div class="mt-6">
                  <label for="phone" class="text-gray-400">Phone</label>
                  <input
                        id="phone"
                        type="tel"
                        value="{{ $userData->phone}}"
                        disabled
                        class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                  />
               </div>
               <div class="mt-6">
                  <label for="email" class="text-gray-400">Email</label>
                  <input
                        id="email"
                        type="email"
                        class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                        disabled
                        value="{{ $userData->email}}"
                  />
               </div>
               @if ($userRole === 'Student')
                  <div class="mt-6">
                     <label for="description" class="text-gray-400">Description</label>
                     <div class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1">
                        @if ($userData->description)
                           {!! $userData->description !!}
                        @else
                           <p class="text-gray-400">You never wrote a description of yourself</p>
                        @endif
                     </div>
                  </div>
                  
               @endif
               <div class="flec">
                  <a
                     type="button"
                     href="/profile/edit/{{ $userData->id }}/{{ $userData->role }}"
                     class="mt-10 px-8 py-2 text-center w-max bg-lime-400 rounded-full">
                     Edit Profile
                  </a>
                  @if ($isCV)
                     <a
                        type="button"
                        href="/curriculum-vintae/edit/{{ $userData->id }}"
                        class="mt-10 px-8 py-2 text-center w-max bg-white border rounded-full">
                        Edit CV
                     </a>
                  @endif
               </div>
         </form>
      </div>
   </div>
@endsection
@section('script')
    <script>
        function openModal(id, role){
            document.getElementById('update-picture').action = `/profile/change-image/${id}/${role}`
            const modal = document.getElementById('modal')
            modal.classList.remove('hidden')
        }

        function closeModal(){
            const modal = document.getElementById('modal')
            modal.classList.add('hidden')
        }
    </script>
@endsection