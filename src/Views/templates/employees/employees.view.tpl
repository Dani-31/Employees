<section class="container-l WWList">
    <section class="depth-1 px-4 py-4">
        <h2>Lista de Employees</h2>
        <section class="grid">
            <form action="index.php?page=Employees-Employees" method="post" class="row">
                <input class="col-8" type="text" name="search" placeholder="Buscar por LastName" value="{{search}}">
                <button class="col-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Buscar</button>
            </form>
        </section>
    </section>
    <table class="my-4">
        <thead>
            <tr>
                <th> EmployeeID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>HireDate</th>
                <th>DepartmentID</th>
                <th><a href="index.php?page=Employees-Employee&mode=INS">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        &nbsp; Nuevo Employee</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach Employees}}

            <tr style="text-align: center;">
                <td>{{EmployeeID}}</td>
                <td >{{FirstName}}</td>
                <td >{{LastName}}</td>
                <td >{{HireDate}}</td>
                <td >{{DepartmentID}}</td>
       

                <td class="center">
                    <a href="index.php?page=Employees-Employee&mode=DSP&EmployeeID={{EmployeeID}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Visualizar
                    </a>
                    &nbsp;
                    &nbsp;
                    <a href="index.php?page=Employees-Employee&mode=UPD&EmployeeID={{EmployeeID}}">
                        <i class="fa-solid fa-pen"></i> &nbsp; Editar
                    </a>
                    &nbsp;
                    &nbsp;
                    <a href="index.php?page=Employees-Employee&mode=DEL&EmployeeID={{EmployeeID}}">
                        <i class="fa-solid fa-trash-can"></i> &nbsp;
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor Employees}}

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total de registros: {{total}}</td>
            </tr>
        </tfoot>
    </table>
</section>