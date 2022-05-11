<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportNextExecutionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $importInfo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($importInfo)
    {
        $this->importInfo = $importInfo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      dd($this->importInfo);
    }
}
