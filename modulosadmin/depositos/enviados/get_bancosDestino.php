<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$idPlataforma = $_POST['idPlataforma'];


if (is_array($idPlataforma)) {
    $Platforma_str = implode(',', $idPlataforma);
} else {
    $Platforma_str = $idPlataforma;
}

$sql_nombre = "SELECT
    Nombre_plataforma
FROM
    plataforma_usuario
WHERE
    Id = '$Platforma_str' ";
$result_nombre = $conec->query($sql_nombre);
while ($row = $result_nombre->fetch_assoc()) {
    $Nombre = $row['Nombre_plataforma'];
}


// Consulta: trae los bancos según la plataforma seleccionada
$query = "SELECT
    b.Id,
    b.Nombre
FROM
    tipo_banco b
INNER JOIN plataforma_usuario p ON
    p.Banco = b.Id
WHERE
    p.Nombre_plataforma = '$Nombre' AND p.Banco != 0";

$result = $conec->query($query);

if ($result->num_rows > 0) {
    echo '<option value="0">Seleccione un banco</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['Id'] . '">' . $row['Nombre'] . '</option>';
    }
} else {
    echo '<option value="N">No hay bancos disponibles</option>';
}
