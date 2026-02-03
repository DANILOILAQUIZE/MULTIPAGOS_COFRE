<?php
  include "../../../../backend/classes/class.repositorio.php";

  $repositorio = new Repositorio;
  $conec = $repositorio->connectDB();

  $busqueda = '';
  if(isset($_POST['id'])){
    $busqueda = "WHERE idVistasTitulos = ".$_POST['id'];
  }

  $sql = "SELECT * FROM vistas_titulos $busqueda";
  $cons = $conec->query($sql);
  $data = array();
  while($resp = $cons->fetch_assoc()){
    $data[] = $resp;
  }
  echo json_encode($data);
?>
