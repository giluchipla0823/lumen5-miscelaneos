<?php
namespace App\Traits;

use App\Libraries\Api;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

Trait ApiResponse{

    /**
     * Crear respuesta de éxito
     *
     * @param $data
     * @param string|NULL $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    protected function successResponse($data, string $message = NULL, int $code = Response::HTTP_OK, array $extras = []){
        if(!$message){
            $message = Response::$statusTexts[$code];
        }

        return $this->makeResponse($data, $message, $code, Api::CODE_SUCCESS);
    }

    /**
     * Crear respuesta de error
     *
     * @param string $message
     * @param int $code
     * @param int $status
     * @param array $extras
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code, int $status = Api::CODE_ERROR, array $extras = []){
        return $this->makeResponse(NULL, $message, $code, $status, $extras);
    }

    /**
     * Crear respuesta de la API
     *
     * @param $data
     * @param string $message
     * @param int $code
     * @param int $status
     * @param array $extras
     * @return JsonResponse
     */
    protected function makeResponse($data, string $message, int $code, int $status, array $extras = []) {
        $response = (new Api)->makeResponse(
            $message,
            $status,
            $code
        );

        if(!is_null($data)){
            $response[Api::IDX_STR_JSON_DATA] = $data;
        }

        $response = array_merge($response, $extras);

        return response()->json($response, $code);
    }
}
