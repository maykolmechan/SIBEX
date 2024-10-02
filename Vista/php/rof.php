<?php
session_start();
include '../../Modelo/Documento.php';

if (isset($_GET['ido'])) {//eliminar
    $elid=$_GET['ido'];
    $cons1 = new Documento();
    /* elimino en BD*/
    try {
    $cons1->eliminar($elid);
     header('location:../oficios.php?av=3');
    } catch (PDOException $exc) {
        echo 'Error al Insertar: ' . $exc->getMessage();
        header('location:../oficios.php?av=0');
    }
}else{
    
}
if (isset($_POST['num'])) {// registro oficio    
    $num = trim($_POST['num']);
    $tipd = 1;
    $tipx = 'OTRO';
    $ani = 0;
    $nom = trim($_POST['nom']);
    $asu = trim($_POST['asu']);
    $nfo = trim($_POST['nfo']);
    $not = trim($_POST['not']);
    $linkarchivo = rand(9,99).$_FILES["txtLink1"]["name"];
    
    $result =move_uploaded_file($_FILES['txtLink1']['tmp_name'], '../DOCS/OFI/'.$linkarchivo);

    if ($num == NULL or $num === '') {
        header('location:../regoficio.php?av=3');
        exit();
    }
    if ($tipd == NULL or $tipd === '') {
        header('location:../regoficio.php?av=3');
        exit();
    }
    //ON DELETE CASCADE
    try {
    /* Creo un Objeto */
    //echo $num.'/'.$nom.'/'.$asu.'/'.$nfo.'/'.$not ;
    $cons2 = new Documento($num,$tipd,$tipx,$ani,$nom,$asu,$nfo,$not,$linkarchivo);

    /* Guardo en BD*/
    $cons2->guardar();

    header('location:../oficios.php?av=2');

    //echo '<br>registró partida correctamente';
         exit();
    } catch (PDOException $exc) {
        echo 'Error al Insertar: ' . $exc->getMessage();
       header('location:../oficios.php?av=0');
    }
}else{
    
}
/* @var $_POST type */
if (isset($_POST['idof'])) {//actualizar
    $id = trim($_POST['idof']);
    $num = trim($_POST['num1']);
    $tipd = 1;
    $tipx = 'OTRO';
    $ani = 0;
    $nom = trim($_POST['nom1']);
    $asu = trim($_POST['asu1']);
    $nfo = trim($_POST['nfo1']);
    $not = trim($_POST['not1']);
    
    $linkoriginal =$_FILES["txtLink1"]["name"]; 
    $linkiii=rand(9,99).$linkoriginal;  
        

    if ($id == NULL or $id === '' or $num == NULL or $num === '') {
        header('location: ../regoficio.php?av=3');
        exit();
    }
    //ON DELETE CASCADE
    try {
    /* Creo un Objeto */
       
    $cons = new Documento($num,$tipd,$tipx,$ani,$nom,$asu,$nfo,$not,$linkiii);
    if ($linkoriginal === '') {//si no hay archivo seleccionada
                 /* Guardo en BD*/
    $cons->actualizarDocumentoSA($id);
        }else{//si hay archivo
    $result =move_uploaded_file($_FILES['txtLink1']['tmp_name'], '../DOCS/OFI/'.$linkiii);
                  /* Guardo en BD*/
    $cons->actualizarDocumentoCA($id);
        }
    /* Guardo en BD*/    

    header('location: ../oficios.php?av=1');

        echo '<br>registró partida correctamente';
         exit();
    } catch (PDOException $exc) {
        echo 'Error al actualizar: ' . $exc->getMessage();
       header('location: ../oficios.php?av=0');
    }
}else{
    
}

