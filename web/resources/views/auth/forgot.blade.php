@extends('app')

@section('title', 'Login')

@section('content')
  <div class="flex flex-col w-full h-full p-0 m-0 relative sm:before:block sm:before:h-6 sm:before:min-h-[24px] sm:before:flex-grow sm:after:block sm:after:h-6 sm:after:min-h-[24px] sm:after:flex-grow">
    <div class="flex flex-col flex-shrink-0 w-full max-w-md min-h-screen h-auto p-0 mx-auto my-0 bg-white shadow-none border-0 border-solid border-black/[0.12] rounded-lg relative sm:block sm:min-h-0 sm:shadow-01dp sm:border">
      <form class="flex flex-col w-full h-full min-h-0 p-0 m-0 overflow-x-hidden overflow-y-auto outline-none relative sm:h-auto sm:min-h-[500px]" action="{{ route('forgot.email') }}" method="post" autocomplete="off" autocapitalize="off">
        @csrf
        @method('POST')

        <div class="flex flex-col flex-grow-0 w-full h-auto px-4 py-4 m-0 relative lg:px-6">
          <div class="inline-block p-0 my-4 overflow-hidden relative">
            <img 
              class="block w-12 h-auto p-0 mx-auto align-middle select-none"
              src="{{ asset('img/logo-app.png') }}" 
              alt="Clinics App"
            />
            <span class="block w-full h-auto p-0 mt-3 headline-5 text-black/[0.87] text-center truncate">
              Find your email
            </span>
          </div>
        </div>
        
        @if (session()->has('message'))
          <div class="hidden w-auto h-14 justify-between items-center p-2 mx-4 rounded-lg bg-success-100 text-success-700 subtitle-2 data-[te-alert-show]:flex lg:mx-6" role="alert" data-te-alert-init data-te-alert-show>
            <div class="inline-block w-auto h-auto p-2 ml-0 relative">
              {{ session()->get('message') }}
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

        <div class="flex flex-col flex-grow-0 w-full h-auto px-4 py-4 m-0 relative lg:px-6">
          <div class="flex justify-between content-start flex-wrap gap-4 w-full max-w-3xl h-auto p-0 mb-0 relative sm:flex-nowrap">
            <div class="inline-block min-w-0 w-full h-auto p-0 m-0 relative sm:w-full">
              <div class="block p-0 m-0 relative" data-te-input-wrapper-init data-te-class-notch-leading-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[-1px_0_0_#ef4444,_0_1px_0_0_#ef4444,_0_-1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-middle-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500" data-te-class-notch-trailing-normal="border-black/[0.12] group-data-[te-input-focused]:shadow-[1px_0_0_#ef4444,_0_-1px_0_0_#ef4444,_0_1px_0_0_#ef4444] group-data-[te-input-focused]:border-red-500">
                <input class="peer block min-h-[auto] w-full rounded border-0 bg-white py-[0.32rem] px-3 leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="text" id="email" name="email" placeholder="Email" value="{{ old('email') }}" />
                <label class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-black/[0.60] transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-red-500 peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none" for="email">
                  Email
                </label>
              </div>
              @error('email')
                <div class="block w-full h-auto p-0 mt-2 relative">
                  <span class="block p-0 m-0 body-2 text-red-500 break-words">
                    {{ $message }}
                  </span>
                </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="flex flex-col flex-grow-0 w-full h-auto px-4 py-4 m-0 relative lg:px-6">
          <div class="inline-block w-auto h-auto p-0 m-0 relative">
            <button class="relative inline-block border-none rounded py-2 px-4 m-0 min-w-[64px] w-full h-9 align-middle button text-center text-white bg-red-500 shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] overflow-hidden outline-none cursor-pointer transition-all hover:shadow-[0_2px_4px_-1px_rgba(0,0,0,0.2),_0_4px_5px_0_rgba(0,0,0,0.14),_0_1px_10px_0_rgba(0,0,0,0.12)] focus:shadow-[0_2px_4px_-1px_rgba(0,0,0,0.2),_0_4px_5px_0_rgba(0,0,0,0.14),_0_1px_10px_0_rgba(0,0,0,0.12)] active:shadow-[0_5px_5px_-3px_rgba(0,0,0,0.2),_0_8px_10px_1px_rgba(0,0,0,0.14),_0_3px_14px_2px_rgba(0,0,0,0.12)] disabled:text-black/[0.38] disabled:bg-black/[0.12] disabled:shadow-none disabled:cursor-default" type="submit" data-te-ripple-init data-te-ripple-color="light">
              Send Password Reset Link
            </button>
          </div>
        </div>

        <div class="flex flex-col flex-grow w-full h-auto px-4 py-4 m-0 relative lg:px-6">
          <div class="block w-auto h-auto p-0 m-0 absolute left-1/2 bottom-4 -translate-x-1/2 z-auto">
            <span class="inline-block w-auto h-auto p-0 m-0 caption text-black/[0.60] align-middle whitespace-nowrap">
              &copy Clinics App {{ now()->year }}, All Rights Reserved.
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
