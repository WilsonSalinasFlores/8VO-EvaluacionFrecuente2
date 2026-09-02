<?php

namespace Services;

use Models\Producto;
use Illuminate\Support\Collection;

class ProductoService
{

    public function obtenerTodosLosProductos(): Collection
    {
        return Producto::all();
    }

    public function crearProducto(array $datos): Producto
    {
        return Producto::create($datos);
    }

    public function calcularDescuento(float $precio, float $porcentajeDescuento): float
    {
        return $precio - ($precio * ($porcentajeDescuento / 100));
    }
}
