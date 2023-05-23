<?php 
    //Conexión
    include './includes/config/database.php';
    $conexion = conectarDb();

    //Arreglo de errores
    $errores = [];

    //Autenticar usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Inyection SQL
        $email = mysqli_real_escape_string($conexion, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) );
        $password = mysqli_real_escape_string($conexion, $_POST['password'] );

        if (!$email) {
            $errores[] = "El Email es obligatorio";
        }

        if (!$password) {
            $errores[] = "El password es obligatorio";
        }

        if (empty($errores)) {
            //Revisar si existe el usuario
            $query = "SELECT * FROM usuario WHERE email = '${email}'";
            $resultado = mysqli_query($conexion, $query);

            if ($resultado->num_rows) {
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto
                $auth = password_verify($password, $usuario['password']);            

                if ($auth) {
                    //Usuartio autenticado
                    session_start();

                    //Llenar arreglo con la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;                

                    header('Location: /index.php');
                } 
                else {
                    $errores[] = "El password es incorrecto";
                }
            } 
            else {
                $errores[] = "El usuario no existe";
            }
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Rencon</title>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    
    <form action="" class="formulario" method="POST">
        <fieldset>
            <img src="/imagenes/logoGreen.svg" alt="Logo Green Recon">
            
            <?php foreach($errores as $error) : ?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

            <h2>Login</h2>

            <div class="campo">
                <label for="email">E-mail</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    placeholder="Ingresa tu E-mail"
                >
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    placeholder="Ingresa tu Password"
                >
            </div>

            <div class="contenedor-boton">
                <input class="boton" type="submit" value="Iniciar Sesión">
            </div>

        </fieldset>
    </form>

</body>
</html>