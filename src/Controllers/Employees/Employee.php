<?php

namespace Controllers\Employees;


use Controllers\PublicController;
use Views\Renderer;
use \Dao\Employees\Employees as DaoEmployees;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Employee extends PublicController{
    private $mode = "NAN";
    private $modeDscArr = [
        "INS" => "Nuevo Employee",
        "UPD" => "Actualizando Employee %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];
    private $modeDsc = "";

    /*Variables de la tabla */

    private $EmployeeID = 0; 
    private $FirstName = "";
    private $LastName = "";
    private $HireDate = ""; 
    private $DepartmentID = 0;
    /*Variables de la tabla */

    private $errors = array();
    private $xsrftk = "";

    public function run(): void
    {
        $this->obtenerDatosDelGet();
        $this->getDatosFromDB();
        if ($this->isPostBack()) {
            $this->obtenerDatosDePost();
            if (count($this->errors) === 0) {
                $this->procesarAccion();
            }
        }
        $this->showView();
    }

    private function obtenerDatosDelGet()
    {
        if (isset($_GET["mode"])) {
            $this->mode = $_GET["mode"];
        }
        if (!isset($this->modeDscArr[$this->mode])) {
            throw new \Exception("Modo no válido");
        }
        if (isset($_GET["EmployeeID"])) {
            $this->EmployeeID = $_GET["EmployeeID"];
        }

        if ($this->mode != "INS" && $this->EmployeeID <= 0) {
            throw new \Exception("ID no válido");
        }
    }
    

    private function getDatosFromDB()
    {
        if($this->EmployeeID > 0){
            $Employees = DaoEmployees::readEmployee($this->EmployeeID);
            if (!$Employees) {
                throw new \Exception("Funcion no encontrado");
            }
            $this->FirstName = $Employees["FirstName"];
            $this->LastName = $Employees["LastName"];
            $this->HireDate = $Employees["HireDate"];
            $this->DepartmentID = $Employees["DepartmentID"];
        }
    }

    private function obtenerDatosDePost()
    {
        $tmpFn = $_POST["FirstName"] ?? "";
        $tmpLn = $_POST["LastName"] ?? "";
        $tmpHd = $_POST["HireDate"] ?? "";
        $tmpDi = $_POST["DepartmentID"] ?? "";

        $tmpLne = $_POST["mode"] ?? "";
        $tmpXsrfTk = $_POST["xsrftk"] ?? "";

        $this->getXSRFToken();
        if (!$this->compareXSRFToken($tmpXsrfTk)) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }

        /*FirstName*/
        if (Validators::IsEmpty($tmpFn)) {
            $this->addError("FirstName", "La FirstName no puede estar vacio", "error");
        }
        $this->FirstName = $tmpFn;
        
        /*LastName */
        if (Validators::IsEmpty($tmpLn)) {
            $this->addError("LastName", "El LastName no puede estar vacio", "error");
        }
        $this->LastName = $tmpLn;

        /*Fecha*/
        if (Validators::IsEmpty($tmpHd)) {
            $this->addError("HireDate", "La fecha de contratación no puede estar vacio", "error");
        }
        $this->HireDate = $tmpHd;

        /*DepartamendoId*/
        if (Validators::IsEmpty($tmpDi)) {
            $this->addError("DepartmentID", "El departamento id no puede estar vacio", "error");
        }
        $this->DepartmentID = $tmpDi;


        /*Modo */
        if (Validators::IsEmpty($tmpLne) || !in_array($tmpLne, ["INS", "UPD", "DEL"])) {
            $this->throwError("Ocurrio un error al procesar la solicitud.");
        }
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case "INS":
                $insResult = DaoEmployees::createEmployee(
    
                    $this->FirstName,
                    $this->LastName,
                    $this->HireDate,
                    $this->DepartmentID
           

                );
                $this->validateDBOperation(
                    "Employee insertado correctamente",
                    "Ocurrio un error al insertar el Employee",
                    $insResult
                );
                break;
            case "UPD":
                $updResult = DaoEmployees::updateEmployee(
                    $this->FirstName,
                    $this->LastName,
                    $this->HireDate,
                    $this->DepartmentID
                  
                );
                $this->validateDBOperation(
                    "Employee actualizado correctamente",
                    "Ocurrio un error al actualizar el Employee",
                    $updResult
                );
                break;
            case "DEL":
                $delResult = DaoEmployees::deleteEmployee($this->EmployeeID);
                $this->validateDBOperation(
                    "Employee eliminado correctamente",
                    "Ocurrio un error al eliminar el Employee",
                    $delResult
                );
                break;
        }
    }

    private function validateDBOperation($msg, $error, $result)
    {
        if (!$result) {
            $this->errors["error_general"] = $error;
        } else {
            Site::redirectToWithMsg(
                "index.php?page=Employees-Employees",
                $msg
            );
        }
    }

    private function throwError($msg)
    {
        Site::redirectToWithMsg(
            "index.php?page=Employees-Employees",
            $msg
        );
    }

    private function addError($key, $msg, $context = "general")
    {
        if (!isset($this->errors[$context . "_" . $key])) {
            $this->errors[$context . "_" . $key] = [];
        }
        $this->errors[$context . "_" . $key][] = $msg;
    }

    private function generateXSRFToken()
    {
        $this->xsrftk = md5(uniqid(rand(), true));
        $_SESSION[$this->name . "_xsrftk"] = $this->xsrftk;
    }
    private function getXSRFToken()
    {
        if (isset($_SESSION[$this->name . "_xsrftk"])) {
            $this->xsrftk = $_SESSION[$this->name . "_xsrftk"];
        }
    }
    private function compareXSRFToken($postXSFR)
    {
        return $postXSFR === $this->xsrftk;
    }

    private function showView()
    {
        $this->generateXSRFToken();
        $viewData = array();
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->LastName);

        $viewData["EmployeeID"] = $this->EmployeeID;
        $viewData["FirstName"] = $this->FirstName;
        $viewData["LastName"] = $this->LastName;
        $viewData["HireDate"] = $this->HireDate;
        $viewData["DepartmentID"] = $this->DepartmentID;


        $viewData["errors"] = $this->errors;
        $viewData["xsrftk"] = $this->xsrftk;
        $viewData["isReadOnly"] = in_array($this->mode, ["DEL", "DSP"]) ? "readonly" : "";
        $viewData["isDisplay"] = $this->mode == "DSP";
        \Views\Renderer::render("Employee/Employee", $viewData);
    }
}