@extends('layouts/auth-layout') 
@section('title') Sign Up @endsection
@section('form')
<div class="w-6/12 max-md:w-full bg-white max-md:bg-transparent min-h-screen p-20 max-sm:p-6 flex flex-col justify-center">
    <h2 class="text-3xl text-center max-md:text-white">Hi, welcome.. 👋</h2>
    <p class="text-gray-500 text-center max-md:text-gray-300">
        Make sure the personal data you registered is correct
    </p>
    <form action="/signup" method="POST" class="mt-2 w-8/12 mx-auto max-lg:w-full space-y-6">
        @csrf
        <div>
            <label for="name" class="max-md:text-white font-light text-gray-700">Name</label>
            <input
                id="name"
                type="text"
                placeholder="Full name"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                required
                name="name"
                value="{{ old('name') }}"
            />
        </div>
        <div class="mt-4">
            <label for="studentId" class="max-md:text-white font-light text-gray-700">Student Id</label>
            <input
                placeholder="Enter your student id"
                type="number"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                id="studentId"
                required
                name="student_id"
                value="{{ old('student_id') }}"
            />
        </div>
        <div class="mt-4">
            <label for="phone" class="max-md:text-white font-light text-gray-700">Phone</label>
            <input
                placeholder="08xxx"
                type="tel"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                id="phone"
                required
                name="phone"
                value="{{ old('phone') }}"
            />
        </div>
        <div class="mt-4">
            <label for="email" class="max-md:text-white font-light text-gray-700">Email</label>
            <input
                placeholder="someone@webmail.umm.ac.id"
                type="email"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                id="email"
                required
                name="email"
                value="{{ old('email') }}"
            />
        </div>
        <div class="mt-4">
            <label for="password" class="max-md:text-white font-light text-gray-700">Password</label>
            <input
                placeholder="Password"
                type="password"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                id="password"
                required
                name="password"
            />
        </div>
        <div class="mt-4">
            <label for="confirmPassword" class="max-md:text-white font-light text-gray-700">Confirm Password</label>
            <input
                placeholder="Confirm password"
                type="password"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                id="confirmPassword"
                required
                name="confirm_password"
            />
        </div>
        @if ($errors->any())
            <ul class="text-red-700 text-sm list-disc ml-4 pb-6 max-md:text-white">
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li> 
                @endforeach
            </ul>
        @endif
        <button
            type="submit"
            class="mt-10 px-8 py-2 text-center w-full bg-lime-400 rounded-full">
            Sign Up
        </button>
    </form>
    <p class="text-center mt-10 max-md:text-white">
        You already have an account ?<a href="/signin" class="text-red-400">
         Sign in here</a>
    </p>
</div>


@endsection
