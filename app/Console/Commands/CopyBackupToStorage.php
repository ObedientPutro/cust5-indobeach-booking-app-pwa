<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyBackupToStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:copy-backup-to-storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy backup folder contents to storage folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $source = base_path('backup-images/images'); // Source folder
        $destination = storage_path('app/public/images'); // Destination folder in storage

        if (File::exists($source)) {
            File::copyDirectory($source, $destination);
            $this->info('Backup folder copied successfully to storage.');
        } else {
            $this->error('Backup folder does not exist.');
        }
    }
}
