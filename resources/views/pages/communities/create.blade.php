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
            <h1 class="text-2xl font-semibold">Create Comunites Of Practice</h1>
            <hr class="my-6 border-gray-200 sm:mx-auto" />

            <div class="bg-white shadow-sm p-6 mt-10 border rounded-xl">
               <form action="/communities/create" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mt-2">
                     <label for="name" class="text-gray-500">Name</label>
                     <input
                        id="name"
                        type="text"
                        placeholder="Enter name"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <input
                        id="researcher"
                        type="text"
                        name="id_researcher"
                        value="{{ auth()->user()->id }}"
                        hidden
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1"/>
                  </div>
                  <div class="mt-6">
                     <label class="text-gray-500" for="image">Comunites Picture</label>
                     <input class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" id="image" name="image" type="file" accept="image/*">
                  </div>
                  <div class="mt-6">
                     <label for="description" class="text-gray-500">Description</label>
                     <input id="description" type="hidden" name="description" value="{!! old('description') !!}">
                     <trix-editor input="description"></trix-editor>
                  </div>
                  @if ($errors->any())
                       <ul class="text-red-700 text-sm list-disc ml-4 pb-6 max-md:text-white">
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
