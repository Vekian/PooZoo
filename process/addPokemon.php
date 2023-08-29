<?php
    require_once('../config/autoload.php');
    require_once('../config/db.php');

    $pokemonZoo = new Zoo($db, $_SESSION['LOGGED_USER']);
    $employee = $pokemonZoo->getEmployee();
    if (isset($_POST['fenceId'])){
        $fenceId = $_POST['fenceId'];
        $idSpecies = $_POST['idSpecies'];
        $type = $_POST['name'];
        $price = $_POST['price'] * (-1);
    }
    $employee->addPokemon($idSpecies, $fenceId, $type);
    $pokemonZoo->addMoney($price);
    header('Location:../fence.php?fenceId='. $fenceId);