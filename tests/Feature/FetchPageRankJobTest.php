<?php

namespace Tests\Feature;

use App\Jobs\FetchPageRankJob;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchPageRankJobTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_page_rank_is_fetched_and_saved()
    {
        // Mock HTTP response
        Http::fake([
            'https://openpagerank.com/api/v1.0/getPageRank*' => Http::response(['response' => [['page_rank_integer' => 5]]]),
        ]);

        // Run the job
        $job = new FetchPageRankJob();
        $job->handle();

        // Assert data saved in the database
        $this->assertDatabaseHas('domains', ['pagerank' => 5]);
    }

}
