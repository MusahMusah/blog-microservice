<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ImportedPostRequest;
use App\Services\ImportService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected ImportService $importService;
    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Save Import Posts from external source.
     */
    public function createImport(ImportedPostRequest $request)
    {
        try {
            $import = $this->importService->createImport($request->validated());
            return response()->success($import, 'Posts import created successfully');
        } catch (\Exception $exception) {
            return response()->error($exception->getMessage(), 'Posts import failed');
        }
    }

    /**
     * Get Imports to Execute.
     */
    public function getImportsToExecute(Request $request)
    {
        try {
            $imports = $this->importService->getImportsToExecute();
            return response()->success($imports, 'Imports to execute found');
        } catch (\Exception $exception) {
            return response()->error($exception->getMessage(), 'Imports to execute not found');
        }

    }

}
