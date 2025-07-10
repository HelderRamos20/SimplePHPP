<?php
namespace Dao\Roles;

use Dao\Table;

class Roles extends Table {
    public static function getRoles(
        string $rolesdsc = "",
        string $rolesest = "",
        string $orderBy = "",
        bool $orderDescending = false,
        int $page = 0,
        int $itemsPerPage = 10
    ) {
        $sqlstr = "SELECT rolescod, rolesdsc, rolesest FROM roles";
        $sqlstrCount = "SELECT COUNT(*) as count FROM roles";
        
        $conditions = [];
        $params = [];
        
        if ($rolesdsc != "") {
            $conditions[] = "rolesdsc LIKE :rolesdsc";
            $params["rolesdsc"] = "%" . $rolesdsc . "%";
        }
        
        if ($rolesest != "") {
            $conditions[] = "rolesest = :rolesest";
            $params["rolesest"] = $rolesest;
        }
        
        if (count($conditions) > 0) {
            $sqlstr .= " WHERE " . implode(" AND ", $conditions);
            $sqlstrCount .= " WHERE " . implode(" AND ", $conditions);
        }
        
        $validOrderBy = ["rolescod", "rolesdsc"];
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
            "roles" => $registros, 
            "total" => $numeroDeRegistros,
            "page" => $page,
            "itemsPerPage" => $itemsPerPage
        ];
    }

    public static function getRolById(string $rolescod) {
        $sqlstr = "SELECT * FROM roles WHERE rolescod = :rolescod";
        $params = ["rolescod" => $rolescod];
        return self::obtenerUnRegistro($sqlstr, $params);
    }

    public static function insertRol(
        string $rolescod,
        string $rolesdsc,
        string $rolesest = "ACT"
    ) {
        $sqlstr = "INSERT INTO roles 
                  (rolescod, rolesdsc, rolesest) 
                  VALUES 
                  (:rolescod, :rolesdsc, :rolesest)";
        $params = [
            "rolescod" => $rolescod,
            "rolesdsc" => $rolesdsc,
            "rolesest" => $rolesest
        ];
        return self::executeNonQuery($sqlstr, $params);
    }

    public static function updateRol(
        string $rolescod,
        string $rolesdsc,
        string $rolesest
    ) {
        $sqlstr = "UPDATE roles SET 
                  rolesdsc = :rolesdsc,
                  rolesest = :rolesest
                  WHERE rolescod = :rolescod";
        $params = [
            "rolescod" => $rolescod,
            "rolesdsc" => $rolesdsc,
            "rolesest" => $rolesest
        ];
        return self::executeNonQuery($sqlstr, $params);
    }

    public static function deleteRol(string $rolescod) {
        $sqlstr = "DELETE FROM roles WHERE rolescod = :rolescod";
        $params = ["rolescod" => $rolescod];
        return self::executeNonQuery($sqlstr, $params);
    }
}
?>