<?php



class ABMStock {

  public function insertarCarta(GSStock $gss){
  
  	$id_usuario_carga=$gss->getId_usuario_carga();
  	$id_card=$gss->getId_Card();
  	$precio_compra=$gss->getPrecio_compra();
  	$estado_carta=$gss->getEstado_carta();
  	$estado_venta=$gss->getEstado_venta();

    $query = "INSERT INTO `stock_actual`(`id_usuario_carga`, `id_card`, `precio_compra`, `estado_carta`, `estado_venta`) VALUES ('$id_usuario_carga','$id_card','$precio_compra','$estado_carta','$estado_venta')";

    $connection = conectar();
     
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      $insertarOK = true;
      mysqli_close($connection);
      return $insertarOK;
    }
  }
    
    	
  public function deleteCarta($id)
  {
    $deleteOK = false;
    $connection = conectar();   
    $query = "DELETE FROM cards_scg WHERE id = '$id'";
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      $deleteOK = true;
      mysqli_close($connection);
      return $deleteOK;
    }    
  }
	
  public function updateCarta(GSStock $gss, $id)
  {
    $updateOK = false;
    $connection = conectar();
    $nombre=$gss->getNombre();
    $edicion=$gss->getEdicion();
    $url=$gss->getUrl();
    $precio=$gss->getPrecio();

    $query = "UPDATE cards_scg SET "
    . "card_name = '$nombre', "
    . "card_edition = '$edicion', "
    . "card_url  = '$url' "
    . "WHERE id = '$id'";

    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      $updateOK = true;
      mysqli_close($connection);
      return $updateOK;
    }
  }

  public function getAllCartas()
  {
    $connection = conectar();
    $query = "SELECT * FROM `stock_actual`";
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      mysqli_close($connection);
      return $result;
    }
  }

  public function getCartaById($id)
  {
    $connection = conectar();
    $query = "SELECT * FROM cards_scg WHERE id = '$id'";
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      mysqli_close($connection);
      return $result;
    }
  }

  public function getCartaByNombre($nombre)
  {
    $connection = conectar();
    $query = "SELECT * FROM cards_scg WHERE LOWER (card_name) like '%". strtolower($nombre)."%'";
    $result = mysqli_query($connection,$query);

    if (!$result)
    {
      $error = "Error: (" . mysqli_errno($connection) . ") " . mysqli_error($connection).")";
      mysqli_close($connection);
      exit();
    }
    else
    {
      mysqli_close($connection);
      return $result;
    }
  }
}
