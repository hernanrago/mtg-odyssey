<?php
require('funciones.php');
require('clases/abm-usuarios.class.php');
require('clases/GSUsuario.class.php');

if($_POST)
{
    if ($_POST['alta']) {
        $nombre = trim($_POST['nombre_usuario']);
        $email = trim($_POST['mail_usuario']);
        $descripcion = trim($_POST['descripcion_usuario']);
        $password = trim($_POST['password_usuario']);

        $todo_ok = true;

        if (strlen($nombre) == 0) {
            $mal_nombre = true;
            $todo_ok = false;
        }
        if (strlen($email) == 0) {
            $mal_email = true;
            $todo_ok = false;
        }
        if (strlen($descripcion) == 0) {
            $mal_descripcion = true;
            $todo_ok = false;
        }
        if (strlen($password) == 0) {
            $mal_password = true;
            $todo_ok = false;
        }
        if ($todo_ok == true) {
            $gsusuario = new GSUsuario();
            $gsusuario->setNombre($nombre);
            $gsusuario->setMail($email);
            $gsusuario->setDescripcion($descripcion);
            $gsusuario->setPassword($password);

            $abmusuario = new ABMUsuario();
            $insertarOK = $abmusuario->insertarUsuario($gsusuario);
        }

    }
}
else
{
	$nombre="";
	$email="";
	$descripcion="";
	$password="";
}

$abmusuario=new ABMUsuario;

$result = $abmusuario->getAllUsuario();

if (!isset($deleteOK)) $deleteOK = 0;
if (!isset($insertarOK)) $insertarOK = 0;
if (!isset($updateOK)) $updateOK = 0;
if (!isset($mal_nombre)) $mal_nombre = 0;
if (!isset($mal_email)) $mal_email = 0;
if (!isset($mal_descripcion)) $mal_descripcion = 0;
if (!isset($mal_password)) $mal_password = 0;
if (!isset($todo_ok)) $todo_ok = 0;

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Formulario de Usuarios</title>
<link rel="stylesheet" href="css/styles.css" >
<link rel="stylesheet" href="css/bootstrap.min.css"  crossorigin="anonymous">
<script src="js/bootstrap.min.js"  crossorigin="anonymous"></script>
</head>
    <body>
	<script type="text/javascript">
		var insertarOK = <?php echo $insertarOK; ?>;
		
		if(insertarOK==true)
		{
			alert("Usuario ingresado correctamente.");
			window.location.href = 'abm-usuarios.php';

		}
		
		var deleteOK = <?php echo $_GET['deleteOK']; ?>;

		if(deleteOK==true)
		{
			alert("Usuario borrado correctamente.");
			window.location.href = 'abm-usuarios.php';
		}
	
	</script>
        <form action="" method="post" id="altaForm">
	        <table border="1" >
                    <thead>
                            <tr>
                            <th colspan="2">Formulario de Usuarios</th>
                            </tr>
                    </thead>

                    <tr>
                        <th>Nombre:</th>
                        <th><input type="text" id="nombre_usuario" name="nombre_usuario" maxlength="250" tabindex="1" value="<?php echo $nombre; ?>"/></th>
                    </tr>
                    <?php 
                    	if($mal_nombre==true)
                    	{
                    ?>	
                    <tr>
	                    <th><div class="alert alert-danger">
						  <strong>¡ATENCION!</strong> Este campo tiene que estar completo.
						</div></th>	
						<th></th>
					</tr>	
					<?php
                    	}
                    ?>
                    <tr>
                        <th>E-mail:</th><th><input type="email" id="mail_usuario" name="mail_usuario" maxlength="100" tabindex="2" value="<?php echo $email; ?>"></th>
                    </tr>
                    <?php 
                    	if($mal_email==true)
                    	{
                    ?>	
                    <tr>
	                    <th><div class="alert alert-danger">
						  <strong>¡ATENCION!</strong> Este campo tiene que estar completo.
						</div></th>	
						<th></th>
					</tr>	
					<?php
                    	}
                    ?>
                    <tr>
                        <th>Descripción:</th><th><input type="text" id="descripcion_usuario" name="descripcion_usuario" maxlength="100" tabindex="3" value="<?php echo $descripcion; ?>"></th>
                    <tr>
                    	<?php 
                    	if($mal_descripcion==true)
                    	{
                    ?>	
                    <tr>
	                    <th><div class="alert alert-danger">
						  <strong>¡ATENCION!</strong> Este campo tiene que estar completo.
						</div></th>	
						<th></th>
					</tr>	
					<?php
                    	}
                    ?>
                	<tr>
                        <th>Password:</th><th><input type="password" id="password_usuario" name="password_usuario" maxlength="100"
                        	tabindex="3" value="<?php echo $password; ?>"></th>
                    <tr>
                    	<?php 
                    	if($mal_password==true)
                    	{
                    ?>	
                    <tr>
	                    <th><div class="alert alert-danger">
						  <strong>¡ATENCION!</strong> Este campo tiene que estar completo.
						</div></th>	
						<th></th>
					</tr>	
					<?php
                    	}
                    ?>
                            <th colspan="2">
                            	<input type="submit" value="Alta" name="alta" id="alta"/>
                            	<input type="reset" value="Limpiar la cola" name="limpiar" id="limpiar"/>
                            </th>
                    </tr>
                    
            </table>
            <p id="mensaje"></p>
            <table border="1" >
				<thead>
					<tr>
		     			<th>Id</th>
		     			<th>Nombre</th>
		     			<th>E-mail</th>
		     			<th>Descripción</th>
		     			<th>Password</th>
		     			<th>Editar</th>
		     			<th>Borrar</th>
		  			</tr>
				</thead>
				
				<?php 
					
					while ($fila = mysqli_fetch_array($result))
					{
				?>
					<tr>
						<td id="id_usuario"><?php echo $fila['id_usuario']; ?></td>
						<td><?php echo $fila['nombre_usuario']; ?></td>
						<td><?php echo $fila['mail_usuario']; ?></td>
						<td><?php echo $fila['descripcion_usuario']; ?></td>
						<td><?php echo $fila['password_usuario']; ?></td>
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