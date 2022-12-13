<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>UMMRN</title>
      <link rel="icon" href="{{ asset('images/logo-umm.svg') }}" />
       @vite('resources/css/app.css')
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      @yield('stylesheet')
   </head>
   <body>
      <nav
         class="py-4 px-14 max-md:px-6 fixed w-full flex items-center justify-between backdrop-blur z-10 bg-red-900">
         <div class="flex">
            <div
               id="toggleMenu"
               class="w-8 h-8 bg-red-800 mr-3 rounded-md flex-col justify-between hidden max-sl:flex">
               <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="bg-white"
                  viewBox="0 0 24 24"
                  strokeWidth="{1.5}"
                  stroke="#fff"
                  className="w-6 h-6">
                  <path
                     strokeLinecap="round"
                     strokeLinejoin="round"
                     d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
               </svg>
            </div>

            <div class="w-20 h-max">
               <a href="/">  <img src="{{ asset('images/logo-umm.svg') }}" alt="logo UMM" /></a>
            </div>
         </div>
         <ul
            id="navItems"
            class="flex items-center space-x-6 text-white max-sl:absolute max-sl:flex-col max-sl:h-max max-sl:bg-red-900 max-sl:backdrop-blur-sm max-sl:inset-0 max-sl:top-16 max-sl:space-y-10 max-sl:space-x-0 max-sl:py-6 max-sl:hidden max-sl:pb-20 max-sl:shadow-md max-sl:ease-in backdrop-blur-sm text-center">
               <li class="hover:border-b border-lime-400">
                  <a href="/">Home</a>
               </li>
               <li class="hover:border-b border-lime-400">
                  <a href="/researchers">Researchers</a>
               </li>
               <li class="hover:border-b border-lime-400">
                  <a href="/communities">Communities of Practice</a>
               </li>
               <li class="hover:border-b border-lime-400">
                  <a href="/projects">Project</a></li>
               <li class="hover:border-b border-lime-400">
                  <a href="called-projects.html">Call for Projects</a>
               </li>
       
         </ul>
         @if (Auth::check())
            <div class="dropdown inline-block relative group/item">
               <button
                  class="bg-lime-400  px-6 py-1 rounded-xl text-slate-900 inline-flex items-center">
                  <span class="mr-1">Account</span>
                  <svg
                     class="fill-current h-4 w-4"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                     <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                  </svg>
               </button>
               <ul class="absolute invisible text-slate-900-700 pt-2 w-32 group-hover/item:visible">
                  <li>
                     <a
                        class=" py-2 px-4 block whitespace-no-wrap bg-white shadow-md rounded-t-lg hover:bg-gray-100"
                        href="/profile"
                        >Profile</a
                     >
                  </li>
                  <li>
                     <form action="/logout" method="POST">
                        @csrf
                        <button
                           class="py-2 px-4 text-left whitespace-no-wrap w-full bg-white shadow-md rounded-b-lg hover:bg-gray-100"
                           type="submit">Logout</>
                     </form>
                  </li>
               </ul>
            </div>
         @else
            <a class="bg-lime-400 px-6 py-1 rounded-xl text-slate-900" href="login.html">Login</a>
         @endif
      </nav>
      <main class="min-h-screen mb-20">
         @include('sweetalert::alert')
         <?php Session::forget('sweet_alert'); ?>
         @yield('content')
      </main>

      <footer class="bg-red-900 max-md:p-6 py-8 px-20">
         <div class="flex items-center justify-between max-sl:flex-col">
            <a href="#" class="flex items-center mb-4 sm:mb-0">
               <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
                  >UMMRN</span
               >
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm text-gray-200 sm:mb-0 max-sl:mt-4">
               <li>
                  <a href="#" class="mr-4 hover:underline md:mr-6">About</a>
               </li>
               <li>
                  <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
               </li>

               <li>
                  <a href="#" class="hover:underline">Contact</a>
               </li>
            </ul>
         </div>
         <hr class="my-6 border-gray-400 sm:mx-auto lg:my-8" />
         <span class="block text-sm text-gray-200 sm:text-center"
            >© 2022 UMM RESEARCH NETWORKS
         </span>
      </footer>
   </body>
   <script src="{{ asset('js/index.js') }}"></script>
   @yield('script')
</html>

