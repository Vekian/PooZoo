<?php
    require_once('../config/autoload.php');
    require_once('../config/db.php');

    if (isset($_POST['typeFence'])){
    $pokemonZoo = new Zoo($db, $_SESSION['LOGGED_USER']);
    $background= 'images/' . (strtolower($_POST['typeFence'])) . '.jpg';
    $type = $_POST['typeFence'];
    $name = $_POST['nameFence'];
    $price = $_POST['price'] * (-1);
    }
    $pokemonZoo->addFence($name, $type, $background, $_SESSION['LOGGED_USER']);
    if ($type == "Legendaire"){
        $price -= 500;
    }
    $pokemonZoo->addMoney($price);
header('Location:../index.php');