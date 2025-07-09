<?php
namespace Controllers;

use Controllers\PublicController;
use Utilities\Context;
use Utilities\Paging;
use Dao\Usuarios\Usuario as DaoUsuario;
use Views\Renderer;

class Usuarios extends PublicController {
    private $useremail = "";
    private $userest = "";
    private $orderBy = "";
    private $orderDescending = false;
    private $pageNumber = 1;
    private $itemsPerPage = 10;
    private $viewData = [];

    public function run(): void {
        $this->getParams();
        $tmpUsuarios = DaoUsuario::getUsuarios(
            $this->useremail,
            $this->userest,
            $this->orderBy,
            $this->orderDescending,
            $this->pageNumber - 1,
            $this->itemsPerPage
        );
        
        $this->viewData["usuarios"] = $tmpUsuarios["usuarios"];
        $this->viewData["total"] = $tmpUsuarios["total"];
        $this->viewData["pageNum"] = $this->pageNumber;
        $this->viewData["itemsPerPage"] = $this->itemsPerPage;
        $this->viewData["useremail"] = $this->useremail;
        $this->viewData["userest"] = $this->userest;
        
        Renderer::render("usuarios", $this->viewData);
    }

    private function getParams(): void {
        $this->useremail = $_GET["useremail"] ?? "";
        $this->userest = $_GET["userest"] ?? "";
        $this->orderBy = $_GET["orderBy"] ?? "";
        $this->orderDescending = boolval($_GET["orderDescending"] ?? false);
        $this->pageNumber = intval($_GET["pageNum"] ?? 1);
        $this->itemsPerPage = intval($_GET["itemsPerPage"] ?? 10);
    }
}
?>