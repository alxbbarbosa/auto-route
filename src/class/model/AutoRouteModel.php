<?php

namespace Abbarbosa\infoDynamics\AutoRoute\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Abbarbosa\infoDynamics\Contracts\iAutoRouteModel;

/**
 * Classe: AutoRouteModel
 * =============================================================================
 * Objetivo: Definir forma de persistencia
 *
 *
 *
 * =============================================================================
 * @author Alexandre Bezerra Barbosa <alxbbarbosa@hotmail.com>
 *
 * @copyright 2015-2019 AB Babosa Serviços e Desenvolvimento ME
 * =============================================================================
 */
class AutoRouteModel extends Model implements iAutoRouteModel
{
    protected $table    = 'stored_routes';

    protected $fillable = [
        'verb',
        'prefix',
        'name',
        'pattern',
        'controller',
        'method',
        'resource'
    ];

    public $timestamps = false;
    
    public function tableExists(): bool
    {
        $driver = Config::get('database.default');

        switch ($driver) {
            case 'mysql':
                return $this->inMySQL();
            case 'pgsql':
                return $this->inPostgres();
            case 'mssql':
                // TO DO
                return false;
            case 'sqlite':
                // TO DO
                return false;
        }

        return false;
    }

    protected function inMySQL(): bool
    {
        $stmt = "SHOW TABLES LIKE '{$this->getTable()}'";
        return DB::connection()->getPdo()->query($stmt)->rowCount() > 0;
    }

    protected function inPostgres(): bool
    {
        $stmt  = "SELECT to_regclass('public.{$this->getTable()}');";
        $conn  = DB::connection()->getPdo();
        $check = $conn->prepare($stmt);
        if ($check->execute()) {
            $result = $check->fetchAll(\PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                return !!$result[0]['to_regclass'];
            }
        }
        return false;
    }
}
