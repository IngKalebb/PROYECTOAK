<?php 
    session_start();
    if (!isset($_SESSION['tiempo'])) {
        $_SESSION['tiempo']=time();
    }
    else if (time() - $_SESSION['tiempo'] > 10000) {
        
        session_destroy();
        header('location:../');
        die();  
    }
    $_SESSION['tiempo']=time();
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            html {
                min-height: 100%;
                position: relative;
            }
            body {
                margin: 0;
                margin-bottom: 40px;
                margin-top: 10px;
            }
            footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 80px;
                color: white;
                margin-top: 50px;
            }
        </style>
</head>

<body>
    <div class="container" style="text-align:center; padding-top: 0%; background-color: rgb(175,238,238);">
        <div class="row">
            <div class="col-3">
                <img src="img/logoGalletas.jpg" alt="" height="200px" width="200px">
            </div>
            <div class="col" style="background-color: rgb(175,238,238);">
                <div class="btn-group" role="group" aria-label="Basic example" style="margin-top: 65px;">
                    <button>Cambio</button>
                <?php
                if ($_SESSION['rol']==1){
                ?>
                    <a href="inicio.php"><button type="button" class="btn btn-primary">Inicio</button></a>
                    <a href="Usuarios.php"><button type="button" class="btn btn-primary">Usuarios</button></a>
                    <a href="categorias.php"><button type="button" class="btn btn-secondary">Categoria</button></a>
                    <a href="productos.php"><button type="button" class="btn btn-success">Productos</button></a>
                    <a href="promociones.php"><button type="button" class="btn btn-warning">Promociones</button></a>
                    <a href="reportes.php"><button type="button" class="btn btn-info">Reportes</button></a>
                    <a href="salir.php"><button type="button" class="btn btn-info">Salir</button></a>
                <?php
                }
                ?>
                <?php
                if ($_SESSION['rol']==2){
                ?>
                    <a href="inicio.php"><button type="button" class="btn btn-primary">Inicio</button></a>
                    <a href="Usuarios.php"><button type="button" class="btn btn-primary">Usuarios</button></a>
                    <a href="productos.php"><button type="button" class="btn btn-success">Productos</button></a>
                    <a href="promociones.php"><button type="button" class="btn btn-warning">Promociones</button></a>
                    <a href="salir.php"><button type="button" class="btn btn-info">Salir</button></a>
                <?php
                }
                ?>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>

</html>