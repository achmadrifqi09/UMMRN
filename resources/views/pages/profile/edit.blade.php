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
            <h1 class="text-2xl font-semibold">Edit Account</h1>
            <hr class="my-6 border-gray-200 sm:mx-auto" />
            <div class="bg-white shadow-sm p-6 mt-10 border rounded-xl">
               <form action="/profile/edit/{{ $userData->id }}/{{ $userData->role }}" method="POST" enctype="multipart/form-data">
                  @method('put')
                  @csrf
                  <div class="mt-2">
                     <label for="name" class="text-gray-500">Name*</label>
                     <input
                        id="name"
                        type="text"
                        placeholder="Enter name"
                        name="name"
                        value="{{ old('name', $userData->name) }}"
                        required
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  @if ($userData->role === 'Researcher' || $userData->role === 'Super Researcher')
                     <div class="mt-6">
                        <label for="researcher" class="text-gray-500">Interest*</label>
                        <input
                           id="interest"
                           type="text"
                           placeholder="Enter interest"
                           name="interest"
                           value="{{ old('interest', $userData->interest) }}"
                           required
                           class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                     </div>
                  @endif
                  @if ($userData->role == 'Student')
                     <div class="mt-6">
                        <label for="studentID" class="text-gray-500">Student ID*</label>
                        <input
                           id="studentID"
                           type="number"
                           placeholder="2019xxx"
                           name="student_id"
                           readonly
                           value="{{ old('phone', $userData->student_id) }}"
                           class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                     </div>
                  @endif
                  <div class="mt-6">
                     <label for="phone" class="text-gray-500">Phone*</label>
                     <input
                        id="phone"
                        type="tel"
                        placeholder="08xxxx"
                        name="phone"
                        required
                        value="{{ old('phone', $userData->phone) }}"
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <label for="email" class="text-gray-500">Email UMM*</label>
                     <input
                        id="email"
                        type="email"
                        placeholder="someone@webmail.umm.ac.id"
                        name="email"
                        value="{{ old('email', $userData->email) }}"
                        required
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <label for="password" class="text-gray-500">Password</label>
                     <input
                        id="password"
                        type="password"
                        placeholder="Password"
                        name="password"
                        value="{{ old('password') }}"
       
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <label for="confirmPassword" class="text-gray-500">Confirm Password</label>
                     <input
                        id="confirmPassword"
                        type="password"
                        placeholder="Password"
                        name="confirm_password"
      
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  @if ($userData->role === 'Student')
                      <div class="mt-6">
                           <input id="x" type="hidden" name="description" value="{!! $userData->description !!}">
                           <trix-editor input="x"></trix-editor>
                     </div>
                  @endif
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
