<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
     <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
     <a href="inicio.php"><span class="m-l-10">SIBEX</span></a>
    </div>
    <div class="menu">
        <ul class="list">
        <?php 
        if(!isset($_SESSION["usuarioo"])){
            ?>
                <br>
                <br>
                <br>
                <center>                    
                    <img src="MUNISANTAROSAPNG.png" alt="LOGO DE LA MUNICIPALIDAD DISTRITAL DE MONSEFÚ" class="img-fluid" width="500" height="500">
                </center>
            <li><a href="logueo.php"><i class="zmdi zmdi-balance"></i><span>INICIAR SESIÓN</span></a></li>            
        <?php } ?>            
            <?php if(isset($_SESSION['usuarioo'])): ?>
            
            <li>
                <div class="user-info">
                    <a class="image" href="inicio.php"><img src="avatar-sibex.jpg" alt="User"></a>
                    <div class="detail">
                        <h4>ADMIN</h4>
                        <div class="status online"> <i class="zmdi zmdi-circle"></i>  En Línea</div>                        
                    </div>
                </div>
            </li>
            
            <li><a href="oficios.php" ><i class="zmdi zmdi-assignment-account"></i><span>Oficios</span></a>         
            </li>
            <li><a href="resoluciones.php" ><i class="zmdi zmdi-menu"></i><span>Resoluciones</span></a>
            </li>
            <li><a href="expedientes.php" ><i class="zmdi zmdi-assignment-account"></i><span>Expedientes</span></a>               
            </li>
            <li><a href="logout.php"><i class="zmdi zmdi-run"></i><span>SALIR</span></a></li>                        
            <li>
                <div class="progress-container progress-primary m-t-10">
                    <span class="progress-badge">Usted ha iniciado sesión</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 77%;">
                            <span class="progress-value">100%</span>
                        </div>
                    </div>
                </div>
                <div class="progress-container progress-info">
                    <span class="progress-badge">NO OLVIDAR CERRAR SESIÓN</span>
                </div>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>