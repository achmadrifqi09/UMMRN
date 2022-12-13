
    <div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-32">
        <div id="cofirm-modal" tabindex="-1" class="fixed hidden top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-hidden md:inset-0 h-modal h-screen bg-black bg-opacity-40">
            <div class="relative w-full h-full max-w-md m-auto top-40">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="question">Are you sure you want to delete this researcher ?</h3>
                        <form action="" method="POST" id="delete-researcher" class="inline-flex">
                            @method('delete')
                            @csrf
                            <button  type="submit" class="mt-3 px-8 py-2 text-center w-max hover:bg-red-600 bg-red-700 rounded-full mr-2 text-white">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button type="button" class="mt-3 px-8 py-2 text-center w-max hover:bg-gray-200 bg-white border rounded-full" onclick="closeModal()">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex justify-between items-center max-sm:flex-col max-sm:items-start">
                <div>
                    <h1 class="text-2xl font-semibold">Projects</h1>
                    <p class="text-gray-400">Manage projects for students</p>
                </div>
                <a class="bg-lime-400 px-6 py-1 rounded-xl text-slate-900 h-max whitespace-nowrap max-sm:mt-2" href="/projects/create">Add Project</a>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto" />
            <div class="overflow-x-auto relative shadow-sm border sm:rounded-lg">
                <table class="w-full text-sm text-left text-slate-900 bg-gray-50">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Title
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Researchers
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Published Year
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
                        @foreach ($projects as $project) 
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                   {{ $project->title }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ $project->researcher->name }}
                                </td>
                                <td class="py-4 px-6">
                                     {{ $project->published_year }}
                                </td>
                                <td class="py-4 px-6">
                                 {{ $project->status }}
                                </td>

                                <td class="py-4 px-6 flex h-max  space-x-4 ">
                                    <a href="/projects/detail/{{ $project->id }}" class="text-base p-2 text-white bg-green-600 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="/projects/edit/{{ $project->id }}" class="text-base p-2 bg-lime-600 text-white rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                        <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                        </svg>
                                    </a>
                                   
                                    <button type="button" onclick="openModal({{ $project->id  }}, '{{ $project->excerpt  }}')" class="text-base p-2 bg-red-600 text-white rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @if ($total == 0)
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <td colspan="5" class="py-4 px-6 text-center">You haven't created a project yet </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @section('script')
    <script>
        function openModal(id, name){
            document.getElementById('question').innerText = `You are sure to remove project '${name}'`
            document.getElementById('delete-researcher').action = `/projects/destroy/${id}`
            const modal = document.getElementById('cofirm-modal')
            modal.classList.remove('hidden')
        }

        function closeModal(){
            const modal = document.getElementById('cofirm-modal')
            modal.classList.add('hidden')
        }
    </script>
@endsection
