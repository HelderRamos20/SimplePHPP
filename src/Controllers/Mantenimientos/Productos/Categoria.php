<?php

namespace Controllers\Mantenimientos\Productos;

use Controllers\PublicController;
use Dao\Producto\Categorias as CategoriasDAO;
use Views\Renderer;

class Categoria extends PublicController
{
    private array $viewData = [];
    public function __construct()
    {
        $this->viewData = [
            "id" => 0,
            "categorias" => "",
            "estado" => "ACT"
        ];
    }
    public function run(): void
    {
        if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
            $this->viewData["id"] = intval($_GET["id"]);
            $categoria = CategoriasDAO::getCategoriasById($this->viewData["id"]);
            if(count($categoria) > 0) {
                $this->viewData["categorias"] = $this->viewData["categoria"];
                $this->viewData["estado"] = $categoria["estado"];
            }
        }
        Renderer::render("mnt/productos/categoria", $this->viewData);
    }
}