<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$txtnom = ucfirst(strtolower($_POST['txtnom']));
$txtemail = $_POST['txtemail'];
$txtcontrasena = $_POST['txtcontrasena'];
$md5_pass = md5($txtcontrasena);
$sltusu = $_POST['sltusu'];

$txtapellido = ucwords(strtolower($_POST['txtapellido']));
$txtnombre = ucwords(strtolower($_POST['txtnombre']));
$txtfechaN = $_POST['txtfechaN'];
$txtFechaEntrada = $_POST['txtFechaEntrada'];
$txtSueldo = $_POST['txtSueldo'];
$slotros = $_POST['slotros'];
$txtcuenta = $_POST['txtcuenta'];
$sltipocuenta = $_POST['sltipocuenta'];
$slBanco = $_POST['slBanco'];

if (is_array($slotros)) {
    $slotros_str = implode(',', $slotros);
} else {
    $slotros_str = $slotros;
}

if (is_array($slBanco)) {
    $Banco_str = implode(',', $slBanco);
} else {
    $Banco_str = $slBanco;
}

//Este codigo sirve para buscar el nombre del tipo de usuario
$tipos = "SELECT * FROM tipo_usuario WHERE Id = '$sltusu' ";
$result_Buscar_tipo =  $conec->query($tipos);
while ($fila = mysqli_fetch_array($result_Buscar_tipo)) {
    $Nom_tipo = $fila['Tipo'];
}
//Este codigo sirve para buscar si ya existe el usuario
$Buscar = "SELECT * FROM gen_usuarios WHERE Usuario = '$txtnom' and Tipo_usuario = '$sltusu' ";
$result_Buscar =  $conec->query($Buscar);
if (mysqli_fetch_row($result_Buscar)) {
    echo json_encode(["su" => "Ya se encuentra el usuario " . $txtnom . " registrado como " . $Nom_tipo]);
} else {
    //Sirve para ingresar usuario nuevo
    $sql_insertar = "INSERT INTO gen_usuarios(Emails,Usuario,Password,Tipo_usuario,Estado,Finca)VALUES('$txtemail','$txtnom','$md5_pass','$sltusu','0','0')";
    $result_insertar = $conec->query($sql_insertar);
    $iddet = $conec->insert_id;
    $insertar_Datos = "INSERT INTO datos_usuarios(IdUsuario,Apellido,Nombre,Fecha_Nacimiento,Fecha_Entrada,Sueldo,Otros,cuentanum,Tipo_cuenta,BancoCoac)
    VALUES('$iddet','$txtapellido','$txtnombre','$txtfechaN','$txtFechaEntrada','$txtSueldo','$slotros_str','$txtcuenta','$sltipocuenta','$Banco_str')";
    $result_datos = $conec->query($insertar_Datos);
    echo json_encode(["success" => "Se creo el Usuario " . $txtnom . "Como " . $Nom_tipo]);
}
