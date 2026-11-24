<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('unknown pages return the custom not found page', function () {
    $this->get('/page-that-does-not-exist')
        ->assertNotFound()
        ->assertSee('404')
        ->assertSee('Page not found')
        ->assertSee('Browse products');
});
