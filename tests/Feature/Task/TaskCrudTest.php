<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test if user can create a task
     */
    public function test_authenticated_user_can_create_a_task(): void
    {
        $user = $this->createUserAndAuthenticate();

        $task = ['title' => 'Test Task for user 1', 'description' => fake()->sentence(10),
                 'user_id' => $user->id];
        $this->post(route('tasks.store', $task));

        $this->assertDatabaseHas('tasks', $task);
    }

    /**
     * Test if user can update a task
     */
    public function test_authenticated_user_can_update_a_task(): void
    {
        $user = $this->createUserAndAuthenticate();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->put("/tasks/{$task->id}", [
           'title' => 'Updated Title',
           'description' => 'Updated Description',
        ]);

        // Assert that the task was updated successfully
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ]);
    }

    /**
     * Test if user can delete a task
     */
    public function test_authenticated_user_can_delete_their_task(): void
    {
        $user = $this->createUserAndAuthenticate();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->delete(route('tasks.destroy', $task->id));

        $this->assertDatabaseMissing('tasks', $task->toArray());
    }

    /**
     * Test if task cannot be created if title is missing
     */
    public function test_user_cannot_create_a_task_without_title(): void
    {
        $user = $this->createUserAndAuthenticate();
        $task = ['title' => '', 'description' => fake()->sentence(10),
                 'user_id' => $user->id];

        $response = $this->post(route('tasks.store', $task));
        $response->assertStatus(302);
        $response->assertInvalid(['title' => 'The title field is required']);
    }

    /**
     * Test task cannot be created if description is missing
     */
    public function test_user_cannot_create_a_task_without_description(): void
    {
        $user = $this->createUserAndAuthenticate();
        $task = ['title' => fake()->sentence(3), 'description' => '',
                 'user_id' => $user->id];

        $response = $this->post(route('tasks.store', $task));
        $response->assertStatus(302);
        $response->assertInvalid(['description' => 'The description field is required']);
    }

    /**
     * Test to check if user cannot update task for another user
     */
    public function test_user_cannot_update_a_task_belonging_to_another_user(): void
    {
        $this->createUserAndAuthenticate();

        $this->seed(UserSeeder::class);

        $task = Task::factory()
            ->for(User::factory())
            ->create();

        $response =  $this->put("/tasks/{$task->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ]);
        $response->assertStatus(302);
        $response = $this->followRedirects($response);
        $response->assertStatus(403);

    }
}
