<?php

namespace Controllers\Employees;

use Controllers\PublicController;
use \Dao\Employees\Employees as DaoEmployees;
use \Views\Renderer;

class Lista extends PublicController
{
    public function run(): void
    {
        $employees = DaoEmployees::getAllEmployees();
        $viewData = array();
        $viewData["employees"] = $employees;
        Renderer::render("Employees/Lista", $viewData);
    }
}
