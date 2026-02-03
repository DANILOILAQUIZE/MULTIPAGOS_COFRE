<?php
  include "../../../../backend/classes/class.repositorio.php";

  $repositorio = new Repositorio;
  $conec = $repositorio->connectDB();

  if($_POST['tipoVista'] == '1'){
    $_POST['pathVista'] = '#';
  }
  if($_POST['idVista'] == '0'){
    $sql = "INSERT INTO vistas VALUES ({$_POST['idVista']},'{$_POST['nomVista']}','{$_POST['pathVista']}','{$_POST['descripcionVista']}',{$_POST['tipoVista']},'{$_POST['iconoVista']}',{$_POST['vistaPrincipal']},1,0,{$_POST['titulo']});";
  }else{
    $sql = "UPDATE vistas SET nombreVista='{$_POST['nomVista']}', pathVista='{$_POST['pathVista']}', descripcionVista='{$_POST['descripcionVista']}', tipoVista={$_POST['tipoVista']}, vistasIdVistas={$_POST['vistaPrincipal']}, iconoVista='{$_POST['iconoVista']}', tituloVista={$_POST['titulo']} WHERE idVistas=".$_POST['idVista'];
  }
  if(!$conec->query($sql)){
    echo $conec->error;
  }
?>
