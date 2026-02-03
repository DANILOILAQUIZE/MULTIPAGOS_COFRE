<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$Hora = date("H:i:s");
$idusuario = $_SESSION['idUsuario'];
$fechaApertura = $_POST['fechaApertura'];
$b_20 = $_POST['b_20'];
$b_10 = $_POST['b_10'];
$b_5 = $_POST['b_5'];
$b_2 = $_POST['b_2'];
$b_1 = $_POST['b_1'];
$m_1 = $_POST['m_1'];
$m_050 = $_POST['m_050'];
$m_025 = $_POST['m_025'];
$m_010 = $_POST['m_010'];
$m_005 = $_POST['m_005'];
$m_001 = $_POST['m_001'];
$idtextosucursal = $_POST['idtextosucursal'];
$sl_caja = $_POST['sl_caja'];


if (is_array($sl_caja)) {
    $slcajas_str = implode(',', $sl_caja);
} else {
    $slcajas_str = $sl_caja;
}


$Buscar = "SELECT * FROM conteo_monedas WHERE IdUsuario = '$idusuario' AND IdSucursal = '$idtextosucursal' AND IdCaja = '$slcajas_str' AND Fecha = '$fechaApertura' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra registrado el conteo para esta fecha " . $fechaApertura  ]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO conteo_monedas(IdUsuario,IdSucursal,IdCaja,Fecha,Hora,B_100,B_50,B_20,B_10,B_5,B_2,B_1,M_1,M_050,M_025,M_010,M_005,M_001,Registro,Estado_caja)VALUES
('$idusuario','$idtextosucursal','$slcajas_str','$fechaApertura','$Hora','0','0','$b_20','$b_10','$b_5','$b_2','$b_1','$m_1','$m_050','$m_025','$m_010','$m_005','$m_001','Normal','0')";
    $result_insertar = $conec->query($sql_insertar);
    echo json_encode(["success" => "El conteo se registro exitosamente"]);
}
