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
    CASE WHEN d.Valor = 0 THEN '' ELSE d.Valor
END AS Valor,
CASE WHEN d.Descripcion = '' OR d.Descripcion = '0' THEN '' ELSE d.Descripcion
END AS Descripcion,
CASE WHEN p1.Nombre_plataforma = '' OR p1.Nombre_plataforma = '0' THEN '' ELSE p1.Nombre_plataforma
END AS Nombre_plataforma,
p1.Id AS IdPlataforma,
CASE WHEN d.N_Comprobante = '' OR d.N_Comprobante = '0' THEN '' ELSE d.N_Comprobante
END AS N_Comprobante,
CASE WHEN g.Usuario = '' OR g.Usuario = '0' THEN '' ELSE g.Usuario
END AS Usuario,
d.IdUsuario,
d.Estado,
CASE WHEN ga.Nombre = '' OR ga.Nombre = '0' THEN '' ELSE ga.Nombre
END AS Gasto,
ga.Id AS IdGasto,
d.Tipo_Ingreso AS Tipo
FROM
    transferencia_recibidas d
LEFT JOIN plataforma_usuario p1 ON
    d.N_Cuenta = p1.Id
LEFT JOIN gen_usuarios g ON
    d.IdUsuario = g.Cod_usuario
LEFT JOIN concepto_gasto ga ON
    d.Concepto_Gasto = ga.Id";
    $resul =  $conec->query($sql_listar);
    while ($fila = mysqli_fetch_array($resul)) {
        $return_arr[] = array(
            "Id" => $fila['Id'],
            "Valor" => $fila['Valor'],
            "Descripcion" => $fila['Descripcion'],
            "Nombre_plataforma" => $fila['Nombre_plataforma'],
            "N_Comprobante" => $fila['N_Comprobante'],
            "Usuario" => $fila['Usuario'],
            "IdUsuario" => $fila['IdUsuario'],
            "Estado" => $fila['Estado'],
            "IdPlataforma" => $fila['IdPlataforma'],
            "Gasto" => $fila['Gasto'],
            "IdGasto" => $fila['IdGasto'],
            "Tipo" => $fila['Tipo']
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
    CASE WHEN d.Valor = 0 THEN '' ELSE d.Valor
END AS Valor,
CASE WHEN d.Descripcion = '' OR d.Descripcion = '0' THEN '' ELSE d.Descripcion
END AS Descripcion,
CASE WHEN p1.Nombre_plataforma = '' OR p1.Nombre_plataforma = '0' THEN '' ELSE p1.Nombre_plataforma
END AS Nombre_plataforma,
p1.Id AS IdPlataforma,
CASE WHEN d.N_Comprobante = '' OR d.N_Comprobante = '0' THEN '' ELSE d.N_Comprobante
END AS N_Comprobante,
CASE WHEN g.Usuario = '' OR g.Usuario = '0' THEN '' ELSE g.Usuario
END AS Usuario,
d.IdUsuario,
d.Estado,
CASE WHEN ga.Nombre = '' OR ga.Nombre = '0' THEN '' ELSE ga.Nombre
END AS Gasto,
ga.Id AS IdGasto,
d.Tipo_Ingreso AS Tipo
FROM
    transferencia_recibidas d
LEFT JOIN plataforma_usuario p1 ON
    d.N_Cuenta = p1.Id
LEFT JOIN gen_usuarios g ON
    d.IdUsuario = g.Cod_usuario
LEFT JOIN concepto_gasto ga ON
    d.Concepto_Gasto = ga.Id
WHERE d.IdUsuario = '$idusuario' ";
    $resul =  $conec->query($sql_listar);
    while ($fila = mysqli_fetch_array($resul)) {
        $return_arr[] = array(
            "Id" => $fila['Id'],
            "Valor" => $fila['Valor'],
            "Descripcion" => $fila['Descripcion'],
            "Nombre_plataforma" => $fila['Nombre_plataforma'],
            "N_Comprobante" => $fila['N_Comprobante'],
            "Usuario" => $fila['Usuario'],
            "IdUsuario" => $fila['IdUsuario'],
            "Estado" => $fila['Estado'],
            "IdPlataforma" => $fila['IdPlataforma'],
            "Gasto" => $fila['Gasto'],
            "IdGasto" => $fila['IdGasto'],
            "Tipo" => $fila['Tipo']
        );
    }
    if (isset($return_arr)) {
        echo json_encode($return_arr);
    } else {
        echo json_encode(["message" => "Sin Datos"]);
    }
}
