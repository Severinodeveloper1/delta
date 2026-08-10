@forelse($products as $product)
    <div class="group bg-white border border-slate-200 rounded-lg overflow-hidden shadow-premium hover:-translate-y-1 hover:border-slate-300 transition-all duration-300 flex flex-col">
        <div class="relative aspect-square overflow-hidden bg-slate-50">
            @php
                $imagenes = is_array($product->imagenes) ? $product->imagenes : json_decode($product->imagenes, true);
                $imagen = $imagenes[0] ?? 'no-image.png';
            @endphp
            @if($imagen && $imagen !== 'no-image.png' && file_exists(public_path('storage/' . $imagen)))
                <img src="{{ asset('storage/' . $imagen) }}" alt="{{ $product->nombre }}" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-300">
                    <i class="fa-solid fa-box text-6xl"></i>
                </div>
            @endif
            @if($product->destacado)
                <span class="absolute top-3 left-3 px-2 py-1 text-[10px] font-mono font-bold text-white bg-accent/90 rounded tracking-wider uppercase">
                    Destacado
                </span>
            @endif
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
    <div class="col-span-full py-16 text-center text-slate-400">
        <i class="fa-solid fa-box-open text-5xl text-slate-300 mb-2 block"></i>
        <span>No se encontraron equipos que coincidan con los filtros seleccionados.</span>
    </div>
@endforelse
