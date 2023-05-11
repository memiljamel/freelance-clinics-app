@extends('app')

@section('title', 'Home')

@section('content')
  <header class="block w-full h-auto fixed top-0 left-0 right-0 z-20">
    <nav class="block w-full h-auto p-0 m-0 bg-white shadow-04dp overflow-hidden relative" data-te-navbar-ref>
      <div class="flex justify-between items-center flex-wrap w-full max-w-5xl min-h-[56px] p-2 mx-auto relative lg:min-h-[64px] lg:flex-nowrap">

        <div class="inline-block w-auto h-auto p-0 m-0 relative">
          <button class="block w-10 h-10 p-2 m-0 text-black/[0.60] rounded-full align-middle cursor-pointer outline-none transition duration-150 ease-in-out hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12] lg:w-12 lg:h-12 lg:p-3 lg:hidden" type="button" data-te-collapse-init data-te-target="#navbarSupportedContent" data-te-toggle="tooltip" title="Open menu" data-te-ripple-init data-te-ripple-color="light" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Open menu">
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

        <div class="flex-1 inline-block w-full h-auto p-0 m-0 relative lg:flex-none lg:w-auto">
          <a class="inline-block w-auto h-10 px-2 py-1.5 m-0 text-black/[0.87] headline-6 no-underline select-none outline-none align-middle" href="{{ route('home.index') }}">
            {{ config('app.name', 'Laravel') }}
          </a>
        </div>

        <div class="hidden flex-grow basis-[100%] items-center p-0 m-0 !visible lg:!flex lg:justify-between lg:items-center lg:basis-auto" id="navbarSupportedContent" data-te-collapse-item>
          <ul class="flex flex-col justify-start items-center w-auto h-auto p-0 mt-4 relative lg:flex-row lg:m-0" data-te-navbar-nav-ref>

            <li class="block w-full h-auto p-0 m0 overflow-hidden relative lg:inline-block lg:w-auto" data-te-nav-item-ref>
              <a class="block w-auto h-auto p-2 m-0 text-black/[0.60] subtitle-1 no-underline outline-none align-middle hover:text-red-500 hover:underline focus:text-red-500 focus:underline active:text-red-500 active:underline [&[class$='active']]:text-red-500" href="#home" data-te-nav-link-ref>
                Home
              </a>
            </li>

            <li class="block w-full h-auto p-0 m0 overflow-hidden relative lg:inline-block lg:w-auto" data-te-nav-item-ref>
              <a class="block w-auto h-auto p-2 m-0 text-black/[0.60] subtitle-1 no-underline outline-none align-middle hover:text-red-500 hover:underline focus:text-red-500 focus:underline active:text-red-500 active:underline [&[class$='active']]:text-red-500" href="#our-speciality" data-te-nav-link-ref>
                Our Speciality
              </a>
            </li>

            <li class="block w-full h-auto p-0 m0 overflow-hidden relative lg:inline-block lg:w-auto" data-te-nav-item-ref>
              <a class="block w-auto h-auto p-2 m-0 text-black/[0.60] subtitle-1 no-underline outline-none align-middle hover:text-red-500 hover:underline focus:text-red-500 focus:underline active:text-red-500 active:underline [&[class$='active']]:text-red-500" href="#about-us" data-te-nav-link-ref>
                About Us
              </a>
            </li>

            <li class="block w-full h-auto p-0 m0 overflow-hidden relative lg:inline-block lg:w-auto" data-te-nav-item-ref>
              <a class="block w-auto h-auto p-2 m-0 text-black/[0.60] subtitle-1 no-underline outline-none align-middle hover:text-red-500 hover:underline focus:text-red-500 focus:underline active:text-red-500 active:underline [&[class$='active']]:text-red-500" href="#patients-say" data-te-nav-link-ref>
                Patients Say
              </a>
            </li>

          </ul>

          <div class="inline-block w-full h-auto px-2 my-4 relative lg:w-auto lg:m-0">
            @auth
              <a class="relative inline-block border border-solid border-black/[0.12] rounded py-2 px-4 m-0 min-w-[64px] w-full h-9 align-middle button text-center text-red-500 bg-white overflow-hidden no-underline outline-none cursor-pointer transition-all hover:bg-red-500/[0.04] hover:border-red-500 focus:bg-red-500/[0.12] focus:border-red-500 active:bg-red-500/[0.10] active:border-red-500" href="{{ route('dashboard.index') }}" data-te-ripple-init data-te-ripple-color="light">
                Go to Dashboard
              </a>
            @else
              <a class="relative inline-block border-0 border-solid border-transparent rounded py-2 px-4 m-0 min-w-[64px] w-full h-9 align-middle button text-center text-white bg-red-500 overflow-hidden no-underline outline-none cursor-pointer transition-all hover:bg-red-600 focus:bg-red-600 active:bg-red-600" href="{{ route('login.index') }}" data-te-ripple-init data-te-ripple-color="light">
                Login
              </a>
            @endauth
          </div>
        </div>

      </div>
    </nav>
  </header>

  <main class="block w-full h-auto pt-14 m-0 relative lg:pt-16">
    <section class="block w-full h-auto p-0 m-0 bg-red-500 overflow-hidden relative" id="home">
      <div class="block w-full max-w-5xl h-auto px-4 mx-auto relative">

        <div class="block w-full h-auto py-[60px] m-0 border-0 border-solid border-black/[0.12] shadow-none sm:py-[90px]">
          <div class="flex justify-start items-stretch flex-wrap gap-0 w-full h-auto p-0 m-0 relative">

            <div class="block min-w-0 w-full h-auto p-0 m-0 bg-transparent rounded-none shadow-none relative">
              <div class="block w-full h-auto pt-[200px] pb-[120px] m-0 relative lg:pt-[240px] lg:pb-[140px]">
                <div class="block w-full h-auto p-0 mb-4 headline-5 text-left text-white relative md:headline-4">
                  Your Health Care is <br /> Our <span id="typeit"></span>
                </div>
                <div class="block w-full h-auto p-0 m-0 body-2 text-left text-white line-clamp-5 text-ellipsis relative md:text-xl">
                  We work to take care of your health and body.
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

    <section class="block w-full h-auto p-0 m-0 bg-white overflow-hidden relative" id="our-speciality">
      <div class="block w-full max-w-5xl h-auto px-4 mx-auto relative">

        <div class="block w-full h-auto py-[60px] m-0 border-0 border-solid border-black/[0.12] shadow-none sm:py-[90px]">
          <div class="block w-full h-auto p-0 mb-[30px] overflow-hidden relative">
            <h2 class="block w-full h-auto p-0 m-0 headline-4 text-center text-black/[0.87] truncate relative">
              Our Speciality
            </h2>
          </div>

          <div class="flex justify-start items-stretch flex-wrap gap-0 w-full h-auto p-0 m-0 relative">

            <div class="block min-w-0 w-full h-auto p-10 m-0 bg-white rounded-none shadow-none relative md:w-4/12 md:p-3 md:mb-10">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                  <path d="M142.4 21.9c5.6 16.8-3.5 34.9-20.2 40.5L96 71.1V192c0 53 43 96 96 96s96-43 96-96V71.1l-26.1-8.7c-16.8-5.6-25.8-23.7-20.2-40.5s23.7-25.8 40.5-20.2l26.1 8.7C334.4 19.1 352 43.5 352 71.1V192c0 77.2-54.6 141.6-127.3 156.7C231 404.6 278.4 448 336 448c61.9 0 112-50.1 112-112V265.3c-28.3-12.3-48-40.5-48-73.3c0-44.2 35.8-80 80-80s80 35.8 80 80c0 32.8-19.7 61-48 73.3V336c0 97.2-78.8 176-176 176c-92.9 0-168.9-71.9-175.5-163.1C87.2 334.2 32 269.6 32 192V71.1c0-27.5 17.6-52 43.8-60.7l26.1-8.7c16.8-5.6 34.9 3.5 40.5 20.2zM480 224a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-7 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  Primary Care
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  Physicians provide comprehensive medical evaluations and primary care for patients of all ages.
                </p>
              </div>
            </div>

            <div class="block min-w-0 w-full h-auto p-10 m-0 bg-white rounded-none shadow-none relative md:w-4/12 md:p-3 md:mb-10">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                  <path d="M96 64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32V224v64V448c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V384H64c-17.7 0-32-14.3-32-32V288c-17.7 0-32-14.3-32-32s14.3-32 32-32V160c0-17.7 14.3-32 32-32H96V64zm448 0v64h32c17.7 0 32 14.3 32 32v64c17.7 0 32 14.3 32 32s-14.3 32-32 32v64c0 17.7-14.3 32-32 32H544v64c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32V288 224 64c0-17.7 14.3-32 32-32h32c17.7 0 32 14.3 32 32zM416 224v64H224V224H416z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-7 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  Sport Medicine
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  Our team personalizes each athlete’s treatment based on his/her sport and age growing bodies.
                </p>
              </div>
            </div>

            <div class="block min-w-0 w-full h-auto p-10 m-0 bg-white rounded-none shadow-none relative md:w-4/12 md:p-3 md:mb-10">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                  <path d="M0 48C0 21.5 21.5 0 48 0H368c26.5 0 48 21.5 48 48V96h50.7c17 0 33.3 6.7 45.3 18.7L589.3 192c12 12 18.7 28.3 18.7 45.3V256v32 64c17.7 0 32 14.3 32 32s-14.3 32-32 32H576c0 53-43 96-96 96s-96-43-96-96H256c0 53-43 96-96 96s-96-43-96-96H48c-26.5 0-48-21.5-48-48V48zM416 256H544V237.3L466.7 160H416v96zM160 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm368-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM176 80v48l-48 0c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h48v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V192h48c8.8 0 16-7.2 16-16V144c0-8.8-7.2-16-16-16H240V80c0-8.8-7.2-16-16-16H192c-8.8 0-16 7.2-16 16z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-7 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  Emergency Medicine
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  Our clinic is always ready for urgent care such as Fractures, Infections, Bites, Minor Burns, Ear Aches, etc.
                </p>
              </div>
            </div>

            <div class="block min-w-0 w-full h-auto p-10 m-0 bg-white rounded-none shadow-none relative md:w-4/12 md:p-3 md:mb-10">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path d="M228.3 469.1L47.6 300.4c-4.2-3.9-8.2-8.1-11.9-12.4h87c22.6 0 43-13.6 51.7-34.5l10.5-25.2 49.3 109.5c3.8 8.5 12.1 14 21.4 14.1s17.8-5 22-13.3L320 253.7l1.7 3.4c9.5 19 28.9 31 50.1 31H476.3c-3.7 4.3-7.7 8.5-11.9 12.4L283.7 469.1c-7.5 7-17.4 10.9-27.7 10.9s-20.2-3.9-27.7-10.9zM503.7 240h-132c-3 0-5.8-1.7-7.2-4.4l-23.2-46.3c-4.1-8.1-12.4-13.3-21.5-13.3s-17.4 5.1-21.5 13.3l-41.4 82.8L205.9 158.2c-3.9-8.7-12.7-14.3-22.2-14.1s-18.1 5.9-21.8 14.8l-31.8 76.3c-1.2 3-4.2 4.9-7.4 4.9H16c-2.6 0-5 .4-7.3 1.1C3 225.2 0 208.2 0 190.9v-5.8c0-69.9 50.5-129.5 119.4-141C165 36.5 211.4 51.4 244 84l12 12 12-12c32.6-32.6 79-47.5 124.6-39.9C461.5 55.6 512 115.2 512 185.1v5.8c0 16.9-2.8 33.5-8.3 49.1z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-7 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  Cardiology
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  Our cardiologists are skilled at diagnosing and treating diseases of the cardiovascular system.
                </p>
              </div>
            </div>

            <div class="block min-w-0 w-full h-auto p-10 m-0 bg-white rounded-none shadow-none relative md:w-4/12 md:p-3 md:mb-10">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path d="M256 192l-39.5-39.5c4.9-12.6 7.5-26.2 7.5-40.5C224 50.1 173.9 0 112 0S0 50.1 0 112s50.1 112 112 112c14.3 0 27.9-2.7 40.5-7.5L192 256l-39.5 39.5c-12.6-4.9-26.2-7.5-40.5-7.5C50.1 288 0 338.1 0 400s50.1 112 112 112s112-50.1 112-112c0-14.3-2.7-27.9-7.5-40.5L499.2 76.8c7.1-7.1 7.1-18.5 0-25.6c-28.3-28.3-74.1-28.3-102.4 0L256 192zm22.6 150.6L396.8 460.8c28.3 28.3 74.1 28.3 102.4 0c7.1-7.1 7.1-18.5 0-25.6L342.6 278.6l-64 64zM64 112a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm48 240a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-7 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  General Surgery
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  New surgical latest technology allows us to provide minimally invasive options when possible.
                </p>
              </div>
            </div>

            <div class="block min-w-0 w-full h-auto p-10 m-0 bg-white rounded-none shadow-none relative md:w-4/12 md:p-3 md:mb-10">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path d="M441 7l32 32 32 32c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-15-15L417.9 128l55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-72-72L295 73c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l55 55L422.1 56 407 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0zM210.3 155.7l61.1-61.1c.3 .3 .6 .7 1 1l16 16 56 56 56 56 16 16c.3 .3 .6 .6 1 1l-191 191c-10.5 10.5-24.7 16.4-39.6 16.4H97.9L41 505c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l57-57V325.3c0-14.9 5.9-29.1 16.4-39.6l43.3-43.3 57 57c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-57-57 41.4-41.4 57 57c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-57-57z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-7 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  Infectious Disease
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  We have extra training in the diagnosis of illnesses and infections caused by bacteria, viruses and fungi.
                </p>
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

    <section class="block w-full h-auto p-0 m-0 bg-white overflow-hidden relative" id="about-us">
      <div class="block w-full max-w-5xl h-auto px-4 mx-auto relative">

        <div class="block w-full h-auto py-[60px] m-0 border-t border-solid border-black/[0.12] shadow-none sm:py-[90px]">
          <div class="flex justify-start items-stretch flex-wrap gap-4 w-full h-auto p-0 m-0 relative md:flex-nowrap">

            <div class="block min-w-0 w-full h-auto p-0 m-0 bg-white rounded-none shadow-none relative md:w-6/12">

              <div class="block w-full h-auto p-0 mb-[30px] overflow-hidden relative md:mb-10">
                <h2 class="block w-full h-auto p-0 mb-4 headline-4 text-left text-black/[0.87] truncate relative">
                  About Us
                </h2>
                <p class="block w-full h-auto p-0 m-0 body-2 text-left text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  Your life is our specialty. Our team of experienced physicians offers a comprehensive range of healthcare services.
                </p>
              </div>

              <div class="block w-full h-auto p-0 mb-[30px] overflow-hidden relative md:mb-10">
                <div class="block w-auto h-auto p-2 m-0 rounded-none text-center text-red-500 bg-transparent absolute left-0 top-0 z-0">
                  <svg class="pointer-events-none w-12 h-12 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                  </svg>
                </div>
                <div class="block w-full h-auto pl-[80px] m-0 overflow-hidden relative">
                  <h3 class="block w-full h-auto p-0 mb-4 subtitle-2 text-lg text-left text-black/[0.87] truncate relative">
                    Experted Doctors
                  </h3>
                  <p class="block w-full h-auto p-0 m-0 body-2 text-left text-black/[0.60] line-clamp-5 text-ellipsis relative">
                    Our team of physicians treats patients of all ages, from infants to seniors.
                  </p>
                </div>
              </div>

              <div class="block w-full h-auto p-0 mb-[30px] overflow-hidden relative md:mb-10">
                <div class="block w-auto h-auto p-2 m-0 rounded-none text-center text-red-500 bg-transparent absolute left-0 top-0 z-0">
                  <svg class="pointer-events-none w-12 h-12 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path d="M192 48c0-26.5 21.5-48 48-48H400c26.5 0 48 21.5 48 48V512H368V432c0-26.5-21.5-48-48-48s-48 21.5-48 48v80H192V48zM48 96H160V512H48c-26.5 0-48-21.5-48-48V320H80c8.8 0 16-7.2 16-16s-7.2-16-16-16H0V224H80c8.8 0 16-7.2 16-16s-7.2-16-16-16H0V144c0-26.5 21.5-48 48-48zm544 0c26.5 0 48 21.5 48 48v48H560c-8.8 0-16 7.2-16 16s7.2 16 16 16h80v64H560c-8.8 0-16 7.2-16 16s7.2 16 16 16h80V464c0 26.5-21.5 48-48 48H480V96H592zM312 64c-8.8 0-16 7.2-16 16v24H272c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h24v24c0 8.8 7.2 16 16 16h16c8.8 0 16-7.2 16-16V152h24c8.8 0 16-7.2 16-16V120c0-8.8-7.2-16-16-16H344V80c0-8.8-7.2-16-16-16H312z" />
                  </svg>
                </div>
                <div class="block w-full h-auto pl-[80px] m-0 overflow-hidden relative">
                  <h3 class="block w-full h-auto p-0 mb-4 subtitle-2 text-lg text-left text-black/[0.87] truncate relative">
                    Healthy Environment
                  </h3>
                  <p class="block w-full h-auto p-0 m-0 body-2 text-left text-black/[0.60] line-clamp-5 text-ellipsis relative">
                    We have experienced nursing team and good beds for healthy environment.
                  </p>
                </div>
              </div>

            </div>

            <div class="block min-w-0 w-full h-auto p-0 m-0 bg-white rounded-none shadow-none relative md:w-6/12">

              <div class="block w-full h-auto p-0 mb-[30px] relative md:mb-10">
                <div class="block w-auto h-auto p-0 m-0 rounded text-center text-white bg-white shadow-2xl relative">
                  <img class="block w-full h-auto p-0 mx-auto align-middle select-none" src="{{ asset('img/about.png') }}" alt="About Us" loading="lazy" />
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="block w-full h-auto p-0 m-0 bg-red-500 overflow-hidden relative" id="patients-say">
      <div class="block w-full max-w-5xl h-auto px-4 mx-auto relative">

        <div class="block w-full h-auto py-[60px] m-0 border-0 border-solid border-black/[0.12] shadow-none sm:py-[90px]">
          <div class="block w-full h-auto p-0 mb-[30px] overflow-hidden relative">
            <h2 class="block w-full h-auto p-0 m-0 headline-4 text-center text-white truncate relative">
              Patients Say
            </h2>
          </div>

          <div class="block w-full h-auto p-0 m-0 overflow-hidden relative" id="carousel">
            <div class="flex justify-start items-stretch flex-nowrap gap-0 w-auto h-auto p-0 -ml-4 backface-hidden relative">

              <div class="block flex-auto flex-shrink-0 min-w-0 w-full h-auto pl-4 m-0 relative md:w-6/12">
                <div class="block w-full h-full py-16 pb-10 px-10 m-0 bg-white rounded shadow-none relative">
                  <div class="block w-16 h-16 p-0 m-0 rounded-full text-red-500/[0.12] bg-transparent absolute left-10 top-10 z-0">
                    <svg class="pointer-events-none w-16 h-16 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                      <path d="M0 216C0 149.7 53.7 96 120 96h8c17.7 0 32 14.3 32 32s-14.3 32-32 32h-8c-30.9 0-56 25.1-56 56v8h64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V320 288 216zm256 0c0-66.3 53.7-120 120-120h8c17.7 0 32 14.3 32 32s-14.3 32-32 32h-8c-30.9 0-56 25.1-56 56v8h64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H320c-35.3 0-64-28.7-64-64V320 288 216z" />
                    </svg>
                  </div>
                  <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                    <p class="block w-full h-auto p-0 mb-4 body-2 text-lg text-left text-black/[0.60] line-clamp-5 text-ellipsis relative">
                      A great benefit of Parkside is its peaceful location and the impeccable medical and nursing service.
                    </p>
                    <h5 class="block w-full h-auto p-0 m-0 subtitle-2 text-left text-red-500 truncate relative">
                      Frank Smith - Envato CEO
                    </h5>
                  </div>
                </div>
              </div>

              <div class="block flex-auto flex-shrink-0 min-w-0 w-full h-auto pl-4 m-0 relative md:w-6/12">
                <div class="block w-full h-full py-16 pb-10 px-10 m-0 bg-white rounded shadow-none relative">
                  <div class="block w-16 h-16 p-0 m-0 rounded-full text-red-500/[0.12] bg-transparent absolute left-10 top-10 z-0">
                    <svg class="pointer-events-none w-16 h-16 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                      <path d="M0 216C0 149.7 53.7 96 120 96h8c17.7 0 32 14.3 32 32s-14.3 32-32 32h-8c-30.9 0-56 25.1-56 56v8h64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V320 288 216zm256 0c0-66.3 53.7-120 120-120h8c17.7 0 32 14.3 32 32s-14.3 32-32 32h-8c-30.9 0-56 25.1-56 56v8h64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H320c-35.3 0-64-28.7-64-64V320 288 216z" />
                    </svg>
                  </div>
                  <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                    <p class="block w-full h-auto p-0 mb-4 body-2 text-lg text-left text-black/[0.60] line-clamp-5 text-ellipsis relative">
                      My treatment was second to none and all the staff at Claremont were efficient, polite and caring
                    </p>
                    <h5 class="block w-full h-auto p-0 m-0 subtitle-2 text-left text-red-500 truncate relative">
                      Jone Doe - Zytheme CEO
                    </h5>
                  </div>
                </div>
              </div>

              <div class="block flex-auto flex-shrink-0 min-w-0 w-full h-auto pl-4 m-0 relative md:w-6/12">
                <div class="block w-full h-full py-16 pb-10 px-10 m-0 bg-white rounded shadow-none relative">
                  <div class="block w-16 h-16 p-0 m-0 rounded-full text-red-500/[0.12] bg-transparent absolute left-10 top-10 z-0">
                    <svg class="pointer-events-none w-16 h-16 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                      <path d="M0 216C0 149.7 53.7 96 120 96h8c17.7 0 32 14.3 32 32s-14.3 32-32 32h-8c-30.9 0-56 25.1-56 56v8h64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V320 288 216zm256 0c0-66.3 53.7-120 120-120h8c17.7 0 32 14.3 32 32s-14.3 32-32 32h-8c-30.9 0-56 25.1-56 56v8h64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H320c-35.3 0-64-28.7-64-64V320 288 216z" />
                    </svg>
                  </div>
                  <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                    <p class="block w-full h-auto p-0 mb-4 body-2 text-lg text-left text-black/[0.60] line-clamp-5 text-ellipsis relative">
                      Our business by optimizing our landing pages. We’ve increased conversion rates by 120%.
                    </p>
                    <h5 class="block w-full h-auto p-0 m-0 subtitle-2 text-left text-red-500 truncate relative">
                      Bone Datche - 7oroof CEO
                    </h5>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="block w-full h-auto p-0 mt-[30px] overflow-hidden relative">
            <div class="flex justify-center items-center flex-wrap gap-0 w-full h-auto p-0 m-0 relative" id="dots"></div>
          </div>
        </div>

      </div>
    </section>
  </main>

  <footer class="block w-full h-auto p-0 m-0 relative">
    <div class="block w-full h-auto p-0 m-0 bg-white overflow-hidden relative">
      <div class="block w-full max-w-5xl h-auto px-4 mx-auto relative">

        <div class="block w-full h-auto py-[60px] m-0 border-0 border-solid border-black/[0.12] shadow-none sm:py-[90px]">
          <div class="flex justify-start items-stretch flex-wrap gap-0 w-full h-auto p-0 m-0 relative">

            <div class="block min-w-0 w-full h-auto p-3 m-0 bg-white rounded-none shadow-none relative md:w-4/12">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-4 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  Phone
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  +221 340 210 533
                </p>
              </div>
            </div>

            <div class="block min-w-0 w-full h-auto p-3 m-0 bg-white rounded-none shadow-none relative md:w-4/12">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                  <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-4 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  Address
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  86 Stolham, PA 6550.
                </p>
              </div>
            </div>

            <div class="block min-w-0 w-full h-auto p-3 m-0 bg-white rounded-none shadow-none relative md:w-4/12">
              <div class="block w-[80px] h-[80px] p-[22px] mx-auto mb-8 rounded-full text-white bg-red-500">
                <svg class="pointer-events-none w-9 h-9 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                </svg>
              </div>
              <div class="block w-full h-auto p-0 m-0 overflow-hidden relative">
                <h3 class="block w-full h-auto p-0 mb-4 subtitle-2 text-lg text-center text-black/[0.87] truncate relative">
                  Opening Time
                </h3>
                <p class="block w-full h-auto p-0 m-0 body-2 text-center text-black/[0.60] line-clamp-5 text-ellipsis relative">
                  Sat-Thu 5:00 to 8:00pm
                </p>
              </div>
            </div>

          </div>
        </div>

        <div class="block w-full h-auto py-2 m-0 border-t border-solid border-black/[0.12] shadow-none">
          <div class="block py-1 m-0 text-center overflow-hidden relative lg:text-left">
            <span class="inline-block w-auto h-auto p-0 m-0 caption text-black/[0.60] align-middle whitespace-nowrap">
              &copy Clinics App {{ now()->year }}, All Rights Reserved.
            </span>
          </div>
        </div>

      </div>
    </div>
  </footer>
@endsection

@push('scripts')
  <script src="{{ mix('/js/active-menu-link.js') }}" defer></script>
  <script src="{{ mix('/js/typeit.js') }}" defer></script>
  <script src="{{ mix('/js/carousel.js') }}" defer></script>
@endpush
