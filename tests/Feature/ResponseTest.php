<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResponseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_response() {
        $attributes = ['name' => 'Test Response'];

        $this->post('/responses', $attributes);

        $this->assertDatabaseHas('responses', $attributes);
    }

    /** @test */
    public function a_user_can_edit_a_response() {
        $response = Response::factory()->create();
        $response->name = 'Edited response name';

        $this->put('/responses/' . $response->id, ['response' => $response]);
        
        $this->assertDatabaseHas('responses', ['name' => $response->name]);
    }

    /** @test */
    public function a_user_can_delete_a_response() {
        $this->withoutExceptionHandling();
        $response = Response::factory()->create();

        $this->delete('/responses/' . $response->id);

        $this->assertDatabaseMissing('responses', ['name' => $response->name]);
    }
}
