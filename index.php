<?php 
    include 'includes/header.php';
    include 'includes/config/database.php';

    require  'vendor/autoload.php';
    use Intervention\Image\ImageManagerStatic  as Image;

    $db = conectarDb();

    $plantaPy;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_FILES['imagen']);
        // echo "</pre>";
        
        if ($_FILES['imagen']['tmp_name']) {
            $image = Image::make($_FILES['imagen']['tmp_name']); 
        }

        $image->save('imagenes/plantaImg.jpg'); //
        
        $salida=array();
        exec("python detect.py", $salida);
        $plantaPy = $salida[0];
        //$plantaPy = 'alcatraz';
        // $query = "SELECT * FROM planta ";
        // $query .= " WHERE NombreComun LIKE '" ;
        // $query .= "$plantaPy'";

        $query =  " SELECT ";
        $query .= "pl.idplanta, pl.Nombre, pl.NombreComun, pl.descripcion, pl.cultivo, pl.distribucion, pl.usos, pl.imagen1, pl.imagen2, pl.imagenDistribucion, ";
        $query .= "re.nombre reino, ";
        $query .= "di.nombre divicion, ";
        $query .= "cl.nombre clase, ";
        $query .= "fa.nombre familia ";
        $query .= "FROM planta pl ";
        $query .= "left join reino re on re.idreino=pl.idreino ";
        $query .= "left join divicion di on di.iddivicion=pl.iddivicion ";
        $query .= "left join clase cl	on cl.idclase=pl.idclase ";
        $query .= "left join familia fa on fa.idfamilia=pl.idfamilia ";    
        $query .= "WHERE NombreComun LIKE '$plantaPy'";

        // echo "<pre>"; 
        // var_dump($query);
        // echo "</pre>"; 
        // exit();
        
        $resultado = mysqli_query($db, $query);

    }

    // $salida=array(); 
    // exec("python detect.py", $salida);
    // echo $salida[0];
    // $plantaPy=1

    session_start();        
        
    if (!$_SESSION['login']) {
        header('Location: /login.php');
    }
?>

    <form class="contenido-imagen" method="POST" class="center" enctype="multipart/form-data">
        <fieldset>
            <div class="campo">
                <label for="buscar">Seleccionar Imagen: </label>
                <input type="file" id="imagen" accept="image/jpeg, image/jpg" name="imagen">
            </div>

            <input class="boton-resultados" type="submit" value="Ver Resultados">
        </fieldset>
    </form>

    <?php 
        if($plantaPy){  
            while ($planta = mysqli_fetch_assoc($resultado) ): 
    ?>
    <!-- <?php //if($plantaPy){  ?> -->
        <div class="centrado">
                <h1><span><?php echo $planta['Nombre'] ?></span> </h1>

                <div class="contenedor-imagen">
                    <img src="imagenes/plantasBase/<?php echo $planta['imagen1']; ?>" alt="planta">

                    <h1>Nombre común: <?php echo $planta['NombreComun'] ?> </h1>
                    
                    <h2>Caracteristicas</h2>
                    <p> <span> Reino: </span> <?php echo $planta['reino'] ?></p>
                    <p> <span> Divicion: </span> <?php echo $planta['divicion'] ?></p>
                    <p> <span> Clase: </span> <?php echo $planta['clase'] ?></p>
                    <p> <span> Familia: </span> <?php echo $planta['familia'] ?></p>

                    <h2>Descripcion</h2>
                    <p><?php  echo $planta['descripcion'] ?></p>

                    <h2>Cultivo</h2>
                    <p><?php  echo $planta['cultivo'] ?></p>

                    <h2>Distribucion</h2>
                    <p><?php  echo $planta['distribucion'] ?></p>

                    <div class="contenedor-imagen">
                        <img src="imagenes/plantasBase/<?php echo $planta['imagenDistribucion']; ?>" alt="planta">
                    </div>

                    <h2>Usos</h2>
                    <p><?php  echo $planta['usos'] ?></p>

                    <div class="contenedor-imagen">
                        <img src="imagenes/plantasBase/<?php echo $planta['imagen2']; ?>" alt="planta">
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; }?>
    <!-- <?php //}?> -->

<?php include 'includes/footer.php'; ?>