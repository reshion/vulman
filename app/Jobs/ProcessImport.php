<?php

namespace App\Jobs;

use App\Business\VulnerabilityImportLogic;
use App\Messages\VulnerabilityImportMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected VulnerabilityImportMessage $message;

    /**
     * Create a new job instance.
     */
    public function __construct(VulnerabilityImportMessage $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $vulnerabilityImportLogic = new VulnerabilityImportLogic($this->message);
        $vulnerabilityImportLogic->importVulnerabilities($this->message);
    }
}