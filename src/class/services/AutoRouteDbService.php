<?php

namespace Abbarbosa\infoDynamics\AutoRoute\Services;

use Illuminate\Support\Facades\Route;
use Abbarbosa\infoDynamics\Contracts\iAutoRouteModel;

/**
 * ==============================================================================================================
 *
 * AutoRouteDbService: Classe para registro de rotas
 *
 * ----------------------------------------------------
 *
 * @author Alexandre Bezerra Barbosa <alxbbarbosa@yahoo.com.br>
 * @copyright (c) 2019, Alexandre Bezerra Barbosa
 * @version 1.00
 * ==============================================================================================================
 */
class AutoRouteDbService
{
    protected $model;

    function __construct(iAutoRouteModel $model)
    {
        $this->model = $model;
    }

    public function register()
    {
        $return = false;
        if ($this->model->tableExists()) {
            $myRoute = $this->model->where('resource', '!=', true)->get();
            $myRoute->each(function (iAutoRouteModel $myRoute) use (&$return) {

                $route_name = !is_null($myRoute->name) && strlen($myRoute->name)
                        ? $myRoute->name : str_replace('/', '-',
                        $myRoute->prefix).str_replace('controller', '',
                        strtolower($myRoute->controller)).'.'.$myRoute->method;

                if (!is_null($myRoute->middleware) && strlen($myRoute->middleware)
                    > 0) {
                    Route::{$myRoute->verb}($myRoute->prefix.'/'.$myRoute->pattern,
                            $myRoute->controller.'@'.$myRoute->method)
                        ->name($route_name)
                        ->middleware($myRoute->middleware);
                    $return = true;
                } else {
                    Route::{$myRoute->verb}($myRoute->prefix.'/'.$myRoute->pattern,
                            $myRoute->controller.'@'.$myRoute->method)
                        ->name($myRoute->name);
                    $return = true;
                }
            });
            $resources = $this->model->where('resource', '=', true)->get();
            $resources->each(function (iAutoRouteModel $resource) use (&$return) {

                if (!is_null($resource->middleware) && strlen($resource->middleware)
                    > 0) {
                    Route::resource($resource->pattern, $resource->controller)
                        ->middleware($resource->middleware);
                    $return = true;
                } else {
                    Route::resource($resource->pattern, $resource->controller);
                    $return = true;
                }
            });
        }
        return $return;
    }
}
