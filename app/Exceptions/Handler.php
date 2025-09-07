<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // You can register custom renderable callbacks here if needed
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        // Handle ModelNotFoundException (404)
        if ($e instanceof ModelNotFoundException) {
            if ($request->expectsJson()) {
                $model = class_basename($e->getModel() ?: 'Resource');
                $ids = implode(', ', (array) $e->getIds());
                return response()->json([
                    'message' => "{$model} not found with id(s) {$ids}"
                ], 404);
            }

            abort(404, 'Resource not found');
        }

        // Handle AuthenticationException (401)
        if ($e instanceof AuthenticationException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage() ?: 'Unauthenticated'
                ], 401);
            }

            return redirect()->guest(route('login'));
        }

        // Handle ValidationException (422)
        if ($e instanceof ValidationException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => $e->errors(),
                ], 422);
            }

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($e->errors());
        }

        return parent::render($request, $e);
    }
}
