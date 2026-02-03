<?php
  include "../../../../backend/classes/class.repositorio.php";

  $repositorio = new Repositorio;
  $conec = $repositorio->connectDB();

  $condicion = '';
  if($_POST['perfil'] != '0'){
    $condicion = 'WHERE vp.idPerfil = '.$_POST['perfil'];
  }
  $sql = "SELECT vp.idPerfil,t.Tipo,v.nombreVista,(SELECT IF(v.tipoVista=2,(SELECT nombreVista FROM vistas WHERE idVistas=v.vistasIdVistas),NULL)) AS Principal,vp.idAsignacionVistasPerfil,v.tipoVista FROM asignacion_vistas_perfil vp INNER JOIN tipo_usuario t ON vp.idPerfil=t.Id INNER JOIN vistas v ON vp.idVistas=v.idVistas $condicion";
  $cons = $conec->query($sql);
  $data = array();
  while($resp = $cons->fetch_assoc()){
    if($resp['Principal'] == ''){
      $resp['Principal'] = $resp['nombreVista'];
      $resp['nombreVista'] = '';
    }
    $data[] = $resp;
  }
  echo json_encode($data);
?>
