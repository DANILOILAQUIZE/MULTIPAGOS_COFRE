<?php
  include "../../../../backend/classes/class.repositorio.php";

  $repositorio = new Repositorio;
  $conec = $repositorio->connectDB();

  if($_POST['idModulo'] == '0'){
    $sql = "INSERT INTO vistas_titulos VALUES ({$_POST['idModulo']},'{$_POST['nomModulo']}');";
  }else{
    $sql = "UPDATE vistas_titulos SET Titulo='{$_POST['nomModulo']}' WHERE idVistasTitulos=".$_POST['idModulo'];
  }
  if(!$conec->query($sql)){
    echo $conec->error;
  }
?>
