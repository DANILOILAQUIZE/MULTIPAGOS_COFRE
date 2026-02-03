<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');

$idusuariosE = $_POST['idusuariosE'];
$txtapellidoE = ucwords(strtolower($_POST['txtapellidoE']));
$txtnombreE = ucwords(strtolower($_POST['txtnombreE']));
$txtfechaNE = $_POST['txtfechaNE'];
$txtFechaEntradaE = $_POST['txtFechaEntradaE'];
$txtSueldoE = $_POST['txtSueldoE'];
$slotrosE = $_POST['slotrosE'];
$txtcuentaE = $_POST['txtcuentaE'];
$sltipocuentaE = $_POST['sltipocuentaE'];
$slBancoE = $_POST['slBancoE'];
$txtnom_E = $_POST['txtnom_E'];
$txtemail_E = $_POST['txtemail_E'];
$sltusu_E = $_POST['sltusu_E'];
$slEstado_E = $_POST['slEstado_E'];

if (is_array($slotrosE)) {
    $slotros_strE = implode(',', $slotrosE);
} else {
    $slotros_strE = $slotrosE;
}

if (is_array($slBancoE)) {
    $Banco_strE = implode(',', $slBancoE);
} else {
    $Banco_strE = $slBancoE;
}

$update = "UPDATE datos_usuarios SET Apellido = '$txtapellidoE',Nombre = '$txtnombreE',Fecha_Nacimiento='$txtfechaNE',Fecha_Entrada='$txtFechaEntradaE',
 Sueldo='$txtSueldoE',Otros = '$slotros_strE',cuentanum = '$txtcuentaE', Tipo_cuenta='$sltipocuentaE', BancoCoac = '$Banco_strE' WHERE IdUsuario = '$idusuariosE'";
$result_datos = $conec->query($update);

$uodate2 = "UPDATE gen_usuarios SET Emails= '$txtemail_E' , Usuario = '$txtnom_E', Tipo_usuario = '$sltusu_E',Estado = '$slEstado_E' WHERE Cod_usuario = '$idusuariosE'";
$result_datos_2 = $conec->query($uodate2);


echo json_encode(["success" => "Se Actualizo  el Usuario " . $txtnombreE]);
