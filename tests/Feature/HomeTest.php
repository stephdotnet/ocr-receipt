<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @group HTTP
 * @group HTTP.Home
 */
class HomeTest extends TestCase
{
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
