@extends('layouts.app')

@section('content')
<div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white border border-slate-200 rounded-2xl p-8 sm:p-10 shadow-premium space-y-6">
        <h1 class="text-3xl font-black text-primary border-b border-slate-100 pb-4">Términos y Condiciones de Uso</h1>
        
        <div class="text-slate-600 text-sm leading-relaxed space-y-4 prose max-w-none">
            @if(isset($company) && $company->terminos_condiciones)
                {!! $company->terminos_condiciones !!}
            @else
                <p><strong>Última actualización: {{ date('d/m/Y') }}</strong></p>
                
                <p>
                    El presente documento establece los Términos y Condiciones bajo los cuales DELTAPACK regula el acceso y uso de su sitio web. Le pedimos que lea atentamente esta información.
                </p>

                <h3 class="text-base font-bold text-primary pt-2">1. Propiedad Intelectual</h3>
                <p>
                    Todo el contenido de este sitio web, incluyendo imágenes, logotipos, fichas técnicas, especificaciones de productos y códigos de programación, es propiedad exclusiva de DELTAPACK o de sus respectivos fabricantes y proveedores de marcas de envasado, protegidos por las leyes nacionales e internacionales de derechos de autor.
                </p>

                <h3 class="text-base font-bold text-primary pt-2">2. Cotizaciones y Precios Referenciales</h3>
                <p>
                    Los precios de los equipos de envasado mostrados en este sitio web son <strong>netamente referenciales</strong> y están sujetos a variaciones sin previo aviso en función de los costos de importación, fletes, configuraciones específicas de planta y accesorios adicionales. Ningún precio mostrado constituye una oferta vinculante o contrato de venta. Toda venta formal requiere una cotización oficial emitida por escrito por un asesor comercial autorizado y la firma de la orden de compra respectiva.
                </p>

                <h3 class="text-base font-bold text-primary pt-2">3. Responsabilidad del Usuario</h3>
                <p>
                    El usuario se compromete a hacer uso de este sitio de manera diligente, correcta y lícita. Queda estrictamente prohibido utilizar el sitio para enviar consultas falsas, solicitudes de cotizaciones fraudulentas o spam técnico que afecte la operatividad de los asesores.
                </p>

                <h3 class="text-base font-bold text-primary pt-2">4. Limitación de Responsabilidad</h3>
                <p>
                    DELTAPACK realiza sus mejores esfuerzos para asegurar que la información técnica y de stock de los equipos sea precisa. Sin embargo, no se garantiza la total ausencia de errores tipográficos en las fichas técnicas o especificaciones. Nos reservamos el derecho de rectificar cualquier error sin responsabilidad alguna.
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
