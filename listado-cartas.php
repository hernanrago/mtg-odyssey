<?php 
require('funciones.php');
require('clases/abm-cartas.class.php');
require('clases/GSCarta.class.php');

//Primer pasada
$TAMANO_PAGINA	= 50;
$pagina = $_GET['pagina'];

if (!$pagina)
{

		$cantidad = cantidad_registros('cards_scg');

		$_SESSION['canti'] = $cantidad;
		$inicio = 0;
		$pagina = 1;

} else{
	$cantidad = $_SESSION['canti'];
	$inicio = ($pagina-1) * $TAMANO_PAGINA;
}
		
$total_paginas = ceil($cantidad/$TAMANO_PAGINA);
					 
if ($cantidad > 0)
{ 
	$sqlb = "select * from cards_scg order by id ASC LIMIT $TAMANO_PAGINA OFFSET $inicio";
	#echo $sqlb; // exit();
	$dbb  = conectar();	 
	$rb = mysqli_query($dbb, $sqlb);
	
	if($rb == false)
	{
		mysqli_close($dbb);
		$error = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";
	}
		mysqli_close($dbb);						
}


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
		
			while ($fila = mysqli_fetch_array($rb))
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


<div align="center"><?php 
if(($pagina - 1) > 0)
{
	echo " <a href='listado-cartas.php?pagina=".($pagina-1)."'>Anterior</a>"; 
}

for ($i=1;$i<=$total_paginas;$i++)
{
	if($pagina == $i)
	{
		echo "<b> ".$pagina."</b>";
	}else{
		echo " <a href=listado-cartas.php?pagina=$i>$i</a>";
	}
}

if(($pagina + 1) <= $total_paginas)
{
	echo " <a href='listado-cartas.php?pagina=".($pagina+1)."'>Siguiente</a>";
}
?></div>
</body>
</html>