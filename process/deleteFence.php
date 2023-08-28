<?php
    require_once('../config/autoload.php');
    require_once('../config/db.php');

    if (isset($_GET['fenceId'])){
        $pokemonZoo = new Zoo($db);
        $fenceId = $_GET['fenceId'];
        $employee = $pokemonZoo->getEmployee();
        $pokemons = $employee->examinePokemons($fenceId);
        foreach($pokemons as $pokemon){
            $employee->movePokemonFromFence($pokemon->getId(), 1, $fenceId);
        }
        $pokemonZoo->deleteFence($fenceId);
    }
header('Location:../index.php');