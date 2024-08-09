
  use ecommerce;

    CREATE TABLE Employees (
     EmployeeID INT PRIMARY KEY AUTO_INCREMENT, 
     FirstName VARCHAR(50), 
     LastName VARCHAR(50), 
     HireDate DATE,
     DepartmentID INT 
);


INSERT INTO Employees (FirstName, LastName, HireDate, DepartmentID) 
VALUES ('Mario', 'Rodriguez', '2024-08-08', 1);

INSERT INTO Employees (FirstName, LastName, HireDate, DepartmentID) 
VALUES ('Jane', 'Mendoza', '2024-07-15', 2);

INSERT INTO Employees (FirstName, LastName, HireDate, DepartmentID) 
VALUES ('Alicia', 'Ruiz', '2023-12-01', 3);

INSERT INTO Employees (FirstName, LastName, HireDate, DepartmentID) 
VALUES ('Joel', 'Moncada', '2024-01-20', 1);
