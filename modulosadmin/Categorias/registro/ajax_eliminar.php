<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idcategoriaEliminar = $_POST['idcategoriaEliminar'];

$update = "UPDATE categorias SET Estado = '1' WHERE Id = '$idcategoriaEliminar'";
$result=  $conec->query($update);

echo json_encode(["success" => "Categoria Eliminada Exitosamente "]);
