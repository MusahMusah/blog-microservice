<?php

namespace App\Listeners;

use App\Jobs\ImportNextExecutionJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ImportNextExecutionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // trigger the job to update import next execution time
        ImportNextExecutionJob::dispatch($this->importInfo);
    }
}
