<?php 

function conectar()
{

 	$SERVER		= "127.0.0.1";
	$USER 		= "root";
	#$PASS 		= "admin123";
	$PASS 		= "";
	$DATABASE	= "gestionproductos";

	if ($db = mysqli_connect($SERVER, $USER, $PASS, $DATABASE))
	{       		 

	}else{
		echo $errorconecto = "Error: (" . mysqli_errno() . ") " . mysqli_error().")";

	}
		return $db;
		
}

function logueo_in($usuario)
{
	 session_start();

	 $_SESSION['usuario'] = $usuario;
}	


function falta_logueo()
{
 
	session_start();
	if (isset($_SESSION['usuario'])) 	{
		$rta = false;
	}else{
		$rta = true;
	}
	return $rta;
}

function logueo_out()

{
	session_start();
	session_destroy();
	unset($_SESSION['usuario']);
	
}

 ?>