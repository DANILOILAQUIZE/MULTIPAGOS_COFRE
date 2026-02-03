<?php
class Repositorio
{

    public function connectDB()
    {
        //Establece la conexion con la Base de Datos
        $conec = new mysqli('localhost', 'root', '', 'multipagos_cof');
        $conec->set_charset("utf8mb4");
        if ($conec->connect_error) {
            return null; // O puedes retornar false o lanzar una excepción
        }

        return $conec;
    }

    public function getArrayTablavendedores($campos, $tabla, $orden)
    {
        /**
         * DEVUELVE UN ARRAY CON LA CONSULTA REALIZADA A LA BASE DE DATOS
         * INPUT <- campos => campos a consultar
         *          tabla => nombre tabla de la base de datos
         *          orden => campo para ordenamiento de la consulta
         * RETURN -> array
         */
        $conec = self::connectDB();
        $sql = "SELECT $campos FROM $tabla ORDER BY $orden";
        $cons = $conec->query($sql);
        $arrayRes = array();
        while ($resp = $cons->fetch_assoc()) {
            $arrayRes[] = $resp;
        }
        return $arrayRes;
    }


    public function getArrayTablatipoOrden($campos, $tabla, $orden)
    {
        /**
         * DEVUELVE UN ARRAY CON LA CONSULTA REALIZADA A LA BASE DE DATOS
         * INPUT <- campos => campos a consultar
         *          tabla => nombre tabla de la base de datos
         *          orden => campo para ordenamiento de la consulta
         * RETURN -> array
         */
        $conec = self::connectDB();
        $sql = "SELECT $campos FROM $tabla ORDER BY $orden";
        $cons = $conec->query($sql);
        $arrayRes = array();
        while ($resp = $cons->fetch_assoc()) {
            $arrayRes[] = $resp;
        }
        return $arrayRes;
    }


    public function getArrayTablaCliente($campos, $tabla, $orden)
    {
        /**
         * DEVUELVE UN ARRAY CON LA CONSULTA REALIZADA A LA BASE DE DATOS
         * INPUT <- campos => campos a consultar
         *          tabla => nombre tabla de la base de datos
         *          orden => campo para ordenamiento de la consulta
         * RETURN -> array
         */
        $conec = self::connectDB();
        $sql = "SELECT $campos FROM $tabla ORDER BY $orden";
        $cons = $conec->query($sql);
        $arrayRes = array();
        while ($resp = $cons->fetch_assoc()) {
            $arrayRes[] = $resp;
        }
        return $arrayRes;
    }


    public function getArrayTablacanal($campos, $tabla, $orden)
    {
        /**
         * DEVUELVE UN ARRAY CON LA CONSULTA REALIZADA A LA BASE DE DATOS
         * INPUT <- campos => campos a consultar
         *          tabla => nombre tabla de la base de datos
         *          orden => campo para ordenamiento de la consulta
         * RETURN -> array
         */
        $conec = self::connectDB();
        $sql = "SELECT $campos FROM $tabla ORDER BY $orden";
        $cons = $conec->query($sql);
        $arrayRes = array();
        while ($resp = $cons->fetch_assoc()) {
            $arrayRes[] = $resp;
        }
        return $arrayRes;
    }


    public function getSelectDB($busqueda, $tabla, $js = "", $name = "", $isSelected = "", $isRequired = false)
    {
        //Busca el 'id' y la informacion solicitada de una tabla de la base de datos y devuelve un select
        //isSelected - se utiliza para un select que se vaya a modificar 
        if ($name == "") {
            $name = $busqueda;
        }
        if ($isRequired == false) {
            $required = '';
            $option = "<option value=0>-</option>";
        } else {
            $required = 'required';
            $option = "<option></option>";
        }
        $sql = "SELECT $busqueda,Id FROM $tabla ORDER BY $busqueda ASC";
        $html = "<select id = '$name' name = '$name' OnChange=\"$js\" class='date' style='width:100%' $required>$option";
        $conec = self::connectDB();
        $resultado = $conec->query($sql);
        echo $conec->error;
        while ($res = $resultado->fetch_assoc()) {
            if ($isSelected != "" && $isSelected == $res['Id']) {
                $selected = 'selected';
            } else {
                $selected = "";
            }
            $html .= "<option value='" . $res['Id'] . "' $selected>" . $res["$busqueda"] . "</option>";
        }
        return $html .= "</select>";
    }

    public function getArrayTablaDB($campos, $tabla, $orden)
    {
        $conec = self::connectDB();
        $sql = "SELECT $campos FROM $tabla ORDER BY $orden";
        $cons = $conec->query($sql);
        $arrayRes = array();
        while ($resp = $cons->fetch_assoc()) {
            $arrayRes[] = $resp;
        }
        return $arrayRes;
    }

