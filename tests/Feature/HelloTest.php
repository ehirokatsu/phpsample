<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Person;

class HelloTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);

        $response = $this->get('/');
        $response->assertStatus(200);
       
        $response = $this->get('/hello');
        $response->assertStatus(404);

        //$user = factory(User::class)->create();
        $person = Person::factory()->create();
        $response = $this->actingAs($person)->get('/hello');
        $response->assertStatus(404);
 
        $response = $this->get('/no_route');
        $response->assertStatus(404);
    }
}
