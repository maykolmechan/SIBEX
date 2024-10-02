<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pabellon
 *
 * @author MAYKOL CAICEDO MECHAN
 */
class Pabellon {
   
    private $idpabellon;
    private $idcementerio;
    private $nombre;
    private $ubicacion;
    private $medidas;    
    private $descripcion;    
    private $freg;
           
    private $objPdo;

    public function __construct( $idcementerio=1, $nombre='', $ubicacion='', $medidas='', $descripcion='' ) {
               
        $this->idcementerio = $idcementerio;
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
        $this->medidas = $medidas;
        $this->descripcion = $descripcion;
        /*Creamos la instancia del objeto. Ya estamos conectados
        $objPdo=new conexion();*/
        $this->conex();
        
    }
    
    function __clone() {
        
    }
    function __destruct(){ 
      	
    } 
    
    private function conex() {

       $this->objPdo = new PDO('mysql:host=localhost;dbname=bdd_sianic;charset=utf8mb4',
                                 'root',
                                '',
                                array(PDO::ATTR_EMULATE_PREPARES => false,
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    
    public function guardar() {
        try{
            //echo 'entra';       
            $stmt = $this->objPdo->prepare('INSERT INTO tab_pabellones (idcementerio,nombre, ubicacion, medidas, descripcion) 
                                             VALUES(:idcementerio,:nombre, :ubicacion, :medidas, :descripcion)');
            $rows = $stmt->execute(array('idcementerio' => $this->idcementerio,
                                         'nombre' => $this->nombre,
                                         'ubicacion' => $this->ubicacion,
                                         'medidas' => $this->medidas,
                                         'descripcion' => $this->descripcion));
            //echo 'despues de la consulta';
        } catch (PDOException $exc) {
            echo 'Error al guardar: ' . $exc->getMessage();
            //header('location:../senfexticum.php?av=0');
        }
    }
    
    public function eliminar($idpabellon) {        
        $stmt = $this->objPdo->prepare('DELETE FROM tab_pabellones WHERE idpabellon = :idpabellon');        
        $rows = $stmt->execute(array('idpabellon' => $idpabellon));
        return $rows;
    }
    
    public function ConsultarPabellonxID($idpabellon) {//id
        //$stmt = $this->objPdo->prepare('select o.nombreo as nom from cargo as c inner join encargado as e on c.idencargado=e.idencargado inner join organizacion as o on c.idorganizacion=o.idorganizacion where c.idorganizacion= :id LIMIT 1');
        $stmt = $this->objPdo->prepare('select * from tab_pabellones where idpabellon= :idpabellon LIMIT 1');
        $stmt->execute(array('idpabellon' => $idpabellon));
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return ($usuarios);
    }
    
    public function consultarALL() {

        $stmt = $this->objPdo->prepare('SELECT * FROM tab_pabellones where idcementerio=1 ORDER BY idpabellon ASC ');
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }
    
    public function actualizarPAB($i) {
       // echo '<br> LE i ='.$i;
        $stmt = $this->objPdo->prepare('UPDATE tab_pabellones set nombre=:nombre,ubicacion=:ubicacion,medidas=:medidas,'
                                                            . ' descripcion=:descripcion WHERE idpabellon=:idpabellon');
        $stmt->execute(array('idpabellon' => $i,'nombre' => $this->nombre,'ubicacion'=> $this->ubicacion,'medidas' => $this->medidas,'descripcion' => $this->descripcion));   
      
    }
    
    function getIdpabellon() {
        return $this->idpabellon;
    }

    function getIdcementerio() {
        return $this->idcementerio;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function getMedidas() {
        return $this->medidas;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFreg() {
        return $this->freg;
    }

    function setIdpabellon($idpabellon) {
        $this->idpabellon = $idpabellon;
    }

    function setIdcementerio($idcementerio) {
        $this->idcementerio = $idcementerio;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setMedidas($medidas) {
        $this->medidas = $medidas;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFreg($freg) {
        $this->freg = $freg;
    }
    
}
