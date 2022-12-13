@extends('layouts/auth-layout') 
@section('title') Sign In @endsection
@section('form')
<div class="w-6/12 max-md:w-full bg-white max-md:bg-transparent min-h-screen p-20 max-sm:p-6 flex flex-col justify-center">
    <h2 class="text-3xl text-center max-md:text-white">Hi, welcome.. 👋</h2>
    <p class="text-gray-500 text-center max-md:text-gray-300">
        Enter your email and passoword here.
    </p>
    <form action="/signin" method="POST" class="mt-14 w-8/12 mx-auto max-lg:w-full">
        @csrf
        <div>
            <label for="email" class="max-md:text-white">Email</label>
            <input
                id="email"
                type="email"
                placeholder="Enter your email"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                name="email"
                value="{{ old('email') }}"
            />
        </div>
        <div class="mt-4">
            <label for="password" class="max-md:text-white">Password</label>
            <input
                placeholder="Enter your password"
                type="password"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                id="password"
                name="password"
            />
        </div>
        @if (session()->has('errorMessage'))
            <p class="pb-6 mt-3 text-sm text-red-700 max-md:text-white">{{ session('errorMessage') }}</p>
        @endif
        
        <button
            type="submit"
            class="mt-10 px-8 py-2 text-center w-full bg-lime-400 rounded-full">
            Sign In
        </button>
    </form>
    <p class="text-center mt-10 max-md:text-white">
        You don't have an account ?<a href="/signup" class="text-red-400">
         Sign up here</a>
    </p>
</div>


@endsection
