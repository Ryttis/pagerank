<?php

use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\FetchPageRankJob;


$schedule = app(Schedule::class);

$schedule->job(new FetchPageRankJob())->daily();

