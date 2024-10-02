<?php
session_start();
$user = trim($_POST['user']);
$pass =trim($_POST['pass']);

include '../Modelo/Period1.php';

$bdd= new Period1();
    $abb=$bdd->CONSULTARSESION(quoted_printable_decode($user),quoted_printable_decode($pass));
       
    $usuarios = $abb;
    
if (count($usuarios)==1) {       
           foreach ($usuarios as $usuario) {
           
               $_SESSION['usuarioo'] = $user;
              
             header('location:../Vista/inicio.php');
                    
               exit();   
              
           }
          echo '<br>acaba el for'; 
 }else{
     echo 'entra al else'; 
    header('location:../Vista/logueo.php?error=1');    
 }
 
 ?>
