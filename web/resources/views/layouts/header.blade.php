<header class="block w-full h-auto fixed top-0 left-0 right-0 z-20 lg:pl-64 lg:left-auto">
  <nav class="flex justify-between items-center w-full h-14 p-2 m-0 bg-red-500 shadow-04dp lg:h-16">

    <div class="inline-block w-auto h-auto p-0 m-0 relative">
      <div class="inline-block w-auto h-auto p-0 m-0 relative">
        <button class="block w-10 h-10 p-2 m-0 text-white rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out hover:bg-white/[0.04] active:bg-white/[0.10] focus:bg-white/[0.12] lg:w-12 lg:h-12 lg:p-3 lg:hidden" type="button" data-te-offcanvas-toggle data-te-target="#offcanvasExample" aria-controls="offcanvasExample" data-te-toggle="tooltip" title="Open menu" data-te-ripple-init data-te-ripple-color="light" aria-label="Open menu">
          <svg
            class="pointer-events-none w-6 h-6 fill-current"
            xmlns="http://www.w3.org/2000/svg"
            height="24px"
            viewBox="0 0 24 24"
            width="24px"
            fill="#000000"
          >
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
          </svg>
        </button>
      </div>
    </div>

    <div class="flex-1 inline-block w-full h-auto p-0 m-0 relative">
      <div class="block px-2 py-1.5 m-0 overflow-hidden relative">
        <h6 class="block w-full h-auto p-0 m-0 headline-6 text-white truncate">
          @yield('title')
        </h6>
      </div>
    </div>

    <div class="inline-block w-auto h-auto p-0 m-0 relative">
      <div class="inline-block w-auto h-auto p-0 m-0 relative" data-te-dropdown-ref>

        <button class="block w-10 h-10 p-2 m-0 text-white rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out hover:bg-white/[0.04] active:bg-white/[0.10] focus:bg-white/[0.12] lg:w-12 lg:h-12 lg:p-3" type="button" id="dropdownMenuButton" data-te-dropdown-toggle-ref data-te-dropdown-animation="off"  aria-expanded="false" data-te-toggle="tooltip" title="More options" data-te-ripple-init data-te-ripple-color="light" aria-label="More options">
          <svg
            class="pointer-events-none w-6 h-6 fill-current"
            xmlns="http://www.w3.org/2000/svg"
            height="24px"
            viewBox="0 0 24 24"
            width="24px"
            fill="#000000"
          >
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
          </svg>
        </button>

        <ul class="hidden w-[192px] h-auto py-2 m-0 list-none rounded-sm bg-white shadow-04dp absolute top-full right-0 z-20 [&[data-te-dropdown-show]]:block" aria-labelledby="dropdownMenuButton" data-te-dropdown-menu-ref>
          
          <li class="block w-full h-auto p-0 m-0 outline-none overflow-hidden relative">
            <a class="block w-full h-12 px-4 py-3 m-0 subtitle-1 text-black/[0.87] text-left no-underline outline-none truncate hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ route('home.index') }}" data-te-dropdown-item-ref data-te-ripple-init data-te-ripple-color="light">
              {{ __('Home') }}
            </a>
          </li>

          <li class="block w-full h-auto p-0 m-0 outline-none overflow-hidden relative">
            <a class="block w-full h-12 px-4 py-3 m-0 subtitle-1 text-black/[0.87] text-left no-underline outline-none truncate hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ route('profile.edit') }}" data-te-dropdown-item-ref data-te-ripple-init data-te-ripple-color="light">
              {{ __('Profile') }}
            </a>
          </li>

          <li class="block w-full h-auto p-0 m-0 outline-none overflow-hidden relative">
            <form class="block w-full h-auto p-0 m-0 relative" action="{{ route('logout') }}" method="post" autocomplete="off" autocapitalize="off">
              @csrf
              @method('POST')

              <button class="block w-full h-12 px-4 py-3 m-0 subtitle-1 text-black/[0.87] text-left no-underline outline-none truncate hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" type="submit" data-te-dropdown-item-ref data-te-ripple-init data-te-ripple-color="light">
                {{ __('Logout') }}
              </button>
            </form>
          </li>

        </ul>

      </div>
    </div>

  </nav>  
</header>
