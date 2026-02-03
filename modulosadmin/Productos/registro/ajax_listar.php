<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$tipos = "SELECT
    p.Id,
    p.Producto,
    p.Com_Banco,
    p.Sub_total,
    p.Iva,
    p.Com_local,
    (c.Nombre) AS Categorias,
    p.Estado,
    (c.Id)AS IdCat
FROM
    productos p
INNER JOIN categorias c ON
    p.Categoria = c.Id";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $return_arr[] = array(
        "Id" => $fila['Id'],
        "Producto" => $fila['Producto'],
        "Com_Banco" => $fila['Com_Banco'],
        "Sub_total" => $fila['Sub_total'],
        "Iva" => $fila['Iva'],
        "Com_local" => $fila['Com_local'],
        "Categorias" => $fila['Categorias'],
        "IdCat" => $fila['IdCat'],
        "Estado" => $fila['Estado']
    );
}
if (isset($return_arr)) {
    echo json_encode($return_arr);
} else {
    echo json_encode(["message" => "Sin Datos"]);
}
