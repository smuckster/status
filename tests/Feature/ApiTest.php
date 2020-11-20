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
    public function an_api_call_can_retrieve_all_services() {
        $attributes1 = ['name' => 'Test Service',
                       'default_status_id' => 1,
                       'current_status_id' => 1,
                       'sort_order' => 1];

        $attributes2 = ['name' => 'Another test service',
                          'default_status_id' => 1,
                          'current_status_id' => 1,
                          'sort_order' => 2];

        Service::create($attributes1);
        Service::create($attributes2);

        $response = $this->getJson('/api/services');

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $attributes1['name']])
            ->assertJsonFragment(['name' => $attributes2['name']]);
    }

    /** @test */
    public function an_api_call_can_retrieve_all_service_groups() {
        $this->withoutExceptionHandling();
        $attributes1 = ['name' => 'Test Service Group',
                        'sort_order' => 1];
        $attributes2 = ['name' => 'Another Test Service Group',
                        'sort_order' => 2];

        ServiceGroup::create($attributes1);
        ServiceGroup::create($attributes2);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $attributes1['name']])
            ->assertJsonFragment(['name' => $attributes2['name']]);
    }
}
