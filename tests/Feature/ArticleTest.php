<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Articulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * Valida si un usuario puede registrar un articulo
     */
    public function test_user_can_register_article_and_return_to_dashboard(): void
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/articulos/registrar');
        $response->assertStatus(200);

        $articleData = [
            'nombre' => 'Unit testing',
            'precio' => 100,
            'cantidad' => 10,
            'user_id' => $user->id,
            'descripcion' => 'Lorem ipsum dolor sit amet'
        ];

        $response = $this->post('/articulos/save', $articleData);

        $response->assertRedirect('/articulos');

        $this->assertDatabaseHas('articulos', [
            'nombre' => $articleData['nombre'],
            'precio' => $articleData['precio'],
            'cantidad' => $articleData['cantidad'],
            'user_id' => $articleData['user_id'],
            'descripcion' => $articleData['descripcion'],
        ]);
    }

    /**
     * Valida si un usuario puede editar un articulo
     */
    public function test_user_can_edit_an_article(): void
    {
        $user = User::find(1);
        $this->actingAs($user);

        $article = Articulo::create([
            'nombre' => 'Unit testing 2',
            'precio' => 100,
            'cantidad' => 10,
            'user_id' => $user->id,
            'descripcion' => 'Lorem ipsum dolor sit amet'
        ]);

        $response = $this->get("/articulos/editar/$article->id");
        $response->assertStatus(200);

        $articleData = [
            'id' => $article->id,
            'nombre' => 'Unit edited',
            'precio' => 99,
            'cantidad' => 5,
            'user_id' => $user->id,
            'descripcion' => 'editeeeed'
        ];

        $response = $this->post('/articulos/save', $articleData);

        $response->assertRedirect('/articulos');

        $this->assertDatabaseHas('articulos', [
            'nombre' => $articleData['nombre'],
            'precio' => $articleData['precio'],
            'cantidad' => $articleData['cantidad'],
            'user_id' => $articleData['user_id'],
            'descripcion' => $articleData['descripcion'],
        ]);
    }

    public function test_user_can_delete_an_article()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $article = Articulo::create([
            'nombre' => 'Im going to be deleted',
            'precio' => 100,
            'cantidad' => 10,
            'user_id' => $user->id,
            'descripcion' => 'Lorem ipsum dolor sit amet'
        ]);

        $response = $this->deleteJson("/articulos/delete/{$article->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Artículo eliminado correctamente',
            ]);

        // Verificar que el artículo ya no existe en la base de datos
        $this->assertDatabaseMissing('articulos', [
            'id' => $article->id,
        ]);
    }
}
