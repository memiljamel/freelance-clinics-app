@extends('app')

@section('title', 'Doctors')

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
              <a class="inline-block w-auto h-auto p-0 m-0 body-1 text-red-500 no-underline outline-none cursor-pointer hover:underline focus:underline active:underline" href="{{ route('doctors.index') }}">
                Doctors
              </a>
            </li>
            <li class="inline-block w-auto h-auto p-0 m-0 leading-6 relative [&+li::before]:content-['/'] [&+li::before]:mx-1 [&+li::before]:text-black/[0.60]">
              <span class="inline-block w-auto h-auto p-0 m-0 body-1 text-black/[0.60] cursor-default">
                Edit
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
          <form class="flex flex-col w-full h-auto outline-none relative" action="{{ route('doctors.update', $doctor->id) }}" method="post" enctype="multipart/form-data" autocomplete="off" autocapitalize="off">
            @csrf
            @method('PATCH')

            <div class="flex justify-between items-center w-full h-16 p-2 m-0 relative">
              <div class="inline-block w-auto h-auto p-0 m-0 relative">
                <a class="block w-10 h-10 p-2 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ route('doctors.index') }}" data-te-toggle="tooltip" title="Back" data-te-ripple-init data-te-ripple-color="light" aria-label="Back">
                  <svg 
                    class="pointer-events-none w-6 h-6 fill-current"
                    xmlns="http://www.w3.org/2000/svg" 
                    height="24px" 
                    viewBox="0 0 24 24" 
                    width="24px" 
                    fill="#000000"
                  >
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                  </svg>
                </a>
              </div>
              <div class="flex-1 inline-block p-2 ml-2 overflow-hidden relative">
                <h6 class="block w-full h-auto p-0 m-0 headline-6 text-black/[0.87] truncate">
                  Edit
                </h6>
              </div>
            </div>

            <div class="flex flex-col w-full h-auto p-4 m-0 border-y border-solid border-black/[0.12] overflow-x-hidden overflow-y-auto relative lg:px-6">
              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-6 relative sm:flex-nowrap">
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-full">
                  <div class="flex justify-center items-center flex-wrap gap-4 w-auto h-auto p-0 m-0 relative sm:justify-start sm:flex-nowrap" data-te-container="images">
                    <div class="inline-block min-w-0 w-auto h-auto p-0 m-0 relative sm:w-auto">
                      <img 
                        class="block w-32 h-32 p-0.5 m-0 rounded-full align-middle ring-2 ring-red-500" 
                        src="{{ $doctor->avatar_url }}" 
                        alt="Default avatar"
                      />
                    </div>
                    <div class="inline-block min-w-0 w-auto h-auto p-0 m-0 relative sm:w-auto">
                      <label class="block w-auto h-auto p-0 m-0 relative">
                        <span class="sr-only">Choose profile photo</span>
                        <input class="block w-full text-sm text-black/[0.60] outline-none file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-red-500/[0.04] file:text-red-500 hover:file:bg-red-500/[0.04] active:file:bg-red-500/[0.10] focus:file:bg-red-500/[0.12]" type="file" id="avatar" name="avatar" accept="image/*" />
                      </label>
                    </div>
                  </div>
                  @error('avatar')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-4 relative sm:flex-nowrap">
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-full">
                  <div class="block p-0 m-0 relative" data-te-input-wrapper-init data-te-class-notch-leading-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[-1px_0_0_#ef4444,_0_1px_0_0_#ef4444,_0_-1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-middle-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-trailing-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[1px_0_0_#ef4444,_0_-1px_0_0_#ef4444,_0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500">
                    <input class="peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="text" id="name" name="name" placeholder="Name" value="{{ $doctor->name }}" />
                    <label class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-black/[0.60] transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-red-500 peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none" for="name">
                      Name
                    </label>
                  </div>
                  @error('name')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-6 relative sm:flex-nowrap">
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-full">
                  <div class="block p-0 m-0 relative">
                    <select class="hidden w-full" data-te-select-init data-te-select-auto-select="true" data-te-select-size="lg" data-te-select-filter="true" data-te-class-select-arrow="absolute right-2.5 text-[0.8rem] cursor-pointer peer-focus:text-red-500 peer-data-[te-input-focused]:text-red-500 group-data-[te-was-validated]/validation:peer-valid:text-green-600 group-data-[te-was-validated]/validation:peer-invalid:text-red-500 w-5 h-5" data-te-class-select-label="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate text-black/[0.60] transition-all duration-200 ease-out peer-focus:scale-[0.8] peer-focus:text-red-500 peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none data-[te-input-state-active]:scale-[0.8]" data-te-class-select-filter-input="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-gray-300 bg-transparent bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition duration-300 ease-in-out motion-reduce:transition-none focus:border-red-500 focus:text-gray-700 focus:shadow-[0_0_0_1px_#ef4444] focus:outline-none" name="specialist">
                      @foreach ($specialists as $specialist)  
                        <option value="{{ $specialist }}" @if ($specialist === $doctor->specialist) selected @endif>
                          {{ $specialist }}
                        </option>
                      @endforeach
                    </select>
                    <label for="specialist" data-te-select-label-ref>
                      Specialist
                    </label>
                  </div>
                  @error('specialist')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-2 relative sm:flex-nowrap">
                <span class="block w-full h-auto p-0 m-0 caption text-black/[0.60] truncate">
                  Date
                </span>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-6 relative sm:flex-nowrap">
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-6/12">
                  <div class="block p-0 m-0 relative">
                    <select class="hidden w-full" data-te-select-init data-te-select-auto-select="true" data-te-select-size="lg" data-te-class-select-arrow="absolute right-2.5 text-[0.8rem] cursor-pointer peer-focus:text-red-500 peer-data-[te-input-focused]:text-red-500 group-data-[te-was-validated]/validation:peer-valid:text-green-600 group-data-[te-was-validated]/validation:peer-invalid:text-red-500 w-5 h-5" data-te-class-select-label="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate text-black/[0.60] transition-all duration-200 ease-out peer-focus:scale-[0.8] peer-focus:text-red-500 peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none data-[te-input-state-active]:scale-[0.8]" data-te-class-select-filter-input="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-gray-300 bg-transparent bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition duration-300 ease-in-out motion-reduce:transition-none focus:border-red-500 focus:text-gray-700 focus:shadow-[0_0_0_1px_#ef4444] focus:outline-none" name="day">
                      @foreach ($days as $day)
                        <option value="{{ $day }}" @if ($day === $doctor->day) selected @endif>
                          {{ $day }}
                        </option>
                      @endforeach
                    </select>
                    <label for="day" data-te-select-label-ref>
                      Day
                    </label>
                  </div>
                  @error('day')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
      
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-6/12">
                  <div class="block p-0 m-0 relative" data-te-datepicker-init data-te-input-wrapper-init data-te-format="yyyy-mm-dd" data-te-class-notch-leading-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[-1px_0_0_#ef4444,_0_1px_0_0_#ef4444,_0_-1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-middle-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-trailing-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[1px_0_0_#ef4444,_0_-1px_0_0_#ef4444,_0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-datepicker-header="xs:max-md:landscape:h-full h-[120px] px-6 bg-red-500 flex flex-col rounded-t-lg" data-te-class-datepicker-footer-btn="outline-none bg-white text-red-500 border-none cursor-pointer py-0 px-2.5 uppercase text-[0.8rem] leading-10 font-medium h-10 tracking-[.1rem] rounded-[10px] mb-2.5 hover:bg-neutral-200 focus:bg-neutral-200" data-te-class-datepicker-cell-content="mx-auto group-[:not([data-te-datepicker-cell-disabled]):not([data-te-datepicker-cell-selected]):hover]:bg-neutral-300 group-[[data-te-datepicker-cell-selected]]:bg-red-500 group-[[data-te-datepicker-cell-selected]]:text-white group-[:not([data-te-datepicker-cell-selected])[data-te-datepicker-cell-focused]]:bg-neutral-100 group-[[data-te-datepicker-cell-focused]]:data-[te-datepicker-cell-selected]:bg-red-500 group-[[data-te-datepicker-cell-current]]:border-solid group-[[data-te-datepicker-cell-current]]:border-black group-[[data-te-datepicker-cell-current]]:border">
                    <input class="peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="text" id="date" name="date" placeholder="Date" value="{{ $doctor->date }}" />
                    <label class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-black/[0.60] transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-red-500 peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none" for="date">
                      Date
                    </label>
                    <button class="block w-8 h-8 p-1.5 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out absolute right-1 top-1/2 -translate-y-1/2 hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" type="button" data-te-datepicker-toggle-ref data-te-datepicker-toggle-button-ref>
                      <svg 
                        class="pointer-events-none w-5 h-5 fill-current"
                        xmlns="http://www.w3.org/2000/svg" 
                        height="24px" 
                        viewBox="0 0 24 24" 
                        width="24px" 
                        fill="#000000"
                      >
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                      </svg>
                    </button>
                  </div>
                  @error('date')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-2 relative sm:flex-nowrap">
                <span class="block w-full h-auto p-0 m-0 caption text-black/[0.60] truncate">
                  Office Hours
                </span>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-4 relative sm:flex-nowrap">
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-6/12">
                  <div class="block p-0 m-0 relative" data-te-timepicker-init data-te-input-wrapper-init data-te-format24="true" data-te-append-validation-info="false" data-te-class-notch-leading-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[-1px_0_0_#ef4444,_0_1px_0_0_#ef4444,_0_-1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-middle-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-trailing-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[1px_0_0_#ef4444,_0_-1px_0_0_#ef4444,_0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-timepicker-head="bg-red-500 h-[100px] rounded-t-lg pr-[24px] pl-[50px] py-[10px] min-[320px]:max-[825px]:landscape:rounded-tr-none min-[320px]:max-[825px]:landscape:rounded-bl-none min-[320px]:max-[825px]:landscape:p-[10px] min-[320px]:max-[825px]:landscape:pr-[10px] min-[320px]:max-[825px]:landscape:h-auto min-[320px]:max-[825px]:landscape:min-h-[305px] flex flex-row items-center justify-center" data-te-class-timepicker-footer-button="text-[0.8rem] min-w-[64px] box-border font-medium leading-[40px] rounded-[10px] tracking-[0.1rem] uppercase text-red-500 border-none bg-transparent transition-[background-color,box-shadow,border] duration-[250ms] ease-[cubic-bezier(0.4,0,0.2,1)] delay-[0ms] outline-none py-0 px-[10px] h-[40px] mb-[10px] hover:bg-[#00000014] focus:bg-[#00000014] focus:outline-none" data-te-class-timepicker-middle-dot="top-1/2 left-1/2 w-[6px] h-[6px] -translate-y-1/2 -translate-x-1/2 rounded-[50%] bg-red-500 absolute" data-te-class-timepicker-hand-pointer="bg-red-500 bottom-1/2 h-2/5 left-[calc(50%-1px)] rtl:!left-auto origin-[center_bottom_0] rtl:!origin-[50%_50%_0] w-[2px] absolute" data-te-class-timepicker-pointer-circle="-top-[21px] -left-[15px] w-[4px] border-[14px] border-solid border-red-500 h-[4px] box-content rounded-[100%] absolute !bg-red-500">
                    <input class="peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="text" id="start_time" name="start_time" value="{{ $doctor->start_time }}" />
                    <label class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-black/[0.60] transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-red-500 peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none" for="start_time">
                      Start time
                    </label>
                    <button class="block w-8 h-8 p-1.5 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out absolute right-1 top-1/2 -translate-y-1/2 hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" type="button" data-te-toggle="timepicker-with-button" data-te-timepicker-toggle-button data-te-timepicker-icon>
                      <svg 
                        class="pointer-events-none w-5 h-5 fill-current"
                        xmlns="http://www.w3.org/2000/svg" 
                        height="24px" 
                        viewBox="0 0 24 24" 
                        width="24px" 
                        fill="#000000"
                      >
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                        <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                      </svg>
                    </button>
                  </div>
                  @error('start_time')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
      
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-6/12">
                  <div class="block p-0 m-0 relative" data-te-timepicker-init data-te-input-wrapper-init data-te-format24="true" data-te-append-validation-info="false" data-te-class-notch-leading-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[-1px_0_0_#ef4444,_0_1px_0_0_#ef4444,_0_-1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-middle-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-trailing-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[1px_0_0_#ef4444,_0_-1px_0_0_#ef4444,_0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-timepicker-head="bg-red-500 h-[100px] rounded-t-lg pr-[24px] pl-[50px] py-[10px] min-[320px]:max-[825px]:landscape:rounded-tr-none min-[320px]:max-[825px]:landscape:rounded-bl-none min-[320px]:max-[825px]:landscape:p-[10px] min-[320px]:max-[825px]:landscape:pr-[10px] min-[320px]:max-[825px]:landscape:h-auto min-[320px]:max-[825px]:landscape:min-h-[305px] flex flex-row items-center justify-center" data-te-class-timepicker-footer-button="text-[0.8rem] min-w-[64px] box-border font-medium leading-[40px] rounded-[10px] tracking-[0.1rem] uppercase text-red-500 border-none bg-transparent transition-[background-color,box-shadow,border] duration-[250ms] ease-[cubic-bezier(0.4,0,0.2,1)] delay-[0ms] outline-none py-0 px-[10px] h-[40px] mb-[10px] hover:bg-[#00000014] focus:bg-[#00000014] focus:outline-none" data-te-class-timepicker-middle-dot="top-1/2 left-1/2 w-[6px] h-[6px] -translate-y-1/2 -translate-x-1/2 rounded-[50%] bg-red-500 absolute" data-te-class-timepicker-hand-pointer="bg-red-500 bottom-1/2 h-2/5 left-[calc(50%-1px)] rtl:!left-auto origin-[center_bottom_0] rtl:!origin-[50%_50%_0] w-[2px] absolute" data-te-class-timepicker-pointer-circle="-top-[21px] -left-[15px] w-[4px] border-[14px] border-solid border-red-500 h-[4px] box-content rounded-[100%] absolute !bg-red-500">
                    <input class="peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="text" id="end_time" name="end_time" value="{{ $doctor->end_time }}" />
                    <label class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-black/[0.60] transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-red-500 peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none" for="end_time">
                      End time
                    </label>
                    <button class="block w-8 h-8 p-1.5 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out absolute right-1 top-1/2 -translate-y-1/2 hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" type="button" data-te-toggle="timepicker-with-button" data-te-timepicker-toggle-button data-te-timepicker-icon>
                      <svg 
                        class="pointer-events-none w-5 h-5 fill-current"
                        xmlns="http://www.w3.org/2000/svg" 
                        height="24px" 
                        viewBox="0 0 24 24" 
                        width="24px" 
                        fill="#000000"
                      >
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                        <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                      </svg>
                    </button>
                  </div>
                  @error('end_time')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-6 relative sm:flex-nowrap">
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-full">
                  <div class="block p-0 m-0 relative" data-te-input-wrapper-init data-te-class-notch-leading-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[-1px_0_0_#ef4444,_0_1px_0_0_#ef4444,_0_-1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-middle-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-trailing-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[1px_0_0_#ef4444,_0_-1px_0_0_#ef4444,_0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500">
                    <input class="peer block min-h-[auto] w-full rounded border-0 bg-transparent py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="text" id="room" placeholder="Room" name="room" value="{{ $doctor->room }}" />
                    <label class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-black/[0.60] transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-red-500 peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none" for="room">
                      Room
                    </label>
                  </div>
                  @error('room')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-4 relative sm:flex-nowrap">
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-full">
                  <div class="block p-0 m-0 relative">
                    <label class="block w-full h-auto p-0 mb-2 caption text-black/[0.60] truncate" for="signature">
                      Signature
                    </label>
                    <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-black/[0.12] bg-clip-padding py-[0.32rem] px-3 font-normal leading-[2.15] text-black/[0.60] transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-black/[0.60] file:transition file:duration-150 file:ease-in-out file:[margin-inline-end:0.75rem] file:[border-inline-end-width:1px] hover:file:bg-neutral-200 focus:border-red-500 focus:text-neutral-700 focus:shadow-[0_0_0_1px] focus:shadow-red-500 focus:outline-none" type="file" id="signature" name="signature" accept="image/*" />
                  </div>
                  @error('signature')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @else
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block w-full h-auto p-0m-0 caption text-black/[0.60] truncate">
                        Please leave blank if there are no changes.
                      </span>
                    </div>
                  @enderror
                </div>
              </div>

              <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-0 relative sm:flex-nowrap">
                <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-full">
                  <div class="block p-0 m-0 relative">
                    <input class="mt-[0.3rem] mr-2 h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 outline-none before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-red-500 checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-red-500 checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-red-500 checked:focus:bg-red-500 checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#ef4444] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]" type="checkbox" id="active" name="active" value="{{ $doctor->active }}" @if ($doctor->active) checked @endif />
                    <label class="inline-block pl-[0.15rem] hover:cursor-pointer" for="active">
                      Active
                    </label>
                  </div>
                  @error('active')
                    <div class="block w-full h-auto p-0 mt-2 relative">
                      <span class="block p-0 m-0 body-2 text-red-500 break-words">
                        {{ $message }}
                      </span>
                    </div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="flex justify-end items-center gap-4 w-full h-[52px] p-2 m-0 relative">
              <div class="inline-block w-auto h-auto p-0 m-0 relative">
                <button class="block w-auto min-w-[64px] h-9 p-2 m-0 cursor-pointer bg-transparent rounded shadow-none button text-center text-red-500 select-none align-middle outline-none relative hover:bg-red-500/[0.04] active:bg-red-500/[0.10] focus:bg-red-500/[0.12]" type="reset" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                  Reset
                </button>
              </div>
              <div class="inline-block w-auto h-auto p-0 m-0 relative">
                <button class="block w-auto min-w-[64px] h-9 p-2 m-0 cursor-pointer bg-transparent rounded shadow-none button text-center text-red-500 select-none align-middle outline-none relative hover:bg-red-500/[0.04] active:bg-red-500/[0.10] focus:bg-red-500/[0.12]" type="submit" data-te-ripple-init data-te-ripple-color="light">
                  Submit
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>

    @include('layouts.footer')

  </div>
  
@endsection
