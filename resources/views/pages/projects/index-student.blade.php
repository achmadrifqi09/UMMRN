 <div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-32">
            <div class="w-full bg">
               <h1 class="text-2xl font-semibold">Projects</h1>
               <p class="text-gray-400">List of projects you can Follow</p>
               <hr class="my-6 border-gray-200 sm:mx-auto" />
            </div>
            <div class="mt-6 w-full">
               <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 align-middle">
                  @foreach ($projects as $project)
                     <div class="text-6xl bg-white shadow-sm border rounded-xl">
                        <img 
                           @if ($project?->image)
                              src="{{ asset('storage/'.$project->image) }}"
                           @else
                              src="{{ asset('images/ic-project.svg') }}"
                           @endif
                        alt="project picture" class="rounded-tl-xl rounded-tr-xl w-full" />
                        <div class="p-4 flex flex-col justify-between">
                           <a href="/projects/detail/{{ $project->id }}" class="text-lg text-slate-900">{{ $project->title }}</a>
                           <div>
                               <p class="text-base mt-2 text-gray-400">By {{ $project->researcher->name }} at {{ $project->published_year }}</p>
                              <div class="text-gray-400 text-base flex mt-1 space-x-6">
                                 <div class="flex space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                                    <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                                    </svg>
                                   <span>
                                     {{ $project->available_member }}/{{ $project->total_member }}
                                   </span>
                                 </div>
                                 <div class="flex space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                       <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 01-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 01-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 01-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584zM12 18a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $project->status }}</span>
                                    
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               
               </div>
            </div>
         </div>