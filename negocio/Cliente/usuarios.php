<?php
include_once("../Servidor/conexion.php");
if (!empty($_POST)) {
    if (empty($_POST['c1']) || empty($_POST['c2']) || empty($_POST['c3']) || empty($_POST['c4']) || empty($_POST['c5']) || empty($_POST['c6']) || empty($_POST['c7'])) {
        $alert = '<div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            Todos los datos son obligatorios
        </div>
    </div>';
    } else {
        $c1 = $_POST['c1'];
        $c2 = $_POST['c2'];
        $c3 = $_POST['c3'];
        $c4 = $_POST['c4'];
        $c5 = $_POST['c5'];
        $c6 = $_POST['c6'];
        $c7 = $_POST['c7'];
        $c8 = md5($_POST['c6']); //constraseña incriptada
        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo= '$c4'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            El correo y/o el usuario ya existen
        </div>
    </div>';
        } else {
            $consulta = mysqli_query($conexion, "INSERT INTO usuarios(NomUsu, ApaUsu, AmaUsu, Correo, telefono, Contra, ruta, idtipo)  values ('$c1', '$c2', '$c3', '$c4', '$c5', '$c6','$c8', '$c7')");
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
        <h2>ADMINISTRACIÓN DE USUARIOS</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            nuevo
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>

                    <?php
                    if ($_SESSION['rol'] == 1) {
                    ?>
                        <th scope="col">Correo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Acciones</th>
                    <?php
                    }
                    ?>

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../Servidor/conexion.php");
                $con = mysqli_query($conexion, "SELECT u.idusuario,u.NomUsu,u.ApaUsu,u.AmaUsu,u.Correo,u.telefono,t.tipousu 
                FROM usuarios u INNER JOIN tipousuarios t ON u.idtipo=t.idtipo");
                $res = mysqli_num_rows($con);
                while ($datos = mysqli_fetch_assoc($con)) {
                ?>
                    <tr>
                        <?php $datos['idusuario'] ?>
                        <td><?php echo $datos['NomUsu']; ?></td>
                        <td><?php echo $datos['ApaUsu']; ?></td>
                        <td><?php echo $datos['AmaUsu']; ?></td>
                        <?php
                        if ($_SESSION['rol'] == 1) {
                        ?>
                            <td><?php echo $datos['Correo']; ?></td>
                            <td><?php echo $datos['telefono']; ?></td>
                            <td><?php echo $datos['tipousu']; ?></td>
                            <td>
                                <a href="../Servidor/editar_usuario.php?id=<?php echo $datos['idusuario']?>"><button type="button" class="btn btn"><i class="fi fi-rs-pencil"></i></button></a><!--boton Editar-->
                                <a href="../Servidor/borrarUsuario.php?id=<?php echo $datos['idusuario'] ?>"><button type="button" class="btn btn-dark"><i class="fi fi-rs-trash"></i></button></a><!--boton borrar-->
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>

    </div>
    <br><br><br>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE USUARIOS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form style="margin: 5%" method="POST">
                        <div>
                            <?php echo isset($alert) ? $alert : ""; ?>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Nombre</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nombre" id="c1" name="c1">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Apellido Paterno</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Apellido Paterno" id="c2" name="c2">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Apellido Materno</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Apellido Materno" id="c3" name="c3">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Correo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Correo" id="c4" name="c4">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Teléfono</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Teléfono" id="c5" name="c5">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Constraseña</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Contraseña" id="c6" name="c6">
                        </div>
                        <select class="form-select" aria-label="Default select example" id="c7" name="c7">
                            <option selected>Seleccionar</option>
                            <?php
                            include_once("../servidor/conexion.php");
                            $cone = mysqli_query($conexion, "SELECT * FROM tipousuarios ORDER BY tipousuarios.tipousu ASC");
                            $resu = mysqli_num_rows($cone);
                            while ($dat = mysqli_fetch_assoc($cone)) {
                            ?>

                                <option value="<?php echo $dat['idtipo'] ?>"><?php echo $dat['tipousu'] ?></option>

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

    <!--inicio modal editar
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDITAR DE USUARIOS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form style="margin: 5%" method="POST">
                        <div>
                            <?php echo isset($alert) ? $alert : ""; ?>
                            <input type="hidden" name="id" value="<?php echo $idusu; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Nombre</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" id="idNom" name="NomUsu" value="hola">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Apellido Paterno</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" id="c2" name="c2">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Apellido Materno</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Apellido Materno" id="c3" name="c3">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Correo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Correo" id="c4" name="c4">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Teléfono</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Teléfono" id="c5" name="c5">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label" style="color: black">Constraseña</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Contraseña" id="c6" name="c6">
                        </div>
                        <select class="form-select" aria-label="Default select example" id="c7" name="c7">
                            <option selected>Seleccionar</option>
                            <?php
                            include_once("../servidor/conexion.php");
                            $cone = mysqli_query($conexion, "SELECT * FROM tipousuarios ORDER BY tipousuarios.tipousu ASC");
                            $resu = mysqli_num_rows($cone);
                            while ($dat = mysqli_fetch_assoc($cone)) {
                            ?>

                                <option value="<?php echo $dat['idtipo'] ?>"><?php echo $dat['tipousu'] ?></option>

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
    -->

    <br>
    <br><br><br><br><br><br><br>
    <footer>
        <?php
        include_once("include/pie.php");
        ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>