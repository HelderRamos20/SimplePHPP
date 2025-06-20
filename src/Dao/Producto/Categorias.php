<?php
namespace Dao\Producto;

use Dao\Table;

class Categorias extends Table {

    public static function getCategorias(){
        $sqlstr = "SELECT * FROM categorias;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function getCategoriasById(int $categoriaId){
        $sqlstr = "SELECT * FROM categorias WHERE id = :id;";
        
        return self::obtenerUnRegistro($sqlstr, ["id" => $categoriaId]);
    }
}