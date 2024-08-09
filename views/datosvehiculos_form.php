<h1>Formulario de DatosVehiculos</h1>
<form method='post' action='index.php?action=save'>
<input type='hidden' name='id_vehiculo' value='<?php echo $row ? $row['id_vehiculo'] : ''; ?>'>
<label for='marca'>Marca:</label>
<input type='text' name='marca' value='<?php echo $row ? $row['marca'] : ''; ?>'><br>
<label for='modelo'>Modelo:</label>
<input type='text' name='modelo' value='<?php echo $row ? $row['modelo'] : ''; ?>'><br>
<label for='año_fabricacion'>Año_fabricacion:</label>
<input type='number' name='año_fabricacion' value='<?php echo $row ? $row['año_fabricacion'] : ''; ?>'><br>
<label for='tipo_combustible'>Tipo_combustible:</label>
<input type='text' name='tipo_combustible' value='<?php echo $row ? $row['tipo_combustible'] : ''; ?>'><br>
<label for='kilometraje'>Kilometraje:</label>
<input type='number' name='kilometraje' value='<?php echo $row ? $row['kilometraje'] : ''; ?>'><br>
<button type='submit'>Guardar</button>
</form>
