<?php 

class GSStock
{

  	private $id_stock;
    private $id_usuario_carga;
    private $id_card;
    private $fecha_alta;
    private $precio_compra;
    private $precio_venta;
    private $fecha_venta;
    private $id_usuario_venta;
    private $id_cliente;
    private $estado_carta;
    private $estado_venta;
    
    public function getId_stock(){
        return $this->id_stock;
    }

    public function setId_stock($id_stock){
        $this->id_stock = $id_stock;
    }

    public function getId_usuario_carga(){
        return $this->id_usuario_carga;
    }

    public function setId_usuario_carga($id_usuario_carga){
        $this->id_usuario_carga = $id_usuario_carga;
    }

    public function getId_card(){
        return $this->id_card;
    }

    public function setId_card($id_card){
        $this->id_card = $id_card;
    }

    public function getFecha_alta(){
        return $this->fecha_alta;
    }

    public function setFecha_alta($fecha_alta){
        $this->fecha_alta = $fecha_alta;
    }

    public function getPrecio_compra(){
        return $this->precio_compra;
    }

    public function setPrecio_compra($precio_compra){
        $this->precio_compra = $precio_compra;
    }

    public function getPrecio_venta(){
        return $this->precio_venta;
    }

    public function setPrecio_venta($precio_venta){
        $this->precio_venta = $precio_venta;
    }

    public function getFecha_venta(){
        return $this->fecha_venta;
    }

    public function setFecha_venta($fecha_venta){
        $this->fecha_venta = $fecha_venta;
    }

    public function getId_usuario_venta(){
        return $this->id_usuario_venta;
    }

    public function setId_usuario_venta($id_usuario_venta){
        $this->id_usuario_venta = $id_usuario_venta;
    }

    public function getId_cliente(){
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente){
        $this->id_cliente = $id_cliente;
    }

    public function getEstado_carta(){
        return $this->estado_carta;
    }

    public function setEstado_carta($estado_carta){
        $this->estado_carta = $estado_carta;
    }

    public function getEstado_venta(){
        return $this->estado_venta;
    }

    public function setEstado_venta($estado_venta){
        $this->estado_venta = $estado_venta;
    }
    
}