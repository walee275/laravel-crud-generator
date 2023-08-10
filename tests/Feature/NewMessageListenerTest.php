<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Events\NewMessageEvent;
use App\Listeners\NewMessageListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
class NewMessageListenerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function testNewMessageListener()
    {
        Event::fake();

        $receiverId = 3;
        $messageContent = 'testing';

        $listener = new NewMessageListener();
        $event = new NewMessageEvent($receiverId, $messageContent);
        $listener->handle($event);

        Event::assertDispatched(NewMessageEvent::class, function ($e) use ($receiverId, $messageContent) {
            return $e->receiverId === $receiverId && $e->messageContent === $messageContent;
        });

        $this->assertEquals($messageContent, Session::get('message'));
    }
}
