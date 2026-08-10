@extends('layouts.app')

@section('content')
<div class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Header Page Info -->
    <div class="space-y-4 max-w-3xl">
        <h2 class="text-xs font-mono font-bold text-accent uppercase tracking-widest border-l-4 border-accent pl-3">
            Atención Comercial
        </h2>
        <h1 class="text-3xl sm:text-5xl font-black text-primary tracking-tight">
            Canales de Atención Técnica y Comercial
        </h1>
        <p class="text-slate-500 leading-relaxed text-base">
            Atendemos llamadas, mensajes y solicitudes técnicas de <strong>Lunes a Viernes de 9:00 a.m. a 5:00 p.m.</strong> (no feriados). Las solicitudes enviadas fuera de este horario serán atendidas a primera hora del día siguiente útil.
        </p>
    </div>

    <!-- Main Grid Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Side: Address, Map, and Cards -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Address and Embed Map Card -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-premium overflow-hidden">
                <div class="p-6 space-y-2">
                    <div class="flex items-center gap-2 text-primary font-bold text-lg">
                        <i class="fa-solid fa-location-dot"></i>
                        <h3>Sede Central</h3>
                    </div>
                    <p class="text-sm text-slate-500">
                        {{ $company->direccion ?? 'Dirección de la empresa no configurada' }}
                    </p>
                </div>
                <!-- Google Maps Iframe -->
                @if(isset($company) && $company->ubicacion)
                    <div class="w-full h-64 border-t border-slate-100 relative">
                        {!! $company->ubicacion !!}
                    </div>
                @else
                    <div class="w-full h-64 border-t border-slate-100 bg-slate-100 flex items-center justify-center text-slate-400">
                        <i class="fa-solid fa-map-location-dot text-6xl"></i>
                    </div>
                @endif
            </div>

            <!-- Contact Info Cards -->
            <div class="space-y-4">
                <div class="p-6 bg-slate-50 rounded-xl border border-slate-200 flex gap-4">
                    <div class="p-3 bg-white text-primary rounded-lg border border-slate-200 h-fit">
                        <i class="fa-solid fa-phone text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-mono font-bold text-slate-500 uppercase tracking-widest mb-1">Teléfono Corporativo</h4>
                        <p class="text-xl font-bold text-primary">{{ $company->telefono ?? 'No configurado' }}</p>
                    </div>
                </div>

                <div class="p-6 bg-slate-50 rounded-xl border border-slate-200 flex gap-4">
                    <div class="p-3 bg-white text-teal-600 rounded-lg border border-slate-200 h-fit">
                        <i class="fa-solid fa-envelope text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-mono font-bold text-slate-500 uppercase tracking-widest mb-1">Correo Electrónico</h4>
                        <p class="text-xl font-bold text-primary">{{ $company->correo ?? 'No configurado' }}</p>
                    </div>
                </div>

                <div class="p-6 bg-slate-50 rounded-xl border border-slate-200 flex gap-4">
                    <div class="p-3 bg-white text-accent rounded-lg border border-slate-200 h-fit">
                        <i class="fa-solid fa-clock text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-mono font-bold text-slate-500 uppercase tracking-widest mb-1">Horario de Atención</h4>
                        <p class="text-xl font-bold text-primary">{{ $company->horario ?? 'No configurado' }}</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Side: Contact Form -->
        <div class="lg:col-span-7 bg-white border border-slate-200 rounded-2xl p-8 sm:p-10 shadow-premium space-y-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full translate-x-12 -translate-y-12"></div>
            
            <h2 class="text-2xl font-black text-primary">Enviar Consulta</h2>

            <form action="{{ route('contacto.enviar') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-2">Nombre Completo *</label>
                        <input type="text" name="nombre" required placeholder="Ej. Juan Pérez" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-2">Empresa</label>
                        <input type="text" name="empresa" placeholder="Ej. Delta Corp" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-2">Celular *</label>
                        <input type="tel" name="telefono" required placeholder="Ej. 999999999" maxlength="12" pattern="[0-9]{1,12}" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,12)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-2">Correo Corporativo *</label>
                        <input type="email" name="correo" required placeholder="nombre@empresa.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                </div>

                <!-- Specialist Visual Selector -->
                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-4">Seleccionar Especialista Técnico *</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @forelse($especialistas as $especialista)
                            <div>
                                <input type="radio" name="especialista" id="especialista{{ $especialista->id }}" value="{{ $especialista->id }}" required class="peer hidden">
                                <label for="especialista{{ $especialista->id }}" class="flex items-center gap-3 p-4 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50 peer-checked:border-accent peer-checked:bg-orange-50/50 transition-all h-full">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-200">
                                        @if($especialista->imagen)
                                            <img src="{{ asset('storage/' . $especialista->imagen) }}" alt="Advisor" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <i class="fa-solid fa-user text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="space-y-0.5">
                                        <h4 class="text-xs font-bold text-primary leading-tight">{{ $especialista->cargo }}</h4>
                                        <p class="text-[10px] text-slate-500 leading-none">{{ $especialista->nombre }}</p>
                                    </div>
                                </label>
                            </div>
                        @empty
                            <div class="col-span-full text-center text-slate-400 py-2">
                                No hay especialistas registrados.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-2">Detalles de la Consulta *</label>
                    <textarea name="mensaje" required rows="4" placeholder="Describa sus requerimientos técnicos, velocidades de envasado, o tipos de producto..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded focus:border-accent focus:bg-white focus:outline-none transition-all"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-4">
                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-accent hover:bg-accent-dark text-white font-bold text-sm tracking-wider uppercase transition-all rounded shadow-md">
                        <i class="fa-solid fa-paper-plane"></i>
                        Enviar Consulta
                    </button>
                    <p class="text-xs text-slate-400 italic text-center sm:text-right max-w-xs">
                        Su solicitud será revisada por nuestro equipo técnico para responderle en un plazo máximo de 24 horas hábiles.
                    </p>
                </div>
            </form>
        </div>

    </div>
</div>

<style>
    /* Styling Google Map embedded iframe to fit container */
    iframe {
        width: 100% !important;
        height: 100% !important;
        border: 0;
        position: absolute;
        inset: 0;
    }
</style>
@endsection
