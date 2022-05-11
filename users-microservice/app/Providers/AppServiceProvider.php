<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data = null, $message = null, $status_code = 200) {
            if (is_null($data)) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                ], $status_code);
            }
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $status_code);
        });

        Response::macro('error', function ($error, $message = null, int $status_code = 400) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'error' => $error,
            ], $status_code);
        });
    }
}
