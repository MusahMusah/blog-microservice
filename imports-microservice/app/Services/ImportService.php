<?php

namespace App\Services;

use App\Models\Import;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ImportService
{
    // create a new import
    public function createImport(array $data)
    {
        return Import::query()->create([
            'api_url' => $data['api_url'],
            'frequency' => $data['frequency'],
            'next_execution_time' => $this->setExecutionTime($data['frequency'])
        ]);
    }

    // Get all the imports whose next_execution_time is less than or equal to the current time
    public function getImportsToExecute() : array|Collection
    {
        return Import::query()->where('next_execution_time', '<=', now())->get();
    }

    // Get all the imports
    public function getAllImports() : array|Collection
    {
        return Import::query()->get();
    }

    // update import next execution time
    public function updateNextExecutionTime(string $importId): void
    {
        $import = Import::query()->find($importId);
        $nextExecutionTime = CarbonImmutable::now()
                                        ->addSeconds($import->frequency)
                                        ->format('Y-m-d H:i:s');
        $import->update([
            'next_execution_time' => $nextExecutionTime
        ]);
    }

    // set execution time using import frequency
    public function setExecutionTime(int $frequency): string
    {
        return CarbonImmutable::now()
            ->addSeconds($frequency)
            ->format('Y-m-d H:i:s');
    }

}
