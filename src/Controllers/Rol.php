<?php
namespace Controllers;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Roles\Roles as DaoRoles;
use Utilities\Site;
use Utilities\Validators;

class Rol extends PublicController {
    private $viewData = [];
    private $mode = "DSP";
    private $modeDescriptions = [
        "DSP" => "Detalle de Rol",
        "INS" => "Nuevo Rol",
        "UPD" => "Editar Rol",
        "DEL" => "Eliminar Rol"
    ];
    
    private $rol = [
        "rolescod" => "",
        "rolesdsc" => "",
        "rolesest" => "ACT"
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
            Renderer::render("rol", $this->viewData);
        } catch (\Exception $ex) {
            Site::redirectToWithMsg("index.php?page=RolesList", $ex->getMessage());
        }
    }

    private function getData() {
        $this->mode = $_GET["mode"] ?? "DSP";
        if ($this->mode !== "INS") {
            $this->rol = DaoRoles::getRolById($_GET["rolescod"]);
            if (!$this->rol) {
                throw new \Exception("Rol no encontrado");
            }
        }
    }

    private function validateData() {
        $errors = [];
        
        if (Validators::IsEmpty($this->rol["rolescod"])) {
            $errors["rolescod_error"] = "El código del rol es requerido";
        }
        
        if (Validators::IsEmpty($this->rol["rolesdsc"])) {
            $errors["rolesdsc_error"] = "La descripción del rol es requerida";
        }
        
        if (!in_array($this->rol["rolesest"], ["ACT", "INA"])) {
            $errors["rolesest_error"] = "Estado inválido";
        }
        
        if (count($errors) > 0) {
            foreach ($errors as $key => $value) {
                $this->rol[$key] = $value;
            }
            return false;
        }
        return true;
    }

    private function handlePostAction() {
        switch ($this->mode) {
            case "INS":
                $result = DaoRoles::insertRol(
                    $this->rol["rolescod"],
                    $this->rol["rolesdsc"],
                    $this->rol["rolesest"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=RolesList",
                        "Rol creado exitosamente"
                    );
                }
                break;
                
            case "UPD":
                $result = DaoRoles::updateRol(
                    $this->rol["rolescod"],
                    $this->rol["rolesdsc"],
                    $this->rol["rolesest"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=RolesList",
                        "Rol actualizado exitosamente"
                    );
                }
                break;
                
            case "DEL":
                $result = DaoRoles::deleteRol($this->rol["rolescod"]);
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=RolesList",
                        "Rol eliminado exitosamente"
                    );
                }
                break;
        }
    }

    private function prepareViewData() {
        $this->viewData["mode"] = $this->mode;
        $this->viewData["FormTitle"] = $this->modeDescriptions[$this->mode];
        $this->viewData["rol"] = $this->rol;
        
        // Para selección de estado
        $rolesestKey = "rolesest_" . strtolower($this->rol["rolesest"]);
        $this->rol[$rolesestKey] = "selected";
    }
}
?>