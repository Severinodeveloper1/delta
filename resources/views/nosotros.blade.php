@extends('layouts.app')

@section('content')
<div class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
    
    <!-- Trayectoria Section -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <h2 class="text-xs font-mono font-bold text-accent uppercase tracking-widest border-l-4 border-accent pl-3">
                Nuestra Trayectoria
            </h2>
            <h1 class="text-3xl sm:text-5xl font-black text-primary tracking-tight leading-tight">
                Especialistas en Envasado Industrial
            </h1>
            <div class="text-slate-600 leading-relaxed space-y-4">
                @if(isset($nosotros) && $nosotros->trayectoria)
                    {!! $nosotros->trayectoria !!}
                @else
                    <p>
                        Desde nuestros inicios, nos hemos dedicado a proveer maquinaria industrial de envasado de la más alta tecnología para empresas alimentarias, químicas, cosméticas y farmacéuticas en todo el país.
                    </p>
                @endif
            </div>

            <!-- Stats Block -->
            <div class="grid grid-cols-3 gap-4 pt-6">
                <div class="p-5 bg-white border border-slate-200 rounded-lg text-center shadow-sm">
                    <div class="text-3xl sm:text-4xl font-black text-accent mb-1">
                        {{ $nosotros->anios ?? '10+' }}
                    </div>
                    <div class="text-[10px] font-mono font-semibold text-slate-500 uppercase tracking-wider">Años de Experiencia</div>
                </div>
                <div class="p-5 bg-white border border-slate-200 rounded-lg text-center shadow-sm">
                    <div class="text-3xl sm:text-4xl font-black text-accent mb-1">
                        {{ $nosotros->patentes ?? '500+' }}
                    </div>
                    <div class="text-[10px] font-mono font-semibold text-slate-500 uppercase tracking-wider">Equipos Vendidos</div>
                </div>
                <div class="p-5 bg-white border border-slate-200 rounded-lg text-center shadow-sm">
                    <div class="text-3xl sm:text-4xl font-black text-accent mb-1">
                        {{ $nosotros->paises ?? '24/7' }}
                    </div>
                    <div class="text-[10px] font-mono font-semibold text-slate-500 uppercase tracking-wider">Soporte Técnico</div>
                </div>
            </div>
        </div>

        <!-- Bento Grid Images -->
        <div class="hidden lg:grid grid-cols-2 gap-4">
            <div class="aspect-square bg-slate-100 rounded-xl overflow-hidden shadow-sm">
                <img src="{{ isset($nosotros) && $nosotros->imagen_1 && file_exists(public_path('storage/' . $nosotros->imagen_1)) ? asset('storage/' . $nosotros->imagen_1) : 'https://picsum.photos/400/400?random=1' }}" alt="Industrial Equipment" class="w-full h-full object-cover">
            </div>
            <div class="aspect-square bg-slate-100 rounded-xl overflow-hidden shadow-sm mt-8">
                <img src="{{ isset($nosotros) && $nosotros->imagen_2 && file_exists(public_path('storage/' . $nosotros->imagen_2)) ? asset('storage/' . $nosotros->imagen_2) : 'https://picsum.photos/400/400?random=2' }}" alt="Production Line" class="w-full h-full object-cover">
            </div>
            <div class="aspect-square bg-slate-100 rounded-xl overflow-hidden shadow-sm -mt-8">
                <img src="{{ isset($nosotros) && $nosotros->imagen_3 && file_exists(public_path('storage/' . $nosotros->imagen_3)) ? asset('storage/' . $nosotros->imagen_3) : 'https://picsum.photos/400/400?random=3' }}" alt="Technical Assembly" class="w-full h-full object-cover">
            </div>
            <div class="aspect-square bg-slate-100 rounded-xl overflow-hidden shadow-sm">
                <img src="{{ isset($nosotros) && $nosotros->imagen_4 && file_exists(public_path('storage/' . $nosotros->imagen_4)) ? asset('storage/' . $nosotros->imagen_4) : 'https://picsum.photos/400/400?random=4' }}" alt="Control System" class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Mission, Vision & Values Section -->
    <section class="py-12 border-y border-slate-200">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-3xl font-black text-primary tracking-tight">Nuestros Pilares</h2>
            <p class="mt-2 text-slate-500">Fundamentos estratégicos de nuestro compromiso tecnológico industrial.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Misión -->
            <div class="p-8 bg-white border border-slate-200 rounded-xl shadow-premium hover:border-accent/40 transition-all flex flex-col space-y-4">
                <div class="w-12 h-12 bg-slate-100 rounded-lg text-primary flex items-center justify-center">
                    <i class="fa-solid fa-crosshairs text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-primary">Misión</h3>
                <div class="text-slate-500 leading-relaxed text-sm">
                    {!! $nosotros->mision ?? '<p>Proveer maquinaria de envasado innovadora, confiable y eficiente que optimice los procesos productivos de nuestros clientes, garantizando soporte técnico permanente y de alta calidad.</p>' !!}
                </div>
            </div>

            <!-- Visión -->
            <div class="p-8 bg-slate-900 text-white rounded-xl shadow-2xl flex flex-col space-y-4">
                <div class="w-12 h-12 bg-slate-800 rounded-lg text-accent flex items-center justify-center">
                    <i class="fa-solid fa-eye text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white">Visión</h3>
                <div class="text-slate-300 leading-relaxed text-sm">
                    {!! $nosotros->vision ?? '<p>Ser reconocidos para el 2030 como el principal socio estratégico en soluciones de envasado automatizado en la región, impulsando la innovación técnica y la sostenibilidad.</p>' !!}
                </div>
            </div>

            <!-- Valores -->
            <div class="p-8 bg-white border border-slate-200 rounded-xl shadow-premium hover:border-accent/40 transition-all flex flex-col space-y-4">
                <div class="w-12 h-12 bg-slate-100 rounded-lg text-primary flex items-center justify-center">
                    <i class="fa-solid fa-handshake text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-primary">Valores</h3>
                <div class="text-slate-500 leading-relaxed text-sm">
                    {!! $nosotros->valores ?? '<p>Innovación técnica, compromiso con la calidad, integridad profesional, soporte centrado en el cliente y sostenibilidad en cada solución que entregamos.</p>' !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Talent/Team Section -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 relative rounded-2xl overflow-hidden border-8 border-slate-200 shadow-2xl">
            <img src="{{ isset($nosotros) && $nosotros->imagen_talento && file_exists(public_path('storage/' . $nosotros->imagen_talento)) ? asset('storage/' . $nosotros->imagen_talento) : 'https://picsum.photos/600/400?random=5' }}" alt="Equipo Técnico" class="w-full h-auto object-cover hover:scale-102 transition-transform duration-500">
        </div>

        <div class="order-1 lg:order-2 space-y-6">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-mono font-bold text-primary bg-slate-100 uppercase tracking-wider">
                Talento Humano
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-primary tracking-tight">
                {{ $nosotros->titulo_talento ?? 'Ingeniería y Soporte Calificado' }}
            </h2>
            <div class="text-slate-600 leading-relaxed text-base">
                {!! $nosotros->descripcion_talento ?? '<p>Contamos con un equipo multidisciplinario de ingenieros mecánicos, electrónicos y técnicos de automatización listos para dar mantenimiento e integrar sistemas complejos en su planta.</p>' !!}
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-slate-200">
                <div class="flex gap-3">
                    <div class="p-2.5 bg-slate-100 text-primary rounded-lg h-fit flex-shrink-0">
                        <i class="fa-solid fa-users-gear text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-primary text-sm mb-1">{{ $nosotros->subtitulo_1 ?? 'Instalación y Puesta en Marcha' }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $nosotros->subtitulo_1_descripcion ?? 'Integramos la línea de producción directo en su establecimiento y capacitamos a su personal.' }}</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="p-2.5 bg-slate-100 text-primary rounded-lg h-fit flex-shrink-0">
                        <i class="fa-solid fa-headset text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-primary text-sm mb-1">{{ $nosotros->subtitulo_2 ?? 'Mantenimiento Preventivo' }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $nosotros->subtitulo_2_descripcion ?? 'Visitas técnicas programadas para asegurar el uptime de su maquinaria.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
