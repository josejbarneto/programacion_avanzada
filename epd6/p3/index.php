<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>P3</title>
        <style>
            #subidor{
                width: 50%;
                float: left;
            }

            #subidor h1{
                margin-top: 0;
            }

            #buscador{
                width: 49%;
                float: right;
            }

            #lista{
                width: 50%;
                float: left;
                list-style: none;
            }


            #lista li:first-of-type{
                border-top: none;
                font-size: 24px;
            }

            #lista li{
                border-top: 1px solid black;
            }

            #logout {
                position: absolute;
                top: 2%;
                right: 2%;
            }
        </style>
    </head>
    <body>
        <?php

        $areas = ["Artística", "Publicitaria", "Moda", "Documental", "Retrato", "Periodística", "Aérea", "Científica", "Deporte"];
        
        //SI HAY SUBMIT
        if (isset($_POST["submit"]) || isset($_POST["buscar_imagenes"])) {

            //SI ESTOY HACIENDO LOGIN
            if (isset($_POST["user"])) {
                if (!isset($_POST["password"])) {
                    $errores[] = "Introduzca una contraseña";
                }
                $user = filter_var($_POST["user"], FILTER_SANITIZE_STRING);
                $clave = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

                if (empty($errores)) {
                    $valida = checkPassword($user, $clave);
                    if ($valida == 1) {
                        ?>
                        <a id="logout" href="index.php">Logout</a>
                        <div id="subidor">
                            <h1>Subida de Im&aacute;genes</h1>
                            <form method="post" enctype="multipart/form-data" MAX>
                                <label>T&iacute;tulo:</label>
                                <input type="text" name="titulo" required /><br>
                                <label>Descripci&oacute;n:</label>
                                <input type="text" name="descripcion" required/><br>
                                <label>&Aacute;rea:</label>
                                <select style="width:60%" name="area" required/>
                                <?php
                                $areas_user = obtenerAreas($user);

                                foreach ($areas_user as $value) {
                                    echo "<option value='$value'>$value</option>";
                                }
                                ?>
                                </select><br>
                                <label>Imagen:</label>
                                <input type="file" name="imagen" required/><br>
                                <input type="submit" name="enviar" />
                                <input type="text" name="user" value="<?php echo $user; ?>" hidden="hidden"/>
                                <input type="text" name="password" value="<?php echo $clave; ?>" hidden="hidden"/>
                                <input type="text" name="submit" value="a" hidden="hidden"/>
                            </form>
                        </div>
                        <div class="buscador">
                            <h1>Buscador de im&aacute;genes</h1>
                            <form id="buscar" method="post" action="index.php">
                                <input id="cuadro" type="search" name="search" placeholder="Introduce una b&uacute;squeda..."/>
                                <select name="type">
                                    <option value="-1" selected></option>
                                    <?php
                                    foreach ($areas as $key => $value) {
                                        echo "<option value='$key'>$value</option>";
                                    }
                                    ?>
                                </select><br>
                                <input id="boton" type="submit" value="Buscar imagenes" name="buscar_imagenes"/>
                            </form>
                        </div>

                        <ul id="lista">
                            <li>Imagenes del Usuario</li>
                            <?php
                            $imagenes = getImagenesByUser($user);
                            showImagenes($imagenes);
                            if (isset($_POST["enviar"])) {
                                if (!isset($_POST["titulo"])) {
                                    $errores[] = "Introduzca un t&iacute;tulo";
                                }
                                if (!isset($_POST["descripcion"])) {
                                    $errores[] = "Introduzca una descripci&oacute;n";
                                }
                                if (!isset($_POST["area"])) {
                                    $errores[] = "Seleccione un &aacute;rea";
                                }
                                if (!isset($_FILES) || ($_FILES["imagen"]["error"] == 4)) {
                                    $errores[] = "Seleccione una imagen";
                                }
                                if ($_FILES["imagen"]["error"] !== 0) {
                                    $errores[] = "Error: " . $_FILES["imagen"]["error"];
                                }
                                if (!extensionValida($_FILES["imagen"])) {
                                    $errores[] = "Formato de archivo no permitido";
                                }
                                if ($_FILES["imagen"]["size"] > (5 * 1024 * 1024)) {
                                    $errores[] = "El archivo supera el tama&ntilde;o permitido";
                                }
                                if (!compruebaHash($_FILES["imagen"])) {
                                    $errores[] = "La imagen seleccionada ya existe en el sistema";
                                }
                                if (empty($errores)) {
                                    $titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_STRING);
                                    $descripcion = filter_var($_POST["descripcion"], FILTER_SANITIZE_STRING);
                                    $area = filter_var($_POST["area"], FILTER_SANITIZE_STRING);
                                    if ($titulo === "") {
                                        $errores = "El t&iacute;tulo no puede estar vac&iacute;o";
                                    }
                                    if ($descripcion === "") {
                                        $errores[] = "La descripci&oacute;n no puede estar vac&iacute;a";
                                    }
                                    if (array_search($area, $areas) === false) {
                                        $errores[] = "El &aacute;rea introducida no es v&aacute;lida";
                                    }

                                    if (empty($errores)) {
                                        guardarImagen($titulo, $descripcion, $area, $_FILES["imagen"]);
                                        $img = $_FILES["imagen"]["name"];
                                        echo "<li>";
                                        echo "<figure>";
                                        echo "<a href='img/$img' download='img/$img'>";
                                        echo "<img src='img/$img'/></a>";
                                        echo "</figure>";
                                        echo "</li>";
                                        echo "</ul>";
                                    }
                                }
                            }
                        } elseif ($valida < 0) {
                            ?>
                            <form method="post">
                                <h1>Registro:</h1>
                                <label>User:</label>
                                <input type="text" name="register" value="<?php echo $user; ?>" required/><br>
                                <label>Contrase&ntilde;a:</label>
                                <input type="password" name="password" value="<?php echo $clave; ?>" required/><br>
                                <label>Email:</label>
                                <input type="email" name="email" required/><br>
                                <label>&Aacute;reas:</label>
                                <select style="width:100%" name="areas[]" multiple size="5" required/>
                                <?php
                                foreach ($areas as $key => $value) {
                                    echo "<option value='$key'>$value</option>";
                                }
                                ?>
                                </select><br>
                                <input type="submit" name="submit"/><br>
                            </form>
                            <?php
                        } else {
                            $errores[] = "User o contrase&ntilde;a incorrectos";
                        }
                    }

                //SI ESTOY HACIENDO EL REGISTRO
                } else if (isset($_POST["register"])) {
                    if (!isset($_POST["password"])) {
                        $errores[] = "Introduzca una contrase&ntilde;a";
                    }
                    if (!isset($_POST["email"])) {
                        $errores[] = "Introduzca una direcci&oacute;n de correo";
                    }
                    if (!isset($_POST["areas"]) || empty($_POST["areas"])) {
                        $errores[] = "Introduzca al menos un &aacute;rea de inter&eacute;s";
                    }
                    if (empty($errores)) {
                        $user = filter_var($_POST["register"], FILTER_SANITIZE_STRING);
                        $clave = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
                        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                        $seleccion = $_POST["areas"];

                        if ($user == "") {
                            $errores[] = "El user no puede estar vac&iacute;o";
                        }
                        if ($clave == "") {
                            $errores[] = "La contrase&ntilde;a no puede estar vac&iacute;a";
                        }
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $errores[] = "El correo introducido no es v&aacute;lido";
                        }

                        if (compruebaUser($user)) {
                            $errores[] = "El user introducido ya existe";
                        }
                        if (empty($errores)) {
                            newUser($user, $clave, $email, $seleccion);
                            header("Refresh:0");
                        }
                    }

                //REALIZANDO BUSQUEDA DE IMAGEN
                } else if (isset($_POST["buscar_imagenes"])) {
                    if (isset($_POST["type"])) {
                        $area = filter_var($_POST["type"], FILTER_SANITIZE_NUMBER_INT);
                        if ($area > -1) {
                            $areas = ["Artística", "Publicitaria", "Moda", "Documental", "Retrato", "Periodística", "Aérea", "Científica", "Deporte"];
                            $imagenes = getImagenesByTipo($areas[$area]);
                            if (!empty($imagenes)) {
                                pintarBusqueda($imagenes, false);
                            } else {
                                $errores[] = "No se han encontrado imagenes del tipo seleccionado";
                            }
                        } elseif (isset($_POST["search"]) && ($_POST["search"] !== "")) {
                            $busca = strtolower(filter_var($_POST["search"], FILTER_SANITIZE_STRING));
                            $imagenes = getImagenesByUserBuscador($busca);

                            if (!empty($imagenes)) {
                                pintarBusqueda($imagenes, true);
                            } else {
                                $errores[] = "Imagen no encontrada";
                            }
                        } else {
                            $errores[] = "Introduzca un criterio de búsqueda";
                        }
                    }
                } else {
                    $errores[] = "Introduzca un usuario";
                }
                if (!empty($errores)) {
                    foreach ($errores as $e) {
                        echo "<span class='error'>$e</span><br>";
                    }
                }
            } else {
                ?>
                <form method="post">
                    <h1>Login:</h1>
                    <label>Usuario:</label>
                    <input type="text" name="user" required/><br>
                    <label>Contrase&ntilde;a:</label>
                    <input type="password" name="password" required/><br>
                    <input type="submit" name="submit" value="Entrar"/>
                </form>
                <?php
            }

            function conectDB() {
                $c = mysqli_connect('localhost', 'root', '', 'p3');
                return $c;
            }

            function checkPassword($user, $pass) {
                $valido = -1;
                $conexion = conectDB();
                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error al realizar la conexion a la base de datos");
                } else {
                    $sql = "SELECT * FROM users WHERE nombre='$user'";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error al ejecutar la consulta.");
                    } else {
                        if (mysqli_num_rows($result) > 0) {
                            $valido = 0;
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row["pass"] === $pass) {
                                $valido = 1;
                            }
                        }
                    }
                }
                mysqli_close($conexion);
                return $valido;
            }

            function compruebaUser($user) {
                $valido = false;
                $conexion = conectDB();
                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error al realizar la conexion a la base de datos");
                } else {
                    $sql = 'SELECT nombre FROM users WHERE nombre = "' . $user . '"';
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error al ejecutar la consulta.");
                    } else {
                        if (mysqli_num_rows($result) == 1) {
                            $valido = true;
                        }
                    }
                }
                mysqli_close($conexion);
                return $valido;
            }

            function newUser($user, $pass, $email, $seleccion) {
                global $areas;
                foreach ($seleccion as $key) {
                    $tipos[] = $areas[$key];
                }

                $conexion = conectDB();
                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error al realizar la conexion a la base de datos");
                } else {
                    $sql = "INSERT INTO users (nombre, pass, email) values ('$user', '$pass', '$email')";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error al ejecutar la consulta.");
                    } else {
                        foreach ($tipos as $area) {
                            $sql = "INSERT INTO area (user, tipo) values ('$user', '$area')";
                            $result = mysqli_query($conexion, $sql);
                            if (!$result) {
                                die("Error al ejecutar la consulta.");
                            }
                        }
                    }
                }
                mysqli_close($conexion);
            }

            function compruebaHash($imagen) {
                $hash = md5_file($imagen["tmp_name"]);
                $valido = true;
                $conexion = conectDB();
                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error al realizar la conexion a la base de datos");
                } else {
                    $sql = "SELECT * FROM imagenes WHERE hash ='$hash'";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error al ejecutar la consulta.");
                    } else {
                        if (mysqli_num_rows($result) !== 0) {
                            $valido = false;
                        }
                    }
                }
                mysqli_close($conexion);
                return $valido;
            }

            function guardarImagen($titulo, $descripcion, $area, $imagen) {
                $conexion = conectDB();
                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error al realizar la conexion a la base de datos");
                } else {
                    $sql = "INSERT INTO imagenes (filename, nombre, fechaHora, descripcion, user, area, hash) VALUES ('" . $imagen["name"] . "' ,'$titulo', '" . date("d/m/Y H:i") . "', '$descripcion', '" . $_POST['user'] . "', '$area', '" . md5_file($imagen['tmp_name']) . "')";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error al ejecutar la consulta ALMACENAR IMAGEN");
                    } else {
                        copy($imagen["tmp_name"], "img/" . $imagen["name"]);
                    }
                }
                mysqli_close($conexion);
            }

            function getImagenesByUser($user) {
                $conexion = conectDB();

                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error al realizar la conexion a la base de datos");
                } else {
                    $sql = 'SELECT hash FROM imagenes WHERE user = "' . $user . '"';
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error al ejecutar la consulta");
                    } else {
                        while ($row = mysqli_fetch_array($result)) {
                            $imagenes[] = $row['hash'];
                        }
                    }
                }
                mysqli_close($conexion);

                return isset($imagenes) ? $imagenes : null;
            }

            function getImagenesByTipo($tipo) {
                $conexion = conectDB();
                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error: no se puede conectar a la BD");
                } else {
                    $sql = "SELECT * FROM imagenes  WHERE area ='$tipo'";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error al ejecutar la consulta");
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $imagenes[] = $row;
                        }
                    }
                }
                mysqli_close($conexion);

                return isset($imagenes) ? $imagenes : null;
            }

            function showImagenes($imagenes) {
                $conexion = conectDB();

                if (!empty($imagenes)) {
                    $conexion = conectDB();
                    if (!$conexion) {
                        mysqli_close($conexion);
                        die("Error al realizar la conexion a la base de datos");
                    } else {
                        foreach ($imagenes as $hash) {
                            $sql = 'SELECT filename FROM imagenes WHERE hash = "' . $hash . '"';
                            $result = mysqli_query($conexion, $sql);
                            if (!$result) {
                                die("Error al buscar imagenes " . mysqli_error($conexion));
                            } else {
                                $row = mysqli_fetch_array($result);
                                $img = $row['filename'];
                                echo "<li>";
                                echo "<figure>";
                                echo "<a href='img/$img' download='img/$img'>";
                                echo "<img src='img/$img'/></a>";
                                echo "</figure>";
                                echo "</li>";
                            }
                        }
                    }
                }
                mysqli_close($conexion);
            }

            function obtenerAreas($user) {
                $conexion = conectDB();

                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error al realizar la conexion a la base de datos");
                } else {
                    $sql = "SELECT tipo FROM area WHERE user ='$user'";
                    $result = mysqli_query($conexion, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                        $areas[] = $row['tipo'];
                    }
                }
                mysqli_close($conexion);

                return isset($areas) ? $areas : null;
            }

            function getImagenesByUserBuscador($filtro) {
                $conexion = conectDB();
                if (!$conexion) {
                    mysqli_close($conexion);
                    die("Error: no se puede conectar a la BD");
                } else {
                    $sql = 'SELECT * FROM imagenes';
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error al ejecutar la consulta");
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if (stristr($row['nombre'], $filtro) || stristr($row['descripcion'], $filtro)) {
                                $imagenes[] = $row;
                            }
                        }
                    }
                }
                mysqli_close($conexion);

                return isset($imagenes) ? $imagenes : null;
            }

            function pintarBusqueda($imagenes, $detalles) {
                if (!file_exists("img")) {
                    mkdir("img");
                }

                $todas = scandir("img");
                if (!empty($imagenes)) {
                    echo "<ul>";
                    foreach ($todas as $img) {
                        if ($img != "." && $img != "..") {
                            $hash = md5_file("img/$img");
                            foreach ($imagenes as $i) {
                                if ($i["hash"] == $hash) {
                                    echo "<li>";
                                    echo "<figure>";
                                    echo "<a href='img/$img' download='img/$img'>";
                                    echo "<img src='img/$img'/></a>";
                                    if ($detalles)
                                        echo "<figcaption>" . $i['nombre'] . "<br/>" . $i['descripcion'] . "</figcaption>";
                                    echo "</figure>";
                                    echo "</li>";
                                }
                            }
                        }
                    }
                    echo "</ul>";
                }
            }

            function extensionValida($fichero) {
                return (array_search($fichero['type'], ["image/jpeg", "image/png"]) !== false);
            }
            ?>
    </body>
</html>
