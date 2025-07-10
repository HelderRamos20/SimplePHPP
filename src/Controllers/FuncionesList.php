<?php
namespace Controllers;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Funciones\Funciones as DaoFunciones;
use Utilities\Context;
use Utilities\Paging;

class FuncionesList extends PublicController {
    private $viewData = [];
    private $fndsc = "";
    private $fnest = "";
    private $orderBy = "";
    private $orderDescending = false;
    private $pageNumber = 1;
    private $itemsPerPage = 10;

    public function run(): void {
        $this->getParams();
        $tmpFunciones = DaoFunciones::getFunciones(
            $this->fndsc,
            $this->fnest,
            $this->orderBy,
            $this->orderDescending,
            $this->pageNumber - 1,
            $this->itemsPerPage
        );
        
        $this->viewData["funciones"] = $tmpFunciones["funciones"];
        $this->viewData["total"] = $tmpFunciones["total"];
        $this->viewData["pageNum"] = $this->pageNumber;
        $this->viewData["itemsPerPage"] = $this->itemsPerPage;
        $this->viewData["fndsc"] = $this->fndsc;
        $this->viewData["fnest"] = $this->fnest;
        
        Renderer::render("funcioneslist", $this->viewData);
    }

    private function getParams(): void {
        $this->fndsc = $_GET["fndsc"] ?? "";
        $this->fnest = $_GET["fnest"] ?? "";
        $this->orderBy = $_GET["orderBy"] ?? "";
        $this->orderDescending = boolval($_GET["orderDescending"] ?? false);
        $this->pageNumber = intval($_GET["pageNum"] ?? 1);
        $this->itemsPerPage = intval($_GET["itemsPerPage"] ?? 10);
    }
}
?>