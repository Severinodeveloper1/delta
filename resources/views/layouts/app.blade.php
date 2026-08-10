<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-bg-light text-slate-900">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'IMPORTACIONES DELTA PERU S.A.C') }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Swiper CSS (For slider component) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Tailwind & App Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full flex flex-col font-sans relative antialiased min-h-screen">
    <!-- Grid Overlay Background -->
    <div class="absolute inset-0 industrial-grid opacity-[0.05] pointer-events-none z-[-1]"></div>

    <!-- Header Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Section -->
    @include('partials.footer')

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert2 notification alerts
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#f97316'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ $errors->first() }}",
                confirmButtonColor: '#0f172a'
            });
        @endif
    </script>

    @php
        $companyInfo = \App\Models\Company::first();
        $waSaldo = \App\Models\Specialist::whereNotNull('whatsapp')->where('whatsapp', '!=', '')->get();
        $cleanCompanyPhone = $companyInfo ? preg_replace('/\D/', '', $companyInfo->telefono) : '';
    @endphp

    <style>
        .wa-primary-bg {
            background-color: #25D366 !important;
        }

        .wa-btn-color {
            background-color: #25D366 !important;
        }

        .wa-btn-color:hover {
            background-color: #128C7E !important;
        }

        .wa-panel-header {
            background-color: #25D366 !important;
        }

        .wa-item-card {
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease-in-out;
        }

        .wa-item-card:hover {
            border-color: #25D366 !important;
            background-color: rgba(37, 211, 102, 0.05) !important;
        }

        .wa-icon-badge {
            background-color: rgba(37, 211, 102, 0.1);
            color: #25D366;
            transition: all 0.2s ease-in-out;
        }

        .wa-item-card:hover .wa-icon-badge {
            background-color: #25D366 !important;
            color: #ffffff !important;
        }

        .wa-hidden {
            display: none !important;
        }
    </style>

    <!-- WhatsApp Floating Button -->
    <div class="fixed bottom-6 right-6 z-[9999] flex flex-col items-end gap-3" id="wa-widget">

        <!-- Specialists Panel (shown/hidden) -->
        @if ($waSaldo->count() > 0)
            <div id="wa-panel" class="hidden flex-col gap-2 items-end">
                <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 w-72 overflow-hidden">
                    <!-- Panel Header -->
                    <div class="wa-panel-header px-5 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-brands fa-whatsapp text-white text-2xl"></i>
                            <div>
                                <p class="text-white font-bold text-sm leading-tight">Escríbenos por WhatsApp</p>
                                <p class="text-white/80 text-[10px] leading-tight">Selecciona un asesor técnico</p>
                            </div>
                        </div>
                        <button type="button" id="wa-panel-close"
                            class="text-white/70 hover:text-white transition-colors">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    <!-- Specialist List -->
                    <div class="p-3 space-y-2 max-h-72 overflow-y-auto">
                        @foreach ($waSaldo as $specialist)
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $specialist->whatsapp) }}?text={{ urlencode('Hola, me gustaría recibir asesoría técnica sobre sus equipos de envasado.') }}"
                                target="_blank" rel="noopener noreferrer"
                                class="wa-item-card flex items-center gap-3 p-3 rounded-xl cursor-pointer">
                                <div
                                    class="w-11 h-11 rounded-full overflow-hidden bg-slate-100 border border-slate-200 flex-shrink-0">
                                    @if ($specialist->imagen)
                                        <img src="{{ asset('storage/' . $specialist->imagen) }}"
                                            alt="{{ $specialist->nombre }}" class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">
                                            <i class="fa-solid fa-user text-lg"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <p class="font-bold text-slate-800 text-sm truncate leading-tight">
                                        {{ $specialist->nombre }}</p>
                                    <p class="text-[11px] text-slate-500 truncate leading-tight">
                                        {{ $specialist->cargo }}</p>
                                </div>
                                <div
                                    class="wa-icon-badge flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="fa-brands fa-whatsapp text-base"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Panel Footer -->
                    <div class="px-4 pb-3 pt-1 text-center border-t border-slate-50">
                        <p class="text-[10px] text-slate-400">Disponible:
                            {{ $companyInfo->horario ?? 'Lun–Vie 9am–5pm' }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Floating Button -->
        @if ($waSaldo->count() > 0)
            <button type="button" id="wa-toggle-btn" title="Contáctanos por WhatsApp"
                class="wa-btn-color relative w-16 h-16 rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-110 active:scale-95 cursor-pointer">
                <!-- Ping animation ring -->
                <span
                    class="absolute inline-flex w-full h-full rounded-full wa-primary-bg opacity-30 animate-ping"></span>

                <!-- Icon default (WA logo) -->
                <i id="wa-icon-open" class="fa-brands fa-whatsapp text-white text-3xl transition-all duration-200"></i>

                <!-- Icon closed (X) -->
                <i id="wa-icon-close"
                    class="fa-solid fa-xmark text-white text-2xl wa-hidden transition-all duration-200"></i>
            </button>
        @else
            <!-- Direct Whatsapp backup if no specialists are configured -->
            @if ($cleanCompanyPhone)
                <a href="https://wa.me/{{ $cleanCompanyPhone }}?text={{ urlencode('Hola, me gustaría recibir asesoría técnica sobre sus equipos de envasado.') }}"
                    target="_blank" rel="noopener noreferrer" title="Contáctanos por WhatsApp"
                    class="wa-btn-color relative w-16 h-16 rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-110 active:scale-95 cursor-pointer">
                    <!-- Ping animation ring -->
                    <span
                        class="absolute inline-flex w-full h-full rounded-full wa-primary-bg opacity-30 animate-ping"></span>

                    <!-- Icon default (WA logo) -->
                    <i class="fa-brands fa-whatsapp text-white text-3xl"></i>
                </a>
            @endif
        @endif
    </div>

    <script>
        (function() {
            var toggleBtn = document.getElementById('wa-toggle-btn');
            var panel = document.getElementById('wa-panel');
            var closeBtn = document.getElementById('wa-panel-close');
            var iconOpen = document.getElementById('wa-icon-open');
            var iconClose = document.getElementById('wa-icon-close');

            if (!toggleBtn) return;

            var isOpen = false;

            function openPanel() {
                isOpen = true;
                if (panel) {
                    panel.classList.remove('hidden');
                    panel.classList.add('flex');
                }
                if (iconOpen) iconOpen.classList.add('wa-hidden');
                if (iconClose) iconClose.classList.remove('wa-hidden');
                toggleBtn.style.setProperty('background-color', '#334155', 'important');
            }

            function closePanel() {
                isOpen = false;
                if (panel) {
                    panel.classList.add('hidden');
                    panel.classList.remove('flex');
                }
                if (iconOpen) iconOpen.classList.remove('wa-hidden');
                if (iconClose) iconClose.classList.add('wa-hidden');
                toggleBtn.style.setProperty('background-color', '#25D366', 'important');
            }

            toggleBtn.addEventListener('click', function() {
                isOpen ? closePanel() : openPanel();
            });

            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    closePanel();
                });
            }

            // Close if clicking outside the widget
            document.addEventListener('click', function(e) {
                var widget = document.getElementById('wa-widget');
                if (widget && !widget.contains(e.target) && isOpen) {
                    closePanel();
                }
            });
        })();
    </script>

</body>

</html>
