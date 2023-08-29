<?php
    require_once('config/autoload.php');
    require_once('config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <?php 
    if(isset($_SESSION['LOGGED_USER'])){
        $pokemonZoo = new Zoo($db, $_SESSION['LOGGED_USER']);
        $reserve = $pokemonZoo->getReserve();
    }?>
<nav class="navbar navbar-expand-lg bg-danger bg-gradient">
    <div class="d-flex align-items-center w-100 justify-content-around flex-wrap">
        <a class="nav-item dropdown ms-lg-5">
            <a class="nav-link dropdown-toggle text-light text-decoration-none" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Accueil
            </a>
            <ul class="dropdown-menu bg-danger bg-gradient ms-lg-5">
                <li><a class="dropdown-item text-light" href="index.php">Accueil</a></li>
                <li><?php if (isset($_SESSION['LOGGED_USER'])) {
                echo('<a href="process/logout.php" class="dropdown-item text-light">Se déconnecter</a>');
            }
            ?></li>
            </ul>
        </a>
        <a href="index.php" class="offset-lg-3 offset-xxl-4"><img src="images/logo.png"  id="logo"></a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-lg-5" id="navbarNavDropdown">
            <ul class="navbar-nav d-flex flex-row justify-content-around ms-auto align-items-center">
                <li class="nav-item me-3">
                    <?php if (isset($_SESSION['LOGGED_USER'])){
                        echo('<a class="text-decoration-none text-light nav-link" href="fence.php?fenceId='. $reserve->getId() .'">Réserve</a>');} ?>
                </li>
                <?php if (isset($_SESSION['LOGGED_USER'])){ ?>
                <li class="nav-item me-3">
                <a href="process/endTheDay.php" class="text-decoration-none text-light nav-link">Finir la journée</a>
                </li>
                <li class="nav-item">
                <div id="gameInfos" class="text-light nav-link">
                    <h5>Jour <?php echo($pokemonZoo->getTime()) ?></h5>
                    <h5><?php echo($pokemonZoo->getPokedollars()) ?><img src="images/pokedollar.png" height="30px" class="ms-2"></h5>
                </div>
                <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
    </header>