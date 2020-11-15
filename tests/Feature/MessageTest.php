<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_a_message_to_an_event() {
        $event = Event::factory()->create();

        $attributes = ['title' => 'First Message',
                       'body' => 'Looks like we are heading into an event, folks.'];

        $this->post('/events/' . $event->id . '/messages', $attributes);

        $this->assertNotNull(Event::find($event->id)->messages()->first());
    }

    /** @test */
    public function a_user_can_edit_a_message() {
        $this->withoutExceptionHandling();
        $event = Event::factory()->create()->withMessages(1);

        $attributes = ['title' => 'Edited message title',
                       'body' => 'Edited message body'];

        $this->put('/messages/' . $event->messages->first()->id, $attributes);

        $this->assertDatabaseHas('messages', $attributes);
    }

    /** @test */
    public function a_user_can_delete_a_message() {
        $event = Event::factory()->create()->withMessages(1);

        $this->delete('/messages/' . $event->messages->first()->id);

        $this->assertDatabaseMissing('messages', ['title' => $event->messages->first()->title]);
    }
}
