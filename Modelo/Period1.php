<?php
/**
 * Description of Period1
 *
 * @author Mayki C. Mechan
 */
class Period1{

    private $idusuario;
    private $nombres;
    private $nick;
    private $pass;
    private $habilitado;     
    private $listar;         
    private $eliminar;
    private $ad;
    private $freg;               
    private $objPdo;

    public function __construct( $nombres='',$nick ='',$pass='',$habilitado='',$listar='',$eliminar='',$ad='' ) {        
        $this->nombres = $nombres;  
        $this->nick = $nick;
        $this->pass = $pass;
        $this->habilitado = $habilitado;
        $this->listar = $listar;
        $this->eliminar = $eliminar;
        $this->ad = $ad;              
        //*Creamos la instancia del objeto. Ya estamos conectados*/
        //$objPdo=new conexion();
        $this->conex();
    }
    
    function __clone() {        
    }
    function __destruct(){       	
    }     
    private function conex() {

       $this->objPdo = new PDO('mysql:host=localhost;dbname=bdd_sibupa;charset=utf8mb4',
                                'root',
                                '',
               //usuario:municaletasr_admin
                    //pass:ubW9IYFh@m 
                    //bdd:municaletasr_munisanta
                                array(PDO::ATTR_EMULATE_PREPARES => false,
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function guardar() {
       

        $stmt = $this->objPdo->prepare('INSERT INTO period1 (nombres,nick,pass,habilitado,listar,eliminar,ad) 
                              VALUES(:nombres,:nick,:pass,:habilitado,:listar,:eliminar,:ad)');

        $rows = $stmt->execute(array('nombres' => $this->nombres,
            'nick' => $this->nick,'pass' => $this->pass,'habilitado' => $this->habilitado,
            'listar' => $this->listar,'eliminar' => $this->eliminar,'ad' => $this->ad                
                )
                                );
    }
    
    public function consultarTODOS() {

        $stmt = $this->objPdo->prepare('SELECT * FROM `period1` '
                . 'order by idusuario DESC');
        $stmt->execute();

        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }
    public function consultarULTIMODIR() {

        $stmt = $this->objPdo->prepare('SELECT * FROM `period1` '
                . 'order by idusuario DESC');
        $stmt->execute();

        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }
    
    public function VERIFICARADMIN($id) {

        $stmt = $this->objPdo->prepare('SELECT ad FROM period1 where idusuario=:id');
        $stmt->execute(array('id' => $id));
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public function BUSCARUSUARIOXID($id) {

        $stmt = $this->objPdo->prepare('SELECT * FROM period1 WHERE id = :id');
        $stmt->execute(array('id' => $id));
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($usuarios as $usuario) {
            $this->setNombres($usuario->titulo);
            $this->setClave($usuario->freg);
            $this->setClave($usuario->freg);
            $this->setClave($usuario->freg);
        }
        
        return $usuarios;
    }
    public function BUSCARIDXNICK($nick) {
        $stmt = $this->objPdo->prepare('SELECT idusuario FROM period1 WHERE nick = :nick');
        $stmt->execute(array('nick' => $nick));
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($usuarios as $usuario) {
            $this->setIdusuario($usuario->idusuario);            
        }
        return $usuarios;
    }
//    public function BUSCARPERMISOACCESO($nick) {//USADO
//        $stmt = $this->objPdo->prepare('SELECT idusuario FROM period1 WHERE nick = :nick AND habilitado=1');
//        $stmt->execute(array('nick' => $nick));
//        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
//        foreach ($usuarios as $usuario) {
//            $this->setIdusuario($usuario->idusuario);            
//        }
//        return $usuarios;
//    }
    public function CONSULTARPERMISOS($id) {
        $stmt = $this->objPdo->prepare('SELECT listar,eliminar,ad FROM period1 WHERE idusuario = :id');
        $stmt->execute(array('id' => $id));
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($usuarios as $usuario) {
            $this->setListar($usuario->listar);         
            $this->setEliminar($usuario->eliminar);           
            $this->setAd($usuario->ad);           
        }
        return $usuarios;
    }
    public function actualizarHABILITADO($i,$v) {        
        $stmt = $this->objPdo->prepare('UPDATE period1 set habilitado=:valor WHERE idusuario=:id');
        $stmt->execute(array('valor'=>$v,'id'=>$i));          
    }
    public function actualizarLISTAR($i,$v) {        
        $stmt = $this->objPdo->prepare('UPDATE period1 set listar=:valor WHERE idusuario=:id');
        $stmt->execute(array('valor'=>$v,'id'=>$i));          
    }
    public function actualizarELIMINAR($i,$v) {        
        $stmt = $this->objPdo->prepare('UPDATE period1 set eliminar=:valor WHERE idusuario=:id');
        $stmt->execute(array('valor'=>$v,'id'=>$i));          
    }
    
    public function CONSULTARSESION($nick, $pass) {
                
        $stmt = $this->objPdo->prepare('SELECT * FROM period1 WHERE nick = :nick AND pass= :pass and habilitado=1');
        $stmt->execute(array('nick' => $nick,'pass' => $pass));
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($usuarios as $usuario) {
            $this->setNombres($usuario->nombres);
            $this->setNick($usuario->nick);
            $this->setPass($usuario->pass);
            $this->setHabilitado($usuario->habilitado);            
            $this->setFreg($usuario->freg);            
        }               
         return $usuarios;
    }

    public function eliminar($id) {
        $stmt = $this->objPdo->prepare('DELETE FROM period1 WHERE idusuario = :id');

        $rows = $stmt->execute(array('id' => $id));

        return $rows;
    }
    
    function getIdusuario() {
        return $this->idusuario;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getNick() {
        return $this->nick;
    }

    function getPass() {
        return $this->pass;
    }

    function getHabilitado() {
        return $this->habilitado;
    }

    function getListar() {
        return $this->listar;
    }

    function getEliminar() {
        return $this->eliminar;
    }

    function getAd() {
        return $this->ad;
    }

    function getFreg() {
        return $this->freg;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setNick($nick) {
        $this->nick = $nick;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setHabilitado($habilitado) {
        $this->habilitado = $habilitado;
    }

    function setListar($listar) {
        $this->listar = $listar;
    }

    function setEliminar($eliminar) {
        $this->eliminar = $eliminar;
    }

    function setAd($ad) {
        $this->ad = $ad;
    }

    function setFreg($freg) {
        $this->freg = $freg;
    }


}

?>
