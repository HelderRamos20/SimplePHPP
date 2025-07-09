<?php
namespace Dao\Usuarios;
use Dao\Table;

class Usuario extends Table {
    public static function getUsuarios(
        string $useremail = "",
        string $userest = "",
        string $orderBy = "",
        bool $orderDescending = false,
        int $page = 0,
        int $itemsPerPage = 10
    ) {
        $sqlstr = "SELECT usercod, useremail, username, userfching, userpswdest, userpswdexp, userest, usertipo 
                   FROM usuario";
        $sqlstrCount = "SELECT COUNT(*) as count FROM usuario";
        
        $conditions = [];
        $params = [];
        
        if ($useremail != "") {
            $conditions[] = "useremail LIKE :useremail";
            $params["useremail"] = "%" . $useremail . "%";
        }
        
        if ($userest != "") {
            $conditions[] = "userest = :userest";
            $params["userest"] = $userest;
        }
        
        if (count($conditions) > 0) {
            $sqlstr .= " WHERE " . implode(" AND ", $conditions);
            $sqlstrCount .= " WHERE " . implode(" AND ", $conditions);
        }
        
        $validOrderBy = ["usercod", "useremail", "username", "userfching"];
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
            "usuarios" => $registros, 
            "total" => $numeroDeRegistros,
            "page" => $page,
            "itemsPerPage" => $itemsPerPage
        ];
    }

    public static function getUsuarioById(int $usercod) {
        $sqlstr = "SELECT * FROM usuario WHERE usercod = :usercod";
        $params = ["usercod" => $usercod];
        return self::obtenerUnRegistro($sqlstr, $params);
    }

    public static function insertUsuario(
        string $useremail,
        string $username,
        string $userpswd,
        string $userest = 'ACT',
        string $usertipo = 'NOR'
    ) {
        $sqlstr = "INSERT INTO usuario 
                  (useremail, username, userpswd, userfching, userest, usertipo) 
                  VALUES 
                  (:useremail, :username, :userpswd, NOW(), :userest, :usertipo)";
        $params = [
            "useremail" => $useremail,
            "username" => $username,
            "userpswd" => $userpswd,
            "userest" => $userest,
            "usertipo" => $usertipo
        ];
        return self::executeNonQuery($sqlstr, $params);
    }

    public static function updateUsuario(
        int $usercod,
        string $useremail,
        string $username,
        string $userest,
        string $usertipo
    ) {
        $sqlstr = "UPDATE usuario SET 
                  useremail = :useremail,
                  username = :username,
                  userest = :userest,
                  usertipo = :usertipo
                  WHERE usercod = :usercod";
        $params = [
            "usercod" => $usercod,
            "useremail" => $useremail,
            "username" => $username,
            "userest" => $userest,
            "usertipo" => $usertipo
        ];
        return self::executeNonQuery($sqlstr, $params);
    }

    public static function deleteUsuario(int $usercod) {
        $sqlstr = "DELETE FROM usuario WHERE usercod = :usercod";
        $params = ["usercod" => $usercod];
        return self::executeNonQuery($sqlstr, $params);
    }
}
?>