<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use App\Models\Service;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_service() {
        $status = Status::factory()->create();
        $attributes = ['name' => 'Moodle',
                       'description' => 'This service is for all of our Moodle sites.',
                       'default_status_id' => $status->id,
                       'current_status_id' => $status->id];

        $this->post('/services', $attributes);

        $this->assertDatabaseHas('services', $attributes);
    }

    /** @test */
    public function a_user_can_view_a_service() {
        $service = Service::factory()->create();

        $this->get('/services/' . $service->id)->assertSee($service->name);

    }

    /** @test */
    public function a_user_can_edit_a_service() {
        $service = Service::factory()->create();

        $service->name = 'Lorem';
        $service->description = 'This is a brand new description for the service.';

        $this->put('/services/' . $service->id, $service->toArray());

        $this->assertDatabaseHas('services', ['name' => $service->name, 'description' => $service->description]);
    }

    /** @test */
    public function a_user_can_delete_a_service() {
        $service = Service::factory()->create();

        $this->delete('/services/' . $service->id);

        $this->assertDatabaseMissing('services', $service->toArray());
    }

    /** @test */
    public function a_user_can_set_the_current_status_of_a_service() {
        $service = Service::factory()->create();
        $status = Status::factory()->create();

        $this->put('/services/' . $service->id . '/setstatus/' . $status->id);
        //dd([$statusBefore, $statusAfter, $status->id]);
        $this->assertEquals($status->id, Service::find($service->id)->current_status_id);
    }

    /** @test */
    public function a_user_can_reset_the_status_of_a_service() {
        $service = Service::factory()->create();
        $defaultStatus = $service->defaultStatus();
        $currentStatus = $service->currentStatus();

        $this->put('/services/' . $service->id . '/resetstatus');

        $this->assertEquals($defaultStatus->id, Service::find($service->id)->defaultStatus()->id);
    }
}
