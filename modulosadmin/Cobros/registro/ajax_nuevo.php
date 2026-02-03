<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$Fecha = date("Y-m-d");
$Hora = date("H:i:s");
$IdUsua =  $_SESSION['idUsuario'];

$VRecibido = $_POST['VRecibido'];
$arraytreceta_tbl_ventas = $_POST['arraytreceta_tbl_ventas'];


$sql_ultimo = "SELECT Numero FROM tbl_ingreso_transacciones WHERE Id = (SELECT MAX(Id)  FROM tbl_ingreso_transacciones)AND Fecha = '$Fecha' AND Usuario = '$IdUsua'";
$result_ultimo = $conec->query($sql_ultimo);
$ultimo = 1;
if ($fila = $result_ultimo->fetch_assoc()) {
    if (!empty($fila['Numero'])) {
        $ultimo = $fila['Numero'] + 1;
    }
}
$automatico = str_pad($ultimo, 4, '0', STR_PAD_LEFT);

foreach ($arraytreceta_tbl_ventas as $key => $v) {
    $descripcion = $v['input-descripcion'];
    $valor = $v['input-valor'];
    $acobrar = $v['input-cobrar'];
    $concepto = is_array($v['slproducto_select']) ? implode(',', $v['slproducto_select']) : $v['slproducto_select'];
    $sql = "INSERT INTO tbl_ingreso_transacciones(
        Numero, Fecha, Hora, Descripcion, Concepto, Valor, A_Cobrar, Tipo, Refe_Proveedor, Recibido, Usuario, Estado
    ) VALUES (
        '$automatico', '$Fecha', '$Hora', '$descripcion', '$concepto', '$valor', '$acobrar', '0', '', '$VRecibido', '$IdUsua', '0'
    );";
    $result_insertar = $conec->query($sql);
    
}
echo json_encode(["success" => "Transaccion Insertada Exitosamente"]);
