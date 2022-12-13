<div class="min-h-screen max-md:px-6 px-20 pt-32">
      <div class="flex justify-between items-center">
         <h1 class="text-2xl font-semibold">Project Detail</h1>

      </div>
      <div id="modal" tabindex="-1" class="fixed hidden top-0 left-0 right-0 z-50 p-4 overflow-x-hidden  md:inset-0 h-modal h-screen w-screen bg-black bg-opacity-40">
         <div class="relative w-screen h-full m-auto px-20 py-12 max-md:px-6">
            <div class="relative bg-white rounded-lg shadow w-full">
               <div class="p-6">
                 <iframe src="" frameborder="0" id="framePdf" class="w-full" style="height: 70vh;"></iframe>
                 <button type="button" class="mt-3 px-8 py-2 text-center w-max text-white hover:bg-slate-500 bg-slate-400 border rounded-full" onclick="closeModal()">Close</button>
               </div>
            </div>
         </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto" />   
      <div class="flex items-center max-sl:flex-col shadow-sm px-5 py-12 rounded-lg border">
         <div class="w-3/12 max-sl:w-full max-sl:mb-8 flex justify-center mr-6">
               <div class="p-1 border rounded-full border-gray-400 w-max h-max">
                  <img
                        @if ($project?->image)
                           src="{{ asset('storage/'.$project->image) }}"
                        @else
                           src="{{  asset('images/ic-project.svg') }}"
                        @endif
                     alt="avatar"
                     class="w-40 h-40 rounded-full object-cover object-top"
                  />
               </div>
         </div>
         <div  class="w-8/12 mx-auto max-lg:w-full border-l pl-6 max-sl:border-l-0">
               <h1 class="text-2xl max-sl:text-center">{{ $project->title }}</h1>
               <p class="text-gray-500 max-sl:text-center">By {{ $project->researcher->name }} at {{ $project->published_year }} </p>
                 <div class="text-gray-400 text-sm flex space-x-2 mt-1 justify-start">
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
               <div class="my-6">
                  <h3 class="text-lg">Description and Requirements</h3>
                  <p class="text-gray-500">{!! $project->description !!}</p>
               </div>
               <a class=" bg-lime-400 px-6 py-1.5 rounded-xl text-slate-900 h-max whitespace-nowrap max-sm:mt-2" href="/projects/edit/{{ $project->id }}">Edit Project</a>
         </div>
      </div>

      <h2 class="text-xl mt-12 mb-4 text-center">Member Joined</h2>
        <div class="overflow-x-auto relative shadow-sm border sm:rounded-lg">
                <table class="w-full text-sm text-left text-slate-900 bg-gray-50">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Email
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Phone Number
                            </th>
                            <th scope="col" class="py-3 px-6 text-center">
                                Submitted Portfolio
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Status
                            </th>
                            <th scope="col" class="py-3 px-6">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($isMember)
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <td scope="row" class="py-4 px-6 font-medium text-gray-900 text-center" colspan="6">
                                   No members have registered yet
                                </td>
                            </tr>
                        @endif
                        @foreach ($members as $member) 
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <td scope="row" class="py-4 px-6 font-medium text-gray-900">
                                   {{ $member?->student?->name }}
                                </td>
                                <td class="py-4 px-6">
                                     {{ $member?->student?->email }}
                                </td>
                                <td class="py-4 px-6">
                                      {{ $member?->student?->phone }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                  <button onclick="openModal('{{ $member?->portfolio }}')" class="text-blue-700">View</button>
                                </td>
                                <td class="py-4 px-6">
                                  {{ $member?->status }}
                                </td>

                                <td class="py-4 px-6 flex h-max  space-x-4 ">
                                    <form action="/projects/approval" method="POST" id="approvalForm">
                                        @csrf
                                        <input type="number" name="id" value="{{ $project->id }}" hidden/>
                                        <input type="text" name="status" id="status" hidden/>
                                        <input type="number" name="studentId" value="{{ $member?->student?->id }}" hidden/>
                                    </form>
                                    <button type="button" onclick="submitted('Accept')" class="text-base p-2 bg-lime-600 text-white rounded-lg">
                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                       </svg>

                                    </button>
                                    <button type="button" onclick="submitted('Reject')" class="text-base p-2 bg-red-600 text-white rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                       </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
   </div>
@section('script')
    <script>
        function submitted(status) {
            let a = document.getElementById('status').value = status;
            document.getElementById('approvalForm').submit();
        }

        
        function openModal(data){
            const modal = document.getElementById('modal')
            document.getElementById('framePdf').src = `http://localhost:8000/storage/${data}`
            console.log(`storage/${data}`)
            modal.classList.remove('hidden')
        }

        function closeModal(){
            const modal = document.getElementById('modal')
            modal.classList.add('hidden')
        }


    </script>
@endsection