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
                switch ($myRoute->verb) {
                    case 'get':
                        Route::get($myRoute->prefix.'/'.$myRoute->pattern,
                                $myRoute->controller.'@'.$myRoute->method)
                            ->name($myRoute->name)
                            ->middleware($myRoute->middleware);
                        $return = true;
                        break;
                    case 'post':
                        Route::post($myRoute->prefix.'/'.$myRoute->pattern,
                                $myRoute->controller.'@'.$myRoute->method)
                            ->name($myRoute->name)
                            ->middleware($myRoute->middleware);
                        $return = true;
                        break;
                    case 'put':
                        Route::put($myRoute->prefix.'/'.$myRoute->pattern,
                                $myRoute->controller.'@'.$myRoute->method)
                            ->name($myRoute->name)
                            ->middleware($myRoute->middleware);
                        $return = true;
                        break;
                    case 'delete':
                        Route::delete($myRoute->prefix.'/'.$myRoute->pattern,
                                $myRoute->controller.'@'.$myRoute->method)
                            ->name($myRoute->name)
                            ->middleware($myRoute->middleware);
                        $return = true;
                        break;
                    case 'any':
                        Route::any($myRoute->prefix.'/'.$myRoute->pattern,
                                $myRoute->controller.'@'.$myRoute->method)
                            ->name($myRoute->name)
                            ->middleware($myRoute->middleware);
                        $return = true;
                        break;
                }
            });
            $resources = $this->model->where('resource', '=', true)->get();
            $resources->each(function (iAutoRouteModel $resource) use (&$return) {
                Route::resource($resource->pattern, $resource->controller)
                    ->middleware($resource->middleware);
                $return = true;
            });
        }
        return $return;
    }
}