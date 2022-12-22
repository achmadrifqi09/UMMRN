<div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-32">
   <div class="w-full bg">
      <div class="flex justify-between items-center max-sm:flex-col max-sm:items-start">
         <div>
            <h1 class="text-2xl font-semibold">Comunities Of Practice</h1>
           
            <p class="text-gray-400">Join Comunities of Practice and Get the Benefits</p>
         </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto" />
   </div>
   <div class="mt-6 w-full">
      <h2 class="mb-4 text-lg border-b w-max">Communities Joined</h2>
      @if ($datas->joinedIsEmpty)
          <div class="py-4 px-6 bg-gray-100 rounded-lg flex justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <span>You've never joined a community</span>
         </div>
      @endif
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 align-middle">
         @foreach ($datas->communitiesJoined as $community)
            <div class="bg-white shadow-md rounded-xl">
               <div class="h-36  bg-cover py-6 rounded-tl-xl rounded-tr-xl bg-bottom" style="background-image: url('{{ asset('images/bg-vector.png') }}')">
                  <img 
                     @if ($community?->community?->image)
                         src="{{ asset('storage/'.$community?->community?->image) }}"
                     @else
                         src="{{ asset('images/ic-comunities.svg') }}"
                     @endif
                     alt="communities picture"
                     class="rounded-full w-40 h-40 mx-auto relative top-8 object-cover border-8 border-white"/>
               </div>
               <div class="mt-20 p-4 pb-6 text-center">
                  @if ($community->id_student === auth()->user()->id && $community->status !== 'Pending'&& $community->status !== 'Reject')
                     <a class="text-xl text-slate-900" href="/communities/detail/{{ $community?->community?->id }}">
                        {{ $community?->community?->name }}
                     </a>
                  @else
                     <p class="text-xl text-slate-900">{{ $community?->community?->name }}</p>
                  @endif
                  <p class="text-base mt-2 text-gray-500">
                     {!! $community?->community?->description !!}
                  </p>
                  @if (auth()->user()->role != 'Student')
                     <a class="mt-4 left-4 px-3 rounded-full py-2 bg-lime-400 flex justify-center items-center" href="/communities/manage">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                           <path d="M17.004 10.407c.138.435-.216.842-.672.842h-3.465a.75.75 0 01-.65-.375l-1.732-3c-.229-.396-.053-.907.393-1.004a5.252 5.252 0 016.126 3.537zM8.12 8.464c.307-.338.838-.235 1.066.16l1.732 3a.75.75 0 010 .75l-1.732 3.001c-.229.396-.76.498-1.067.16A5.231 5.231 0 016.75 12c0-1.362.519-2.603 1.37-3.536zM10.878 17.13c-.447-.097-.623-.608-.394-1.003l1.733-3.003a.75.75 0 01.65-.375h3.465c.457 0 .81.408.672.843a5.252 5.252 0 01-6.126 3.538z" />
                           <path fill-rule="evenodd" d="M21 12.75a.75.75 0 000-1.5h-.783a8.22 8.22 0 00-.237-1.357l.734-.267a.75.75 0 10-.513-1.41l-.735.268a8.24 8.24 0 00-.689-1.191l.6-.504a.75.75 0 10-.964-1.149l-.6.504a8.3 8.3 0 00-1.054-.885l.391-.678a.75.75 0 10-1.299-.75l-.39.677a8.188 8.188 0 00-1.295-.471l.136-.77a.75.75 0 00-1.477-.26l-.136.77a8.364 8.364 0 00-1.377 0l-.136-.77a.75.75 0 10-1.477.26l.136.77c-.448.121-.88.28-1.294.47l-.39-.676a.75.75 0 00-1.3.75l.392.678a8.29 8.29 0 00-1.054.885l-.6-.504a.75.75 0 00-.965 1.149l.6.503a8.243 8.243 0 00-.689 1.192L3.8 8.217a.75.75 0 10-.513 1.41l.735.267a8.222 8.222 0 00-.238 1.355h-.783a.75.75 0 000 1.5h.783c.042.464.122.917.238 1.356l-.735.268a.75.75 0 10.513 1.41l.735-.268c.197.417.428.816.69 1.192l-.6.504a.75.75 0 10.963 1.149l.601-.505c.326.323.679.62 1.054.885l-.392.68a.75.75 0 101.3.75l.39-.679c.414.192.847.35 1.294.471l-.136.771a.75.75 0 101.477.26l.137-.772a8.376 8.376 0 001.376 0l.136.773a.75.75 0 101.477-.26l-.136-.772a8.19 8.19 0 001.294-.47l.391.677a.75.75 0 101.3-.75l-.393-.679a8.282 8.282 0 001.054-.885l.601.504a.75.75 0 10.964-1.15l-.6-.503a8.24 8.24 0 00.69-1.191l.735.268a.75.75 0 10.512-1.41l-.734-.268c.115-.438.195-.892.237-1.356h.784zm-2.657-3.06a6.744 6.744 0 00-1.19-2.053 6.784 6.784 0 00-1.82-1.51A6.704 6.704 0 0012 5.25a6.801 6.801 0 00-1.225.111 6.7 6.7 0 00-2.15.792 6.784 6.784 0 00-2.952 3.489.758.758 0 01-.036.099A6.74 6.74 0 005.251 12a6.739 6.739 0 003.355 5.835l.01.006.01.005a6.706 6.706 0 002.203.802c.007 0 .014.002.021.004a6.792 6.792 0 002.301 0l.022-.004a6.707 6.707 0 002.228-.816 6.781 6.781 0 001.762-1.483l.009-.01.009-.012a6.744 6.744 0 001.18-2.064c.253-.708.39-1.47.39-2.264a6.74 6.74 0 00-.408-2.308z" clip-rule="evenodd" />
                        </svg>
                        Manage
                     </a>
                  @else
                     @if ($community->id_student === auth()->user()->id)
                         <button class="mt-4 w-full left-4 px-6 rounded-full py-2 bg-lime-400 flex justify-center items-center mx-auto" disabled>
                        {{ $community->status }}
                     @else
                     <form action="/communities/join" method="POST">
                        @csrf
                        <input type="number" name="id_student" required value="{{ auth()->user()->id }}" hidden>
                        <input type="number" name="id_community" required value="{{ $community->id }}" hidden>
                        <button class="mt-4 w-full left-4 px-6 rounded-full py-2 bg-lime-400 flex justify-center items-center mx-auto" type="submit">
                        + Join
                        </button>
                     </form>
                     @endif
                  @endif
               </div>
            </div>
         @endforeach
      </div>
   </div>

    <div class="mt-20 w-full">
      <h2 class="mb-4 text-lg border-b w-max">Unjoined Communities</h2>
       @if ($datas->communitiesIsEmpty)
          <div class="py-4 px-6 bg-gray-100 rounded-lg flex justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>

            <span>No other community</span>
         </div>
      @endif
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 align-middle">
         @foreach ($datas->communities as $community)
            <div class="bg-white shadow-md rounded-xl">
               <div class="h-36  bg-cover py-6 rounded-tl-xl rounded-tr-xl bg-bottom" style="background-image: url('{{ asset('images/bg-vector.png') }}')">
                  <img 
                     @if ($community?->image)
                         src="{{ asset('storage/'.$community?->image) }}"
                     @else
                         src="{{ asset('images/ic-comunities.svg') }}"
                     @endif
                     alt="communities picture"
                     class="rounded-full w-40 h-40 mx-auto relative top-8 object-cover border-8 border-white"/>
               </div>
               <div class="mt-20 p-4 pb-6 text-center">
                
                  <p class="text-xl text-slate-900">{{ $community?->name }}</p>

                  <p class="text-base mt-2 text-gray-500">
                     {!! $community?->description !!}
                  </p>
                     <form action="/communities/join" method="POST">
                        @csrf
                        <input type="number" name="id_student" required value="{{ auth()->user()->id }}" hidden>
                        <input type="number" name="id_community" required value="{{ $community->id }}" hidden>
                        <button class="mt-4 w-full left-4 px-6 rounded-full py-2 bg-lime-400 flex justify-center items-center mx-auto" type="submit">
                        + Join
                        </button>
                     </form>
               </div>
            </div>
         @endforeach
      </div>
   </div>
</div>
