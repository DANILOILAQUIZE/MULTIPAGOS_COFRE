<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Multipagos Express</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="img/multipagos.jpg" rel="icon">
    <link rel="stylesheet" href="css/loader_div.css">
    

    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('img/fondo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body>

    <div id="loader_div" style="display: none;">
        <div class="rueda">
            <img src="img/multipagos.jpg" alt="Logo">
        </div>
        <div class="cargando">Cargando...</div>
    </div>

    <div class="main">
        <h1>MULTIPAGOS COFRE</h1>
        <h3>Ingrese sus credenciales de inicio de sesion</h3>

        <form method="post" action="login.php">
            <label for="first">
                Usuario:
            </label>
            <input type="text" id="Usuario" name="Usuario"
                placeholder="Ingrese su nombre de Usuario">

            <label for="password">
                Clave:
            </label>
            <input type="password" id="Password" name="Password"
                placeholder="Ingrese su Clave">

            <div class="wrap">
                <button type="submit">
                    Ingresar
                </button>
            </div>
        </form>

        <!-- <p>Olvide mi Clave ?
            <a href="#" style="text-decoration: none;">
                Recuperarla
            </a>
        </p> -->
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</body>

</html>
