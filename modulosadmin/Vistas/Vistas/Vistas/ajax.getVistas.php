<?php
  include "../../../../backend/classes/class.repositorio.php";

  $repositorio = new Repositorio;
  $conec = $repositorio->connectDB();

  $busqueda = '';
  if(isset($_POST['id'])){
    $busqueda = "WHERE v.idVistas = ".$_POST['id'];
  }

  $sql = "SELECT v.*, (SELECT IF(v.tipoVista=1,'PRINCIPAL','SECUNDARIA')) AS nomTipoVista, (SELECT Titulo FROM vistas_titulos WHERE idVistasTitulos=v.tituloVista) AS Titulo FROM vistas v $busqueda";
  $cons = $conec->query($sql);
  $data = array();
  while($resp = $cons->fetch_assoc()){
    $data[] = $resp;
  }
  echo json_encode($data);
?>
