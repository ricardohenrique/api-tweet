<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TweetIntegrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetRandomTweetTest()
    {
        $response = $this->get('/api/tweet');
        $response->assertStatus(200);
        $response->assertJsonStructure([]);
    }
}
