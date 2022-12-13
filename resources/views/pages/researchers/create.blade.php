@extends('layouts/main-layout')

@section('content')
   <div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-32">
      <div class="w-full bg">
            <h1 class="text-2xl font-semibold">Create Researcher</h1>
            <hr class="my-6 border-gray-200 sm:mx-auto" />

            <div class="bg-white shadow-sm p-6 mt-10 border rounded-xl">
               <form action="/researchers/create" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mt-2">
                     <label for="name" class="text-gray-500">Name*</label>
                     <input
                        id="name"
                        type="text"
                        placeholder="Enter name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <label for="researcher" class="text-gray-500">Interest*</label>
                      <input
                        id="interest"
                        type="text"
                        placeholder="Enter interest"
                        name="interest"
                        value="{{ old('interest') }}"
                        required
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <label for="phone" class="text-gray-500">Phone*</label>
                     <input
                        id="phone"
                        type="tel"
                        placeholder="08xxxx"
                        name="phone"
                        required
                        value="{{ old('phone') }}"
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <label for="email" class="text-gray-500">Email UMM*</label>
                     <input
                        id="email"
                        type="email"
                        placeholder="someone@webmail.umm.ac.id"
                        name="email"
                        value="{{ old('email') }}"
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
                        required
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <label for="confirmPassword" class="text-gray-500">Confirm Password</label>
                     <input
                        id="confirmPassword"
                        type="password"
                        placeholder="Password"
                        name="confirm_password"
                        required
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                  </div>
                  <div class="mt-6">
                     <label for="role" class="text-gray-500">Role*</label>
                     <select
                        id="role"
                        type="text"
                        name="role"
                        class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1">
                        @if (old('role') === 'Super Researcher')
                           <option value="Super Researcher" selected>Super Researcher</option>
                           <option value="Researcher">Researcher</option>
                        @else
                           <option value="Super Researcher">Super Researcher</option>
                           <option value="Researcher" selected>Researcher</option>
                        @endif
                          
                     </select>
                  </div>
                  <div class="mt-6">
                     <label class="text-gray-500" for="image">Profile Picture</label>
                     <input class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" id="image" type="file" name="image" accept="image/*">
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