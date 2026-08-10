@extends('layouts.app')

@section('content')
<!-- Hero Slider Section -->
<section class="relative h-[650px] overflow-hidden bg-primary">
    <div class="swiper heroSwiper h-full">
        <div class="swiper-wrapper">
            @forelse($banners as $banner)
                <div class="swiper-slide relative h-full">
                    <!-- Background image -->
                    <img src="{{ asset('storage/' . $banner->imagen) }}" alt="{{ $banner->nombre }}" class="absolute inset-0 w-full h-full object-cover">
                    <!-- Dark overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-primary/30"></div>

                    <!-- Slide Content -->
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                        <div class="max-w-2xl text-white space-y-6">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono tracking-widest uppercase bg-accent/90 text-white">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                {{ $banner->titulo }}
                            </span>
                            <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-none text-white">
                                {{ $banner->nombre }}
                            </h1>
                            <p class="text-lg text-slate-200 leading-relaxed max-w-xl">
                                {{ $banner->descripcion }}
                            </p>
                            <div class="pt-4">
                                <a href="{{ route('tienda') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-sm font-bold rounded bg-accent hover:bg-accent-dark text-white hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg shadow-accent/20">
                                    Ver Catálogo de Equipos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default Slide fallback -->
                <div class="swiper-slide relative h-full bg-primary flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white space-y-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono tracking-widest uppercase bg-accent/90 text-white">
                            Líderes en Envasado
                        </span>
                        <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-none">
                            Líneas de Envasado Industrial
                        </h1>
                        <p class="text-lg text-slate-200 leading-relaxed max-w-xl">
                            Maquinaria automatizada de alta precisión para el envasado y sellado de líquidos, sólidos y granulados.
                        </p>
                        <div class="pt-4">
                            <a href="{{ route('tienda') }}" class="inline-flex items-center justify-center px-8 py-4 rounded bg-accent text-white font-bold text-sm tracking-wider uppercase hover:bg-accent-dark transition-all">
                                Ver Equipos
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <!-- Pagination / Navigation -->
        <div class="swiper-pagination !bottom-8"></div>
        <div class="swiper-button-next !text-white !w-12 !h-12 after:!text-lg bg-black/20 hover:bg-black/40 backdrop-blur rounded-full !hidden sm:!flex"></div>
        <div class="swiper-button-prev !text-white !w-12 !h-12 after:!text-lg bg-black/20 hover:bg-black/40 backdrop-blur rounded-full !hidden sm:!flex"></div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-primary sm:text-4xl">Categorías de Envasado</h2>
                <p class="mt-2 text-slate-500 max-w-xl leading-relaxed">
                    Sistemas automatizados adaptados a los distintos tipos de productos y empaques requeridos por la industria moderna.
                </p>
            </div>
            <a href="{{ route('tienda') }}" class="inline-flex items-center gap-2 text-sm font-bold text-accent hover:text-accent-dark transition-colors font-mono uppercase tracking-wider">
                Ver todos los sistemas <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <div class="group bg-white rounded-lg border border-slate-200 overflow-hidden shadow-premium hover:border-accent/40 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-video overflow-hidden bg-slate-100">
                        @if($category->imagen)
                            <img src="{{ asset('storage/' . $category->imagen) }}" alt="{{ $category->nombre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-200">
                                <i class="fa-solid fa-box-open text-4xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div class="space-y-2">
                            <h3 class="text-lg font-bold text-primary group-hover:text-accent transition-colors">
                                {{ $category->nombre }}
                            </h3>
                            <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed">
                                {{ $category->descripcion }}
                            </p>
                        </div>
                        <a href="{{ route('tienda', ['categorias' => $category->id]) }}" class="mt-4 inline-flex items-center gap-1.5 text-xs font-mono font-bold text-accent group-hover:translate-x-1 transition-transform">
                            VER EQUIPOS <i class="fa-solid fa-arrow-right-long text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-slate-400">
                    No hay categorías registradas.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-16 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-black tracking-tight text-primary sm:text-4xl">Equipos Destacados</h2>
            <a href="{{ route('tienda') }}" class="px-4 py-2 border border-slate-200 hover:border-slate-300 bg-white text-xs font-mono font-bold text-slate-700 hover:text-primary transition-all rounded shadow-sm">
                Ver Tienda Completa <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="group bg-white border border-slate-200 rounded-lg overflow-hidden shadow-premium hover:-translate-y-1 hover:border-slate-300 transition-all duration-300 flex flex-col">
                    <div class="relative aspect-square overflow-hidden bg-slate-50">
                        @php
                            $imagenes = is_array($product->imagenes) ? $product->imagenes : json_decode($product->imagenes, true);
                            $imagen = $imagenes[0] ?? 'no-image.png';
                        @endphp
                        @if($imagen && $imagen !== 'no-image.png')
                            <img src="{{ asset('storage/' . $imagen) }}" alt="{{ $product->nombre }}" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-300">
                                <i class="fa-solid fa-box text-6xl"></i>
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 px-2 py-1 text-[10px] font-mono font-bold text-white bg-accent/90 rounded tracking-wider uppercase">
                            Destacado
                        </span>
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div class="space-y-1 mb-4">
                            <span class="text-[10px] font-mono font-bold text-accent uppercase tracking-widest">
                                {{ $product->taxonomy->nombre ?? 'Maquinaria' }}
                            </span>
                            <h3 class="text-base font-bold text-primary line-clamp-2 leading-snug">
                                {{ $product->nombre }}
                            </h3>
                            <div class="flex items-center gap-1.5 text-xs text-teal-600 font-bold font-mono">
                                <i class="fa-solid fa-circle-check text-[10px]"></i> EN STOCK
                            </div>
                        </div>

                        <div>
                            <div class="text-xl font-black text-primary mb-3">
                                US$ {{ number_format($product->precio_referencial, 2) }}
                            </div>
                            <a href="{{ route('producto.detalle', $product->slug) }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-primary font-bold text-xs font-mono transition-all rounded">
                                <i class="fa-solid fa-eye"></i> Ver detalle
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-400">
                    No hay productos destacados disponibles.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Trust Section -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-premium grid grid-cols-1 md:grid-cols-2">
        <div class="p-8 sm:p-12 lg:p-16 flex flex-col justify-between space-y-8">
            <div class="space-y-4">
                <h2 class="text-3xl font-black tracking-tight text-primary sm:text-4xl">
                    {{ $seccion->titulo ?? 'Garantía y Respaldo de Fábrica' }}
                </h2>
                <p class="text-slate-500 leading-relaxed text-base">
                    {{ $seccion->descripcion ?? 'Brindamos soluciones integrales que no solo abarcan la adquisición del equipo, sino también el acompañamiento técnico continuo para asegurar la productividad de su planta.' }}
                </p>
            </div>

            <div class="space-y-6">
                <!-- Garantie -->
                <div class="flex items-start gap-4">
                    <div class="p-3 bg-slate-100 rounded-lg text-primary flex-shrink-0">
                        <i class="fa-solid fa-shield-halved text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-primary mb-1">{{ $seccion->titulo_garantia ?? 'Garantía Estructural' }}</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $seccion->descripcion_garantia ?? 'Cobertura completa de 1 año contra defectos de fabricación.' }}</p>
                    </div>
                </div>
                <!-- Support -->
                <div class="flex items-start gap-4">
                    <div class="p-3 bg-slate-100 rounded-lg text-primary flex-shrink-0">
                        <i class="fa-solid fa-screwdriver-wrench text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-primary mb-1">{{ $seccion->titulo_soporte ?? 'Soporte Técnico Especializado' }}</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $seccion->descripcion_soporte ?? 'Atención inmediata y repuestos originales de stock constante.' }}</p>
                    </div>
                </div>
                <!-- Training -->
                <div class="flex items-start gap-4">
                    <div class="p-3 bg-slate-100 rounded-lg text-primary flex-shrink-0">
                        <i class="fa-solid fa-user-graduate text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-primary mb-1">{{ $seccion->titulo_capacitacion ?? 'Capacitación Operativa' }}</h4>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $seccion->descripcion_capacitacion ?? 'Inducción certificada para operarios de planta y mecánicos.' }}</p>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <a href="{{ route('contacto') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white font-bold text-sm tracking-wider uppercase hover:bg-accent transition-all rounded shadow-md">
                    Hablar con un Experto
                </a>
            </div>
        </div>

        <div class="relative min-h-[350px] md:min-h-full bg-slate-100">
            @if(isset($seccion) && $seccion->imagen)
                <img src="{{ asset('storage/' . $seccion->imagen) }}" alt="Soporte Técnico" class="absolute inset-0 w-full h-full object-cover">
            @else
                <div class="absolute inset-0 flex items-center justify-center text-slate-300 bg-slate-200">
                    <i class="fa-solid fa-gears text-8xl"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-primary/10 mix-blend-multiply"></div>
        </div>
    </div>
</section>

<!-- Initialize Hero Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper(".heroSwiper", {
            loop: true,
            speed: 1000,
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 6000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            }
        });
    });
</script>
@endsection
