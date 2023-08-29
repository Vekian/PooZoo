<?php
    require_once('../config/autoload.php');
    require_once('../config/db.php');

    $pokemonZoo = new Zoo($db, $_SESSION['LOGGED_USER']);
    $employee = $pokemonZoo->getEmployee();
    if (isset($_POST['pokemonId'])){
        $idPokemon = $_POST['pokemonId'];
        $fenceId = $_POST['fenceId'];
        $newFenceId = $_POST['newFenceId'];
    }
$employee->movePokemonFromFence($idPokemon, $newFenceId, $fenceId);
$pokemonZoo->addMoney(-5);
header('Location:../fence.php?fenceId='. $fenceId);