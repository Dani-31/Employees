<?php
namespace Controllers\Employees;

use Controllers\PublicController;
use \Dao\Employees\Employees as DaoEmployees;
use Utilities\Context;
use Utilities\Paging;
use Views\Renderer;

const SESSION_EMPLOYEES_SEARCH = "employees_search_data";

class Employees extends \Controllers\PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }
        $viewData["Employees"] = DaoEmployees::readAllEmployees($viewData["search"]);
        $viewData["total"] = count($viewData["Employees"]);

        \Views\Renderer::render("Employees/Employees", $viewData);
    }

    private function getSearchData()
    {
        if (isset($_POST["search"])) {
            return $_POST["search"];
        }
        return "";
    }

    private function getSessionSearchData()
    {
        if (isset($_SESSION[SESSION_EMPLOYEES_SEARCH])) {
            return $_SESSION[SESSION_EMPLOYEES_SEARCH];
        }
        return "";
    }

    private function setSessionSearchData($search)
    {
        $_SESSION[SESSION_EMPLOYEES_SEARCH] = $search;
    }
}