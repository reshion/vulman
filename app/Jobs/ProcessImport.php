<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = Storage::get($this->filePath);
        $rows = array_map('str_getcsv', explode("\n", $file));

        // Verarbeitung der Daten
        foreach ($rows as $row) {
            Log::info($row[0]);
            // Hier die Datenverarbeitung einfügen, z.B. Datenbankimport
            // Beispiel:
            // User::create([
            //     'name' => $row[0],
            //     'email' => $row[1],
            //     // weitere Felder
            // ]);
        }

        // Datei nach Verarbeitung löschen
        Storage::delete($this->filePath);
    }
}
