<?php

namespace Dao\Employees;

class Employees extends \Dao\Table
{
    
         /**Nuevo*/

    public static function createEmployee(
        $FirstName,
        $LastName,
        $HireDate,
        $DepartmentID
        ) {
            $InsSql = "INSERT INTO Employees (FirstName, LastName, HireDate,DepartmentID)
             value (:FirstName, :LastName, :HireDate, :DepartmentID);";
            $insParams = [
              
                'FirstName' => $FirstName,
                'LastName' => $LastName,
                'HireDate' => $HireDate,
                'DepartmentID' => $DepartmentID
           
    
            ];
    
            return self::executeNonQuery($InsSql, $insParams);
    }
   

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
