<div class="min-h-screen max-md:px-6 px-20 pt-32">
      <div class="flex justify-between items-center">
         <h1 class="text-2xl font-semibold">Project Detail</h1>
       
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto" />   
      <div id="modal" tabindex="-1" class="fixed hidden top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-hidden md:inset-0 h-modal h-screen bg-black bg-opacity-40">
         <div class="relative w-full h-full max-w-md m-auto top-40">
            <div class="relative bg-white rounded-lg shadow">
               <div class="p-6">
                  <form action="" method="POST" enctype="multipart/form-data" id="join-project">
                        @csrf
                        <div class="mt-6">
                           <input type="number" name="id_student" id="id_student" hidden required>
                           <input type="number" name="id_project" id="id_project" hidden required>
                           <label class="text-gray-500" for="image">Submit your portfolio (pdf)</label>
                           <input class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" id="portfolio" type="file" name="portfolio" accept="application/pdf" required>
                        </div>
                        <button  type="submit" class="mt-6 px-8 py-2 text-center w-max hover:bg-lime-500 bg-lime-400 rounded-full">
                           Join Project
                        </button>
                        <button type="button" class="mt-3 px-8 py-2 text-center w-max hover:bg-gray-200 bg-white border rounded-full" onclick="closeModal()">No, cancel</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="flex space-x-6 max-sl:flex-col max-sl:space-x-0">
         <div class="flex items-center flex-col shadow-sm py-12 rounded-lg w-4/6 max-sl:w-full border">
            <div class="w-3/12 max-sl:w-full max-sl:mb-8 flex justify-center">
                  <div class="p-1 border rounded-full border-gray-400 w-max h-max">
                     <img
                           @if ($project?->image)
                              src="{{ asset('storage/'.$project->image) }}"
                           @else
                              src="{{  asset('images/ic-project.svg') }}"
                           @endif
                        alt="avatar"
                        class="w-32 h-32 rounded-full object-cover object-top"
                     />
                  </div>
            </div>
            <div  class="mx-auto px-6 mt-4">
                  <h1 class="text-2xl text-center">{{ $project->title }}</h1>
                  <p class="text-gray-500 text-center">By {{ $project->researcher->name }} at {{ $project->published_year }}</p>
                  <div class="text-gray-400 text-base flex space-x-6 mt-3 justify-center">
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
                  <hr class="my-3">
                  <div class="space-y-4">
                     <h3 class="text-lg font-medium">Description and Requirement</h3>
                     <p class="text-gray-500 ">{!! $project->description !!}</p>
                  </div>
                 
                     @if (!isset($status) && $project->status !== 'Complated')
                         <button class=" bg-lime-400 px-6 py-1.5 rounded-xl text-slate-900 h-max whitespace-nowrap max-sm:mt-2" type="submit" onclick="openModal({{ auth()->user()->id }}, '{{ $project->id }}')">Join Project</button>
                     @elseif($project->status == 'Complated')
                         <button class=" bg-red-900 px-6 py-1.5 rounded-xl text-white h-max whitespace-nowrap max-sm:mt-2" type="submit" disabled>{{ $project->status }}</button>
                     @else
                        <button class=" bg-lime-400 px-6 py-1.5 rounded-xl text-slate-900 h-max whitespace-nowrap max-sm:mt-2" type="submit" disabled>{{ $status }}</button>
                     @endif

                  <hr class="my-6">
            </div>
         </div>
         <div class="w-2/6 max-sl:w-full max-sl:mt-10">
            <p class="pb-4 text-gray-400">More projects from {{ $project->researcher->name }}</p>
             @if ($anotherProjectIsEmpty)
               <p class="py-1 text-center bg-red-100 rounded-lg">Researcher doest have another project</p>
            @endif
            @foreach ($projects as $prj)
               <a href="/projects/detail/{{ $prj->id }}">
                  <div class="shadow-sm p-2 border rounded-xl my-2">
                     <div class="flex space-x-2">
                        <img 
                           @if ($prj?->image)
                              src="{{ asset('storage/'.$prj->image) }}"
                           @else
                              src="{{  asset('images/ic-project.svg') }}"
                           @endif
                        alt="" class="w-24 h-20 object-cover rounded-xl">
                        <div>
                           <span>{{ $prj->excerpt }}</span>  
                           <div class="text-gray-400 text-sm flex space-x-2 mt-1 justify-start">
                              <div class="flex space-x-1">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                                    <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                                 </svg>
                                 <span>
                                    {{ $prj->available_member }}/{{ $prj->total_member }}
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
               </a>
            @endforeach
         </div>
      </div>
   </div>

    <script>
        function openModal(idStudent, idProject){
            document.getElementById('join-project').action = `/projects/join`
            document.getElementById('id_student').value = idStudent
            document.getElementById('id_project').value = idProject

            const modal = document.getElementById('modal')
            modal.classList.remove('hidden')
        }

        function closeModal(){
            const modal = document.getElementById('modal')
            modal.classList.add('hidden')
        }
    </script>
