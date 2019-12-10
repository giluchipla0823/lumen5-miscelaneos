<?php

namespace App\Libraries;

class Api {
    CONST CODE_SUCCESS = 1;
    CONST CODE_ALERT = 2;
    CONST CODE_ERROR = 3;
    CONST CODE_ERROR_DB = 4;

    CONST IDX_STR_API_NAME = 'jsonapi';
    CONST IDX_STR_API_VERSION = 'version';
    CONST IDX_STR_JSON_STATUS = "status";
    CONST IDX_STR_JSON_CODE = "code";
    CONST IDX_STR_JSON_MESSAGE = "message";
    CONST IDX_STR_JSON_MESSAGE_DETAIL = "description";
    CONST IDX_STR_JSON_ERRORS = "errors";
    CONST IDX_STR_JSON_DATA = "data";
    CONST IDX_STR_JSON_CACHE = "cache";

    protected $response = array(
        self::IDX_STR_API_NAME => array(
            self::IDX_STR_API_VERSION => '1.0.0'
        ),
        self::IDX_STR_JSON_STATUS => self::CODE_SUCCESS,
        self::IDX_STR_JSON_CODE => 200,
        self::IDX_STR_JSON_MESSAGE => 'OK'
    );


    /**
     * Construir respuesta de la API
     *
     * @param string $message
     * @param int $status
     * @param int $code
     * @param array $extra
     * @return array
     */
    public function makeResponse(string $message, int $status, int $code, array $extra = []): array {
        $response = $this->response;

        $response[self::IDX_STR_JSON_STATUS] = $status;
        $response[self::IDX_STR_JSON_CODE] = $code;
        $response[self::IDX_STR_JSON_MESSAGE] = $message;

        foreach ($extra as $key => $value){
            $response[$key] = $value;
        }

        return $response;
    }
}
