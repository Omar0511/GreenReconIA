<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navegacion">
        <a href="index.php">Inicio</a>
        <a href="blog.php">Blog</a>
        <a href="contacto.php">Contáctanos</a>
        <a href="cerrar-sesion.php">Cerrar Sesión</a>
    </nav>

    <h4 class="titulo-formulario">FORMULARIO CONTACTO</h4>

    <form class="contact-form" action="https://formsubmit.co/za19012225@zapopan.tecmm.edu.mx" method="post">
        <input type="text" name="nombre" placeholder="Ingresa tu nombre" 
        pattern="^[A-Za-zÑñÁáÉéÍíÓóÚú\s]+$" title="Solo letras y espacios" required>
        
        <input type="email" name="correo" placeholder="Ingresa tu correo" title="Formato correo invalido" required >
        
        <textarea name="comentarios" cols="30" rows="10" placeholder="Escribe tus comentarios" required></textarea>
    
        <input type="submit" value="Enviar Formulario">
    </form>
</body>
</html>