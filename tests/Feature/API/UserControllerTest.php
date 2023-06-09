<?php

namespace Tests\Feature\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_usuarios_enpoint(): void
    {
        $usuarios = User::factory(2)->create();
        $response = $this->getJson('/api/v1/usuarios');

        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');

        $response->assertJson(function (AssertableJson $json) use ($usuarios) {

            $json->whereAllType([
                'data.0.nome' => 'string',
                'data.0.email' => 'string',
                'data.0.data_criacao' => 'string'
            ]);

            // Verificar se as chaves existem no array
            $json->hasAll(['data.0.nome', 'data.0.email', 'data.0.data_atualizacao']);

            // Pegar uma collection de usuário (1 usuário somente)
            $usuario = $usuarios->first();

            // Realizar o assert para verificar se os dados criados são exatamente os mesmo recém salvos
            $json->whereAll([
                'data.0.nome' => $usuario->name,
                'data.0.email' => $usuario->email
            ]);
        });
    }

    /**
     *
     */
    public function test_get_unico_usuario_endpoint()
    {
        $usuario = User::factory(1)->createOne();
        $response = $this->getJson('/api/v1/usuarios/' . $usuario->id);

        // Verificar se o status de retorno do endpoint é 200
        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use ($usuario) {

            $json->hasAll(['data.nome', 'data.email']);

            // Verificar os tipos
            $json->whereAllType([
                'data.nome' => 'string',
                'data.email' => 'string'
            ]);

            // Verificar os valores
            $json->whereAll([
                'data.nome' => $usuario->name,
                'data.email' => $usuario->email
            ]);
        });
    }

    /**
     *
     */
    public function test_post_usuarios_endpoint()
    {
        $usuario = User::factory(1)->makeOne()->toArray();
        $response = $this->postJson('/api/v1/usuarios', array_merge($usuario, [
            'password' => 'secret12',
            'password_confirmation' => 'secret12'
        ]));

        $response->assertStatus(201);

        $response->assertJson(function (AssertableJson $json) use ($usuario) {

            $json->hasAll(['data.nome', 'data.email', 'data.data_criacao', 'data.data_atualizacao']);

            $json->whereAll([
                'data.nome' => $usuario['name'],
                'data.email' => $usuario['email']
            ]);
        });
    }

    /**
     *
     */
    public function test_post_usuarios_quando_tentar_criar_um_usuario_invalido()
    {
        $response = $this->postJson('/api/v1/usuarios', []);

        $response->assertStatus(422);

        $response->assertJson(function (AssertableJson $json) {
            $json->hasAll(['message', 'errors']);

            $json->whereAll([
                'errors.name.0' => 'The name field is required.',
                'errors.email.0' => 'The email field is required.'
            ]);
        });
    }

    /**
     *
     */
    public function test_put_usuarios_endpoint()
    {
        User::factory(1)->createOne();

        $usuario = [
            'name' => 'Diego Lisboa',
            'email' => 'diego.lis@hotmail.com'
        ];

        $response = $this->putJson('/api/v1/usuarios/1', $usuario);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use ($usuario) {
            $json->hasAll(['data.nome', 'data.email']);

            $json->whereAll([
                'data.nome' => $usuario['name'],
                'data.email' => $usuario['email']
            ]);
        });
    }

    /**
     *
     */
    public function test_patch_usuarios_endpoint()
    {
        User::factory(1)->createOne();

        $usuario = [
            'name' => 'Diego Pires',
            'email' => 'diego.lis@hotmail.com'
        ];

        $response = $this->patchJson('/api/v1/usuarios/1', $usuario);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use ($usuario) {
            $json->has('data.nome');

            $json->where('data.nome', $usuario['name']);
        });
    }

    /**
     *
     */
    public function test_delete_usuarios_endpoint()
    {
        User::factory(1)->createOne();

        $response = $this->deleteJson('/api/v1/usuarios/1');

        $response->assertStatus(200);
    }
}
