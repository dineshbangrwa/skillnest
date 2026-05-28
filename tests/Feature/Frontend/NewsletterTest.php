<?php

use App\Models\Newsletter;

test('user can subscribe to newsletter with valid email', function () {
    $response = $this->post(route('newsletter.subscribe'), [
        'email' => 'subscriber@example.com',
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
        'message' => 'Thank you for subscribing to our newsletter!',
    ]);

    $this->assertDatabaseHas('newsletters', [
        'email' => 'subscriber@example.com',
        'is_subscribed' => true,
    ]);
});

test('user cannot subscribe with invalid email', function () {
    $response = $this->post(route('newsletter.subscribe'), [
        'email' => 'not-an-email',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors('email');
});

test('user cannot subscribe with duplicate email', function () {
    Newsletter::create([
        'email' => 'duplicate@example.com',
        'is_subscribed' => true,
    ]);

    $response = $this->post(route('newsletter.subscribe'), [
        'email' => 'duplicate@example.com',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors('email');
});

test('user can unsubscribe from newsletter', function () {
    Newsletter::create([
        'email' => 'unsub@example.com',
        'is_subscribed' => true,
    ]);

    $response = $this->get(route('newsletter.unsubscribe', 'unsub@example.com'));

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
        'message' => 'You have been unsubscribed from our newsletter.',
    ]);

    $this->assertDatabaseHas('newsletters', [
        'email' => 'unsub@example.com',
        'is_subscribed' => false,
    ]);
});

test('unsubscribe returns error for non-existent email', function () {
    $response = $this->get(route('newsletter.unsubscribe', 'nonexistent@example.com'));

    $response->assertStatus(404);
    $response->assertJson([
        'success' => false,
        'message' => 'Email not found in our newsletter list.',
    ]);
});
