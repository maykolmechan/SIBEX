<?php
/**
 * @author Maykol Caicedo Mechan
 */

session_start();
// Manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', '/path/to/error.log');

if (!isset($_SESSION['usuarioo']) || $_SESSION['usuarioo'] === '') {
    header('location:./inicio.php');
    exit();
}

$avizo = isset($_GET['av']) ? htmlspecialchars($_GET['av']) : '';

function mostrar_avizo($codigo) {
    $avisos = [
        '0' => '<div class="alert alert-danger" role="alert">Ocurrió un error al ejecutar la operación.</div>',
        '1' => '<div class="alert alert-success" role="alert">EXPEDIENTE ACTUALIZADO CORRECTAMENTE.</div>',
        '2' => '<div class="alert alert-success" role="alert">EXPEDIENTE NUEVO REGISTRADO CORRECTAMENTE.</div>',
        '3' => '<div class="alert alert-success" role="alert">EXPEDIENTE ELIMINADO CORRECTAMENTE.</div>',
    ];
    
    return $avisos[$codigo] ?? '';
}

$avizo = mostrar_avizo($avizo);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="description" content="SIBEX">
    <title> Expedientes </title>
    <link rel="shortcut icon" type="image/png" href="../SIBEX.png">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>
<body class="theme-blush">

<div class="overlay"></div>

<?php include 'menuizq.php'; ?>
<?php include 'iconosder.php'; ?>
<?php include 'menuder.php'; ?>

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Expedientes</h2>
                    <br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php"><i class="zmdi zmdi-home"></i> SIBEX</a></li>
                        <li class="breadcrumb-item">Listado</li>
                        <li class="breadcrumb-item active">Expedientes</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <?php echo $avizo; ?>
                <div class="col-lg-5 col-md-6 col-sm-12">       
                    <a href="regexpediente.php"><button class="btn btn-success float-right" type="button">Nuevo Expediente</button></a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">                            
                        <ul class="header-dropdown">                            
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>                                        
                                    <tr>                                            
                                        <th>NÚMERO</th>
                                        <th>SOLICITANTE</th>
                                        <th>TIPO DE SOLICITUD</th>
                                        <th>ASUNTO</th>
                                        <th>N° DE FOLIOS</th>
                                        <th>NOTAS</th>
                                        <th>ARCHIVO / FECHA REG.</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>                            
                                        <th>NÚMERO</th>
                                        <th>SOLICITANTE</th>
                                        <th>TIPO DE SOLICITUD</th>
                                        <th>ASUNTO</th>
                                        <th>N° DE FOLIOS</th>
                                        <th>NOTAS</th>
                                        <th>ARCHIVO / FECHA REG.</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                require '../Modelo/Documento.php';            
                                $bdd = new Documento();
                                $regs = $bdd->consultarEX();                
                                
                                if (!empty($regs)) {
                                    foreach ($regs as $cons) {
                                        echo '<tr>';
                                        echo '<td><a class="single-user-name">' . htmlspecialchars($cons->ndoc) . '</a><br></td>';
                                        echo '<td>' . htmlspecialchars($cons->nombres) . '</td>';
                                        echo '<td><strong>' . htmlspecialchars($cons->tipoex) . '</strong></td>'; 
                                        echo '<td><a class="single-user-name">' . htmlspecialchars($cons->asure) . '</a><br></td>';                                         
                                        echo '<td><a class="single-user-name">' . htmlspecialchars($cons->nfolio) . '</a><br></td>';                                         
                                        echo '<td><p><small><a class="single-user-name">' . htmlspecialchars($cons->nota) . '</a></small></p></td>';                                         
                                        echo '<td><strong><a class="single-user-name" href="' . htmlspecialchars($cons->arch) . '" target="_blank">' . htmlspecialchars($cons->arch) . '</a></strong> <br>' . htmlspecialchars($cons->freg) . '';                                         
                                        echo '<a target="_blank" href="DOCS/OFI/' . htmlspecialchars($cons->linkarchivo) . '"><img width="60" height="60" src="pdf-documento.png" alt="CLICK PARA ABRIR ARCHIVO" /></a></td>';
                                        echo '<td><a href="updexpediente.php?ndoc=' . htmlspecialchars($cons->ndoc) . '" class="btn btn-info"><i class="zmdi zmdi-edit"></i></a>
                                                    <a href="eliexpediente.php?ndoc=' . htmlspecialchars($cons->ndoc) . '" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></a></td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="9">No se encontraron registros</td></tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</section>
</body>
</html>
