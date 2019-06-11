<?php

use Illuminate\Database\Seeder;
use Abbarbosa\infoDynamics\AutoRoute\Model\AutoRouteModel;

class StoredRoutesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stored_routes = [
            [
                'verb' => 'get', // get, post, put, delete, any
                'prefix' => 'Sample', // http://something/Sample/index
                'name' => 'test.index', // Nome da rota
                'pattern' => 'index', // Pattern é parte da URI, como se vê acima
                'controller' => 'TestController', // Nome do controller
                'method' => 'index', // Método no controller
                'resource' => false, // Este deve ser verdadeiro apenas para recursos
            ],
            [
                'verb' => 'get',
                'prefix' => 'Sample',
                'name' => 'test.edit',
                'pattern' => 'edit/{id}',
                'controller' => 'TestController',
                'method' => 'edit',
                'resource' => false,
            ],
            [
                'verb' => 'post',
                'prefix' => 'Sample',
                'name' => 'store',
                'pattern' => 'test.storage',
                'controller' => 'TestController',
                'method' => 'store',
                'resource' => false,
            ],
            // Deverá gerar rotas para para CRUD / Resource
            [
                'verb' => null, // Em caso de recurso deixe aqui nulo
                'prefix' => null, // - Opcional
                'name' => null, // Em caso de recurso deixe aqui nulo
                'pattern' => 'all-routes',
                'controller' => 'TestController',
                'method' => null, // Em caso de recurso deixe aqui nulo
                'resource' => true,
            ],
        ];
        foreach ($stored_routes as $row) {
            AutoRouteModel::create($row);
        }
    }
}