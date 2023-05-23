<?php
    //Importar conexión
    include './includes/config/database.php';
    $conexion = conectarDb();

    //Crear usuario
    $nombre = "admin";
    $apellidoPaterno = "plantas";
    $apellidoMaterno = "inteligencia";
    $email = 'admin@zapopan.tecmm.edu.mx';
    $password = 12345;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $query = " INSERT INTO usuario (nombre, apellidoPaterno, apellidoMaterno, email, password) 
            VALUES ('${nombre}', '${apellidoPaterno}', '${apellidoMaterno}', '${email}', '${passwordHash}');"
    ;

    //Agregar a la BD
    mysqli_query($conexion, $query);


    echo $query;