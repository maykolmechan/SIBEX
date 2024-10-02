<?php
/**
 *
 * @author Maykol Caicedo Mechan
 */

session_start();

unset ($SESSION['usuarioo']);

session_destroy();
header('location:./logueo.php?error=2');
    exit();

?>
