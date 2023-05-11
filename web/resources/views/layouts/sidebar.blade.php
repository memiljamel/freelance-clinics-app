<aside class="block w-auto h-full p-0 m-0 !visible overflow-hidden transition-transform -translate-x-full fixed top-0 left-0 z-[1045] lg:translate-x-0 lg:z-30 [&[data-te-offcanvas-show]]:transform-none [&[data-te-offcanvas-show]]:shadow-16dp" id="offcanvasExample" tabindex="-1" data-te-offcanvas-init>
  <div class="block w-64 h-full bg-white border-r border-solid border-black/[0.12] shadow-none overflow-x-hidden overflow-y-auto">
    <div class="block w-full h-14 p-0 m-0 relative lg:h-16">
      <div class="inline-block w-full h-auto p-2 my-0 whitespace-nowrap relative lg:py-3">
        <a class="inline-block w-auto h-10 px-2 py-1.5 m-0 no-underline select-none outline-none" href="{{ route('dashboard.index') }}">
          <span class="inline-block w-auto h-auto p-0 m-0 headline-6 text-black/[0.87] align-middle">
            {{ config('app.name', 'Laravel') }}
          </span>
        </a>
      </div>
    </div>

    <ul class="block w-full h-auto py-2 pr-2 m-0 list-none border-t border-solid border-black/[0.12] shadow-none relative">
      <li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
        <a 
          class="group flex justify-between items-center gap-4 w-full h-12 py-3 px-4 m-0 mr-2 subtitle-1 text-black/[0.60] rounded-r-full no-underline outline-none whitespace-nowrap overflow-hidden text-ellipsis select-none hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] open:bg-red-500/[0.04] open:text-red-500 open:hover:bg-red-500/[0.04] open:active:bg-red-500/[0.10] open:focus:bg-red-500/[0.12]" 
          href="{{ route('dashboard.index') }}"
          @if (request()->routeIs('dashboard.*')) open @endif
        >
          <div class="inline-block w-auto h-auto relative">
            <svg
              class="pointer-events-none w-6 h-6 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              height="24px"
              viewBox="0 0 24 24"
              width="24px"
              fill="#000000"
            >
              <path d="M0 0h24v24H0z" fill="none" />
              <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
            </svg>
          </div>
          <div class="flex-1 inline-block w-full h-auto overflow-hidden relative">
            <span class="block w-full h-auto p-0 m-0 text-black/[0.87] truncate group-open:text-red-500">
              Dashboard
            </span>
          </div>
        </a>
      </li>
      <li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
        <a 
          class="group flex justify-between items-center gap-4 w-full h-12 py-3 px-4 m-0 mr-2 subtitle-1 text-black/[0.60] rounded-r-full no-underline outline-none whitespace-nowrap overflow-hidden text-ellipsis select-none hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] open:bg-red-500/[0.04] open:text-red-500 open:hover:bg-red-500/[0.04] open:active:bg-red-500/[0.10] open:focus:bg-red-500/[0.12]" 
          href="/#"
          @if (request()->routeIs('queue.*')) open @endif
        >
          <div class="inline-block w-auto h-auto relative">
            <svg
              class="pointer-events-none w-6 h-6 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              enableBackground="new 0 0 24 24"
              height="24px"
              viewBox="0 0 24 24"
              width="24px"
              fill="#000000"
            >
              <g>
                <rect fill="none" height="24" width="24" />
              </g>
              <g>
                <path d="M6,2l0.01,6L10,12l-3.99,4.01L6,22h12v-6l-4-4l4-3.99V2H6z M16,16.5V20H8v-3.5l4-4L16,16.5z" />
              </g>
            </svg>
          </div>
          <div class="flex-1 inline-block w-full h-auto overflow-hidden relative">
            <span class="block w-full h-auto p-0 m-0 text-black/[0.87] truncate group-open:text-red-500">
              Waiting List
            </span>
          </div>
        </a>
      </li>
      <li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
        <a 
          class="group flex justify-between items-center gap-4 w-full h-12 py-3 px-4 m-0 mr-2 subtitle-1 text-black/[0.60] rounded-r-full no-underline outline-none whitespace-nowrap overflow-hidden text-ellipsis select-none hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] open:bg-red-500/[0.04] open:text-red-500 open:hover:bg-red-500/[0.04] open:active:bg-red-500/[0.10] open:focus:bg-red-500/[0.12]" 
          href="{{ route('patients.index') }}"
          @if (request()->routeIs('patients.*') || request()->routeIs('forms.*')) open @endif
        >
          <div class="inline-block w-auto h-auto relative">
            <svg
              class="pointer-events-none w-6 h-6 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              height="24px"
              viewBox="0 0 24 24"
              width="24px"
              fill="#000000"
            >
              <path d="M0 0h24v24H0z" fill="none" />
              <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
            </svg>
          </div>
          <div class="flex-1 inline-block w-full h-auto overflow-hidden relative">
            <span class="block w-full h-auto p-0 m-0 text-black/[0.87] truncate group-open:text-red-500">
              Patients
            </span>
          </div>
        </a>
      </li>
      <li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
        <a 
          class="group flex justify-between items-center gap-4 w-full h-12 py-3 px-4 m-0 mr-2 subtitle-1 text-black/[0.60] rounded-r-full no-underline outline-none whitespace-nowrap overflow-hidden text-ellipsis select-none hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] open:bg-red-500/[0.04] open:text-red-500 open:hover:bg-red-500/[0.04] open:active:bg-red-500/[0.10] open:focus:bg-red-500/[0.12]" 
          href="{{ route('doctors.index') }}"
          @if (request()->routeIs('doctors.*')) open @endif
        >
          <div class="inline-block w-auto h-auto relative">
            <svg
              class="pointer-events-none w-6 h-6 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              height="24px"
              viewBox="0 0 24 24"
              width="24px"
              fill="#000000"
            >
              <path d="M0 0h24v24H0z" fill="none" />
              <path d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
            </svg>
          </div>
          <div class="flex-1 inline-block w-full h-auto overflow-hidden relative">
            <span class="block w-full h-auto p-0 m-0 text-black/[0.87] truncate group-open:text-red-500">
              Doctors
            </span>
          </div>
        </a>
      </li>
      <li class="block w-full h-auto p-0 m-0 overflow-hidden relative">
        <a 
          class="group flex justify-between items-center gap-4 w-full h-12 py-3 px-4 m-0 mr-2 subtitle-1 text-black/[0.60] rounded-r-full no-underline outline-none whitespace-nowrap overflow-hidden text-ellipsis select-none hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] open:bg-red-500/[0.04] open:text-red-500 open:hover:bg-red-500/[0.04] open:active:bg-red-500/[0.10] open:focus:bg-red-500/[0.12]" 
          href="{{ route('users.index') }}"
          @if (request()->routeIs('users.*')) open @endif
        >
          <div class="inline-block w-auto h-auto relative">
            <svg
              class="pointer-events-none w-6 h-6 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              enableBackground="new 0 0 24 24"
              height="24px"
              viewBox="0 0 24 24"
              width="24px"
              fill="#000000"
            >
              <rect fill="none" height="24" width="24" />
              <g>
                <path d="M12,12.75c1.63,0,3.07,0.39,4.24,0.9c1.08,0.48,1.76,1.56,1.76,2.73L18,18H6l0-1.61c0-1.18,0.68-2.26,1.76-2.73 C8.93,13.14,10.37,12.75,12,12.75z M4,13c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2s-2,0.9-2,2C2,12.1,2.9,13,4,13z M5.13,14.1 C4.76,14.04,4.39,14,4,14c-0.99,0-1.93,0.21-2.78,0.58C0.48,14.9,0,15.62,0,16.43V18l4.5,0v-1.61C4.5,15.56,4.73,14.78,5.13,14.1z M20,13c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2s-2,0.9-2,2C18,12.1,18.9,13,20,13z M24,16.43c0-0.81-0.48-1.53-1.22-1.85 C21.93,14.21,20.99,14,20,14c-0.39,0-0.76,0.04-1.13,0.1c0.4,0.68,0.63,1.46,0.63,2.29V18l4.5,0V16.43z M12,6c1.66,0,3,1.34,3,3 c0,1.66-1.34,3-3,3s-3-1.34-3-3C9,7.34,10.34,6,12,6z" />
              </g>
            </svg>
          </div>
          <div class="flex-1 inline-block w-full h-auto overflow-hidden relative">
            <span class="block w-full h-auto p-0 m-0 text-black/[0.87] truncate group-open:text-red-500">
              Users
            </span>
          </div>
        </a>
      </li>
    </ul>
  </div>
</aside>
