<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Service;
use App\Models\Response;
use App\Models\ServiceGroup;
use App\Events\EventResolved;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_an_event() {
        $attributes = ['name' => 'Test Outage Event',
                       'description' => 'We\'re having a major outage, folks.',
                       'current_response_id' => Response::factory()->create()->id];

        $this->post('/events', $attributes);

        $this->assertDatabaseHas('events', $attributes);
    }

    /** @test */
    public function a_user_can_add_a_service_to_an_event() {
        $this->withoutExceptionHandling();
        $event = Event::factory()->create();
        $service = Service::factory()->create();

        $this->post('/events/' . $event->id . '/allocateservice/' . $service->id);

        $this->assertEquals($service->id, Event::find($event->id)->services()->first()->id);
    }

    /** @test */
    public function a_user_can_add_a_service_group_to_an_event() {
        $event = Event::factory()->create();
        $serviceGroup = ServiceGroup::factory()->create();

        $this->post('/events/' . $event->id . '/allocateservicegroup/' . $serviceGroup->id);

        $this->assertEquals($serviceGroup->id, Event::find($event->id)->serviceGroups()->first()->id);
    }

    /** @test */
    public function a_user_can_remove_a_service_from_an_event() {
        $event = Event::factory()->create();
        $service = Service::factory()->create();

        $this->post('/events/' . $event->id . '/allocateservice/' . $service->id);

        $this->delete('/events/' . $event->id . '/deallocateservice/' . $service->id);

        $this->assertNull(Event::find($event->id)->services()->first());
    }

    /** @test */
    public function a_user_can_remove_a_service_group_from_an_event() {
        $event = Event::factory()->create();
        $serviceGroup = ServiceGroup::factory()->create();

        $this->post('/events/' . $event->id . '/allocateservicegroup/' . $serviceGroup->id);

        $this->delete('/events/' . $event->id . '/deallocateservicegroup/' . $serviceGroup->id);

        $this->assertNull(Event::find($event->id)->serviceGroups()->first());
    }

    /** @test */
    public function a_user_can_resolve_an_event() {
        $event = Event::factory()->create();

        $this->put('/events/' . $event->id . '/resolve');

        $this->assertNotNull(Event::find($event->id)->resolved_at);
    }

    /** @test */
    public function resolving_an_event_dispatches_an_event() {
        \Illuminate\Support\Facades\Event::fake();

        $event = Event::factory()->create();

        $this->put('/events/' . $event->id . '/resolve');

        \Illuminate\Support\Facades\Event::assertDispatched(EventResolved::class);
    }

    /** @test */
    public function resolving_an_event_resets_the_status_of_its_services() {
        $this->withoutExceptionHandling();

        //\Illuminate\Support\Facades\Event::fake();

        $event = Event::factory()->create();
        $services = Service::factory()->count(2)->create();
        $serviceGroup = ServiceGroup::factory()->create();

        $this->put('/events/' . $event->id . '/resolve');

        // Trigger the event, because the previous test ensures that it was dispatched
        $listener = new \App\Listeners\ResetServices();
        $listener->handle(new EventResolved($event));

        foreach($services as $service) {
            $this->assertEquals(Service::find($service->id)->defaultStatus()->id, Service::find($service->id)->currentStatus()->id);
        }

        foreach($serviceGroup->services as $service) {
            $this->assertEquals(Service::find($service->id)->defaultStatus()->id, Service::find($service->id)->currentStatus()->id);
        }
    }
}
