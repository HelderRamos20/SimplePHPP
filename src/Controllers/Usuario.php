<?php
namespace Controllers;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Usuarios\Usuario as DaoUsuario;
use Utilities\Site;
use Utilities\Validators;

class Usuario extends PublicController {
    private $viewData = [];
    private $mode = "DSP";
    private $modeDescriptions = [
        "DSP" => "Detalle de Usuario",
        "INS" => "Nuevo Usuario",
        "UPD" => "Editar Usuario",
        "DEL" => "Eliminar Usuario"
    ];
    
    private $usuario = [
        "usercod" => 0,
        "useremail" => "",
        "username" => "",
        "userpswd" => "",
        "userest" => "ACT",
        "usertipo" => "NOR"
    ];

    public function run(): void {
        try {
            $this->getData();
            if ($this->isPostBack()) {
                if ($this->validateData()) {
                    $this->handlePostAction();
                }
            }
            $this->prepareViewData();
            Renderer::render("usuario", $this->viewData);
        } catch (\Exception $ex) {
            Site::redirectToWithMsg("index.php?page=Usuarios", $ex->getMessage());
        }
    }

    private function getData() {
        $this->mode = $_GET["mode"] ?? "DSP";
        if ($this->mode !== "INS") {
            $this->usuario = DaoUsuario::getUsuarioById(intval($_GET["usercod"]));
            if (!$this->usuario) {
                throw new \Exception("Usuario no encontrado");
            }
        }
    }

    private function validateData() {
        // Validaciones básicas
        if (Validators::IsEmpty($this->usuario["useremail"])) {
            $this->usuario["error_useremail"] = "El email es requerido";
            return false;
        }
        
        if ($this->mode === "INS" && Validators::IsEmpty($this->usuario["userpswd"])) {
            $this->usuario["error_userpswd"] = "La contraseña es requerida";
            return false;
        }
        
        return true;
    }

    private function handlePostAction() {
        switch ($this->mode) {
            case "INS":
                $result = DaoUsuario::insertUsuario(
                    $this->usuario["useremail"],
                    $this->usuario["username"],
                    $this->usuario["userpswd"],
                    $this->usuario["userest"],
                    $this->usuario["usertipo"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg("index.php?page=Usuarios", "Usuario creado exitosamente");
                }
                break;
                
            case "UPD":
                $result = DaoUsuario::updateUsuario(
                    $this->usuario["usercod"],
                    $this->usuario["useremail"],
                    $this->usuario["username"],
                    $this->usuario["userest"],
                    $this->usuario["usertipo"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg("index.php?page=Usuarios", "Usuario actualizado exitosamente");
                }
                break;
                
            case "DEL":
                $result = DaoUsuario::deleteUsuario($this->usuario["usercod"]);
                if ($result > 0) {
                    Site::redirectToWithMsg("index.php?page=Usuarios", "Usuario eliminado exitosamente");
                }
                break;
        }
    }

    private function prepareViewData() {
        $this->viewData["mode"] = $this->mode;
        $this->viewData["FormTitle"] = $this->modeDescriptions[$this->mode];
        $this->viewData["usuario"] = $this->usuario;
    }
}
?>