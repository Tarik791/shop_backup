<?php

use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\RunBackup;

return function (Schedule $schedule) {
    $schedule->command('app:backup-products')->daily();
    $schedule->job(new RunBackup)->daily();
};
