<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

use Illuminate\Http\Request;


class HelloTest extends TestCase
{
    //テスト用データベースを初期化する。これがないと以前のテストデータが残る
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);

        $response = $this->get('/');
        $response->assertStatus(200)->assertViewIs('index');

        //$user = factory(User::class)->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
 
        $response = $this->get('/no_route');
        $response->assertStatus(404);

        $response = $this->call('GET', 'find');
        //$response = $this->get('find');
        $response->assertStatus(200)->assertViewIs('find');
/*
        //テストデータを生成する
        User::factory()->create([
            'name' => 'AAA',
            'email' => 'BBB@CCC.com',
            'password' => 'AAAABBBB',
        ]);

        //生成したテストデータがDBに登録されていること
        $this->assertDatabaseHas('users', [
            'name' => 'AAA',
            'email' => 'BBB@CCC.com',
            'password' => 'AAAABBBB',
        ]);
*/

        $data = [
            'name' => 'John Doe',
            'mail' => 'john@example.com',
            'age' => 20,
        ];

        $response = $this->post('/add', $data);
        $this->assertDatabaseHas('people', $data);
        $response->assertRedirect('/index_db');
        $response->assertStatus(302);
        //$response->assertValid();
        
    }
}
