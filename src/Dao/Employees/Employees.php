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
     /**Actualizar */

    public static function updateEmployee(
        $EmployeeID,
        $FirstName,
        $LastName,
        $HireDate,
        $DepartmentID
    ) {
        $UpdSql = "UPDATE Employees set FirstName = :FirstName, LastName = :LastName, HireDate = :HireDate, DepartmentID= :DepartmentID where  EmployeeID = : EmployeeID;";
        $updParams = [
            'EmployeeID' => $EmployeeID,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'HireDate' => $HireDate,
            'DepartmentID' => $DepartmentID
        ];

        return self::executeNonQuery($UpdSql, $updParams);
    }
     /**Eliminar */

    public static function deleteEmployees($EmployeeID)
    {
        $DelSql = "DELETE from Employeess where  EmployeeID = : EmployeeID;";
        $delParams = ['EmployeeID' => $EmployeeID];
        return self::executeNonQuery($DelSql, $delParams);
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
