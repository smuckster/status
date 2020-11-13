<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use App\Models\Service;
use App\Models\ServiceGroup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceGroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_service_group() {
        $attributes = ['name' => 'SaaS Apps',
                       'description' => 'These services tend to go down at the same time.'];

        $this->post('/servicegroups', $attributes)->assertRedirect();

        $this->assertDatabaseHas('service_groups', $attributes);
    }

    /** @test */
    public function a_user_can_allocate_a_service_to_a_service_group() {
        $service = Service::factory()->create();
        $serviceGroup = ServiceGroup::factory()->create();

        $this->post('/servicegroups/' . $serviceGroup->id . '/allocate/' . $service->id);

        $this->assertInstanceOf(Service::class, $serviceGroup->services->first());
    }

    /** @test */
    public function a_user_can_remove_a_service_from_a_service_group() {
        $service = Service::factory()->create();
        $serviceGroup = ServiceGroup::factory()->create();

        $this->post('/servicegroups/' . $serviceGroup->id . '/deallocate/' . $service->id);

        $this->assertNull($serviceGroup->services->first());
    }

    /** @test */
    public function a_user_can_edit_a_service_group() {
        $this->withoutExceptionHandling();

        $serviceGroup = ServiceGroup::factory()->create();

        $serviceGroup->name = 'New Service Group Name';
        $serviceGroup->description = 'Now this description has been edited.';

        $this->put('/servicegroups/' . $serviceGroup->id, ['serviceGroup' => $serviceGroup]);

        $this->assertDatabaseHas('service_groups', ['name' => $serviceGroup->name, 'description' => $serviceGroup->description]);
    }

    /** @test */
    public function a_user_can_delete_a_service_group() {
        $serviceGroup = ServiceGroup::factory()->create();

        $this->delete('/servicegroups/' . $serviceGroup->id, ['serviceGroup' => $serviceGroup]);

        $this->assertDatabaseMissing('service_groups', ['name' => $serviceGroup->name, 'description' => $serviceGroup->description]);
    }

    /** @test */
    public function a_user_can_set_the_current_status_of_a_service_group() {
        $serviceGroup = ServiceGroup::factory()->create();
        $services = Service::factory()->count(3)->create();
        $status = Status::factory()->create();

        foreach($services as $service) {
            $this->post('/servicegroups/' . $serviceGroup->id . '/allocate/' . $service->id);
        }

        $this->put('/servicegroups/' . $serviceGroup->id . '/setstatus/' . $status->id);

        foreach($services as $service) {
            $this->assertEquals($status->id, Service::find($service->id)->current_status_id);
        }
    }

    /** @test */
    public function a_user_can_reset_the_status_of_a_service_group() {
        $serviceGroup = ServiceGroup::factory()->create();
        $services = Service::factory()->count(2)->create();

        foreach($services as $service) {
            $this->put('/servicegroups/' . $serviceGroup->id . '/allocate/' . $service->id);
        }

        $this->put('/servicegroups/' . $serviceGroup->id . '/resetstatus');

        foreach($services as $service) {
            $this->assertEquals(Service::find($service->id)->default_status, Service::find($service->id)->current_status);
        }
    }
}
