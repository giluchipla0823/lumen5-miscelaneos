<?php

namespace App\Traits;

use App\Helpers\DatatablesHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

Trait ResponseTransformer{

    /**
     * Transformar respuesta de instancias de modelo
     *
     * @param Model $instance
     * @return Model
     */
    protected function transformInstance(Model $instance){
        $transformer = $instance->resource;

        if(!$transformer){
            return $instance;
        }

        $instance = new $transformer($instance);

        return $instance;
    }

    /**
     * Transformar respuesta para colecciones
     *
     * @param Collection $collection
     * @return Collection
     */
    protected function transformCollection(Collection $collection){
        if ($collection->isEmpty()) {
            return $collection;
        }

        $transformer = $collection->first()->resource;

        if(!$transformer){
            return $collection;
        }

        $collection = $transformer::collection($collection);

        return $collection;
    }


    /**
     * Transformar recurso de datatables
     *
     * @param Collection $collection
     * @return array|mixed
     */
    protected function transformDatatables(Collection $collection){
        $transformer = NULL;
        $method = 'of';

        if(!$collection->isEmpty()){
            $transformer = $collection->first()->resource;
        }

        if($transformer){
            $method = "resource";
            $collection = $transformer::collection($collection);
        }

        $json = datatables()->{$method}($collection)->toJson();

        return DatatablesHelper::makeResponse($json);
    }
}
