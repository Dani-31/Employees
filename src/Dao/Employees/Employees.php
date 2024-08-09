<?php

namespace Dao\Employees;

class Employees extends \Dao\Table
{



    /**Lista */

    public static function readAllEmployees($filter = '')
    {
        $sqlstr = "SELECT * from Employees where LastName like :filter;";
        $params = array('filter' => '%' . $filter . '%');
        return self::obtenerRegistros($sqlstr, $params);
    }


    public static function readEmployee($EmployeeID)
    {
        $sqlstr = "SELECT * from Employees where  EmployeeID = :EmployeeID;";
        $params = array('EmployeeID' => $EmployeeID);
        return self::obtenerUnRegistro($sqlstr, $params);
    }
}
