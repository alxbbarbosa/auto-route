<?php

namespace Abbarbosa\infoDynamics\AutoRoute\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * ==============================================================================================================
 *
 * AutoRoute: Classe Facade para registro de rotas
 *
 * ----------------------------------------------------
 *
 * @author Alexandre Bezerra Barbosa <alxbbarbosa@yahoo.com.br>
 * @copyright (c) 2019, Alexandre Bezerra Barbosa
 * @version 1.00
 * ==============================================================================================================
 */
class AutoRoute extends Facade
{

    public static function getFacadeAccessor(): string
    {
        return 'autoRouteDB';
    }
}