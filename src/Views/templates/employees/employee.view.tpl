<section class="grid">
    <section class="row">
        <h2 class="col-12 col-m-6 offset-m-3 depth-1 p-4">{{modeDsc}}</h2>
    </section>
</section>
<section class="grid">
    <section class="row my-4">
        <form class="col-12 col-m-6 offset-m-3 depth-1" action="index.php?page=Employees-Employee&mode={{mode}}&EmployeeID={{EmployeeID}}"
            method="POST">
            <input type="hidden" name="EmployeeID" value="{{EmployeeID}}">
            <input type="hidden" name="xsrftk" value="{{xsrftk}}">
            <input type="hidden" name="mode" value="{{mode}}">

            <div class="row my-4">
                <label class="col-4" for="rtrt"> EmployeeID:</label>
                <input class="col-8" type="text" name="EmployeeID" id="rtrt" value="{{EmployeeID}}" readonly>
            </div>

            <div class="row my-4">
                <label class="col-4" for="rtFn">FirstName:</label>
                <input class="col-8" type="text" name="FirstName" id="rtFn" value="{{FirstName}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_FirstName}}
                {{foreach error_FirstName}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_FirstName}}
                {{endif error_FirstName}}
                {{endwith errors}}
            </div>
            
            <div class="row my-4">
                <label class="col-4" for="rtLn">LastName:</label>
                <input class="col-8" type="text" name="LastName" id="rtLn" value="{{LastName}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_LastName}}
                {{foreach error_LastName}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_LastName}}
                {{endif error_LastName}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="rtHd">HireDate:</label>
                <input class="col-8" type="number" name="HireDate" id="rtHd" value="{{HireDate}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_HireDate}}
                {{foreach error_HireDate}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_HireDate}}
                {{endif error_HireDate}}
                {{endwith errors}}
            </div>

            <div class="row my-4">
                <label class="col-4" for="rtDi">DepartmentID:</label>
                <input class="col-8" type="number" name="DepartmentID" id="rtDi" value="{{DepartmentID}}" required {{isReadOnly}}>
                {{with errors}}
                {{if error_DepartmentID}}
                {{foreach error_DepartmentID}}
                <div class="col-12 error">{{this}}</div>
                {{endfor error_DepartmentID}}
                {{endif error_DepartmentID}}
                {{endwith errors}}
            </div>



            <div class="row flex-end">
                {{ifnot isDisplay}}
                <button type="submit" class="primary mx-2">
                    <i class="fa-solid fa-check"></i>&nbsp;
                    Guardar
                </button>
                {{endifnot isDisplay}}
                <button type="button" onclick="window.location='index.php?page=Employees-Employees'">
                    <i class="fa-solid fa-xmark"></i>
                    Cancelar
                </button>
            </div>
        </form>
    </section>
</section>