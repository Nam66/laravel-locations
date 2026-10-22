<?php

use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Console Schedule
|--------------------------------------------------------------------------
| Reset location data daily at midnight
*/

Schedule::command('locations:reset --force')
    ->dailyAt('00:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/locations-reset.log'));
