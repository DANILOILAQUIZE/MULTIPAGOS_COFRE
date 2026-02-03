<?php
include "../../../backend/classes/class.repositorio.php";
session_start();
$repositorio = new Repositorio;
$conec = $repositorio->connectDB();
date_default_timezone_set('America/Guayaquil');
$idusuario = $_SESSION['idUsuario'];
$Typeusuario = $_SESSION['type'];
$Fecha = date("Y-m-d");
if ($Typeusuario == '1' || $Typeusuario == '2' || $Typeusuario == '4') {
   $transacciones = "SELECT   
    t.Id,
    t.Numero,
    t.Fecha,
    t.Descripcion,
    p.Producto,
    t.Valor,
    t.A_Cobrar,
    (
        SELECT pla1.Plataforma
        FROM tbl_ingreso_transacciones t1
        LEFT JOIN plataforma_usuario pla1 ON t1.Tipo = pla1.Id
        WHERE t1.Id = t.Id
        LIMIT 1
    ) AS Plataforma,
    (pla.Id)AS IdPlataforma,
    t.Refe_Proveedor,
    t.Recibido,
    g.Usuario,
    t.Estado,
    t.Usuario AS IdUsuario,
    t.Dif_com_bamco
FROM tbl_ingreso_transacciones t
INNER JOIN productos p ON t.Concepto = p.Id
LEFT JOIN plataforma_usuario pla ON t.Tipo = pla.Id
INNER JOIN gen_usuarios g ON t.Usuario = g.Cod_usuario
WHERE t.Fecha = '$Fecha'
ORDER BY t.Id DESC";

    $result = $conec->query($transacciones);
    $grupos = [];
    $return_arr = [];
    $total_acobrar = 0;
    $total_cambio = 0;

    // Agrupar por Numero
    while ($fila = mysqli_fetch_assoc($result)) {
        $grupos[$fila['Numero']][] = $fila;
        $total_acobrar += $fila['A_Cobrar'];
    }

    // Recorremos cada grupo
    foreach ($grupos as $numero => $filas) {
        $filas = array_values($filas);
        $total = count($filas);

        $total_acobrar = 0;
        $recibido = 0;

        foreach ($filas as $i => $f) {
            $total_acobrar += floatval($f['A_Cobrar']);
            if ($i === 0) {
                $recibido = floatval($f['Recibido']);
            }
        }

        $total_cambio = $recibido - $total_acobrar;

        foreach ($filas as $index => $fila) {
            $fila_numero = ($index === 0) ? $numero : '';
            $isLast = ($index === $total - 2); // penúltima fila

            $return_arr[] = array(
                "Id" => $fila['Id'],
                "Numero" => $fila_numero,
                "Fecha" => $fila['Fecha'],
                "Descripcion" => $fila['Descripcion'],
                "Producto" => $fila['Producto'],
                "Valor" => $fila['Valor'],
                "A_Cobrar" => $fila['A_Cobrar'],
                "Plataforma" => $fila['Plataforma'],
                "Refe_Proveedor" => $fila['Refe_Proveedor'],
                "Recibido" => ($index === 0) ? number_format($recibido, 2, '.', '') : '',
                "Usuario" => $fila['Usuario'],
                "Estado" => $fila['Estado'],
                "TotalAcobrar" => ($index === 0) ? number_format($total_acobrar, 2, '.', '') : '',
                "Cambio" => ($index === 0) ? number_format($total_cambio, 2, '.', '') : '',
                "ColorFinal" => $isLast ? '1' : '0',
                "IdUsuario" => $fila['IdUsuario'],
                "IdPlataforma" => $fila['IdPlataforma'],
                "Dif_com_bamco" => $fila['Dif_com_bamco']
            );
        }
    }
    echo json_encode($return_arr ?: ["message" => "Sin Datos"]);
} else if ($Typeusuario == '3') {
    $transacciones = "SELECT   
    t.Id,
    t.Numero,
    t.Fecha,
    t.Descripcion,
    p.Producto,
    t.Valor,
    t.A_Cobrar,
    (
        SELECT pla1.Plataforma
        FROM tbl_ingreso_transacciones t1
        LEFT JOIN plataforma_usuario pla1 ON t1.Tipo = pla1.Id
        WHERE t1.Id = t.Id
        LIMIT 1
    ) AS Plataforma,
    (pla.Id)AS IdPlataforma,
    t.Refe_Proveedor,
    t.Recibido,
    g.Usuario,
    t.Estado,
    t.Usuario AS IdUsuario,
    t.Dif_com_bamco
FROM tbl_ingreso_transacciones t
INNER JOIN productos p ON t.Concepto = p.Id
LEFT JOIN plataforma_usuario pla ON t.Tipo = pla.Id
INNER JOIN gen_usuarios g ON t.Usuario = g.Cod_usuario
WHERE t.Usuario = '$idusuario' AND t.Fecha = '$Fecha'
ORDER BY t.Id DESC";

    $result = $conec->query($transacciones);
    $grupos = [];
    $return_arr = [];
    $total_acobrar = 0;
    $total_cambio = 0;

    // Agrupar por Numero
    while ($fila = mysqli_fetch_assoc($result)) {
        $grupos[$fila['Numero']][] = $fila;
        $total_acobrar += $fila['A_Cobrar'];
    }

    // Recorremos cada grupo
    foreach ($grupos as $numero => $filas) {
        $filas = array_values($filas);
        $total = count($filas);

        $total_acobrar = 0;
        $recibido = 0;

        foreach ($filas as $i => $f) {
            $total_acobrar += floatval($f['A_Cobrar']);
            if ($i === 0) {
                $recibido = floatval($f['Recibido']);
            }
        }

        $total_cambio = $recibido - $total_acobrar;

        foreach ($filas as $index => $fila) {
            $fila_numero = ($index === 0) ? $numero : '';
            $isLast = ($index === $total - 2); // penúltima fila

            $return_arr[] = array(
                "Id" => $fila['Id'],
                "Numero" => $fila_numero,
                "Fecha" => $fila['Fecha'],
                "Descripcion" => $fila['Descripcion'],
                "Producto" => $fila['Producto'],
                "Valor" => $fila['Valor'],
                "A_Cobrar" => $fila['A_Cobrar'],
                "Plataforma" => $fila['Plataforma'],
                "Refe_Proveedor" => $fila['Refe_Proveedor'],
                "Recibido" => ($index === 0) ? number_format($recibido, 2, '.', '') : '',
                "Usuario" => $fila['Usuario'],
                "Estado" => $fila['Estado'],
                "TotalAcobrar" => ($index === 0) ? number_format($total_acobrar, 2, '.', '') : '',
                "Cambio" => ($index === 0) ? number_format($total_cambio, 2, '.', '') : '',
                "ColorFinal" => $isLast ? '1' : '0',
                "IdUsuario" => $fila['IdUsuario'],
                "IdPlataforma" => $fila['IdPlataforma'],
                "Dif_com_bamco" => $fila['Dif_com_bamco']
            );
        }
    }
    echo json_encode($return_arr ?: ["message" => "Sin Datos"]);
}
