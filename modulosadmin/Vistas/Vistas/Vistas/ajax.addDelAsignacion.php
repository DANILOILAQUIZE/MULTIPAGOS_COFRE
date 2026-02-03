<?php
  include "../../../../backend/classes/class.repositorio.php";

  $repositorio = new Repositorio;
  $conec = $repositorio->connectDB();

  if($_POST['idAsignacion'] == '0'){
    array_push($_POST['subvistas'],$_POST['vista'],1);
    $id = implode(',',$_POST['subvistas']);
    $sql = "SELECT idVistas FROM asignacion_vistas_perfil WHERE idPerfil={$_POST['perfil']} AND idVistas IN ($id)";
    $cons = $conec->query($sql);
    $info = array();
    while($resp = $cons->fetch_assoc()){
      $info[] = $resp;
    }
    for($i=0;$i<count($_POST['subvistas']);$i++){
      $x = 0;
      foreach($info as $items){
        if($_POST['subvistas'][$i] == $items['idVistas']){
          $x = 1;
        }
      }
      if($x == 0){
        $conec->query("INSERT INTO asignacion_vistas_perfil VALUES ({$_POST['idAsignacion']},{$_POST['perfil']},{$_POST['subvistas'][$i]});");
      }
    }
  }else{
    $conec->query("DELETE FROM asignacion_vistas_perfil WHERE idAsignacionVistasPerfil=".$_POST['idAsignacion']);
  }
?>
