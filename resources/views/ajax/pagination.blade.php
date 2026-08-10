@if ($products->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between font-mono text-sm">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($products->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-slate-500 bg-white border border-slate-300 rounded cursor-not-allowed">
                    Anterior
                </span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-slate-700 bg-white border border-slate-300 rounded hover:text-accent focus:outline-none transition-colors">
                    Anterior
                </a>
            @endif

            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-slate-700 bg-white border border-slate-300 rounded hover:text-accent focus:outline-none transition-colors">
                    Siguiente
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-slate-500 bg-white border border-slate-300 rounded cursor-not-allowed">
                    Siguiente
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md gap-1">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <span aria-disabled="true" aria-label="Anterior">
                            <span class="relative inline-flex items-center px-3 py-2 text-slate-400 bg-white border border-slate-200 rounded cursor-not-allowed" aria-hidden="true">
                                <i class="fa-solid fa-chevron-left text-xs"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-slate-600 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:text-accent transition-colors" aria-label="Anterior">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 text-slate-700 bg-white border border-slate-200 cursor-not-allowed">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $products->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 text-white bg-accent border border-accent font-bold rounded">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-slate-700 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:text-accent transition-colors" aria-label="Página {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 text-slate-600 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:text-accent transition-colors" aria-label="Siguiente">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="Siguiente">
                            <span class="relative inline-flex items-center px-3 py-2 text-slate-400 bg-white border border-slate-200 rounded cursor-not-allowed" aria-hidden="true">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
