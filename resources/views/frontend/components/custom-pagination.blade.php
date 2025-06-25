@if ($paginator->hasPages())
    <div class="flex justify-center">
        <div class="pagination flex gap-1 items-center">
            {{-- First Page --}}
            <a href="{{ $paginator->url(1) }}"
                class="px-3 py-1 rounded border {{ $paginator->onFirstPage() ? 'bg-gray-300 cursor-not-allowed' : 'bg-white hover:bg-gray-100' }}"
                {{ $paginator->onFirstPage() ? 'aria-disabled=true' : '' }}>
                First
            </a>

            {{-- Page Numbers --}}
            @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                <a href="{{ $paginator->url($page) }}"
                    class="px-3 py-1 rounded border {{ $page == $paginator->currentPage() ? 'bg-indigo-500 text-white' : 'bg-white hover:bg-gray-100' }}">
                    {{ $page }}
                </a>
            @endfor

            {{-- Next Page --}}
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-1 rounded border {{ !$paginator->hasMorePages() ? 'bg-gray-300 cursor-not-allowed' : 'bg-white hover:bg-gray-100' }}"
                {{ !$paginator->hasMorePages() ? 'aria-disabled=true' : '' }}>
                Next
            </a>
        </div>
    </div>
@endif
