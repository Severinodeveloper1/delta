@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Breadcrumb or Back navigation -->
    <div>
        <a href="{{ route('tienda') }}" class="inline-flex items-center gap-2 text-xs font-mono font-bold text-slate-500 hover:text-accent transition-colors uppercase">
            <i class="fa-solid fa-arrow-left-long"></i> Volver a Equipos
        </a>
    </div>

    <!-- Product Intro Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Left Side: Interactive Gallery -->
        <div class="lg:col-span-7 space-y-4">
            @php
                $imagenes = is_array($product->imagenes) ? $product->imagenes : json_decode($product->imagenes, true);
                $firstImagen = $imagenes[0] ?? 'no-image.png';
            @endphp
            
            <!-- Main Image Zoom container -->
            <div id="mainGallery" class="relative aspect-video rounded-xl bg-slate-50 border border-slate-200 overflow-hidden group cursor-crosshair">
                @if($firstImagen && $firstImagen !== 'no-image.png' && file_exists(public_path('storage/' . $firstImagen)))
                    <img id="mainImage" src="{{ asset('storage/' . $firstImagen) }}" alt="{{ $product->nombre }}" class="w-full h-full object-contain transition-transform duration-500 origin-center">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-300">
                        <i class="fa-solid fa-box text-8xl"></i>
                    </div>
                @endif
                
                <div class="absolute bottom-4 left-4 px-4 py-2.5 bg-accent text-white flex items-center gap-3 shadow-lg rounded">
                    <i class="fa-solid fa-circle-play text-lg"></i>
                    <div class="flex flex-col leading-none">
                        <span class="text-xs font-mono font-bold uppercase tracking-wider">Equipo en Uso</span>
                        <span class="text-[9px] opacity-75">Video Demostrativo</span>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Grid -->
            @if(count($imagenes) > 1)
                <div class="grid grid-cols-5 gap-3">
                    @foreach($imagenes as $index => $img)
                        @if(file_exists(public_path('storage/' . $img)))
                            <button type="button" class="thumb-item aspect-square rounded-lg border overflow-hidden transition-all {{ $index === 0 ? 'border-accent ring-1 ring-accent' : 'border-slate-200 hover:border-slate-300' }}" data-src="{{ asset('storage/' . $img) }}">
                                <img src="{{ asset('storage/' . $img) }}" alt="Thumbnail" class="w-full h-full object-contain">
                            </button>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right Side: Details & Quote Request Button -->
        <div class="lg:col-span-5 space-y-6">
            <div class="space-y-2">
                <span class="text-xs font-mono font-bold text-accent uppercase tracking-widest">
                    {{ $product->taxonomy->nombre ?? 'Sistema de Envasado' }}
                </span>
                <h1 class="text-3xl font-black text-primary tracking-tight leading-tight">
                    {{ $product->nombre }}
                </h1>
                
                <!-- Manufacturer Badge -->
                @if($product->brand)
                    <div class="text-xs text-slate-400 font-mono">
                        Fabricante: <strong class="text-slate-600 font-sans font-bold">{{ $product->brand->nombre }}</strong>
                    </div>
                @endif
            </div>

            <!-- Short description -->
            <div class="text-slate-600 border-l-4 border-primary pl-4 py-1 text-base leading-relaxed">
                {{ $product->descripcion_corta }}
            </div>

            <!-- Price & Actions Card -->
            <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl space-y-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-accent/5 rounded-full translate-x-8 -translate-y-8 pointer-events-none"></div>
                
                <div class="space-y-1">
                    <span class="text-xs font-mono font-bold text-slate-400 uppercase tracking-wider">Precio Referencial</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-primary">US$ {{ number_format($product->precio_referencial, 2) }}</span>
                        <span class="text-xs font-mono text-slate-400">Inc. IGV</span>
                    </div>
                    <p class="text-[10px] text-slate-500 italic">
                        * Sujeto a evaluación, contacte a un asesor para configuración final y leasing.
                    </p>
                </div>

                <button type="button" onclick="openQuoteModal()" class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 bg-accent hover:bg-accent-dark text-white font-bold text-lg uppercase tracking-wider transition-all rounded shadow-md">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    Solicitar Cotización
                </button>
            </div>

            <!-- Key Features Icons -->
            <div class="grid grid-cols-3 gap-3">
                <div class="p-4 bg-white border border-slate-200 rounded-lg text-center space-y-1 shadow-sm">
                    <i class="fa-solid fa-shield-halved text-accent text-lg"></i>
                    <span class="block text-[9px] font-mono font-bold text-slate-500 uppercase">1 Año de Garantía</span>
                </div>
                <div class="p-4 bg-white border border-slate-200 rounded-lg text-center space-y-1 shadow-sm">
                    <i class="fa-solid fa-headset text-accent text-lg"></i>
                    <span class="block text-[9px] font-mono font-bold text-slate-500 uppercase">Soporte Técnico</span>
                </div>
                <div class="p-4 bg-white border border-slate-200 rounded-lg text-center space-y-1 shadow-sm">
                    <i class="fa-solid fa-truck-fast text-accent text-lg"></i>
                    <span class="block text-[9px] font-mono font-bold text-slate-500 uppercase">Envíos a todo el país</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Detailed Description Section -->
    @if($product->desripcion_detallada)
        <section class="pt-10 border-t border-slate-200 space-y-4">
            <div class="space-y-1">
                <span class="text-xs font-mono font-bold text-accent uppercase tracking-wider">Descripción Completa</span>
                <h2 class="text-2xl font-black text-primary">Información General del Equipo</h2>
            </div>
            <div class="prose max-w-none text-slate-600 leading-relaxed bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                {!! $product->desripcion_detallada !!}
            </div>
        </section>
    @endif

    <!-- Specifications HTML table -->
    <section class="pt-10 border-t border-slate-200 space-y-4">
        <div class="space-y-1">
            <span class="text-xs font-mono font-bold text-accent uppercase tracking-wider">Profundidad Técnica</span>
            <h2 class="text-2xl font-black text-primary">Ficha Técnica Detallada</h2>
        </div>
        
        @if($product->especificaciones)
            <div class="prose max-w-none bg-white border border-slate-200 rounded-xl p-6 shadow-sm overflow-x-auto especificaciones-table">
                {!! $product->especificaciones !!}
            </div>
        @else
            <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl text-center text-slate-400">
                No hay especificaciones técnicas disponibles para este equipo.
            </div>
        @endif
    </section>

    <!-- Documents PDF Module -->
    @php
        $urlFicha = null;
        if (!empty($product->ficha_tecnica)) {
            $fichaData = $product->ficha_tecnica;
            $filePath = null;
            if (is_array($fichaData)) {
                $filePath = $fichaData[0]['download_link'] ?? $fichaData[0] ?? null;
            } elseif (is_string($fichaData)) {
                $filePath = $fichaData;
            }
            if ($filePath) {
                $urlFicha = asset('storage/' . str_replace('\\', '/', $filePath));
            }
        }
    @endphp

    @if($urlFicha)
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-10 border-t border-slate-200">
            <div class="p-6 bg-slate-900 text-white rounded-xl shadow-xl flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                    <i class="fa-solid fa-file-pdf text-accent text-4xl"></i>
                    <h3 class="text-lg font-bold">Documentación Técnica</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Descargue los diagramas de planta, especificaciones de alimentación neumática y guías de mantenimiento preventivo.
                    </p>
                </div>
                <a href="{{ $urlFicha }}" target="_blank" download class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-white text-primary hover:bg-accent hover:text-white font-bold text-xs font-mono transition-all rounded">
                    Descargar Ficha Técnica PDF
                </a>
            </div>
        </section>
    @endif
