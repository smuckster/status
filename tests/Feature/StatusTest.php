<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use App\Models\Service;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_status() {
        $attributes = ['name' => 'Test Status',
                       'description' => 'This is only a test',
                       'color' => '#009933'];

        $this->post('/statuses', $attributes);

        $this->assertDatabaseHas('statuses', $attributes);
    }

    /** @test */
    public function a_user_can_edit_a_status() {
        $status = Status::factory()->create();

        $status->name = 'Edited Status Name';
        $status->description = 'This description has been edited.';
        $status->color = '#000000';

        $this->put('/statuses/' . $status->id, ['status' => $status]);

        $this->assertDatabaseHas('statuses', ['name' => $status->name, 'description' => $status->description, 'color' => $status->color]);
    }

    /** @test */
    public function a_user_can_delete_a_status() {
        $status = Status::factory()->create();

        $this->delete('/statuses/' . $status->id);

        $this->assertDatabaseMissing('statuses', ['name' => $status->name]);
    }

}
