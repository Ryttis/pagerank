<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Domain;
use Illuminate\Support\Facades\Http;



class FetchPageRankJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle() :void
    {
        $domains = json_decode(file_get_contents('https://raw.githubusercontent.com/Kikobeats/top-sites/master/top-sites.json'), true);

        foreach ($domains as $domain) {
            $response = Http::withHeaders([
                'API-OPR' => 'ws48csg0cow0w4kg0gck4oc8wo80kcg8w0g4s08k',
            ])->get("https://openpagerank.com/api/v1.0/getPageRank", ['domains[]' => $domain['rootDomain']]);

            $pagerank = $response->json()['response'][0]['page_rank_integer'] ?? 0;

            Domain::updateOrCreate(
                ['domain' => $domain['rootDomain']],
                ['pagerank' => $pagerank]
            );
        }
    }

}
