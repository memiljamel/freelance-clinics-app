@if ($paginator->hasPages()) 
  <nav class="inline-block w-full h-auto p-0 m-0 bg-white relative">
    <div class="flex justify-between items-center gap-4 p-0 m-0 sm:hidden">
      @if ($paginator->onFirstPage())
        <div class="inline-block w-auto h-auto p-0 m-0 relative">
          <span class="block min-w-[64px] w-auto h-9 px-4 py-2 m-0 bg-white rounded subtitle-2 text-black/[0.60] text-center border border-solid border-black/[0.12] align-middle no-underline outline-none cursor-default whitespace-nowrap relative hover:bg-transparent active:bg-transparent focus:bg-transparent">
            Previous
          </span>
        </div>
      @else
        <div class="inline-block w-auto h-auto p-0 m-0 relative">
          <a class="block min-w-[64px] w-auto h-9 px-4 py-2 m-0 bg-white rounded subtitle-2 text-black/[0.60] text-center border border-solid border-black/[0.12] align-middle no-underline outline-none cursor-pointer whitespace-nowrap relative hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ $paginator->previousPageUrl() }}">
            Previous
          </a>
        </div>
      @endif

      @if ($paginator->hasMorePages())
        <div class="inline-block w-auto h-auto p-0 m-0 relative">
          <a class="block min-w-[64px] w-auto h-9 px-4 py-2 m-0 bg-white rounded subtitle-2 text-black/[0.60] text-center border border-solid border-black/[0.12] align-middle no-underline outline-none cursor-pointer whitespace-nowrap relative hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ $paginator->nextPageUrl() }}">
            Next
          </a>
        </div>
      @else
        <div class="inline-block w-auto h-auto p-0 m-0 relative">
          <span class="block min-w-[64px] w-auto h-9 px-4 py-2 m-0 bg-white rounded subtitle-2 text-black/[0.60] text-center border border-solid border-black/[0.12] align-middle no-underline outline-none cursor-default whitespace-nowrap relative hover:bg-transparent active:bg-transparent focus:bg-transparent">
            Next
          </span>
        </div>
      @endif
    </div>

    <div class="hidden justify-between items-center gap-4 p-0 m-0 sm:flex">
      <div class="inline-block w-auto h-auto p-2 m-0 relative">
        <p class="block body-2 text-black/[0.87] font-normal whitespace-nowrap">
          Showing
          @if ($paginator->firstItem())
            <span class="font-medium">
              {{ $paginator->firstItem() }}
            </span>
            to
            <span class="font-medium">
              {{ $paginator->lastItem() }}
            </span>
          @else
            {{ $paginator->count() }}
          @endif
          of
          <span class="font-medium">
            {{ $paginator->total() }}
          </span>
          results
        </p>
      </div>
      <div class="flex w-auto h-auto p-0 m-0 rounded shadow-none -space-x-px isolate" aria-label="Pagination">
        @if ($paginator->onFirstPage())
          <div class="inline-block w-auto h-auto p-0 m-0 relative">
            <span class="flex justify-center items-center w-9 h-9 p-1.5 m-0 bg-white rounded-l subtitle-2 text-black/[0.60] text-center ring-1 ring-inset ring-black/[0.12] no-underline outline-none cursor-default whitespace-nowrap relative hover:bg-transparent active:bg-transparent focus:bg-transparent" aria-disabled="true">
              <svg 
                class="pointer-events-none w-full h-full fill-current"
                xmlns="http://www.w3.org/2000/svg" 
                height="24px" 
                viewBox="0 0 24 24" 
                width="24px" 
                fill="#000000"
              >
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
              </svg>
            </span>
          </div>
        @else
          <div class="inline-block w-auto h-auto p-0 m-0 relative">
            <a class="flex justify-center items-center w-9 h-9 p-1.5 m-0 bg-white rounded-l subtitle-2 text-black/[0.60] text-center ring-1 ring-inset ring-black/[0.12] no-underline outline-none cursor-pointer whitespace-nowrap relative hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ $paginator->previousPageUrl() }}" aria-label="previous" rel="prev">
              <svg 
                class="pointer-events-none w-full h-full fill-current"
                xmlns="http://www.w3.org/2000/svg" 
                height="24px" 
                viewBox="0 0 24 24" 
                width="24px" 
                fill="#000000"
              >
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
              </svg>
            </a>
          </div>
        @endif

        @foreach ($elements as $element)
          @if (is_string($element))
            <div class="inline-block w-auto h-auto p-0 m-0 relative">
              <span class="flex justify-center items-center w-9 h-9 px-1 py-1.5 m-0 bg-white rounded-none subtitle-2 text-black/[0.60] text-center ring-1 ring-inset ring-black/[0.12] no-underline outline-none cursor-default whitespace-nowrap relative hover:bg-transparent active:bg-transparent focus:bg-transparent" aria-disabled="true">
                {{ $element }}
              </span>
            </div>
          @endif

          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
                <div class="inline-block w-auto h-auto p-0 m-0 relative">
                  <span class="flex justify-center items-center w-9 h-9 px-1 py-1.5 m-0 bg-red-500 rounded-none subtitle-2 text-white text-center ring-1 ring-inset ring-red-500 no-underline outline-none cursor-default whitespace-nowrap relative hover:bg-red-500 active:bg-red-500 focus:bg-red-500" aria-current="page">
                    {{ $page }}
                  </span>
                </div>
              @else
                <div class="inline-block w-auto h-auto p-0 m-0 relative">
                  <a class="flex justify-center items-center w-9 h-9 px-1 py-1.5 m-0 bg-white rounded-none subtitle-2 text-black/[0.60] text-center ring-1 ring-inset ring-black/[0.12] no-underline outline-none cursor-pointer whitespace-nowrap relative hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" aria-current="page">
                    {{ $page }}
                  </a>
                </div>
              @endif
            @endforeach
          @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
          <div class="inline-block w-auto h-auto p-0 m-0 relative">
            <a class="flex justify-center items-center w-9 h-9 p-1.5 m-0 bg-white rounded-r subtitle-2 text-black/[0.60] text-center ring-1 ring-inset ring-black/[0.12] no-underline outline-offset-0 cursor-pointer whitespace-nowrap relative hover:bg-black/[0.04] active:bg-black/[0.10] focus:bg-black/[0.12]" href="{{ $paginator->nextPageUrl() }}" aria-label="next" rel="next">
              <svg 
                class="pointer-events-none w-full h-full fill-current"
                xmlns="http://www.w3.org/2000/svg" 
                height="24px" 
                viewBox="0 0 24 24" 
                width="24px" 
                fill="#000000"
              >
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
              </svg>
            </a>
          </div>
        @else
          <div class="inline-block w-auto h-auto p-0 m-0 relative">
            <span class="flex justify-center items-center w-9 h-9 p-1.5 m-0 bg-white rounded-r subtitle-2 text-black/[0.60] text-center ring-1 ring-inset ring-black/[0.12] no-underline outline-none cursor-default whitespace-nowrap relative hover:bg-transparent active:bg-transparent focus:bg-transparent" aria-disabled="true">
              <svg 
                class="pointer-events-none w-full h-full fill-current"
                xmlns="http://www.w3.org/2000/svg" 
                height="24px" 
                viewBox="0 0 24 24" 
                width="24px" 
                fill="#000000"
              >
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
              </svg>
            </span>
          </div>
        @endif
      </div>
    </div>
  </nav>
@endif