</div>

<!-- Modal request quote form overlay -->
<div id="cotizacionModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeQuoteModal()"></div>

    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen p-4 relative z-10">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-8 shadow-2xl space-y-6 border border-slate-200">
            
            <div class="flex justify-between items-start">
                <h3 class="text-xl font-black text-primary">Solicitar Cotización</h3>
                <button type="button" onclick="closeQuoteModal()" class="text-slate-400 hover:text-primary focus:outline-none">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Product info banner -->
            <div class="p-4 bg-slate-50 border border-slate-200 rounded-lg text-xs space-y-1.5">
                <div><strong>Equipo:</strong> <span class="text-slate-600">{{ $product->nombre }}</span></div>
                <div><strong>Precio Referencial:</strong> <span class="text-slate-600">US$ {{ number_format($product->precio_referencial, 2) }}</span></div>
                <div><strong>Categoría:</strong> <span class="text-slate-600">{{ $product->taxonomy->nombre ?? 'N/A' }}</span></div>
            </div>

            <form id="formCotizacion" action="{{ route('cotizacion.enviar') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="producto" value="{{ $product->nombre }}">
                <input type="hidden" name="precio" value="{{ $product->precio_referencial }}">
                <input type="hidden" name="categoria" value="{{ $product->taxonomy->nombre ?? 'N/A' }}">

                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Nombre Completo *</label>
                    <input type="text" name="nombre" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Empresa</label>
                    <input type="text" name="empresa" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Correo *</label>
                        <input type="email" name="correo" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Celular *</label>
                        <input type="text" name="telefono" required maxlength="12" pattern="[0-9]{1,12}" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,12)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Ciudad</label>
                    <input type="text" name="ciudad" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Mensaje</label>
                    <textarea name="mensaje" rows="3" placeholder="Requerimientos de velocidad, tamaño de bolsa, voltaje..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" id="btnEnviarCotizacion" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-primary hover:bg-accent text-white font-bold text-sm tracking-wider uppercase transition-all rounded shadow-md">
                        Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Gallery script & Zoom effects -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Thumbnail switching logic
        const thumbs = document.querySelectorAll('.thumb-item');
        const mainImage = document.getElementById('mainImage');

        thumbs.forEach(button => {
            button.addEventListener('click', function () {
                // Remove active rings
                thumbs.forEach(t => t.classList.remove('border-accent', 'ring-1', 'ring-accent'));
                // Add active rings to current
                button.classList.add('border-accent', 'ring-1', 'ring-accent');
                // Change main src
                const newSrc = button.getAttribute('data-src');
                if (mainImage && newSrc) {
                    mainImage.src = newSrc;
                }
            });
        });

        // Hover Zoom effect
        const gallery = document.getElementById('mainGallery');
        if (gallery && mainImage) {
            gallery.addEventListener('mousemove', function (e) {
                const rect = gallery.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width;
                const y = (e.clientY - rect.top) / rect.height;
                mainImage.style.transformOrigin = `${x * 100}% ${y * 100}%`;
                mainImage.style.transform = 'scale(1.3)';
            });

            gallery.addEventListener('mouseleave', function () {
                mainImage.style.transform = 'scale(1)';
                mainImage.style.transformOrigin = 'center';
            });
        }
    });

    // Modal Control functions
    function openQuoteModal() {
        const modal = document.getElementById('cotizacionModal');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeQuoteModal() {
        const modal = document.getElementById('cotizacionModal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    // Capture and submit the quote request form via AJAX (preventing Direct JSON Redirect)
    document.addEventListener('DOMContentLoaded', function () {
        const formCotizacion = document.getElementById('formCotizacion');
        const btnEnviar = document.getElementById('btnEnviarCotizacion');
        
        if (formCotizacion) {
            formCotizacion.addEventListener('submit', function (e) {
                e.preventDefault();
                
                if (btnEnviar) {
                    btnEnviar.disabled = true;
                    btnEnviar.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Enviando...';
                }
                
                const formData = new FormData(formCotizacion);
                
                fetch(formCotizacion.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (response.status === 429) {
                        throw new Error('Demasiadas solicitudes. Por favor, espere un minuto antes de intentar de nuevo.');
                    }
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Error en el servidor al enviar la solicitud.');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (btnEnviar) {
                        btnEnviar.disabled = false;
                        btnEnviar.innerHTML = 'Enviar Solicitud';
                    }
                    
                    if (data.success) {
                        closeQuoteModal();
                        Swal.fire({
                            icon: 'success',
                            title: '¡Solicitud Enviada!',
                            text: data.message,
                            confirmButtonColor: '#0d6efd'
                        });
                        formCotizacion.reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Hubo un error al procesar su solicitud.',
                            confirmButtonColor: '#0f172a'
                        });
                    }
                })
                .catch(error => {
                    if (btnEnviar) {
                        btnEnviar.disabled = false;
                        btnEnviar.innerHTML = 'Enviar Solicitud';
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'No se pudo conectar con el servidor. Verifique su conexión.',
                        confirmButtonColor: '#0f172a'
                    });
                });
            });
        }
    });
</script>

<style>
    /* Styling styles inside product specifications table output */
    .especificaciones-table table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    .especificaciones-table th {
        background-color: #f8fafc !important;
        padding: 12px 16px !important;
        border: 1px solid #e2e8f0 !important;
        font-family: 'JetBrains Mono', monospace !important;
        font-size: 13px !important;
        text-align: left !important;
    }
    .especificaciones-table td {
        padding: 12px 16px !important;
        border: 1px solid #e2e8f0 !important;
        font-size: 14px !important;
    }
</style>
@endsection
