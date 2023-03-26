<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('stability', function ($url) {
    $this->get($url)->assertOk();
})->with([
    '/login',
    '/register',
]);
