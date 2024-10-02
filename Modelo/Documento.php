<?php
/**
 *
 * @author Maykol Caicedo Mechan 
 * Incluimos fichero
 */
class Documento{

    private $iddocumento;
    private $ndoc;
    private $tipodoc;
    private $tipoex;
    private $anio;
    private $nombres;
    private $asure;
    private $nfolio;
    private $nota;
    private $linkarchivo;
    private $freg;
    private $objPdo;
    
    public function __construct( $ndoc= '',$tipodoc= '',$tipoex= '',$anio= '', $nombres= '',$asure= '', $nfolio= '', $nota= '', $linkarchivo= '') {
       
        $this->ndoc = $ndoc;
        $this->tipodoc = $tipodoc;
        $this->tipoex = $tipoex;
        $this->anio = $anio;
        $this->nombres = $nombres;
        $this->asure = $asure;
        $this->nfolio = $nfolio;
        $this->nota = $nota;
        $this->linkarchivo = $linkarchivo;     
        
        /*Creamos la instancia del objeto. Ya estamos conectados*/
        $this->conex();
        
    }
    function __clone() {
        
    }
    function __destruct(){ 
      	
    } 
    
    private function conex() {

       $this->objPdo = new PDO('mysql:host=localhost;dbname=bdd_sibex;charset=utf8mb4',
                                'root',
                                '',
             //usuario:municaletasr_admin
                    //pass:ubW9IYFh@m 
                    //bdd:municaletasr_munisanta
                                array(PDO::ATTR_EMULATE_PREPARES => false,
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function guardar() {
        try{
        $stmt = $this->objPdo->prepare('INSERT INTO documento (ndoc, tipodoc, tipoex, anio, nombres, asure, nfolio, nota, linkarchivo) 
                                        VALUES(:ndoc, :tipodoc, :tipoex, :anio, :nombres, :asure, :nfolio, :nota, :linkarchivo)');

        $rows = $stmt->execute(array('ndoc' => $this->ndoc,
                                     'tipodoc' => $this->tipodoc,
                                     'tipoex' => $this->tipoex,
                                     'anio' => $this->anio,
                                     'nombres' => $this->nombres,
                                     'asure' => $this->asure,
                                     'nfolio' => $this->nfolio,
                                     'nota' => $this->nota,
                                     'linkarchivo' => $this->linkarchivo)
                                );
            echo 'despues de la consulta';
        } catch (PDOException $exc) {
            echo 'Error al guardar: ' . $exc->getMessage();
            //header('location:../oficios.php?av=0');
        }
    }

    public function consultar() {
        $stmt = $this->objPdo->prepare('SELECT * FROM tipodocumento t right JOIN documento d on t.idtipo=d.idtipo left join organizacion o on d.idorganizacion=o.idorganizacion ORDER BY iddocumento DESC');
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }
    
    public function consultarOF(){
        $stmt = $this->objPdo->prepare('SELECT * FROM Documento where tipodoc=1 ORDER BY iddocumento DESC');
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }
    
    public function consultarRE(){
        $stmt = $this->objPdo->prepare('SELECT * FROM Documento where tipodoc=2 ORDER BY iddocumento DESC');
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }
    
    public function consultarEX(){
        $stmt = $this->objPdo->prepare('SELECT * FROM Documento where tipodoc=3 ORDER BY iddocumento DESC');
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }
        
    public function consultarALL(){
        $stmt = $this->objPdo->prepare('SELECT * FROM documento');
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }
    
    public function obtenerPorId($id) {
        $stmt = $this->objPdo->prepare('SELECT * FROM documento WHERE iddocumento = :id');
        $stmt->execute(array('id' => $id));
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return ($usuarios);
    }    
        
    public function actualizarDocumentoCA($i) {
        //echo '<br> LE i ='.$i;ndoc, tipodoc, tipoex, anio, nombres, asure, nfolio, nota, linkarchivo
       $stmt = $this->objPdo->prepare('UPDATE documento set ndoc=:ndoc, tipodoc=:tipodoc, tipoex=:tipoex, anio=:anio, nombres=:nombres, asure=:asure, nfolio=:nfolio, nota=:nota, linkarchivo=:linkarchivo WHERE iddocumento=:iddocumento');
       $stmt->execute(array('iddocumento' => $i,
                            'ndoc' => $this->ndoc,
                            'tipodoc' => $this->tipodoc,
                            'tipoex' => $this->tipoex,
                            'anio' => $this->anio,
                            'nombres' => $this->nombres,
                            'asure' => $this->asure,
                            'nfolio' => $this->nfolio,
                            'nota' => $this->nota,
                            'linkarchivo' => $this->linkarchivo
                            ));
       // echo 'antes de salir de actualizar cargo';
    }
    
    public function actualizarDocumentoSA($i) {
        //echo '<br> LE i ='.$i;
        $stmt = $this->objPdo->prepare('UPDATE documento set ndoc=:ndoc, tipodoc=:tipodoc, tipoex=:tipoex, anio=:anio, nombres=:nombres, asure=:asure, nfolio=:nfolio, nota=:nota WHERE iddocumento=:iddocumento');
        $stmt->execute(array('iddocumento' => $i,
                            'ndoc' => $this->ndoc,
                            'tipodoc' => $this->tipodoc,
                            'tipoex' => $this->tipoex,
                            'anio' => $this->anio,
                            'nombres' => $this->nombres,
                            'asure' => $this->asure,
                            'nfolio' => $this->nfolio,
                            'nota' => $this->nota));
       // echo 'antes de salir de actualizar cargo';
    }
    
    public function eliminar($id) {
        $stmt = $this->objPdo->prepare('DELETE FROM documento WHERE iddocumento = :id');
        $rows = $stmt->execute(array('id' => $id));
        return $rows;
    }
    
    
    function getIddocumento() {
        return $this->iddocumento;
    }

    function getApellidos() {
        return $this->tipodoc;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getDni() {
        return $this->asure;
    }

    function getFnac() {
        return $this->nfolio;
    }

    function getNota() {
        return $this->nota;
    }

    function getLinkarchivo() {
        return $this->linkarchivo;
    }

    function getFreg() {
        return $this->freg;
    }

    function setIddocumento($iddocumento) {
        $this->iddocumento = $iddocumento;
    }

    function setApellidos($apellidos) {
        $this->tipodoc = $apellidos;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setDni($dni) {
        $this->asure = $dni;
    }

    function setFnac($fnac) {
        $this->nfolio = $fnac;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }

    function setLinkarchivo($linkarchivo) {
        $this->linkarchivo = $linkarchivo;
    }

    function setFreg($freg) {
        $this->freg = $freg;
    }

    
}

?>