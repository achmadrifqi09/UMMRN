@extends('layouts/main-layout') 
@section('stylesheet')
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
   <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
   <style>
      trix-toolbar [data-trix-button-group="file-tools"]{
         display: none;
      }
   </style>
@endsection
@section('content')
   <div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-32">
      <div class="w-full bg">
            <h1 class="text-2xl font-semibold">Create Projects</h1>
            <hr class="my-6 border-gray-200 sm:mx-auto" />

            <div class="bg-white shadow-sm p-6 mt-10 border rounded-xl">
               <form action="/projects/create" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mt-2">
                     <label for="title" class="text-gray-500">Title</label>
                     <input
                        id="title"
                        type="text"
                        placeholder="Enter title"
                        name="title"
                        value="{{ old('title') }}"
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" 
                        required/>
                  </div>
                  <div class="mt-6">
                     <label for="total_member" class="text-gray-500">Maximum Members</label>
                     <input
                        id="total_member"
                        type="number"
                        placeholder="0"
                        name="total_member"
                        value="{{ old('total_member') }}"
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" 
                        required/>
                  </div>
                  <div class="mt-6" hidden>
                     <label for="researcher" class="text-gray-500">Researchers</label>
                     <input
                        id="researcher"
                        type="number"
                        value="{{ auth()->user()->id }}"
                        name="id_researcher"
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" 
                        required/>
                  </div>
                  <div class="mt-6" hidden>
                     <label for="publishedYear" class="text-gray-500">Published Year</label>
                     <input
                        id="publishedYear"
                        type="number"
                        name="published_year"
                        value="{{ $publishedYear }}"
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" 
                        required/>
                  </div>
                  <div class="mt-6">
                     <label for="status" class="text-gray-500">Status</label>
                     <select
                        id="status"
                        type="text"
                        name="status"
                        required
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1">
                           @if (old('status') === 'Complated')
                              <option value="Open">Open</option>
                              <option value="Active">Active</option>
                              <option value="Complated" selected>Complated</option>
                           @elseif(old('status') === 'Active')
                              <option value="Open">Open</option>
                              <option value="Active" selected>Active</option>
                              <option value="Complated">Complated</option>
                           @else
                              <option value="Open" selected>Open</option>
                              <option value="Active">Active</option>
                              <option value="Complated">Complated</option>
                           @endif
                           
                     </select>
                  </div>
                   <div class="mt-6 bg-gray-100 p-2 rounded-xl">
                     <div class="flex justify-center py-6 text-gray-600">
                  
                        <svg id="ic-img"
                           xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                        <img src="" alt="project picture" id="imagePreview" class="w-40 rounded-xl" style="display: none">
                     </div>
                     <input class="w-full border border-gray-300 bg-gray-100 px-4 py-2 rounded-md mt-1" id="image" type="file" name="image" accept="image/*" onchange="showPreview(event);">
                  </div>
                  <div class="mt-6">
                     <label for="description" class="text-gray-500">Description</label>
                     <input id="description" type="hidden" name="description" value="{!! old('description') !!}" required>
                     <trix-editor input="description"></trix-editor>
                     <span class="text-sm text-red-900">*Please enter the project requirements here</span>
                  </div>
                   @if ($errors->any())
                     <ul class="text-red-700 text-sm list-disc ml-5 mt-2 pb-6">
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li> 
                        @endforeach
                     </ul>
                  @endif
                  <button type="submit" class="bg-lime-400 px-6 py-1 rounded-xl text-slate-900 h-max mt-6">Submit</button>
               </form>
            </div>
         </div>
      </div>
      
   </div>
@endsection

@section('script')
    <script>
      function showPreview(event){
         if(event.target.files.length > 0){
            let src = URL.createObjectURL(event.target.files[0]);
            let preview = document.getElementById("imagePreview");
            document.getElementById('ic-img').style.display = 'none'
           

            preview.style.display = 'block'
            preview.src = src;
            preview.style.display = "block";
         }
      }
    </script>
@endsection

