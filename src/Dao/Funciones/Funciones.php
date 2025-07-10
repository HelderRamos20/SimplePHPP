<?php
namespace Dao\Funciones;

use Dao\Table;

class Funciones extends Table {
    public static function getFunciones(
        string $fndsc = "",
        string $fnest = "",
        string $orderBy = "",
        bool $orderDescending = false,
        int $page = 0,
        int $itemsPerPage = 10
    ) {
        $sqlstr = "SELECT fncod, fndsc, fnest, fntyp FROM funciones";
        $sqlstrCount = "SELECT COUNT(*) as count FROM funciones";
        
        $conditions = [];
        $params = [];
        
        if ($fndsc != "") {
            $conditions[] = "fndsc LIKE :fndsc";
            $params["fndsc"] = "%" . $fndsc . "%";
        }
        
        if ($fnest != "") {
            $conditions[] = "fnest = :fnest";
            $params["fnest"] = $fnest;
        }
        
        if (count($conditions) > 0) {
            $sqlstr .= " WHERE " . implode(" AND ", $conditions);
            $sqlstrCount .= " WHERE " . implode(" AND ", $conditions);
        }
        
        $validOrderBy = ["fncod", "fndsc", "fntyp"];
        if ($orderBy != "" && in_array($orderBy, $validOrderBy)) {
            $sqlstr .= " ORDER BY " . $orderBy;
            if ($orderDescending) {
                $sqlstr .= " DESC";
            }
        }
        
        $numeroDeRegistros = self::obtenerUnRegistro($sqlstrCount, $params)["count"];
        $pagesCount = ceil($numeroDeRegistros / $itemsPerPage);
        $page = max(0, min($page, $pagesCount - 1));
        $sqlstr .= " LIMIT " . $page * $itemsPerPage . ", " . $itemsPerPage;

        $registros = self::obtenerRegistros($sqlstr, $params);
        return [
            "funciones" => $registros, 
            "total" => $numeroDeRegistros,
            "page" => $page,
            "itemsPerPage" => $itemsPerPage
        ];
    }

    public static function getFuncionById(string $fncod) {
        $sqlstr = "SELECT * FROM funciones WHERE fncod = :fncod";
        $params = ["fncod" => $fncod];
        return self::obtenerUnRegistro($sqlstr, $params);
    }

    public static function insertFuncion(
        string $fncod,
        string $fndsc,
        string $fnest = "ACT",
        string $fntyp = "GEN"
    ) {
        $sqlstr = "INSERT INTO funciones 
                  (fncod, fndsc, fnest, fntyp) 
                  VALUES 
                  (:fncod, :fndsc, :fnest, :fntyp)";
        $params = [
            "fncod" => $fncod,
            "fndsc" => $fndsc,
            "fnest" => $fnest,
            "fntyp" => $fntyp
        ];
        return self::executeNonQuery($sqlstr, $params);
    }

    public static function updateFuncion(
        string $fncod,
        string $fndsc,
        string $fnest,
        string $fntyp
    ) {
        $sqlstr = "UPDATE funciones SET 
                  fndsc = :fndsc,
                  fnest = :fnest,
                  fntyp = :fntyp
                  WHERE fncod = :fncod";
        $params = [
            "fncod" => $fncod,
            "fndsc" => $fndsc,
            "fnest" => $fnest,
            "fntyp" => $fntyp
        ];
        return self::executeNonQuery($sqlstr, $params);
    }

    public static function deleteFuncion(string $fncod) {
        $sqlstr = "DELETE FROM funciones WHERE fncod = :fncod";
        $params = ["fncod" => $fncod];
        return self::executeNonQuery($sqlstr, $params);
    }
}
?>