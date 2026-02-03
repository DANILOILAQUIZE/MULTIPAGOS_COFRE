<?php
include "../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

if (isset($_POST['sucursales'])) {
    $sucursales = $_POST['sucursales']; // array de IDs

    // Sanitizar (por seguridad si no usas PDO)
    $sucursales = array_map('intval', $sucursales);
    $ids = implode(',', $sucursales);


    $sql = "SELECT Id,Nombre FROM cajas WHERE IdSucursal IN ($ids) ";
    $result = $conec->query($sql);

    while ($fila = $result->fetch_assoc()) {
        echo '<option value="' . $fila['Id'] . '">' . $fila['Nombre'] . '</option>';
    }
}
