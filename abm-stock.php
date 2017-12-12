<?php
//error_reporting(0);
require('funciones.php');
require('clases/abm-usuarios.class.php');
require('clases/abm-cartas.class.php');
require('clases/abm-stock.class.php');
require('clases/GSStock.class.php');

if ($_POST) {
	
	if ($_POST['alta']) {
		$usuario = trim($_POST['select_usuario']);
		$carta = trim($_POST['select_carta']);
		$precio = trim($_POST['precio_compra']);
		$estado_carta = trim($_POST['estado_carta']);
		$estado_venta = trim($_POST['estado_venta']);

		$todo_ok = true;

        if (strlen($usuario) == 0) {
        $mal_usuario = true;
        $todo_ok = false;
        }

        if (strlen($carta) == 0) {
            $mal_carta = true;
            $todo_ok = false;
        }

        if (strlen($precio) == 0) {
            $mal_precio = true;
            $todo_ok = false;
        }

        if(is_numeric($precio) == false) {
			$precio_no_numerico = true;
            $todo_ok = false;
		}

        if (strlen($estado_carta) == 0) {
            $mal_estado_carta = true;
            $todo_ok = false;
        }

        if (strlen($estado_venta) == 0) {
            $mal_estado_venta = true;
            $todo_ok = false;
        }

        if ($todo_ok == true) {
        	$gsstock = new GSStock();
        	$gsstock ->setId_usuario_carga($usuario);
        	$gsstock ->setId_card($carta);
        	$gsstock ->setPrecio_compra($precio);
        	$gsstock ->setEstado_carta($estado_carta);
        	$gsstock ->setEstado_venta($estado_venta);
        	$abmstock = new ABMStock();
			$abmstock->insertarCarta($gsstock);
        	
        }


	}
}

$abmusuario = new ABMUsuario();
$result_usuarios = $abmusuario->getAllUsuario();	
$abmcarta = new ABMCarta();
$result_cartas = $abmcarta->getAllCartas();

if (!isset($mal_usuario)) $deleteOK = 0;
if (!isset($mal_carta)) $mal_carta = 0;
if (!isset($mal_precio)) $mal_precio = 0;
if (!isset($precio_no_numerico)) $precio_no_numerico = 0;
if (!isset($mal_estado_carta)) $mal_estado_carta = 0;
if (!isset($mal_estado_venta)) $mal_estado_venta = 0;

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form action="" method="post">
		<select name="select_usuario" id="select_usuario">
			<?php
				while ($fila_usuario = mysqli_fetch_array($result_usuarios)) {	
		  	?>
			<option value=
				"<?php echo $fila_usuario['id_usuario'] ?>"
				<?php if(trim($fila_usuario['id_usuario'])) echo "selected"; ?>>
					<?php echo $fila_usuario['descripcion_usuario']; ?>
			</option>
		<?php } ?>
		</select>
		<br/>

		<select name="select_carta" id="select_carta">
			<?php
				while ($fila_carta = mysqli_fetch_array($result_cartas)) {
		  	?>
			<option value=
				"<?php echo $fila_carta['id'] ?>"
				<?php if(trim($fila_carta['id'])) echo "selected"; ?>>
					<?php echo $fila_carta['card_name']." | ".$fila_carta['card_edition']; ?>
			</option>
		<?php } ?>
		</select>
		<br/>

		Precio de compra: <input type="text" name="precio_compra" id="precio_compra"/>
		<br/>

		<?php 
        	if($precio_no_numerico==true)
        	{
        ?>	
            <div class="alert alert-danger">
			  <strong>¡ATENCION!</strong> El precio debe ser numérico.
			</div>
			<?php } ?>
		<select name="estado_carta" id="estado_carta">
			<option value="nm">NM</option>
			<option value="pl">PL</option>
			<option value="hp">HP</option>
			<option value="dm">DM</option>
		</select>
		<br/>

		<select name="estado_venta" id="estado_venta">
			<option value="disponible">Disponible</option>
			<option value="reservada">Reservada</option>
			<option value="vendida">Vendida</option>
		</select>
		<br/>

		<input type="submit" value="Ingresar" id="alta" name="alta" />
	</form>

	<form>
		<table border="1" >
				<thead>
					<tr>
		     			<th>Id Stock</th>
		     			<th>Usuario de carga</th>
		     			<th>Carta</th>
		     			<th>Fecha de alta</th>
		     			<th>Precio de compra</th>
		     			<th>Precio de venta</th>
		     			<th>Fecha de venta</th>
		     			<th>Usuario de venta</th>
		     			<th>Cliente</th>
		     			<th>Estado de la carta</th>
		     			<th>Estado de la venta</th>
		  			</tr>
				</thead>
				
				<?php 
					$abmstock=new ABMStock();
					$result=$abmstock->getAllCartas();
					while ($fila = mysqli_fetch_array($result))
					{
				?>
					<tr>
						<td id="id_stock"><?php echo $fila['id_stock']; ?></td>
						<td id="id_usuario_carga"><?php echo $fila['id_usuario_carga']; ?></td>
						<td id="id_card"><?php echo $fila['id_card']; ?></td>
						<td id="fecha_alta"><?php echo $fila['fecha_alta']; ?></td>
						<td id="precio_compra"><?php echo $fila['precio_compra']; ?></td>
						<td id="precio_venta"><?php echo $fila['precio_venta']; ?></td>
						<td id="fecha_venta"><?php echo $fila['fecha_venta']; ?></td>
						<td id="id_usuario_venta"><?php echo $fila['id_usuario_venta']; ?></td>
						<td id="id_cliente"><?php echo $fila['id_cliente']; ?></td>
						<td id="estado_carta"><?php echo $fila['estado_carta']; ?></td>
						<td id="estado_venta"><?php echo $fila['estado_venta']; ?></td>
						<td align="center">
							<a href="formulario-edicion-usuarios.php?id_usuario=<?php echo $fila['id_usuario'];?>&acc=modificacion">
								<input type="button" value="Editar" />
							</a>
						</td>
						<td align="center">
							<a href="baja-usuario.php?id_usuario=<?php echo $fila['id_usuario'];?>"> 
								<input type="button" value="Borrar"/>
							</a>
						</td>
					</tr>
				<?php 
					}
				?>
			</table>
	</form>
</body>
</html>
