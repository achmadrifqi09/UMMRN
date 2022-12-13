@extends('layouts/main-layout') 
@section('stylesheet')
   <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
    <div class="min-h-screen max-md:px-6 px-20 flex flex-col items-center pt-32">
        <div class="w-full">
            <h1 class="text-2xl font-semibold">Manage Comunities Of Practice</h1> 
            <hr class="my-6 border-gray-200 sm:mx-auto" />
            <h2 class="py-4 text-slate-900"><strong>Comunities Detail</strong></h2>
            <form action="">
               <div class="flex items-start max-sm:flex-col shadow-sm rounded-lg border px-6 py-10">
                  <div
                     class="w-3/12 max-sm:w-full max-sm:mb-8 flex flex-col justify-center items-center mr-6">
                     <div class="p-1 border rounded-full border-gray-400 w-max mt-6 max-sm:mt-0">
                        <img 
                        @if ($community?->image)
                            src="{{ asset('storage/'.$community->image) }}"
                        @else
                            src="{{ asset('images/ic-comunities.svg') }}"
                        @endif 
                        
                        alt="avatar" class="w-24 h-24 rounded-full object-cover object-center" />
                     </div>
                     {{-- <label for="communities_picture" class="relative top-8 px-4 py-1 right-1 text-sm bg-lime-400 rounded-xl">Change</label>
                     <input hidden class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" id="communities_picture" name="communities_picture" type="file" accept="image/*"> --}}
                  </div>
                  <div  class="w-8/12 mx-auto max-lg:w-full border-l pl-6 max-sm:pl-0 max-sm:border-l-0">
                     <div class="mt-2">
                        <label for="name" class="text-gray-500">Name</label>
                        <input
                            id="name"
                            type="name"
                            disabled
                            name="name"
                            value="{{ $community?->name }}"
                            class="w-full bg-gray-100 px-4 py-2 rounded-md mt-1" />
                     </div>
                     <div class="mt-6">
                         <p class="text-gray-500">Description</p>
                         <div class="bg-gray-100 px-4 py-2 rounded-md mt-1">
                            {!! $community->description !!}
                         </div>
                     </div>
                  </div>
               </div>
            </form>
            <h2 class="py-4 text-slate-900 mt-8"><strong>Member Of Comunities</strong></h2>
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
                                Phone
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
                        @foreach ($members as $member)
                            
                        @endforeach
                        <tr class="bg-white border-b hover:bg-gray-50 ">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $member->student->name }}
                            </th>
                            <td class="py-4 px-6">
                               {{ $member->student->email }}
                            </td>
                            <td class="py-4 px-6">
                               {{ $member->student->phone }}
                            </td>
                            <td class="py-4 px-6">
                               {{ $member->status }}
                            </td>
                            <td class="py-4 px-6 flex h-max  space-x-4 ">
                                <form action="/communities/approval" method="POST" id="approvalForm">
                                        @csrf
                                        <input type="number" name="id" value="{{ $member->id }}" hidden/>
                                        <input type="text" name="status" id="status" hidden/>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
  <script>
        function submitted(status) {
            let a = document.getElementById('status').value = status;
            document.getElementById('approvalForm').submit();
        }

    </script>
@endsection