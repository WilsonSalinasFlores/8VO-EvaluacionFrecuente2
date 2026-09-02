<?php

namespace Controllers;

use App\Http\Controllers\Controller;
use Services\ProductoService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    protected $productoService;

    
    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index()
    {
        $productos = $this->productoService->obtenerTodosLosProductos();
        return view('productos.index', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $this->productoService->crearProducto($validated);

        return redirect()->back()->with('success', 'Producto creado exitosamente');
    }
}
