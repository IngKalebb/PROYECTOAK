<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <header>
        <?php
        include_once("include/encabezado.php");
        ?>
    </header>
    <h2>Inicio</h2>
    <!--Inicio Coursel-->
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/principe.jpg" class="d-block w-100" height="800px" width="700px" alt="">
                </div>
                <div class="carousel-item">
                    <img src="img/principe.jpg" class="d-block w-100" height="800px" width="700px" alt="">
                </div>
                <div class="carousel-item">
                    <img src="img/principe.jpg" class="d-block w-100" height="800px" width="700px" alt="">
                </div>
                <div class="carousel-item">
                    <img src="img/principe.jpg" class="d-block w-100" height="800px" width="700px" alt="">
                </div>
                <div class="carousel-item">
                    <img src="img/principe.jpg" class="d-block w-100" height="800px" width="700px" alt="">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <br><br>
    <!--fin coursel-->
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