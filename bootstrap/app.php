<?php



use Illuminate\Http\Request;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Foundation\Application;
use Illuminate\Database\QueryException;
use App\Http\Middleware\AuthUserMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Traits\ApiResponder;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: [
            __DIR__ . '/../routes/api_users.php',
          
            __DIR__ . '/../routes/api_admins.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth-user' => AuthUserMiddleware::class,
            'localization' => \App\Http\Middleware\LocalizationMiddleware::class,
            'profile_json' => \App\Http\Middleware\ProfileJson::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Create a responder instance with the trait
        $responder = new class {
            use ApiResponder;
        };

        $exceptions->render(function (Throwable $e, Request $request) use ($responder) {
            if ($request->is('api/*')) {
                if ($e instanceof NotFoundHttpException) {
                    if ($e->getPrevious() && $e->getPrevious() instanceof ModelNotFoundException) {
                        $model = __('app.models.' . strtolower(class_basename($e->getPrevious()->getModel())), [], lang());

                        return $responder
                            ->setStatusCode(404)
                            ->respondWithError(__('app.exceptions.model not found', ['model' => $model], lang()), 404);
                    }
                    return $responder
                        ->setStatusCode(404)
                        ->respondWithError(__('app.exceptions.url not found', ['url' => $request->url()], lang()), 404);
                }
            }
        });

        $exceptions->render(function (AuthorizationException $exception, Request $request) use ($responder) {
            return $responder
                ->setStatusCode(403)
                ->respondWithError(__("app.exceptions.this action is unauthorized", [], lang()), 403);
        });

        $exceptions->render(function (AccessDeniedHttpException $exception, Request $request) use ($responder) {
            return $responder
                ->setStatusCode(403)
                ->respondWithError(__("app.exceptions.this action is unauthorized", [], lang()), 403);
        });

        $exceptions->render(function (ValidationException $exception, Request $request) use ($responder) {
            return $responder
                ->setStatusCode(422)
                ->respondWithError(array_values($exception->errors())[0][0], 422);
        });

        $exceptions->render(function (AuthenticationException $exception, Request $request) use ($responder) {
            if ($request->expectsJson()) {
                return $responder
                    ->setStatusCode(401)
                    ->respondWithError(__("app.exceptions.you have to login first", [], lang()), 401);
            } else {
                return redirect()->guest('login');
            }
        });
    })->create();
