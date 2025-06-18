<?php

use App\Models\User;
use App\Models\Comment;
use App\Models\Simulation;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\delete;

it('can create a comment', function () {
    $user = User::factory()->create();
    $simulation = Simulation::factory()->create();

    $this->actingAs($user)
        ->post(route('comments.store'), [
            'simulation_id' => $simulation->id,
            'content' => 'This is a test comment.',
        ])
        ->assertRedirect();
    $this->assertDatabaseHas('comments', [
        'simulation_id' => $simulation->id,
        'user_id' => $user->id,
        'content' => 'This is a test comment.',
    ]);
});

it('can not create a comment without content', function () {
    $user = User::factory()->create();
    $simulation = Simulation::factory()->create();

    $this->actingAs($user)
        ->post(route('comments.store'), [
            'simulation_id' => $simulation->id,
            'content' => '',
        ])
        ->assertSessionHasErrors('content');
});

it('can not create a comment without being authenticated', function () {
    $simulation = Simulation::factory()->create();

    $this->post(route('comments.store'), [
        'simulation_id' => $simulation->id,
        'content' => 'This is a test comment.',
    ])->assertRedirect(route('login'));
});

it('user can delete their own comment', function () {
    $user = User::factory()->create();
    $comment = Comment::factory()->create(['user_id' => $user->id]);

    actingAs($user)
        ->delete(route('comments.destroy', $comment))
        ->assertRedirect();

    $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
});

it('user cannot delete someone else\'s comment', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $comment = Comment::factory()->create(['user_id' => $otherUser->id]);

    actingAs($user)
        ->delete(route('comments.destroy', $comment))
        ->assertStatus(403);

    $this->assertDatabaseHas('comments', ['id' => $comment->id]);
});

it('guest cannot delete any comment', function () {
    $comment = Comment::factory()->create();

    delete(route('comments.destroy', $comment))
        ->assertRedirect(route('login'));

    $this->assertDatabaseHas('comments', ['id' => $comment->id]);
});
