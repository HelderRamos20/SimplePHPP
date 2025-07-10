<?php
namespace Controllers;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Roles\Roles as DaoRoles;
use Utilities\Context;
use Utilities\Paging;

class RolesList extends PublicController {
    private $viewData = [];
    private $rolesdsc = "";
    private $rolesest = "";
    private $orderBy = "";
    private $orderDescending = false;
    private $pageNumber = 1;
    private $itemsPerPage = 10;

    public function run(): void {
        $this->getParams();
        $tmpRoles = DaoRoles::getRoles(
            $this->rolesdsc,
            $this->rolesest,
            $this->orderBy,
            $this->orderDescending,
            $this->pageNumber - 1,
            $this->itemsPerPage
        );
        
        $this->viewData["roles"] = $tmpRoles["roles"];
        $this->viewData["total"] = $tmpRoles["total"];
        $this->viewData["pageNum"] = $this->pageNumber;
        $this->viewData["itemsPerPage"] = $this->itemsPerPage;
        $this->viewData["rolesdsc"] = $this->rolesdsc;
        $this->viewData["rolesest"] = $this->rolesest;
        
        Renderer::render("roleslist", $this->viewData);
    }

    private function getParams(): void {
        $this->rolesdsc = $_GET["rolesdsc"] ?? "";
        $this->rolesest = $_GET["rolesest"] ?? "";
        $this->orderBy = $_GET["orderBy"] ?? "";
        $this->orderDescending = boolval($_GET["orderDescending"] ?? false);
        $this->pageNumber = intval($_GET["pageNum"] ?? 1);
        $this->itemsPerPage = intval($_GET["itemsPerPage"] ?? 10);
    }
}
?>