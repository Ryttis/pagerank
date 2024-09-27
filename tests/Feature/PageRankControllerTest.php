<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Domain;

class PageRankControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if getDomains method returns paginated domains
     */
    public function test_get_domains_returns_paginated_domains()
    {
        Domain::factory()->count(200)->create();

        $response = $this->get('/api/domains');

        $response->assertStatus(200);

        $response->assertJsonCount(100, 'data');

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'domain', 'pagerank'],
            ],
            'links'
        ]);
    }
}
