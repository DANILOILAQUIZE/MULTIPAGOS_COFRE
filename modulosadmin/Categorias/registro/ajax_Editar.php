<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$IdCategoria_E = $_POST['IdCategoria_E'];
$categoria_E = ucwords(strtolower($_POST['categoria_E']));
$slEstado_E = $_POST['slEstado_E'];

$update = "UPDATE categorias SET Nombre = '$categoria_E',Estado='$slEstado_E' WHERE Id = '$IdCategoria_E'   ";
$result_datos = $conec->query($update);
echo json_encode(["success" => "Se Actualizo  la Categoria :" . $categoria_E]);
