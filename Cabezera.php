<?php error_reporting(0);  ?>

<input type="hidden" id="idUsuarioRegistra" value="<?php echo $_SESSION['idUsuario']; ?>">
<input type="hidden" id="usuarioRegistra" value="<?php echo $_SESSION['Usuario']; ?>">
<input type="hidden" id="idPerfil" value="<?php echo $_SESSION['idPerfil']; ?>">
<input type="hidden" id="idFincaSession" value="<?php echo $_SESSION['finca']; ?>">

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation-wobble" src="/<?php echo $projectName ?>img/multipagos.jpg" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
    <li class="nav-item" title="Logout">
      <a class="nav-link" href="loginoff.php" role="button">
          <i class="fas fa-chevron-circle-left" aria-hidden="true"></i>
        </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo-->
  <a href="#" class="brand-link">
    <div style="display: flex; justify-content: center; align-items: center;">
      <img src="/<?php echo $projectName ?>img/multipagos.jpg"
        alt="AdminLTE Logo"
        style="width: 80px; height: 80px; object-fit: cover;">
    </div>

  </a>
  <!-- Sidebar -->
  <div class="sidebar">

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <br><br>
          <a href="/menu.php" class="nav-link" id="menuDashboard">
            <i class="nav-icon fas fa-tachometer-alt"></i>

            <p>
              MENU OPCIONES
            </p>
          </a>
        </li>
        <?php
        $i_titulos = 0;
        $titulos = array();
        for ($i_titulos = 0; $i_titulos < count($paths); $i_titulos++) {
          if ($paths[$i_titulos]["tituloVista"] != 0 && $paths[$i_titulos]["tituloVista"] != null) {
            if (!in_array($paths[$i_titulos]["tituloVista"], $titulos)) {
              array_push($titulos, $paths[$i_titulos]["tituloVista"]);
            }
          }
        }
        $auxTitulos = ($titulos);
        //var_dump($titulos);
        $i_vistas = 0;
        $auxiliarTitulos = 0;
        //echo json_encode($paths);
        for ($k = 0; $k < count($auxTitulos); $k++) {
          for ($i_vistas = 0; $i_vistas < count($paths); $i_vistas++) {
            if ($paths[$i_vistas]["tituloVista"] === $auxTitulos[$k]) {
              if ($auxiliarTitulos == 0) {
        ?>
                <li class="nav-header"><?php echo strtoupper($paths[$i_vistas]["Titulo"]); ?></li>
              <?php
                $auxiliarTitulos = 1;
              }
              if ($paths[$i_vistas]["tipoVista"] === "1") {
                $menuOpen = '';
                $activeMenu = '';
                if ($paths[$i_vistas]["idVistas"] == $tituloActual) {
                  $menuOpen = 'menu-open';
                  $activeMenu = 'active';
                }
              ?>
                <li class="nav-item <?php echo $menuOpen; ?>">
                  <a href="#" class="nav-link <?php echo $activeMenu; ?>">
                    <i class="nav-icon <?php echo $paths[$i_vistas]["iconoVista"] ?>"></i>
                    <p>
                      <?php echo $paths[$i_vistas]["nombreVista"] ?>
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <?php
                    $j_vistas = 0;
                    for ($j_vistas = 0; $j_vistas < count($paths); $j_vistas++) {
                      if (($paths[$j_vistas]["tipoVista"] === "2") && ($paths[$j_vistas]["vistasIdVistas"] === $paths[$i_vistas]["idVistas"])) {
                        $active = '';
                        if ($paths[$j_vistas]["pathVista"] == $pathActual) {
                          $active = 'active';
                        }
                    ?>
                        <li class="nav-item">
                          <a href="<?php 
                            $path = $paths[$j_vistas]["pathVista"];
                            // Eliminar todos los duplicados de modulosadmin
                            $path = preg_replace('/(modulosadmin\/)+/', 'modulosadmin/', $path);
                            // Corregir rutas que terminan en menu.php
                            if (preg_match('/^(modulosadmin\/[^\/]+)\/menu\.php$/', $path, $matches)) {
                              $path = $matches[1] . '/' . basename($matches[1]) . '.php';
                            }
                            // Asegurar ruta absoluta para no depender del directorio actual
                            $path = '/' . ltrim($path, '/');
                            echo $path;
                          ?>" class="nav-link <?php echo $active; ?>">
                            <i class="<?php echo $paths[$j_vistas]["iconoVista"] ?> nav-icon" aria-hidden="true"></i>
                            <p><?php echo $paths[$j_vistas]["nombreVista"]; ?></p>
                          </a>
                        </li>
                    <?php
                      }
                    }
                    ?>
                  </ul>
                </li>
              <?php
              }
              ?>
        <?php
            }
            if ($i_vistas === (count($paths) - 1)) {
              $auxiliarTitulos = 0;
            }
          }
        }
        ?>
      </ul>
    </nav>
  </div>
  <!-- /.sidebar -->
</aside>
<script></script>
