<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Services\ProductoService;

class ProductoServiceTest extends TestCase
{
    public function test_calcula_descuento_correctamente()
    {
        $servicio = new ProductoService();
        $resultado = $servicio->calcularDescuento(100, 20); 
        $this->assertEquals(80, $resultado);
    }
}
