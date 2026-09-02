<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Models\Producto;

class ProductoControllerTest extends TestCase
{
    use RefreshDatabase; // Reinicia la BD antes de cada test

    public function test_puede_crear_un_producto()
    {
        $response = $this->post('/productos', [
            'nombre' => 'Teclado Mecánico',
            'precio' => 100
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Teclado Mecánico'
        ]);
    }
}
