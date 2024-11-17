<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_database(): void
    {
        $user = User::factory()->create();

        $fetchedUser = User::query()->find($user->id);
        $this->assertInstanceOf(User::class, $fetchedUser);

        $fetchedUser->name = 'John Doe';
        $fetchedUser->save();
        $this->assertSame('John Doe', $fetchedUser->name);

        $fetchedUser->delete();
        $deletedUser = User::query()->find($fetchedUser->id);
        $this->assertNull($deletedUser);
    }
}
