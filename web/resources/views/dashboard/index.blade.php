@extends('app')

@section('title', 'Dashboard')

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
                Home
              </span>
            </li>
          </ol>
        </nav>

        <div class="flex justify-start items-stretch flex-wrap gap-4 p-0 mt-4 relative sm:flex-nowrap">

          <div class="block min-w-0 w-full h-auto p-0 m-0 relative sm:w-4/12">
            <div class="block w-full h-full p-4 m-0 bg-white rounded shadow-01dp overflow-hidden relative">
              <div class="flex justify-between items-center p-0 m-0 relative">
                <div class="flex-1 inline-block w-full h-auto pr-4 m-0 overflow-hidden relative">
                  <h5 class="block w-full h-auto p-0 m-0 text-black/[0.60] subtitle-2 text-xs text-left uppercase truncate">
                    Users
                  </h5>
                  <span class="block w-full h-auto p-0 m-0 text-black/[0.87] headline-6 text-left truncate">
                    {{ optional($user)->count() ?? 0 }}
                  </span>
                </div>
                <div class="inline-block w-auto h-auto p-0 m-0 relative">
                  <div class="block w-12 h-12 p-3 m-0 bg-red-500 rounded-full text-white shadow-lg relative">
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
                </div>
              </div>
              <div class="block w-full h-auto p-0 mt-4 overflow-hidden relative">
                <div class="flex justify-start items-center w-full h-auto p-0 m-0 relative">
                  @if (optional($user)->latest >= optional($user)->longest)
                    <div class="inline-block w-auto h-auto p-px m-0 text-green-500 align-middle relative">
                      <svg 
                        class="pointer-events-none w-[18px] h-[18px] fill-current"
                        xmlns="http://www.w3.org/2000/svg" 
                        height="24px" 
                        viewBox="0 0 24 24" 
                        width="24px" 
                        fill="#000000"
                      >
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                      </svg>
                    </div>
                    <span class="inline-block w-auto h-auto p-0 m-0 text-green-500 body-2 text-left align-middle truncate">
                      @if (optional($user)->count() > 0)
                        {{ number_format((optional($user)->latest - optional($user)->longest) / optional($user)->latest * 100, 2) }}%
                      @else
                        0.00%
                      @endif
                    </span>
                  @else
                    <div class="inline-block w-auto h-auto p-px m-0 text-red-500 align-middle relative">
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
                    <span class="inline-block w-auto h-auto p-0 m-0 text-red-500 body-2 text-left align-middle truncate">
                      @if (optional($user)->count() > 0)
                        {{ number_format((optional($user)->latest - optional($user)->longest) / optional($user)->latest * 100, 2) }}%
                      @else
                        0.00%
                      @endif
                    </span>
                  @endif
                  <span class="inline-block w-auto h-auto p-0 ml-4 text-black/[0.60] body-2 text-left align-middle truncate">
                    Since last month
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="block min-w-0 w-full h-auto p-0 m-0 relative sm:w-4/12">
            <div class="block w-full h-full p-4 m-0 bg-white rounded shadow-01dp overflow-hidden relative">
              <div class="flex justify-between items-center p-0 m-0 relative">
                <div class="flex-1 inline-block w-full h-auto pr-4 m-0 overflow-hidden relative">
                  <h5 class="block w-full h-auto p-0 m-0 text-black/[0.60] subtitle-2 text-xs text-left uppercase truncate">
                    Doctors
                  </h5>
                  <span class="block w-full h-auto p-0 m-0 text-black/[0.87] headline-6 text-left truncate">
                    {{ optional($doctor)->count() ?? 0 }}
                  </span>
                </div>
                <div class="inline-block w-auto h-auto p-0 m-0 relative">
                  <div class="block w-12 h-12 p-3 m-0 bg-red-500 rounded-full text-white shadow-lg relative">
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
                </div>
              </div>
              <div class="block w-full h-auto p-0 mt-4 overflow-hidden relative">
                <div class="flex justify-start items-center w-full h-auto p-0 m-0 relative">
                  @if (optional($doctor)->latest >= optional($doctor)->longest)
                    <div class="inline-block w-auto h-auto p-px m-0 text-green-500 align-middle relative">
                      <svg 
                        class="pointer-events-none w-[18px] h-[18px] fill-current"
                        xmlns="http://www.w3.org/2000/svg" 
                        height="24px" 
                        viewBox="0 0 24 24" 
                        width="24px" 
                        fill="#000000"
                      >
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                      </svg>
                    </div>
                    <span class="inline-block w-auto h-auto p-0 m-0 text-green-500 body-2 text-left align-middle truncate">
                      @if (optional($doctor)->count() > 0)
                        {{ number_format((optional($doctor)->latest - optional($doctor)->longest) / optional($doctor)->latest * 100, 2) }}%
                      @else
                        0.00%
                      @endif
                    </span>
                  @else
                    <div class="inline-block w-auto h-auto p-px m-0 text-red-500 align-middle relative">
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
                    <span class="inline-block w-auto h-auto p-0 m-0 text-red-500 body-2 text-left align-middle truncate">
                      @if (optional($doctor)->count() > 0)
                        {{ number_format((optional($doctor)->latest - optional($doctor)->longest) / optional($doctor)->latest * 100, 2) }}%
                      @else
                        0.00%
                      @endif
                    </span>
                  @endif
                  <span class="inline-block w-auto h-auto p-0 ml-4 text-black/[0.60] body-2 text-left align-middle truncate">
                    Since last month
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="block min-w-0 w-full h-auto p-0 m-0 relative sm:w-4/12">
            <div class="block w-full h-full p-4 m-0 bg-white rounded shadow-01dp overflow-hidden relative">
              <div class="flex justify-between items-center p-0 m-0 relative">
                <div class="flex-1 inline-block w-full h-auto pr-4 m-0 overflow-hidden relative">
                  <h5 class="block w-full h-auto p-0 m-0 text-black/[0.60] subtitle-2 text-xs text-left uppercase truncate">
                    Patients
                  </h5>
                  <span class="block w-full h-auto p-0 m-0 text-black/[0.87] headline-6 text-left truncate">
                    {{ optional($patient)->count() ?? 0 }}
                  </span>
                </div>
                <div class="inline-block w-auto h-auto p-0 m-0 relative">
                  <div class="block w-12 h-12 p-3 m-0 bg-red-500 rounded-full text-white shadow-lg relative">
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
                </div>
              </div>
              <div class="block w-full h-auto p-0 mt-4 overflow-hidden relative">
                <div class="flex justify-start items-center w-full h-auto p-0 m-0 relative">
                  @if (optional($patient)->latest >= optional($patient)->longest)
                    <div class="inline-block w-auto h-auto p-px m-0 text-green-500 align-middle relative">
                      <svg 
                        class="pointer-events-none w-[18px] h-[18px] fill-current"
                        xmlns="http://www.w3.org/2000/svg" 
                        height="24px" 
                        viewBox="0 0 24 24" 
                        width="24px" 
                        fill="#000000"
                      >
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                      </svg>
                    </div>
                    <span class="inline-block w-auto h-auto p-0 m-0 text-green-500 body-2 text-left align-middle truncate">
                      @if (optional($patient)->count() > 0)
                        {{ number_format((optional($patient)->latest - optional($patient)->longest) / optional($patient)->latest * 100, 2) }}%
                      @else
                        0.00%
                      @endif
                    </span>
                  @else
                    <div class="inline-block w-auto h-auto p-px m-0 text-red-500 align-middle relative">
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
                    <span class="inline-block w-auto h-auto p-0 m-0 text-red-500 body-2 text-left align-middle truncate">
                      @if (optional($patient)->count() > 0)
                        {{ number_format((optional($patient)->latest - optional($patient)->longest) / optional($patient)->latest * 100, 2) }}%
                      @else
                        0.00%
                      @endif
                    </span>
                  @endif
                  <span class="inline-block w-auto h-auto p-0 ml-4 text-black/[0.60] body-2 text-left align-middle truncate">
                    Since last month
                  </span>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="flex justify-start items-stretch flex-wrap gap-4 p-0 mt-4 relative sm:flex-nowrap">

          <div class="block min-w-0 w-full h-auto p-0 m-0 relative sm:w-8/12">
            <div class="block w-full h-full p-4 m-0 bg-white rounded shadow-01dp overflow-hidden relative">
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h5 class="block w-full h-auto p-0 m-0 text-black/[0.60] subtitle-2 text-xs text-left uppercase truncate">
                  Overview
                </h5>
                <span class="block w-full h-auto p-0 m-0 text-black/[0.87] headline-6 text-left truncate">
                  Patient Registration
                </span>
              </div>
              <div class="block w-full h-auto p-0 mt-4 overflow-hidden relative">
                <canvas id="line-chart"></canvas>
              </div>
            </div>
          </div>
          
          <div class="block min-w-0 w-full h-auto p-0 m-0 relative sm:w-4/12">
            <div class="block w-full h-full p-4 m-0 bg-white rounded shadow-01dp overflow-hidden relative">
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h5 class="block w-full h-auto p-0 m-0 text-black/[0.60] subtitle-2 text-xs text-left uppercase truncate">
                  Overview
                </h5>
                <span class="block w-full h-auto p-0 m-0 text-black/[0.87] headline-6 text-left truncate">
                  Patient Type
                </span>
              </div>
              <div class="block w-full h-auto p-0 mt-4 overflow-hidden relative">
                <canvas id="pie-chart"></canvas>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>

    @include('layouts.footer')
    
  </div>
@endsection

@push('scripts')
  <script>
    const dataLine = {{ 
      Illuminate\Support\Js::from(
        collect([
            optional($patient)->jan ?? 0, 
            optional($patient)->feb ?? 0, 
            optional($patient)->mar ?? 0, 
            optional($patient)->apr ?? 0, 
            optional($patient)->may ?? 0, 
            optional($patient)->jun ?? 0, 
            optional($patient)->jul ?? 0, 
            optional($patient)->aug ?? 0, 
            optional($patient)->sep ?? 0, 
            optional($patient)->oct ?? 0, 
            optional($patient)->nov ?? 0, 
            optional($patient)->dec ?? 0,
        ])->map(function ($item) {
            return strval($item);
        })->toArray()
      );
    }}
  </script>

  <script>
    const dataPie = {{ 
      Illuminate\Support\Js::from(
        collect([
            optional($patient)->general ?? 0, 
            optional($patient)->jkn ?? 0,
        ])->map(function ($item) {
            return strval($item);
        })->toArray()
      ); 
    }}
  </script>

  <script src="{{ mix('/js/charts.js') }}" defer></script>
@endpush
