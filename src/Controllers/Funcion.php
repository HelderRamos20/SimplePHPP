<?php
namespace Controllers;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Funciones\Funciones as DaoFunciones;
use Utilities\Site;
use Utilities\Validators;

class Funcion extends PublicController {
    private $viewData = [];
    private $mode = "DSP";
    private $modeDescriptions = [
        "DSP" => "Detalle de Función",
        "INS" => "Nueva Función",
        "UPD" => "Editar Función",
        "DEL" => "Eliminar Función"
    ];
    
    private $funcion = [
        "fncod" => "",
        "fndsc" => "",
        "fnest" => "ACT",
        "fntyp" => "GEN"
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
            Renderer::render("funcion", $this->viewData);
        } catch (\Exception $ex) {
            Site::redirectToWithMsg("index.php?page=FuncionesList", $ex->getMessage());
        }
    }

    private function getData() {
        $this->mode = $_GET["mode"] ?? "DSP";
        if ($this->mode !== "INS") {
            $this->funcion = DaoFunciones::getFuncionById($_GET["fncod"]);
            if (!$this->funcion) {
                throw new \Exception("Función no encontrada");
            }
        }
    }

    private function validateData() {
        $errors = [];
        
        if (Validators::IsEmpty($this->funcion["fncod"])) {
            $errors["fncod_error"] = "El código de función es requerido";
        }
        
        if (Validators::IsEmpty($this->funcion["fndsc"])) {
            $errors["fndsc_error"] = "La descripción es requerida";
        }
        
        if (!in_array($this->funcion["fnest"], ["ACT", "INA"])) {
            $errors["fnest_error"] = "Estado inválido";
        }
        
        if (!in_array($this->funcion["fntyp"], ["GEN", "ESP", "ADM"])) {
            $errors["fntyp_error"] = "Tipo de función inválido";
        }
        
        if (count($errors) > 0) {
            foreach ($errors as $key => $value) {
                $this->funcion[$key] = $value;
            }
            return false;
        }
        return true;
    }

    private function handlePostAction() {
        switch ($this->mode) {
            case "INS":
                $result = DaoFunciones::insertFuncion(
                    $this->funcion["fncod"],
                    $this->funcion["fndsc"],
                    $this->funcion["fnest"],
                    $this->funcion["fntyp"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=FuncionesList",
                        "Función creada exitosamente"
                    );
                }
                break;
                
            case "UPD":
                $result = DaoFunciones::updateFuncion(
                    $this->funcion["fncod"],
                    $this->funcion["fndsc"],
                    $this->funcion["fnest"],
                    $this->funcion["fntyp"]
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=FuncionesList",
                        "Función actualizada exitosamente"
                    );
                }
                break;
                
            case "DEL":
                $result = DaoFunciones::deleteFuncion($this->funcion["fncod"]);
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=FuncionesList",
                        "Función eliminada exitosamente"
                    );
                }
                break;
        }
    }

    private function prepareViewData() {
        $this->viewData["mode"] = $this->mode;
        $this->viewData["FormTitle"] = $this->modeDescriptions[$this->mode];
        $this->viewData["funcion"] = $this->funcion;
        
        // Para selección de estado y tipo
        $fnestKey = "fnest_" . strtolower($this->funcion["fnest"]);
        $this->funcion[$fnestKey] = "selected";
        
        $fntypKey = "fntyp_" . strtolower($this->funcion["fntyp"]);
        $this->funcion[$fntypKey] = "selected";
    }
}
?>