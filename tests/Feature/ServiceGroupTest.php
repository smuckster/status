<?php

namespace Tests\Feature;

use Tests\TestCase;
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

        $this->post('servicegroups/' . $serviceGroup->id . '/allocate', ['service' => $service->id]);

        $this->assertInstanceOf(Service::class, $serviceGroup->services->first());
    }

    /** @test */
    public function a_user_can_remove_a_service_from_a_service_group() {
        $service = Service::factory()->create();
        $serviceGroup = ServiceGroup::factory()->create();

        $this->post('servicegroups/' . $serviceGroup->id . '/deallocate', ['service' => $service->id]);

        $this->assertNull($serviceGroup->services->first());
    }
}
