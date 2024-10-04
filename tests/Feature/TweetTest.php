<?php

use App\Livewire\Tweet\Create;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

it('shold be able to create a new tweet', function() {
    $user = User::factory()->create();

    actingAs($user);

    livewire(Create::class)         
    ->set('body', 'This is my first Tweet')
    ->call('tweet')
    ->assertEmitted('tweet::created');

    assertDatabaseCount('tweets', count:1);

    expect(Tweet::first())
    ->body->toBe('This is my first Tweet')
    ->created_by->toBe($user->id);
});


it('should make sure that only authenticad users can tweet', function() {
    livewire(Create::class)
    ->set('body', 'This is my first tweet')
    ->call('tweet')
    ->asserForbidden()
    ->assertRedirect(route('login'));   

    actingAs(User::factory()->create());

    livewire(Create::class)         
    ->set('body', 'This is my first Tweet')
    ->call('tweet')
    ->assertEmitted('tweet::created');

});

todo('should be able to create a tweet');
todo('body is required');
todo('the tweet body should have a max length of 140 characters');
todo('should show the on the timeline');
