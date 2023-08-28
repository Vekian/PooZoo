<?php
require_once('../config/autoload.php');
require_once('../config/db.php');

$pokemonZoo = new Zoo($db);
$pokemonZoo->endOfTheDay();
header('Location:../index.php');