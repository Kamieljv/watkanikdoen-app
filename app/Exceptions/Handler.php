<?php

namespace App\Exceptions;

use App\Notifications\Mail\ErrorAlert;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Notification;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // API error responses
        if ($request->is('api/*')) {
            return $this->handleApiException($request, $exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle API exceptions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleApiException($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof \Illuminate\Http\Exceptions\HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }

    /**
     * Create a custom JSON response for API.
     *
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function customApiResponse($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [
            'success' => false,
            'message' => $exception->getMessage(),
        ];

        switch ($statusCode) {
            case 401:
                $response['message'] = 'Unauthorized';
                break;
            case 403:
                $response['message'] = 'Forbidden';
                break;
            case 404:
                $response['message'] = 'Not Found';
                break;
            case 405:
                $response['message'] = 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = 'Unprocessable Entity';
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Internal Server Error' : $exception->getMessage();
                break;
        }

        if (config('app.debug')) {
            $response['debug'] = [
                'exception' => get_class($exception),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => collect($exception->getTrace())->map(function ($trace) {
                    return array_filter($trace, function ($key) {
                        return !in_array($key, ['args']);
                    }, ARRAY_FILTER_USE_KEY);
                })->all(),
            ];
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401)
            : redirect()->guest(route('login'));
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(\Illuminate\Validation\ValidationException $e, $request)
    {
        if ($e->response) {
            return $e->response;
        }

        return $request->expectsJson()
            ? response()->json([
                'success' => false,
                'message' => 'The given data was invalid.',
                'errors' => $e->errors(),
            ], 422)
            : redirect()->back()->withInput($request->input())->withErrors($e->errors());
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        if (config('app.env') === 'production') {
            $this->reportable(function (Throwable $e) {
                // Skip email alerts for known Livewire/Filament hydration noise caused by
                // malformed requests (bots/scanners) hitting /livewire/update directly.
                // Still gets logged normally by Laravel below, just not emailed.
                // See: https://github.com/filamentphp/filament/discussions/19658
                if ($this->isLivewireHydrationNoise($e)) {
                    return;
                }

                // Create Notification Data
                $exception = [
                    "class" => get_class($e),
                    "message" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "traceback" => $e->getTraceAsString()
                ];

                // Create a Job for Notification which will run after 5 seconds.
                Notification::route('mail', config('app.admin_email'))
                    ->notify((new ErrorAlert($exception))->delay(now()->addSeconds(5)));

            });
        }
    }

    /**
     * Detect TypeErrors thrown while Livewire hydrates component properties from a
     * malformed update payload (e.g. bots fuzzing /livewire/update). Not an app bug.
     */
    protected function isLivewireHydrationNoise(Throwable $e): bool
    {
        return $e instanceof \TypeError
            && (str_contains($e->getFile(), '/vendor/livewire/')
                || str_contains($e->getFile(), '/vendor/filament/notifications/'));
    }
}
