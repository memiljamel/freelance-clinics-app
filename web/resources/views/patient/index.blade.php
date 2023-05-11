@extends('app')

@section('title', 'Patients')

@section('content')

  <div class="flex flex-col w-full h-full p-0 m-0 relative">
    @include('layouts.header')

    @include('layouts.sidebar')

    <main class="block flex-grow flex-shrink-0 w-auto h-auto p-0 mt-14 ml-0 lg:mt-16 lg:ml-64">
      <div class="block w-full max-w-7xl h-auto p-4 mx-auto overflow-hidden xl:m-0">
        <nav class="block w-full h-auto p-0 m-0 bg-white rounded whitespace-nowrap relative">
          <ol class="block w-full h-auto p-0 m-0 overflow-hidden">
            <li class="inline-block w-auto h-auto p-0 m-0 leading-6 relative [&+li::before]:content-['/'] [&+li::before]:mx-1 [&+li::before]:text-black/[0.60]">
              <a class="inline-block w-auto h-auto p-0 m-0 body-1 text-red-500 no-underline outline-none cursor-pointer hover:underline focus:underline active:underline" href="{{ route('dashboard.index') }}">
                Dashboard
              </a>
            </li>
            <li class="inline-block w-auto h-auto p-0 m-0 leading-6 relative [&+li::before]:content-['/'] [&+li::before]:mx-1 [&+li::before]:text-black/[0.60]">
              <span class="inline-block w-auto h-auto p-0 m-0 body-1 text-black/[0.60] cursor-default">
                Patients
              </span>
            </li>
          </ol>
        </nav>

        @if (session()->has('message'))
          <div class="hidden w-full h-14 justify-between items-center p-2 mt-4 rounded-lg bg-success-100 text-success-700 subtitle-2 data-[te-alert-show]:flex" role="alert" data-te-alert-init data-te-alert-show>
            <div class="inline-block w-auto h-auto p-2 ml-0 relative">
              <strong class="inline-block p-0 m-0 relative">Successfully!</strong> {{ session()->get('message') }}
            </div>
            <div class="inline-block w-auto h-auto p-0 m-0 relative">
              <button class="block w-10 h-10 p-2 m-0 text-success-900 rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out opacity-50 hover:opacity-75 focus:opacity-100" type="button" data-te-alert-dismiss data-te-ripple-init data-te-ripple-color="light" aria-label="Close">
                <svg 
                  class="pointer-events-none w-6 h-6 fill-current"
                  xmlns="http://www.w3.org/2000/svg" 
                  height="24px" 
                  viewBox="0 0 24 24" 
                  width="24px" 
                  fill="#000000"
                >
                  <path d="M0 0h24v24H0z" fill="none"/>
                  <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
              </button>
            </div>
          </div>
        @endif
    
        <div class="block w-full h-auto p-0 mt-4 rounded bg-white text-black/[0.87] shadow-01dp">
          <div class="block w-full h-auto p-0 m-0 overflow-hidden">
            <div class="flex justify-between items-center w-full h-16 p-2 m-0 relative">
              <div class="flex-1 inline-block p-2 m-0 overflow-hidden relative">
                <h6 class="block w-full h-auto p-0 m-0 headline-6 text-black/[0.87] whitespace-nowrap overflow-hidden text-ellipsis">
                  All patients
                </h6>
              </div>
              <div class="inline-block w-auto h-auto p-0 m-0 relative">
                <a class="block w-10 h-10 p-2 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ route('patients.create') }}" data-te-toggle="tooltip" title="Create" data-te-ripple-init data-te-ripple-color="light" aria-label="Create">
                  <svg 
                    class="pointer-events-none w-6 h-6 fill-current"
                    xmlns="http://www.w3.org/2000/svg" 
                    height="24px" 
                    viewBox="0 0 24 24" 
                    width="24px" 
                    fill="#000000"
                  >
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                  </svg>
                </a>
              </div>
            </div>
          </div>
          <div class="block w-full h-auto p-0 m-0 overflow-x-auto">
            <table class="table-auto table w-full h-auto p-0 m-0 border-spacing-0">
              <thead class="table-header-group">
                <tr class="table-row w-full h-auto p-0 m-0 align-middle text-inherit bg-white outline-none">
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Name
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Email
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Date of Birth
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Address
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Patient
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Allergy
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Status
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Gender
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-left uppercase select-none whitespace-nowrap relative">
                    Specialist
                  </th>
                  <th class="table-cell h-10 px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-xs text-black/[0.87] text-center uppercase select-none whitespace-nowrap relative">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="table-row-group">
                @forelse ($patients as $patient)
                  <tr class="table-row w-full h-auto p-0 m-0 align-middle text-inherit bg-white outline-none hover:bg-black/[0.04]">
                    <td class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] subtitle-2 text-black/[0.87] text-left select-auto whitespace-nowrap relative">
                      {{ $patient->name }}
                    </td>
                    <th class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-left select-auto whitespace-nowrap relative">
                      <a class="inline-block w-auto h-auto p-0 m-0 body-2 text-red-500 no-underline cursor-pointer hover:underline focus:underline active:underline" href="{{ route('users.index', ['id' => $patient->user->id]) }}">
                        {{ $patient->user->email }}
                      </a>
                    </td>
                    <td class="table-cell w-auto h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-left select-auto whitespace-nowrap relative">
                      {{ $patient->date_of_birth }}
                    </td>
                    <td class="table-cell min-w-[256px] h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-left select-auto whitespace-normal relative">
                      {{ $patient->address }}
                    </td>
                    <td class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-left select-auto whitespace-nowrap relative">
                      @if ($patient->type === 'JKN')
                        <span class="inline-block w-auto h-6 px-2.5 m-0 bg-green-500/[0.04] text-green-500 font-Roboto caption font-medium rounded-full align-middle leading-6 select-none">JKN</span>
                      @else
                        <span class="inline-block w-auto h-6 px-2.5 m-0 bg-red-500/[0.04] text-yellow-500 font-Roboto caption font-medium rounded-full align-middle leading-6 select-none">General</span>
                      @endif
                    </td>
                    <td class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-left select-auto whitespace-nowrap relative">
                      {{ $patient->allergy }}
                    </td>
                    <td class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-left select-auto whitespace-nowrap relative">
                      {{ $patient->status }}
                    </td>
                    <td class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-left select-auto whitespace-nowrap relative">
                      {{ $patient->gender }}
                    </td>
                    <td class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-left select-auto whitespace-nowrap relative">
                      <a class="inline-block w-auto h-auto p-0 m-0 body-2 text-red-500 no-underline cursor-pointer hover:underline focus:underline active:underline" href="{{ route('doctors.index', ['id' => $patient->doctor->id]) }}">
                        {{ $patient->doctor->specialist }}
                      </a>
                    </td>
                    <td class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-center select-auto whitespace-nowrap relative">
                      <form action="{{ route('patients.destroy', $patient->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <a class="inline-block w-10 h-10 p-2 mx-auto text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ route('forms.edit', $patient->id) }}" data-te-toggle="tooltip" title="Forms" data-te-ripple-init data-te-ripple-color="light" aria-label="Forms">
                          <svg 
                            class="pointer-events-none w-6 h-6 fill-current" 
                            xmlns="http://www.w3.org/2000/svg" 
                            height="24px" 
                            viewBox="0 0 24 24" 
                            width="24px" 
                            fill="#000000"
                          >
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                          </svg>
                        </a>
                        <a class="inline-block w-10 h-10 p-2 mx-auto text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ route('patients.edit', $patient->id) }}" data-te-toggle="tooltip" title="Edit" data-te-ripple-init data-te-ripple-color="light" aria-label="Edit">
                          <svg 
                            class="pointer-events-none w-6 h-6 fill-current" 
                            xmlns="http://www.w3.org/2000/svg" 
                            height="24px"
                            viewBox="0 0 24 24" 
                            width="24px" 
                            fill="#000000"
                          >
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                          </svg>
                        </a>
                        <button class="inline-block w-10 h-10 p-2 mx-auto text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" type="submit" data-te-toggle="tooltip" title="Delete" data-te-ripple-init data-te-ripple-color="light" aria-label="Delete">
                          <svg 
                            class="pointer-events-none w-6 h-6 fill-current" 
                            xmlns="http://www.w3.org/2000/svg" 
                            height="24px" 
                            viewBox="0 0 24 24" 
                            width="24px" 
                            fill="#000000"
                          >
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                          </svg>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr class="table-row w-full h-auto p-0 m-0 align-middle text-inherit bg-white outline-none hover:bg-transparent">
                    <td class="table-cell h-[52px] px-4 m-0 border-b border-solid border-black/[0.12] body-2 text-black/[0.87] text-center select-auto whitespace-nowrap relative" colspan="10">
                      No data.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="block w-full h-auto p-0 m-0 overflow-x-auto">
            <div class="flex justify-start items-center w-full h-[52px] p-2 m-0 relative">
              {{ $patients->links('layouts.pagination') }}
            </div>
          </div>
        </div>
      </div>
    </main>

    @include('layouts.footer')

  </div>

@endsection
