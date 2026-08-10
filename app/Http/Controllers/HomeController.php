<?php

namespace App\Http\Controllers;

use App\Mail\Reclamos;
use App\Models\About;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Product;
use App\Models\Section;
use App\Models\Specialist;
use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display Home Page
     */
    public function index()
    {
        $company = Company::first();
        $seccion = Section::first();
        $banners = Banner::all();
        $categories = Taxonomy::all();
        $especialistas = Specialist::all();
        
        $products = Product::with('taxonomy')
            ->where('destacado', true)
            ->where('activo', true)
            ->take(4)
            ->get();

        return view('home', compact('company', 'seccion', 'banners', 'categories', 'products', 'especialistas'));
    }

    /**
     * Display Product details
     */
    public function detalleProducto($slug)
    {
        $company = Company::first();
        $especialistas = Specialist::all();
        
        $product = Product::with(['taxonomy', 'brand'])
            ->where('slug', $slug)
            ->where('activo', true)
            ->firstOrFail();

        return view('producto-detalle', compact('product', 'company', 'especialistas'));
    }

    /**
     * Display About Us
     */
    public function nosotros()
    {
        $company = Company::first();
        $nosotros = About::first();
        $especialistas = Specialist::all();

        return view('nosotros', compact('company', 'nosotros', 'especialistas'));
    }

    /**
     * Display Contact
     */
    public function contacto()
    {
        $company = Company::first();
        $especialistas = Specialist::all();

        return view('contacto', compact('company', 'especialistas'));
    }

    /**
     * Handle Quote requests by email
     */
    public function enviar(Request $request)
    {
        $request->validate([
            'producto'  => 'required|string',
            'precio'    => 'nullable',
            'categoria' => 'nullable|string',
            'nombre'    => 'required|string|max:100|regex:/^[\pL\pN\s\.\,\-]+$/u',
            'empresa'   => 'nullable|string|max:150|regex:/^[\pL\pN\s\.\,\-]+$/u',
            'correo'    => 'required|email|max:150',
            'telefono'  => 'required|regex:/^[0-9]{1,12}$/',
            'ciudad'    => 'nullable|string|max:100|regex:/^[\pL\pN\s\.\,\-]+$/u',
            'mensaje'   => 'nullable|string|max:1000|regex:/^[\pL\pN\s\.\,\-]+$/u',
        ], [
            'nombre.regex'   => 'El nombre no puede contener caracteres especiales.',
            'empresa.regex'  => 'La empresa no puede contener caracteres especiales.',
            'ciudad.regex'   => 'La ciudad no puede contener caracteres especiales.',
            'mensaje.regex'  => 'El mensaje no puede contener caracteres especiales.',
            'telefono.regex' => 'El teléfono solo puede contener números (máximo 12 dígitos).',
        ]);

        $datos = $request->all();

        // Dynamically get the notification email from settings
        $company = Company::first();
        $destinatario = $company?->correo_notificaciones ?? 'contacto@deltapack.pe';

        Mail::send('emails.cotizacion', compact('datos'), function ($message) use ($datos, $destinatario) {
            $message->to($destinatario)
                    ->replyTo($datos['correo'], $datos['nombre'])
                    ->subject('Nueva Solicitud de Cotización - ' . $datos['producto']);
        });

        return response()->json([
            'success' => true,
            'message' => 'Su solicitud fue enviada correctamente. Nos pondremos en contacto con usted a la brevedad.'
        ]);
    }

    /**
     * Handle Contact form submissions
     */
    public function enviarContacto(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|max:100',
            'empresa'      => 'nullable|max:150',
            'telefono'     => 'required|max:30',
            'correo'       => 'required|email',
            'especialista' => 'required|exists:specialists,id',
            'mensaje'      => 'required|max:3000'
        ]);

        $especialista = Specialist::findOrFail($request->especialista);

        $datos = [
            'nombre'       => $request->nombre,
            'empresa'      => $request->empresa,
            'telefono'     => $request->telefono,
            'correo'       => $request->correo,
            'mensaje'      => $request->mensaje,
            'especialista' => $especialista
        ];

        // Dynamically get the notification email from settings
        $company = Company::first();
        $destinatario = $company?->correo_notificaciones ?? 'contacto@deltapack.pe';

        Mail::send('emails.contacto', compact('datos'), function ($mail) use ($datos, $destinatario) {
            $mail->to($destinatario)
                 ->replyTo($datos['correo'], $datos['nombre'])
                 ->subject('Nueva Consulta Web - Asesoría Técnica');
        });

        return back()->with('success', 'Su consulta fue enviada correctamente.');
    }

    /**
     * Display Reclamation Book
     */
    public function libroReclamaciones()
    {
        $company = Company::first();
        $especialistas = Specialist::all();

        return view('libro-reclamaciones', compact('company', 'especialistas'));
    }

    /**
     * Handle virtual reclamations submit (AJAX)
     */
    public function correoReclamo(Request $request)
    {
        $request->validate([
            'nombre'            => 'required|string|max:150',
            'tipo_doc'          => 'required|string',
            'nro_doc'           => 'required|string',
            'telefono'          => 'required|string',
            'correo'            => 'required|email',
            'domicilio'         => 'required|string',
            'tipo_bien'         => 'required|string',
            'descripcion_bien'  => 'required|string',
            'tipo_solicitud'    => 'required|string',
            'detalle_reclamo'   => 'required|string',
            'pedido_consumidor' => 'required|string',
        ]);

        $correo = new Reclamos($request->all());
        
        // Dynamically get the notification email from settings
        $company = Company::first();
        $destinatario = $company?->correo_notificaciones ?? 'contacto@deltapack.pe';

        try {
            Mail::to($destinatario)->send($correo);
            return response()->json([
                'status' => true, 
                'msg'    => 'El reclamo fue registrado satisfactoriamente. Se ha enviado una copia a su correo.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false, 
                'msg'    => 'Hubo un error al enviar, inténtelo de nuevo más tarde: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display Terms
     */
    public function terminos()
    {
        $company = Company::first();
        $especialistas = Specialist::all();
        return view('terminos', compact('company', 'especialistas'));
    }

    /**
     * Display Privacy policy
     */
    public function politicas()
    {
        $company = Company::first();
        $especialistas = Specialist::all();
        return view('politicas', compact('company', 'especialistas'));
    }
}
