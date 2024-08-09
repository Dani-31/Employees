<h1>Lista de DatosVehiculos</h1>
<a href='index.php?action=new'>Nuevo</a>
<table>
<tr><th>id_vehiculo</th><th>marca</th><th>modelo</th><th>año_fabricacion</th><th>tipo_combustible</th><th>kilometraje</th><th>Acciones</th></tr>
<?php foreach ($rows as $row): ?>
<tr><td><?php echo $row['id_vehiculo']; ?></td><td><?php echo $row['marca']; ?></td><td><?php echo $row['modelo']; ?></td><td><?php echo $row['año_fabricacion']; ?></td><td><?php echo $row['tipo_combustible']; ?></td><td><?php echo $row['kilometraje']; ?></td><td><a href='index.php?action=edit&id=<?php echo $row['id_vehiculo']; ?>'>Editar</a> | <a href='index.php?action=delete&id=<?php echo $row['id_vehiculo']; ?>'>Eliminar</a></td></tr>
<?php endforeach; ?>
</table>
