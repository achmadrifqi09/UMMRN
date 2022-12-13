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
            <h1 class="text-2xl font-semibold">Update CV</h1>
            <hr class="my-6 border-gray-200 sm:mx-auto" />

            <div class="bg-white shadow-sm p-6 mt-10 border rounded-xl">
               <form action="/curriculum-vintae/edit/{{ $cvData->id_researcher }}" method="POST">
                  @method('put')
                  @csrf
                  <input type="text" value="{{ auth()->user()->id }}" hidden name="id_researcher"/>
                 
                  <div class="mt-6">
                     <label for="education" class="text-gray-500">Education</label>
                     <input id="education" type="hidden" name="education" value="{!! old('education', $cvData->education) !!}">
                     <trix-editor input="education"></trix-editor>
                  </div>
                  <div class="mt-6">
                     <label for="skill" class="text-gray-500">Skill</label>
                     <input id="skill" type="hidden" name="skill" value="{!! old('skill', $cvData->skill) !!}">
                     <trix-editor input="skill"></trix-editor>
                  </div>
                  <div class="mt-6">
                     <label for="teaching" class="text-gray-500">Teaching</label>
                     <input id="teaching" type="hidden" name="teaching" value="{!! old('teaching', $cvData->teaching) !!}">
                     <trix-editor input="teaching"></trix-editor>
                  </div>
                  <div class="mt-6">
                     <label for="organizational" class="text-gray-500">Organizational</label>
                     <input id="organizational" type="hidden" name="organizational" value="{!! old('organizational', $cvData->organizational) !!}">
                     <trix-editor input="organizational"></trix-editor>
                  </div>
                  <div class="mt-6">
                     <label for="award" class="text-gray-500">Award</label>
                     <input id="award" type="hidden" name="award" value="{!! old('award', $cvData->award) !!}">
                     <trix-editor input="award"></trix-editor>
                  </div>
                  <div class="mt-6">
                     <label for="topic" class="text-gray-500">Topic</label>
                     <input id="topic" type="hidden" name="topic" value="{!! old('topic', $cvData->topic) !!}">
                     <trix-editor input="topic"></trix-editor>
                  </div>
                  <div class="mt-6">
                     <label for="publications" class="text-gray-500">Publications</label>
                     <input id="publications" type="hidden" name="publications" value="{!! old('publications', $cvData->publications) !!}">
                     <trix-editor input="publications"></trix-editor>
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