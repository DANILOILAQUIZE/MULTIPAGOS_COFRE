<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

  <?php
  session_start();
  include "backend/classes/class.repositorio.php";
  $repositorio = new Repositorio;
  //$ip = $repositorio->getPermisoConexion($_POST['Usuario']); 
  $ip = 'login';
  if ($ip == "login") {
    $Usuario = $_POST['Usuario'];
    $Password = md5($_POST['Password']);
    $conec = $repositorio->connectDB();
    $sql = "SELECT * FROM gen_usuarios WHERE Usuario='$Usuario' and Estado = '0'";
    $res = $conec->query($sql);
    if ($pass = $res->fetch_assoc()) {
      if ($Password == $pass['Password']) {
        $_SESSION['loggedin'] = true;
        $_SESSION['Usuario'] = $pass['Usuario'];
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5 * 100000);
        $_SESSION['type'] = $pass['Tipo_usuario'];
        $_SESSION['idPerfil'] = $pass['Tipo_usuario'];
        $_SESSION['nivel'] = $pass['Nivel'];
        $_SESSION['finca'] = $pass['Finca'];
        $_SESSION['idUsuario'] = $pass['Cod_usuario'];
        /** */
        // $_SESSION['projectName'] = "multipagoscofre.com/";
        // $_SESSION['pathRaiz'] = "/home/feverzap/";

        //$_SESSION['projectName'] = "grupocofretipanluisa.com/";
       // $_SESSION['pathRaiz'] = "C:/xampp/htdocs/";

       
        //CUANDO YA ESTE EN PRODUCCION
        //$_SESSION['projectName'] = "https://grupocofretipanluisa.com/";
        //$_SESSION['pathRaiz'] = "public_html/Sistema/";

        //CUANDO ESTE EN DESARROLLO
        $_SESSION['projectName'] = "http://localhost/Sistema/";
        $_SESSION['pathRaiz'] = "";
        $vistas = listarVistas($conec, $pass['Tipo_usuario']);
        $_SESSION["paths"] = $vistas;

        /** */
        $rest = explode('_', $_SESSION['Usuario']);

        $href = 'menu.php';

        //print_r($_SESSION);
        echo "<script> 
        Swal.fire({
          icon: 'success',
          title: 'Bienvenido, $Usuario',
          position: 'center',
          showConfirmButton: false
        })
        setTimeout(function (){location.href='$href'},1000); 
      </script>";
      } else {
        echo "<script> 
        Swal.fire({
          icon: 'error',
          title: 'CREDENCIALES INCORRECTAS',
          position: 'center',
          showConfirmButton: false
        })
        setTimeout(function (){location.href='logeo.php'},1000); 
      </script>";
      }
    } else {
      echo "<script> 
        Swal.fire({
          icon: 'warning',
          title: 'USUARIO NO REGISTRADO',
          position: 'center',
          showConfirmButton: false
        })
        setTimeout(function (){location.href='logeo.php'},1000); 
      </script>";
    }
  } else {
    echo $ip . "<script> location.href='index.php'</script>";
  }

  function listarVistas($conec, $idPerfil)
  {
  $sql = "SELECT vi.*, avp.idAsignacionVistasPerfil,avp.idPerfil, vt.Titulo  FROM asignacion_vistas_perfil avp
INNER JOIN vistas vi ON vi.idVistas=avp.idVistas
LEFT JOIN vistas_titulos vt ON vt.idVistasTitulos = vi.tituloVista
WHERE avp.idPerfil='$idPerfil' ORDER BY vi.auxiliarVisualizacion ASC,vi.tituloVista DESC;";
    $res = $conec->query($sql);
    $return_arr = array();
    while ($row = mysqli_fetch_assoc($res)) {
      if (!empty($row['pathVista'])) {
        $path = $row['pathVista'];
        $path = preg_replace('/(modulosadmin\/)+/', 'modulosadmin/', $path);
        if (preg_match('/^(modulosadmin\/[^\/]+)\/menu\.php$/', $path, $matches)) {
          $path = $matches[1] . '/' . basename($matches[1]) . '.php';
        }
        $row['pathVista'] = ltrim($path, '/');
      }
      array_push($return_arr, $row);
    }
    //var_dump($return_arr);
    return ($return_arr);
  }
  /** */
  ?>
</body>

</html>
