<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>UMMRN - @yield('title')</title>
      <link rel="icon" href="{{ asset('images/logo-umm.svg') }}" />
      @vite('resources/css/app.css')
   </head>
   <body>
      <main class="min-h-screen w-full flex max-md:flex-col-reverse bg-red-900">
         @yield('form')
         <div
            class="w-6/12 max-md:w-full max-lg:min-h-screen bg-cover bg-center bg-no-repeat flex flex-col justify-center items-center max-sm:h-max max-md:min-h-0 max-md:py-20"
            style="background-image: url('images/bg-vector.png')">
            <img src="{{ asset('images/logo-umm.svg') }}" alt="logo UMM" class="w-6/12" />
            <h1 class="text-white mt-10 text-2xl max-md:text-lg">UMM RESEARCH NETWORKS</h1>
         </div>
      </main>
      @yield('script')
   </body>
</html>
