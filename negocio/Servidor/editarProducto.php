<?php
include_once("../Servidor/conexion.php");

// Actualizar usuario
if (!empty($_POST)) {
    $alert = "";

    // Validación de campos vacíos
    if (empty($_POST['nombreG']) || empty($_POST['precio']) || empty($_POST['foto']) || empty($_POST['idCategoria'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todos los campos son requeridos</div>';
    } else {
        // Recogiendo datos del formulario
        $idProducto   = intval($_GET['id']);
        $nombre = $_POST['nombreG'];
        $preg = $_POST['precio'];
        $fotog = $_POST['foto'];
        $idCategoria = $_POST['idCategoria'];

        // Query para actualizar datos del usuario
        $sql_update = mysqli_query($conexion, "UPDATE productos SET nombreG='$nombre', precio='$preg', foto='$fotog', idCategoria='$idCategoria' WHERE idProducto=$idProducto");

        if ($sql_update) {
            // Redirigir con parámetro de éxito
            header("Location: ../Cliente/productos.php?update=success");
            exit();
        } else {
            $alert = '<div class="alert alert-danger" role="alert">Error al actualizar el usuario</div>';
        }
    }
}

// Mostrar datos del usuario
if (empty($_REQUEST['id'])) {
    header("Location: ../Cliente/productos.php");
    exit();
}

$idProducto = intval($_REQUEST['id']);

$stmt = $conexion->prepare("SELECT * FROM productos WHERE idProducto = ?");
$stmt->bind_param("i", $idProducto);
$stmt->execute();
$result = $stmt->get_result();
$result_sql = $result->num_rows;

if ($result_sql == 0) {
    header("Location: ../Cliente/productos.php");
    exit();
} else {
    $data = $result->fetch_assoc();
    $nombre = $data['nombreG'];
    $preg = $data['precio'];
    $fotog = $data['foto'];
    $idCategoria = $data['idCategoria'];
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idProducto; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" placeholder="Ingrese nombre" class="form-control" name="nombreG" id="nombreG" value="<?php echo $nombre; ?> ">

                </div>
                <div class="form-group">
                    <label for="Precio">Precio</label>
                    <input type="text" placeholder="Ingrese Precio" class="form-control" name="precio" id="precio" value="<?php echo $preg; ?>">
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="text" placeholder="Ingrese Foto" class="form-control" name="foto" id="foto" value="<?php echo $fotog; ?>">
                </div>
                <div class="form-group">
                    <label for="Categoria">Tipo</label>
                    <select name="idCategoria" id="idCategoria" class="form-control">
                        <option value="1" <?php if ($idCategoria == 1) echo "selected"; ?>>Dulces</option>
                        <option value="2" <?php if ($idCategoria == 2) echo "selected"; ?>>Saladas</option>
                    </select>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.href='../Cliente/productos.php'">Cancelar</button>

                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>Editar Producto</button>
            </form>
        </div>
    </div>
</div>
<br><br><br><br><br><br>
<!--Inicio de modal ediar-->
<!--Fin de modal ediar-->
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<!-- End of Main Content -->