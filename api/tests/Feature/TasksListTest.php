<?php

declare(strict_types=1);


namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;

class TasksListTest extends \Tests\TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::now());
        $this->setUpFaker();
    }

    public function test_the_task_list_is_created_properly(): void
    {
        $this->withoutExceptionHandling();
        $id = $this->faker->uuid;
        $title = $this->faker->sentence;
        $userId = $this->faker->uuid;
        $user = User::factory()->create([
            'id' => $userId,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ]);
        $this->actingAs($user);

        $response = $this->put("/api/task-lists/${id}", [
            'name' => $title,
        ]);

        $response->assertStatus(201);

        $this->get("/api/task-lists/${id}")
             ->assertStatus(200)
             ->assertJson([
                 'name' => $title,
                 'tasks' => [],
                 'createdAt' => Carbon::now()->toAtomString(),
                 'ownerId' => $userId
             ]);
    }
}
