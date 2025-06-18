<?php

namespace Dao\Producto;

use Dao\Table;

class Productos extends Table {
    public static function obtenerProductos():Array
    {
        return[
                [
                    "id" => 1,
                    "descripcion" => "Producto 1",
                    "precio" => 50.00,
                    "estado" => "ACT",
                    "stock" => 100
                ],
                [
                    "id" => 1,
                    "descripcion" => "Producto 2",
                    "precio" => 100.00,
                    "estado" => "ACT",
                    "stock" => 100
                ],
                [
                    "id" => 1,
                    "descripcion" => "Producto 3",
                    "precio" => 120.00,
                    "estado" => "ACT",
                    "stock" => 100
                ]
            ];
    }
}