    public function getArraySemanas2($anio, $all = false)
    {
        /**
         * DEVUELVE UN ARRAY CON LAS SEMANAS DEL AÑO
         * INPUT <- anio => año del que se va obtener las semanas
         * RETURN -> array
         */
        date_default_timezone_set('America/Guayaquil');
        if ($anio == date('Y')) {
            $anio = 0;
        }
        $year2 = substr($anio, -2);
        $year4 = $anio;
        if ($anio == 0) {
            $year4 = date('Y');
            $year2 = date('y');
        }
        $fUltSema = "$year4-12-28";
        $semanaMax = date('W', strtotime($fUltSema));
        $semanaAct = $anio == 0 ? date('W') : $semanaMax;
        if ($semanaAct != $semanaMax && $all === false) {
            $semanaMax = $semanaAct;
        }
        $arraySemanas = array();
        for ($i = 1; $i <= $semanaMax; $i++) {
            if ($i < 10) {
                $cont = '0' . $i;
            } else {
                $cont = $i;
            }
            array_push($arraySemanas, $year2 . $cont);
        }
        return $arraySemanas;
    }

    public function getSemanasProyeccion($actual = false)
    {
        date_default_timezone_set('America/Guayaquil');
        $dias = $actual ? 0 : 7;
        $fecha = date('Y-m-d', strtotime("+$dias day"));
        $i = 0;
        $arraySemanas = array();
        while ($i < 53) {
            $item = explode('-', $fecha);
            $semana = date('W', strtotime($fecha));
            $anio = $item[0];
            if ($semana >= intval('52') && $item[1] == '01') {
                $anio = intval($item[0]) - 1;
            } else if ($semana == '01' && $item[1] == '12') {
                $anio = intval($item[0]) + 1;
            }
            $arraySemanas[] = substr($anio, -2) . $semana;
            $fecha = date('Y-m-d', strtotime("$fecha -7 days"));
            $i++;
        }
        return $arraySemanas;
    }

    public function getArraySemanas()
    {
        // Devuelve un array con las semanas del año en curso
        date_default_timezone_set('America/Guayaquil');
        $fUltSema = date('Y') . '-12-28';
        $semanaMax = date('W', strtotime($fUltSema));
        $semanaAct = date('W');
        if ($semanaAct != $semanaMax) {
            $semanaMax = $semanaAct + 1;
        }
        $arraySemanas = array();
        for ($i = 1; $i <= $semanaMax; $i++) {
            if ($i < 10) {
                $cont = '0' . $i;
            } else {
                $cont = $i;
            }
            array_push($arraySemanas, date('y') . $cont);
        }
        return $arraySemanas;
    }

    public function getArrayAnios()
    { // ANTES getSelectAnio
        /**
         * DEVUELVE UN ARRAY CON LOS ULTIMOS 4 AÑOS
         * RETURN -> array
         */
        date_default_timezone_set('America/Guayaquil');
        $anio = date('Y');
        $arrayAnios = array();
        for ($i = $anio; $i > ($anio - 4); $i--) {
            $arrayAnios[] = $i;
        }
        return $arrayAnios;
    }

    public function getSelectAnio($js = "", $dae = false)
    {
        //Devuelve un Select con los ultimos 5 años 
        date_default_timezone_set('America/Guayaquil');
        $anio = date('Y'); //2020
        if ($dae == false) {
            $ano = date('y'); //20
        } else {
            $ano = $anio;
        }
        $html = 'Año: 
      <select id = "anio" name = "anio" class="form-control input-sm"  OnChange="' . $js . '">
        <option value = 0>-</option>';
        for ($i = 0; $i < 5; $i++) {
            $html .= "<option value ='" . $ano . "'>" . $anio . "</option>";
            $ano -= 1;
            $anio -= 1;
        }
        return $html .= "</select>";
    }

    public function getElementosColumna($columna, $tabla, $condicion = "")
    {
        //Devuelve un array con los elementos diferentes de una columna de una tabla 
        $i = 0;
        $elementos = [];
        $conec = self::connectDB();
        $sql = "SELECT DISTINCT($columna) FROM $tabla $condicion ORDER BY $columna ASC;";
        if ($result = $conec->query($sql)) {
            while ($resp = $result->fetch_assoc()) {
                $elementos[$i] = $resp["$columna"];
                $i++;
            }
            return $elementos;
        } else {
            echo $conec->error . " Query=$sql";
        }
    }

    public function getRegistroSumaDB($columna, $tabla, $condicion = "")
    {
        //Devuelve un Registro/Suma especifico de una tabla
        $conec = self::connectDB();
        $sql = "SELECT $columna FROM $tabla $condicion LIMIT 1;";
        if ($result = $conec->query($sql)) {
            $res = $result->fetch_assoc();
            return $result->num_rows > 0 ? $res[$columna] : '';
        } else {
            echo $conec->error . " Query=$sql";
        }
    }

