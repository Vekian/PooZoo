<?php
    require_once('../config/autoload.php');
    require_once('../config/db.php');

$pokemonZoo = new Zoo($db);
if (isset($_GET['id'])){
     $id= $_GET['id'];
     $fenceId = $_GET['fenceId'];
     $price = $_GET['price'] * (-1);
}
$employee = $pokemonZoo->getEmployee();
$pokemon= $employee->getPokemon($id);
$employee->feedPokemon($pokemon);
$pokemonZoo->addMoney($price);
header('Location:../fence.php?fenceId=' . $fenceId);