@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Sidebar Filters -->
        <aside class="w-full lg:w-64 space-y-6 flex-shrink-0">
            <!-- Search Widget -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm space-y-3">
                <h4 class="font-mono text-xs uppercase tracking-widest text-primary font-bold">Buscar</h4>
                <div class="relative">
                    <input type="text" id="inputBuscar" placeholder="Nombre o descripción..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded text-sm focus:border-accent focus:bg-white focus:outline-none transition-all">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm space-y-3">
                <h4 class="font-mono text-xs uppercase tracking-widest text-primary font-bold">Sistemas de Envasado</h4>
                <div class="space-y-2">
                    @forelse($categories as $category)
                        <label class="flex items-center gap-2.5 text-sm text-slate-600 hover:text-primary cursor-pointer select-none">
                            <input type="checkbox" name="categorias[]" value="{{ $category->id }}" class="category-checkbox rounded border-slate-300 text-accent focus:ring-accent w-4 h-4">
                            <span>{{ $category->nombre }}</span>
                        </label>
                    @empty
                        <p class="text-xs text-slate-400">No hay categorías.</p>
                    @endforelse
                </div>
            </div>

            <!-- Brands Widget -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm space-y-3">
                <h4 class="font-mono text-xs uppercase tracking-widest text-primary font-bold">Fabricantes</h4>
                <div class="space-y-2">
                    @forelse($brands as $brand)
                        <label class="flex items-center gap-2.5 text-sm text-slate-600 hover:text-primary cursor-pointer select-none">
                            <input type="checkbox" name="marcas[]" value="{{ $brand->id }}" class="brand-checkbox rounded border-slate-300 text-accent focus:ring-accent w-4 h-4">
                            <span>{{ $brand->nombre }}</span>
                        </label>
                    @empty
                        <p class="text-xs text-slate-400">No hay marcas.</p>
                    @endforelse
                </div>
            </div>
        </aside>

        <!-- Product Grid Content -->
        <div class="flex-grow space-y-6">
            <!-- Header Grid Info -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-sm text-slate-500">
                    Mostrando <strong id="catalog-count-desde">0</strong> a <strong id="catalog-count-hasta">0</strong> de <strong id="catalog-count-total">0</strong> equipos
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-xs font-mono font-bold text-slate-500 uppercase">Ordenar por:</span>
                    <select id="selectOrden" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded text-sm focus:outline-none focus:border-accent">
                        <option value="recientes">Más Recientes</option>
                        <option value="precio_asc">Precio: Menor a Mayor</option>
                        <option value="precio_desc">Precio: Mayor a Menor</option>
                        <option value="nombre">Orden Alfabético</option>
                    </select>
                </div>
            </div>

            <!-- AJAX Products List container -->
            <div id="catalog-products-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 min-h-[300px]">
                <!-- Loaders or items will be injected here -->
            </div>

            <!-- AJAX Pagination container -->
            <div id="catalog-pagination-container" class="flex justify-center pt-6">
                <!-- Pagination will be injected here -->
            </div>
        </div>

    </div>
</div>

<!-- JQuery & AJAX Implementation -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        // Run filter queries
        function fetchProducts(page = 1) {
            // Collect filters
            let search = $('#inputBuscar').val();
            let orden = $('#selectOrden').val();
            
            let categorias = [];
            $('.category-checkbox:checked').each(function () {
                categorias.push($(this).val());
            });

            let marcas = [];
            $('.brand-checkbox:checked').each(function () {
                marcas.push($(this).val());
            });

            // Set loading state
            $('#catalog-products-container').html(`
                <div class="col-span-full flex flex-col items-center justify-center py-12 text-slate-400">
                    <i class="fa-solid fa-circle-notch fa-spin text-4xl text-accent mb-2"></i>
                    <span>Cargando equipos...</span>
                </div>
            `);

            // Execute ajax request
            $.ajax({
                url: "{{ route('tienda.productos') }}",
                data: {
                    buscar: search,
                    categorias: categorias.join(','),
                    marcas: marcas.join(','),
                    orden: orden,
                    page: page
                },
                success: function (res) {
                    $('#catalog-products-container').html(res.html);
                    $('#catalog-pagination-container').html(res.pagination);
                    
                    $('#catalog-count-total').text(res.total);
                    $('#catalog-count-desde').text(res.desde || 0);
                    $('#catalog-count-hasta').text(res.hasta || 0);
                },
                error: function () {
                    $('#catalog-products-container').html(`
                        <div class="col-span-full py-12 text-center text-red-500">
                            <i class="fa-solid fa-triangle-exclamation text-3xl mb-2"></i>
                            <p>Ocurrió un error al cargar los equipos. Inténtelo de nuevo más tarde.</p>
                        </div>
                    `);
                }
            });
        }

        // Initialize Catalog list
        fetchProducts();

        // Listen for filter changes
        $('#inputBuscar').on('keyup', function () {
            fetchProducts();
        });

        $('#selectOrden').on('change', function () {
            fetchProducts();
        });

        $('.category-checkbox, .brand-checkbox').on('change', function () {
            fetchProducts();
        });

        // Pagination page selection handler
        $(document).on('click', '#catalog-pagination-container a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchProducts(page);
            // Smooth scroll to top of catalog section
            $('html, body').animate({ scrollTop: 40 }, 400);
        });
    });
</script>
@endsection