    public function deleteRegistroDB($tabla, $columnaId, $id)
    {
        //Elimina un Registro especifico de una tabla a traves del Id
        $conec = self::connectDB();
        $sql = "DELETE FROM $tabla WHERE $columnaId = '$id';";
        if (!$conec->query($sql)) {
            echo $conec->error . " Query=$sql";
        }
    }

    public function getPermisoConexion($usuario)
    {
        //Verifica si la IP tiene permitido el acceso
        /*if($usuario != "Roger Wright"){
      if (!empty($_SERVER['HTTP_CLIENT_IP'])){
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      }else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }else{
          $ip = $_SERVER['REMOTE_ADDR'];
      }
      $sql = "SELECT id FROM ip_login WHERE ip = '$ip' LIMIT 1;";
      $conec = self::connectDB();
      $resul = $conec->query($sql);
      $row = $resul->num_rows;
      if($row == 0){
          return "<script>alert('NO TIENE PERMISOS PARA ACCEDER AL SISTEMA DE EQR EQUATOROSES C.A.');</script>";
      }else{
          return "login";
      }
    }else{*/
        return "login";
        //}
    }

    public function verificarSesion($SESSION)
    {
        //Verifica si se inicio sesion y el tipo de usuario al que pertenece    
        if (isset($SESSION['loggedin']) && $SESSION['loggedin'] == true) {
            echo "<script>console.log('Conectado como: " . $SESSION['Usuario'] . ", Tipo Usuario: " . $SESSION['type'] . ", Nivel Usuario: " . $SESSION['nivel'] . ", Finca: " . $SESSION['finca'] . "');</script>";
        } else {
            header("Location:https://eqrapp.com/");
            exit;
        }/*
    $now = time();
    if($now > $SESSION['expire']){
      session_destroy();
      echo "Su sesion a terminado,
      <a href='https://eqrapp.com/'>Necesita Hacer Login</a>";
      exit;
    }*/
    }

    public function getInicioFinSemana($year, $week)
    {
        //Devuelve el primer y ultimo dia de una semana y año especificado
        date_default_timezone_set('America/Guayaquil');
        $fechaInicial = $year . '-12-28';
        $diaSemana = date('N', strtotime($fechaInicial));
        if ($diaSemana != '1') {
            $i = 7;
            while ($i >= $diaSemana) {
                $i--;
            }
            $fechaInicial = date('Y-m-d', strtotime($fechaInicial . '-' . $i . ' days'));
        }
        $w = date('W', strtotime($fechaInicial));
        if ($w != $week) {
            while ($w > $week) {
                $fechaInicial = date('Y-m-d', strtotime($fechaInicial . '-7 days'));
                $w = date('W', strtotime($fechaInicial));
            }
        }
        $lunes = $fechaInicial;
        $domingo = date('Y-m-d', strtotime($fechaInicial . '+6 days'));
        return [$lunes, $domingo];
    }

    public function getAnioSemana($fecha)
    {
        // Devuelve el anio_semana de la fecha especificada
        $itemsF = explode('-', $fecha);
        $semana = date('W', strtotime($fecha));
        if ($semana >= intval('52') && $itemsF[1] == '01') {
            $itemsF[0] = intval($itemsF[0]) - 1;
        } else if ($semana == '01' && $itemsF[1] == '12') {
            $itemsF[0] = intval($itemsF[0]) + 1;
        }
        return substr($itemsF[0], -2) . $semana;
    }

    public function getSelectSemanasAnio($anio)
    {
        // Devuelve un select con las semanas del anio especificado
        date_default_timezone_set('America/Guayaquil');
        if ($anio != date('Y')) {
            $fecha = $anio . "-12-28";
        } else {
            $fecha = date('Y-m-d');
        }
        $mes = date('m', strtotime($fecha));
        $semana = date('W', strtotime($fecha));
        if ($semana >= 52 && $mes == '01') {
            $anio = date('y', strtotime($fecha)) - 1;
        } else if ($semana == '01' && $mes == '12') {
            $anio = date('y', strtotime($fecha)) + 1;
        } else {
            $anio = date('y', strtotime($fecha));
        }
        $html = "<select name='semana' id='semana' class='form-control'>";
        for ($i = $semana; $i >= 1; $i--) {
            if ($i < 10) {
                $x = '0' . $i;
            } else {
                $x = $i;
            }
            $html .= "<option value='$anio$x'>$anio$x</option>";
        }
        return $html .= "</select>";
    }

    public function getTokenAS2()
    {
        $json = json_encode(array(
            "nombreUsuario" => "pruebas",
            "rol" => "Ecommerce",
            "clave" => "Pruebas1$",
            "sistema" => "AS2-ERP"
        ));
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://eqr.as2erp.com:8022/AS2/rest/usuariors/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )
        ));
        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $token = '';
        if ($code == 200) {
            $arrayRsp = json_decode($response, true);
            $token = $arrayRsp['token'];
        }
        return array(
            'token' => $token,
            'http_code' => $code
        );
    }
}
