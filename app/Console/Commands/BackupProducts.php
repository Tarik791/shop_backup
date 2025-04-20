<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BackupService;
use App\Services\ApiAuthenticator;

class BackupProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backup-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Performs a secure backup of product data from the API, with authentication via email and password.';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $auth = app(ApiAuthenticator::class);
        $token = $auth->authenticate($this);
    
        if (!$token) {
            return;
        }
        $this->info("start backup...");
        $backup = app(BackupService::class);
        $success = $backup->runBackup($token);
    
        if ($success) {
            $this->info("Backup successfully completed.");
        } else {
            $this->error("Backup not completed. Check log.");
        }
    }
}
