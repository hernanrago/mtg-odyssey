<?php 
require('funciones.php');
require('clases/abm-cartas.class.php');
require('clases/GSCarta.class.php');

$abmcarta=new ABMCarta;
$result =$abmcarta->getAllCartas();

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Listado de Cartas</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Edición</th>
				<th>URL</th>
				<th>Precio</th>
			</tr>
		</thead>
		<tbody>
		<?php
		
			while ($fila = mysqli_fetch_array($result))
			{
		?>
			<tr>
				<td id="id"><?php echo $fila['id']; ?></td>
				<td><?php echo $fila['card_name']; ?></td>
				<td><?php echo $fila['card_edition']; ?></td>
				<td><?php echo $fila['card_url']; ?></td>
				<td><?php echo $fila['card_price']; ?></td>
				<td align="center">
					<a href="formulario-edicion-cartas.php?id=<?php echo $fila['id'];?>">
						<input type="button" value="Editar" />
					</a>
				</td>
				<td align="center">
					<a href="baja-cartas.php?id=<?php echo $fila['id'];?>">
						<input type="button" value="Borrar"/>
					</a>
				</td>
			</tr>
		<?php } ?>			
		</tbody>

	</table>

</body>
</html>