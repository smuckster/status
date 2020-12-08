<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Service;
use App\Models\ServiceGroup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_api_call_can_retrieve_all_services_and_groups() {
        $services[] = Service::create(['name' => 'Test Service',
                                       'default_status_id' => 1,
                                       'current_status_id' => 1,
                                       'sort_order' => 1]);
        $services[] = Service::create(['name' => 'Another test service',
                                       'default_status_id' => 1,
                                       'current_status_id' => 1,
                                       'sort_order' => 2]);

        $serviceGroup = ServiceGroup::factory()->create();

        foreach($services as $service) {
            $serviceGroup->allocateService($service);
        }

        $response = $this->getJson('/api/services');

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $services[0]->name])
            ->assertJsonFragment(['name' => $services[1]->name])
            ->assertJsonFragment(['name' => $serviceGroup->name]);
    }
}
