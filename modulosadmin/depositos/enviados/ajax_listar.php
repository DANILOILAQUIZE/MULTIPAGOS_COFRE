<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idusuario = $_SESSION['idUsuario'];
$Typeusuario = $_SESSION['type'];
if ($Typeusuario == '1' || $Typeusuario == '2' || $Typeusuario == '4') {
    $sql_listar = "SELECT
    d.Id,
    d.Numero,
    d.Valor,
    p1.Nombre_plataforma,
    (p1.Id)AS IdPlataforma,
    p2.Nombre_plataforma AS PlataformaDestino,
    t.Nombre,
    (t.Id)AS IdBanco,
    d.N_caja,
    g.Usuario,
    (d.IdUsuario)AS IdUsuario,
    d.Estado,
    (p2.Id)AS IdPlataforma2,
    (t1.Nombre)AS BancoDestino,
    (t1.Id)AS IdBancoDestino,
    (d.Comprobante)AS Comprobante
FROM transferencia_enviado d
INNER JOIN plataforma_usuario p1 ON d.N_Cuenta = p1.Id         -- origen
INNER JOIN plataforma_usuario p2 ON d.Cuenta_destino = p2.Id   -- destino (otro campo)
INNER JOIN tipo_banco t ON d.Banco = t.Id
INNER JOIN tipo_banco t1 ON d.Banco_destino = t1.Id
INNER JOIN gen_usuarios g ON d.IdUsuario = g.Cod_usuario;";
    $resul =  $conec->query($sql_listar);
    while ($fila = mysqli_fetch_array($resul)) {
        $return_arr[] = array(
            "Id" => $fila['Id'],
            "Numero" => $fila['Numero'],
            "Valor" => $fila['Valor'],
            "Nombre_plataforma" => $fila['Nombre_plataforma'],
            "Nombre" => $fila['Nombre'],
            "N_caja" => $fila['N_caja'],
            "Usuario" => $fila['Usuario'],
            "IdUsuario" => $fila['IdUsuario'],
            "Estado" => $fila['Estado'],
            "IdPlataforma" => $fila['IdPlataforma'],
            "IdBanco" => $fila['IdBanco'],
            "PlataformaDestino" => $fila['PlataformaDestino'],
            "IdPlataforma2" => $fila['IdPlataforma2'],
            "BancoDestino"=>$fila['BancoDestino'],
            "IdBancoDestino"=>$fila['IdBancoDestino'],
            "Comprobante"=> $fila['Comprobante']
        );
    }
    if (isset($return_arr)) {
        echo json_encode($return_arr);
    } else {
        echo json_encode(["message" => "Sin Datos"]);
    }
} else if ($Typeusuario == '3') {
    $sql_listar = "SELECT
    d.Id,
    d.Numero,
    d.Valor,
    p1.Nombre_plataforma,
    (p1.Id)AS IdPlataforma,
    p2.Nombre_plataforma AS PlataformaDestino,
    t.Nombre,
    (t.Id)AS IdBanco,
    d.N_caja,
    g.Usuario,
    (d.IdUsuario)AS IdUsuario,
    d.Estado,
    (p2.Id)AS IdPlataforma2,
    (t1.Nombre)AS BancoDestino,
    (t1.Id)AS IdBancoDestino,
    (d.Comprobante)AS Comprobante
FROM transferencia_enviado d
INNER JOIN plataforma_usuario p1 ON d.N_Cuenta = p1.Id         -- origen
INNER JOIN plataforma_usuario p2 ON d.Cuenta_destino = p2.Id   -- destino (otro campo)
INNER JOIN tipo_banco t ON d.Banco = t.Id
INNER JOIN tipo_banco t1 ON d.Banco_destino = t1.Id
INNER JOIN gen_usuarios g ON d.IdUsuario = g.Cod_usuario
WHERE d.IdUsuario = '$idusuario' ";
    $resul =  $conec->query($sql_listar);
    while ($fila = mysqli_fetch_array($resul)) {
        $return_arr[] = array(
          "Id" => $fila['Id'],
            "Numero" => $fila['Numero'],
            "Valor" => $fila['Valor'],
            "Nombre_plataforma" => $fila['Nombre_plataforma'],
            "Nombre" => $fila['Nombre'],
            "N_caja" => $fila['N_caja'],
            "Usuario" => $fila['Usuario'],
            "IdUsuario" => $fila['IdUsuario'],
            "Estado" => $fila['Estado'],
            "IdPlataforma" => $fila['IdPlataforma'],
            "IdBanco" => $fila['IdBanco'],
            "PlataformaDestino" => $fila['PlataformaDestino'],
            "IdPlataforma2" => $fila['IdPlataforma2'],
            "BancoDestino"=>$fila['BancoDestino'],
            "IdBancoDestino"=>$fila['IdBancoDestino'],
             "Comprobante"=> $fila['Comprobante']
        );
    }
    if (isset($return_arr)) {
        echo json_encode($return_arr);
    } else {
        echo json_encode(["message" => "Sin Datos"]);
    }
}
