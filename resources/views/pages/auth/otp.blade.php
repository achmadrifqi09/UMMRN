@extends('layouts/auth-layout') 
@section('title') Sign Up @endsection
@section('form')
<div class="w-6/12 max-md:w-full bg-white max-md:bg-transparent min-h-screen p-20 max-sm:p-6 flex flex-col justify-center">
    <h2 class="text-3xl text-center max-md:text-white">Congratulations 👏 <br> one more step.. </h2>
    <p class="text-gray-500 text-center max-md:text-gray-300 mt-2">
       Enter the code we sent to your email.
    </p>
 
    <form action="/otp-validation/{{ $id }}/{{ $role }}" method="POST" class="mt-2 w-8/12 mx-auto max-lg:w-full space-y-6" onload="setValue({{ $id }}, '{{ $role }}')">
        @csrf
        <div>
            <label for="otp" class="max-md:text-white font-light text-gray-700">Code Verification</label>
            <input
                id="otp"
                type="number"
                placeholder="xxxx"
                class="w-full bg-gray-50 px-4 py-2 rounded-md mt-1"
                required
                name="otp"
            />
            <div class="flex flex-col justify-center items-center mt-2 space-x-2 text-gray-500" id="wrapResend">
                
                <p id="time" class="text-sm text-center">00</p>
            </div>
            @if($errors->any())
                <p class="text-red-700 text-sm mt-2">{{$errors->first()}}</p>
            @endif
        </div>
   
         <input
                id="id"
                type="text"
                hidden
                required
                value="{{ $id }}"
                name="id"
            />
         <input
                id="role"
                type="text"
                hidden
                required
                value="{{ $role }}"
                name="role"
            />
       
        <button
            type="submit"
            class="mt-10 px-8 py-2 text-center w-full bg-lime-400 rounded-full">
            Submit
        </button>
    </form>
   
</div>


@endsection
@section('script')
    <script src="{{ asset('js/timer.js') }}"></script>
@endsection
