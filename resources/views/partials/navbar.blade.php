<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo Section -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @if (isset($company) && $company->logo)
                        <img class="h-10 w-auto object-contain" src="{{ asset('storage/' . $company->logo) }}"
                            alt="Delta Logo">
                    @else
                        <span class="text-2xl font-extrabold tracking-tight text-primary">
                            IMPORTACIONES <span class="text-accent">DELTA</span>
                        </span>
                    @endif
                </a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}"
                    class="font-mono text-xs uppercase tracking-wider {{ Route::is('home') ? 'text-accent border-b-2 border-accent pb-1' : 'text-slate-600 hover:text-primary transition-colors' }}">
                    Inicio
                </a>
                <a href="{{ route('nosotros') }}"
                    class="font-mono text-xs uppercase tracking-wider {{ Route::is('nosotros') ? 'text-accent border-b-2 border-accent pb-1' : 'text-slate-600 hover:text-primary transition-colors' }}">
                    Nosotros
                </a>
                <a href="{{ route('tienda') }}"
                    class="font-mono text-xs uppercase tracking-wider {{ Route::is('tienda') || Route::is('producto.detalle') ? 'text-accent border-b-2 border-accent pb-1' : 'text-slate-600 hover:text-primary transition-colors' }}">
                    Equipos
                </a>
                <a href="{{ route('contacto') }}"
                    class="font-mono text-xs uppercase tracking-wider {{ Route::is('contacto') ? 'text-accent border-b-2 border-accent pb-1' : 'text-slate-600 hover:text-primary transition-colors' }}">
                    Contacto
                </a>

                @auth
                    <a href="/contacto"
                        class="ml-4 px-4 py-2 text-xs font-mono font-bold text-white bg-primary rounded hover:bg-accent transition-all">
                        Solicita un Asesor
                    </a>
                @else
                    <a href="{{ route('contacto') }}"
                        class="ml-4 text-xs font-mono font-semibold text-primary hover:text-accent">
                        Solicita un Asesor
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" type="button"
                    class="text-slate-500 hover:text-primary focus:outline-none focus:text-primary">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path id="menu-icon-open" class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="menu-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-slate-200">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 flex flex-col gap-2 shadow-inner">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ Route::is('home') ? 'text-accent bg-slate-50' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                Inicio
            </a>
            <a href="{{ route('nosotros') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ Route::is('nosotros') ? 'text-accent bg-slate-50' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                Nosotros
            </a>
            <a href="{{ route('tienda') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ Route::is('tienda') || Route::is('producto.detalle') ? 'text-accent bg-slate-50' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                Equipos
            </a>
            <a href="{{ route('contacto') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ Route::is('contacto') ? 'text-accent bg-slate-50' : 'text-slate-600 hover:bg-slate-50 hover:text-primary' }}">
                Contacto
            </a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('menu-icon-open');
        const closeIcon = document.getElementById('menu-icon-close');

        if (btn && menu) {
            btn.addEventListener('click', function() {
                menu.classList.toggle('hidden');
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }
    });
</script>
