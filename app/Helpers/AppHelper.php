<?php

namespace App\Helpers;

use Illuminate\Validation\Validator;

class AppHelper
{
    /**
     * Obtener información del controlador actual
     *
     * @return array
     */
    public static function getControllerInfo(): array {
        $route = app('request')->route();

        if($route){
            $routeUse = $route[1]['uses'];

            list($name, $action) = explode('@', class_basename($routeUse));

            return [
                'name' => $name
                , 'action' => $action
            ];
        }

        return [];
    }

    /**
     * Formato de errores de validación
     *
     * @param Validator $validator
     * @return array
     */
    public static function getFormatValidationErrors(Validator $validator){
        $errors = $validator->errors()->getMessages();
        $response = [];

        foreach ($errors as $key => $value) {
            $response[] = [
                'field' => $key
                , 'message' => $value[0]
            ];
        }

        return $response;
    }


}
