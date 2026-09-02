<?php

namespace Src\Controllers;

use App\Http\Controllers\Controller;
use Src\Services\ProductoService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    protected $productoService;

    /**
     * SOLID: Single Responsibility Principle (SRP)
     * El controlador solo se encarga de recibir peticiones HTTP y devolver respuestas.
     * La lógica de negocio está delegada a ProductoService (Inyección de dependencias).
     */
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
