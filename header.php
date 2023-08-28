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
        $pokemonZoo = new Zoo($db);
    ?>
    <header class="d-flex justify-content-around align-items-center bg-danger bg-gradient">
        <a class="text-decoration-none text-light" href="index.php">Accueil</a>
        <a class="text-decoration-none text-light" href="fence.php?fenceId=1">Réserve</a>
        <a href="index.php"><img src="images/logo.png" height="80px"></a>
        
        <a href="process/endTheDay.php" class="text-decoration-none text-light">Finir la journée</a>
        <div id="gameInfos" class="text-light">
            <h5>Jour <?php echo($pokemonZoo->getTime()) ?></h5>
            <h5><?php echo($pokemonZoo->getPokedollars()) ?><img src="images/pokedollar.png" height="30px" class="ms-2"></h5>
        </div>
    </header>