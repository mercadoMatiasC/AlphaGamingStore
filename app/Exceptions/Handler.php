<?php

namespace App\Exceptions;

use Throwable;
use DomainException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * Register exception handling callbacks.
     */
    public function register(): void
    {
        /**
         * Domain errors (business rules)
         * These should NEVER show a Laravel error page
         */
        $this->renderable(function (DomainException $e, $request) {
            // Only handle domain errors on write actions
            if (! $request->isMethod('post')) 
                return null; // let Laravel show the error (bug)

            // API / AJAX
            if ($request->expectsJson()) 
                return response()->json(['message' => $e->getMessage(),], 422);

            // Web flow
            return redirect()->back()->with('error', $e->getMessage());
        });
    }
}