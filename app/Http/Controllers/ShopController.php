<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Company;
use App\Models\Product;
use App\Models\Specialist;
use App\Models\Taxonomy;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display Shop Catalog view
     */
    public function index()
    {
        $company = Company::first();
        $especialistas = Specialist::all();

        $categories = Taxonomy::withCount([
            'products as total' => function ($q) {
                $q->where('activo', true);
            }
        ])->orderBy('nombre')->get();

        $brands = Brand::withCount([
            'products as total' => function ($q) {
                $q->where('activo', true);
            }
        ])->orderBy('nombre')->get();

        return view('tienda', compact('company', 'categories', 'brands', 'especialistas'));
    }

    /**
     * Handle AJAX Product retrieval & filtering
     */
    public function productos(Request $request)
    {
        $query = Product::with(['taxonomy', 'brand'])
            ->where('activo', true);

        // Search text filter
        if ($request->filled('buscar')) {
            $buscar = trim($request->buscar);
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('descripcion_corta', 'like', "%{$buscar}%")
                  ->orWhere('desripcion_detallada', 'like', "%{$buscar}%")
                  ->orWhere('slug', 'like', "%{$buscar}%");
            });
        }

        // Category filter (comma separated ID list)
        if ($request->filled('categorias')) {
            $categorias = explode(',', $request->categorias);
            $query->whereIn('taxonomy_id', $categorias);
        }

        // Brand filter (comma separated ID list)
        if ($request->filled('marcas')) {
            $marcas = explode(',', $request->marcas);
            $query->whereIn('brand_id', $marcas);
        }

        // Sorting options
        switch ($request->orden) {
            case 'precio_asc':
                $query->orderBy('precio_referencial', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio_referencial', 'desc');
                break;
            case 'nombre':
                $query->orderBy('nombre', 'asc');
                break;
            case 'recientes':
            default:
                $query->latest();
                break;
        }

        // Pagination settings
        $perPage = $request->perPage ?? 12;
        $products = $query->paginate($perPage);

        // AJAX response returns pre-rendered subviews and metadata
        if ($request->ajax()) {
            return response()->json([
                'html' => view('ajax.productos', compact('products'))->render(),
                'pagination' => view('ajax.pagination', compact('products'))->render(),
                'total' => $products->total(),
                'desde' => $products->firstItem(),
                'hasta' => $products->lastItem()
            ]);
        }

        abort(404);
    }
}
