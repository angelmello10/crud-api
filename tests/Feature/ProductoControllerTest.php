<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_puede_crear_producto()
    {
        $user = User::factory()->create();
        $categoria = Categoria::factory()->create();

        $data = [
            'nombre' => 'Producto de prueba',
            'descripcion' => 'Descripción',
            'precio' => 99.99,
            'stock' => 10,
            'categoria_id' => $categoria->id,
        ];

        $response = $this->actingAs($user)->postJson('/api/productos', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('productos', ['nombre' => 'Producto de prueba']);
    }

    public function test_usuario_no_autenticado_no_puede_crear_producto()
    {
        $response = $this->postJson('/api/productos', []);
        $response->assertStatus(401);
    }
}
