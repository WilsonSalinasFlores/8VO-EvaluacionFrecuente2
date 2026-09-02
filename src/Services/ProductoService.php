<?php

namespace Src\Services;

use Src\Models\Producto;
use Illuminate\Support\Collection;

class ProductoService
{
    /**
     * SOLID: Single Responsibility Principle (SRP)
     * Esta clase tiene la única responsabilidad de manejar la lógica de negocio
     * relacionada con los productos, separándola del controlador.
     */

    public function obtenerTodosLosProductos(): Collection
    {
        return Producto::all();
    }

    public function crearProducto(array $datos): Producto
    {
        // Aquí puede ir lógica adicional de negocio, validaciones complejas, etc.
        return Producto::create($datos);
    }
}
