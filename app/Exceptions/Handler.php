<?php

namespace App\Exceptions;

use App\Helpers\AppHelper;
use App\Libraries\Api;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($exception->getModel()));

            return $this->errorResponse(
                "No existe ninguna instancia de {$modelName} con el id especificado",
                Response::HTTP_NOT_FOUND
            );
        }

        if ($exception instanceof AuthenticationException) {
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_UNAUTHORIZED
            );
        }

        if($exception instanceof AuthorizationException){
            return $this->errorResponse(
                'Unauthorized',
                Response::HTTP_UNAUTHORIZED
            );
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse(
                'El método especificado en la petición no es válido',
                Response::HTTP_METHOD_NOT_ALLOWED
            );
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse(
                'No se encontró la URL especificada',
                Response::HTTP_NOT_FOUND
            );
        }

        if($exception instanceof QueryException){
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                Api::CODE_ERROR_DB
            );
        }

        if($exception instanceof ExceptionFormat){
            return $this->errorResponse(
                $exception->getMessage(),
                $exception->getCode(),
                $exception->getStatus()
            );
        }

        if($exception instanceof Exception){
            return $this->errorResponse(
                $exception->getMessage(),
                $exception->getCode()
            );
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        if ($exception instanceof TokenMismatchException) {
            dd('TokenMismatchException', $exception);
        }
        
        return $this->errorResponse(
            'Falla inesperada. Intente luego',
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param ValidationException $exc
     * @return JsonResponse
     */
    protected function convertValidationExceptionToResponse(ValidationException $exc)
    {
        $errors = AppHelper::getFormatValidationErrors($exc->validator);

        return $this->errorResponse(
            'Processing error',
            Response::HTTP_UNPROCESSABLE_ENTITY,
            Api::CODE_ERROR,
            [Api::IDX_STR_JSON_ERRORS => $errors]
        );
    }
}
