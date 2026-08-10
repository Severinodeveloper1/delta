@extends('layouts.app')

@section('content')
<div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-10 shadow-premium space-y-8">
        
        <!-- Header Info -->
        <div class="text-center space-y-2 border-b border-slate-100 pb-6">
            <div class="inline-flex p-3 bg-accent/10 text-accent rounded-full">
                <i class="fa-solid fa-book text-2xl"></i>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-primary">Libro de Reclamaciones Virtual</h1>
            <p class="text-sm text-slate-500 max-w-md mx-auto">
                Conforme a lo establecido en el Código de Protección y Defensa del Consumidor, nuestra empresa pone a su disposición este libro virtual.
            </p>
        </div>

        <form id="formReclamo" class="space-y-6">
            @csrf
            
            <!-- 1. Identificación del Consumidor -->
            <div class="space-y-4">
                <h3 class="text-xs font-mono font-bold text-slate-500 uppercase tracking-widest border-l-4 border-accent pl-3">1. Identificación del Consumidor</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Nombres y Apellidos *</label>
                        <input type="text" name="nombre" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Tipo de Documento *</label>
                        <select name="tipo_doc" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                            <option value="DNI">DNI (Documento Nacional de Identidad)</option>
                            <option value="RUC">RUC</option>
                            <option value="CE">Carnet de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Número de Documento *</label>
                        <input type="text" name="nro_doc" required maxlength="20" oninput="this.value = this.value.replace(/[^A-Za-z0-9\-]/g, '')" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Teléfono / Celular *</label>
                        <input type="tel" name="telefono" required maxlength="12" pattern="[0-9]{1,12}" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,12)" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Correo Electrónico *</label>
                        <input type="email" name="correo" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Domicilio *</label>
                        <input type="text" name="domicilio" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                </div>
            </div>

            <!-- 2. Detalle del Bien Contratado -->
            <div class="space-y-4">
                <h3 class="text-xs font-mono font-bold text-slate-500 uppercase tracking-widest border-l-4 border-accent pl-3">2. Detalle del Bien Contratado</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Tipo de Bien *</label>
                        <select name="tipo_bien" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                            <option value="Producto">Producto (Maquinaria, Repuesto, Accesorio)</option>
                            <option value="Servicio">Servicio (Soporte Técnico, Instalación, Mantenimiento)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Monto Reclamado (S/. o US$)</label>
                        <input type="text" name="monto" placeholder="Ej. US$ 1,500.00" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Descripción del Bien *</label>
                    <input type="text" name="descripcion_bien" required placeholder="Ej. Selladora automática modelo Delta-300" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                </div>
            </div>

            <!-- 3. Detalle de la Reclamación -->
            <div class="space-y-4">
                <h3 class="text-xs font-mono font-bold text-slate-500 uppercase tracking-widest border-l-4 border-accent pl-3">3. Detalle del Reclamo o Queja</h3>
                
                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Tipo de Solicitud *</label>
                    <div class="flex gap-6 mt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="radio" name="tipo_solicitud" value="Reclamo" checked class="text-accent focus:ring-accent border-slate-300 w-4 h-4">
                            <span class="text-sm text-slate-700"><strong>Reclamo</strong> <span class="text-xs text-slate-400 font-sans">(Disconformidad relacionada al producto o servicio contratado)</span></span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="radio" name="tipo_solicitud" value="Queja" class="text-accent focus:ring-accent border-slate-300 w-4 h-4">
                            <span class="text-sm text-slate-700"><strong>Queja</strong> <span class="text-xs text-slate-400 font-sans">(Malestar o descontento respecto a la atención al cliente)</span></span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Detalle del Reclamo o Queja *</label>
                    <textarea name="detalle_reclamo" required rows="4" placeholder="Describa el inconveniente detalladamente..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold text-slate-500 uppercase tracking-wider mb-1">Pedido del Consumidor *</label>
                    <textarea name="pedido_consumidor" required rows="3" placeholder="¿Qué acción o compensación solicita?" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all"></textarea>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-6">
                <button type="submit" id="btnEnviarReclamo" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-accent hover:bg-accent-dark text-white font-bold text-sm tracking-wider uppercase transition-all rounded shadow-md">
                    <i class="fa-solid fa-paper-plane"></i>
                    Enviar Reclamación
                </button>
                <p class="text-xs text-slate-400 italic text-center sm:text-right max-w-xs">
                    Una copia de esta reclamación será enviada a su correo electrónico. Responderemos en un plazo máximo de 15 días hábiles.
                </p>
            </div>

        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#formReclamo').on('submit', function (e) {
            e.preventDefault();
            
            let btn = $('#btnEnviarReclamo');
            btn.prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin"></i> Enviando...');

            $.ajax({
                url: "/reclamo",
                type: "POST",
                data: $(this).serialize(),
                success: function (res) {
                    btn.prop('disabled', false).html('<i class="fa-solid fa-paper-plane"></i> Enviar Reclamación');
                    
                    if (res.status) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Reclamación Enviada!',
                            text: res.msg,
                            confirmButtonColor: '#f97316'
                        }).then(() => {
                            $('#formReclamo')[0].reset();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.msg,
                            confirmButtonColor: '#0f172a'
                        });
                    }
                },
                error: function () {
                    btn.prop('disabled', false).html('<i class="fa-solid fa-paper-plane"></i> Enviar Reclamación');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Red',
                        text: 'No se pudo procesar la solicitud. Verifique su conexión e intente nuevamente.',
                        confirmButtonColor: '#0f172a'
                    });
                }
            });
        });
    });
</script>
@endsection
