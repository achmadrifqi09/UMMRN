@extends('layouts/main-layout')
@section('stylesheet')
   <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection
@section('content')
<div
   class="min-h-screen bg-red-900 pt-20 max-md:px-6 px-20 flex flex-col items-center justify-center">
   <div class="text-center p-6">
      <h1 class="text-white max-sm:text-4xl text-5xl" data-aos="fade-up">Your Research Network,</h1>
      <h1
         class="text-5xl max-sm:text-4xl mt-4 bg-gradient-to-r from-white to-blue-400 bg-clip-text text-transparent" data-aos="fade-up">
         Solution and Opportunities
      </h1>
   </div>
   <div class="p-6 flex justify-center items-center w-full max-md:flex-col">
      <input
         type="text"
         class="rounded-2xl py-2 w-2/6 px-3.5 max-md:w-full"
         placeholder="Search for..." />
      <button class="px-6 py-2 bg-lime-400 rounded-2xl ml-4 max-md:ml-0 max-md:mt-6 w-max">
         Discover
      </button>
   </div>
</div>
<div class="px-20 max-md:p-6 flex justify-center">
   <div
      class="bg-white p-4 relative -top-20 max-sm:-top-36 max-sm:w-full max-sm:mt-6 shadow-md w-max rounded-xl" data-aos="fade-up">
      <div class="p-4">
         <h3 class="text-xl border-slate-900 w-max m-auto pl-4">The Benefits You Get</h3>
      </div>
      <div class="flex max-sm:flex-col max-md:w-full text-center">
         <div class="border-r p-4 max-sm:border-b max-sm:border-r-0">
            <div
               class="w-8 h-8 bg-red-900 flex items-center justify-center text-white p-1.5 rounded-full mb-3 mx-auto">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6">
                  <path
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" />
               </svg>
            </div>
            <span>Add experience and expertise</span>
         </div>
         <div class="border-r p-4 max-sm:border-b max-sm:border-r-0">
            <div
               class="w-8 h-8 bg-red-900 flex items-center justify-center text-white p-1.5 rounded-full mb-3 mx-auto">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6">
                  <path
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
               </svg>
            </div>
            <span>Make a portfolio as a provision for work</span>
         </div>
         <div class="p-4">
            <div
               class="w-8 h-8 bg-red-900 flex items-center justify-center text-white p-1.5 rounded-full mb-3 mx-auto">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6">
                  <path
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
               </svg>
            </div>
            <span>Collaboration with experts</span>
         </div>
      </div>
   </div>
</div>
<div class="px-20 max-md:px-6 mb-20">
   <h1 class="text-2xl font-semibold border-b-2 w-max border-slate-900" data-aos="zoom-in-right">Project</h1>
   <div class="flex justify-between items-center mt-2">
      <p class="text-gray-400" data-aos="zoom-in-right">Register yourself for an ongoing project.</p>
      <a href="/projects" class="text-gray-400 hover:pl-2 flex" data-aos="zoom-in-left"
         >View All</a>
   </div>
   <div class="mt-10">
      @if ($isProject)
          <p class="bg-red-200 py-2 px-6 rounded-lg w-max">No projects have been added yet</p>
      @endif
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 align-middle">
         @php
            $duration = 3000;
         @endphp
         @foreach ($projects as $project)
            <div class="text-6xl bg-white shadow-sm border rounded-xl" data-aos="fade-left" data-aos-duration="{{ $duration = $duration - 650 }}">
               <img 
               @if ($project?->image)
                   src="{{ asset('storage/'.$project->image) }}"
               @else
                   src="{{ asset('images/ic-project.svg') }}"
               @endif
               alt="" class="rounded-tl-xl rounded-tr-xl w-full" />
               <div class="p-4">
                  <h5 class="text-lg">{{ $project->title }}</h5>
                  <p class="text-base mt-2 text-gray-400">By {{ $project->researcher->name }} at {{ $project->published_year }}</p>
                  <div 
                     @if ($project?->status == 'Open')
                        class="text-base px-5 rounded-full mt-6 py-1 w-max bg-lime-400 text-slate-900"
                     @elseif($project?->status == 'Complated')
                        class="text-base px-5 rounded-full mt-6 py-1 w-max bg-red-900 text-white"
                     @else
                        class="text-base px-5 rounded-full mt-6 py-1 w-max bg-white text-slate-900 border border-gray-300"
                     @endif>
                  
                     {{ $project->status }}
                  </div>
               </div>
            </div>
         @endforeach
      </div>
   </div>
</div>
@endsection
@section('script')
   <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
   <script>
      AOS.init({ once: true,});
   </script>
@endsection