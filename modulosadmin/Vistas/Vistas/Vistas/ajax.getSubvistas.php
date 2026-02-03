<?php
  include "../../../../backend/classes/class.repositorio.php";

  $repositorio = new Repositorio;
  $data = '';
  print_r($_POST);
  foreach($repositorio->getArrayTablaDB('idVistas,nombreVista',"vistas WHERE vistasIdVistas=".$_POST['vp'],"nombreVista") as $items){
    $data .= "<option value='{$items['idVistas']}' selected>{$items['nombreVista']}</option>";
  }
  echo $data;
?>
