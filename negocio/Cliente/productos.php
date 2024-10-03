<?php
include_once("../Servidor/conexion.php");
if (!empty($_POST)) {
    if (empty($_POST['nomg']) || empty($_POST['preg']) || empty($_POST['categ'])) {
        $alert = '<div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            Todos los datos son obligatorios
        </div>
    </div>';
    } else {
        $nomg = $_POST['nomg'];
        $preg = $_POST['preg'];
        $fotog = $_POST['fotog'];
        $categ = $_POST['categ'];
        $query = mysqli_query($conexion, "SELECT * FROM productos WHERE nombreG= '$nomg'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            El producto ya existe
        </div>
    </div>';
        } else {
            $consulta = mysqli_query($conexion, "INSERT INTO productos(nombreG, precio, foto, idCategoria)  values ('$nomg', '$preg', '$fotog', '$categ')");
            if ($consulta) {
                $alert = '<div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            Datos guardados
        </div>
    </div>';
            } else {
                $alert = '<div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            Error al guardar.
        </div>
    </div>';
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>

    <?php
    include_once("include/encabezado.php");
    ?>
    <div class="container" style="text-align: center;">
        <h2>PRODUCTOS</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalProduc">
            nuevo
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">foto</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("../Servidor/conexion.php");
                $con = mysqli_query($conexion, "SELECT p.idProducto,p.nombreG,p.precio, p.foto, p.idCategoria, g.tipoGalleta 
                FROM productos p INNER JOIN categoriagalletas g ON p.idCategoria=g.idCategoria");
                $res = mysqli_num_rows($con);
                while ($datos = mysqli_fetch_assoc($con)) {
                ?>
                    <tr>
                        <?php $datos['idProducto'] ?>
                        <td><?php echo $datos['nombreG']; ?></td>
                        <td><?php echo $datos['precio']; ?></td>
                        <td><?php echo $datos['foto']; ?></td>
                        <td><?php echo $datos['tipoGalleta']; ?></td>
                        <td>
                            <a href="../Servidor/editarProducto.php?id=<?php echo $datos['idProducto'] ?>"><button type="button" class="btn btn"><i class="fi fi-rs-pencil"></i></button></a><!--boton Editar-->
                            <a href="../Servidor/borrarProducto.php?id=<?php echo $datos['idProducto'] ?>"><button type="button" class="btn btn-dark"><i class="fi fi-rs-trash"></i></button></a><!--boton borrar-->
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalProduc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">AÑADIR PRODUCTO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form style="margin: 5%" method="POST" enctype="multipart/form-data">
                        <div>
                            <?php echo isset($alert) ? $alert : ""; ?>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Nombre</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nombre" id="nomg" name="nomg">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Precio</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Precio" id="preg" name="preg">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">foto</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Foto" id="fotog" name="fotog">
                        </div>
                        <select class="form-select" aria-label="Default select example" id="categ" name="categ">
                            <option selected>Seleccionar</option>
                            <?php
                            include_once("../servidor/conexion.php");
                            $cone = mysqli_query($conexion, "SELECT * FROM categoriagalletas ORDER BY categoriagalletas.tipoGalleta ASC");
                            $resu = mysqli_num_rows($cone);
                            while ($dat = mysqli_fetch_assoc($cone)) {
                            ?>
                                <option value="<?php echo $dat['idCategoria'] ?>"><?php echo $dat['tipoGalleta'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br>


    <footer>
        <?php
        include_once("include/pie.php");
        ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>