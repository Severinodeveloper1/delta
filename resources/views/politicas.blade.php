@extends('layouts.app')

@section('content')
<div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white border border-slate-200 rounded-2xl p-8 sm:p-10 shadow-premium space-y-6">
        <h1 class="text-3xl font-black text-primary border-b border-slate-100 pb-4">Políticas de Privacidad</h1>
        
        <div class="text-slate-600 text-sm leading-relaxed space-y-4 prose max-w-none">
            <p><strong>Última actualización: {{ date('d/m/Y') }}</strong></p>
            
            <p>
                DELTAPACK está plenamente comprometido con la protección de los datos personales de sus clientes y usuarios. En cumplimiento de la Ley N° 29733 (Ley de Protección de Datos Personales de Perú) y su reglamento, informamos sobre el tratamiento de su información.
            </p>

            <h3 class="text-base font-bold text-primary pt-2">1. Recopilación de Datos</h3>
            <p>
                Los datos que recopilamos a través de nuestros formularios de contacto, solicitud de cotización y libro de reclamaciones (tales como nombres, correo electrónico, empresa, teléfono y ciudad) son brindados voluntariamente por el usuario.
            </p>

            <h3 class="text-base font-bold text-primary pt-2">2. Finalidad del Tratamiento</h3>
            <p>
                Sus datos personales serán tratados exclusivamente para las siguientes finalidades:
                <br>- Atender sus solicitudes de información y cotizaciones de maquinaria.
                <br>- Brindarle soporte técnico postventa y asesoramiento operativo.
                <br>- Procesar quejas y reclamos formalizados a través del Libro de Reclamaciones.
                <br>- Enviar información comercial y actualizaciones tecnológicas de su interés (solo si ha brindado su consentimiento).
            </p>

            <h3 class="text-base font-bold text-primary pt-2">3. Confidencialidad y Seguridad</h3>
            <p>
                DELTAPACK no comparte, vende ni arrienda sus datos personales a terceros sin su consentimiento explícito, excepto cuando sea requerido por mandato judicial o autoridad competente. Contamos con medidas de seguridad de TI adecuadas para evitar accesos no autorizados o pérdida de información.
            </p>

            <h3 class="text-base font-bold text-primary pt-2">4. Derechos ARCO</h3>
            <p>
                Los usuarios pueden ejercer en cualquier momento sus derechos de Acceso, Rectificación, Cancelación y Oposición (Derechos ARCO) respecto a sus datos personales escribiendo directamente a nuestro correo de contacto corporativo.
            </p>
        </div>
    </div>
</div>
@endsection
