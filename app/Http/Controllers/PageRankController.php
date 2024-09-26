<?php

namespace App\Http\Controllers;

use App\Models\Domain;

class PageRankController extends Controller
{
    public function getDomains()
    {
        return Domain::paginate(100);
    }
}
