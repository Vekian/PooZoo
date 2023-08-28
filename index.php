<?php
    include_once('header.php');
    $fences= $pokemonZoo->getFences();
?>
    <main class="text-center">
        <h1>
            Bienvenue au <?php echo($pokemonZoo->getName()); ?> !
        </h1>
        <h2>
            Il y a <?php  echo($pokemonZoo->numberTotal()); ?> pokemons dans le zoo. (dont <?php echo($fences[0]->getPopulation()) ?> dans la réserve)
        </h2>
        <div id="fences" class="d-flex justify-content-center flex-wrap">
            <?php 
                $pokemonZoo->displayFences();
            ?>
            <button type="button" id="addFence" class="btn btn-secondary col-3 ms-3 <?php
            if (count($pokemonZoo->getFences()) - 1 >= $pokemonZoo->getNumberMaxFences()) {
                echo('d-none');
            }
            ?>" data-bs-toggle="modal" data-bs-target="#addFenceModal">
                Ajouter un enclos
            </button>
        </div>
        <div class="modal fade" id="addFenceModal" tabindex="-1" aria-labelledby="addFenceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addFenceModalLabel">Ajouter un enclos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3> Prix de l'enclos : <?php echo($pokemonZoo->getPriceFence()); ?> <img src='images/pokedollar.png' height='30px' /></h3>
                        <form action="process/addFence.php" method="POST" class="text-center m-4">
                            <label for="text" class="mt-1">Veuillez donner un nom à votre enclos : </label>
                            <input type="text" name="nameFence" id="nameFence" required><br />
                            <label for="typeFence" class="mt-1">Choisissez le type d'enclos : </label>
                            <select name="typeFence" id="typeFence" class="m-2" required >
                            <?php
                                echo('<option value="" selected disabled hidden>Choisir</option>');
                                $fenceTypes= Fence::$fenceTypes;
                                foreach($fenceTypes as $fenceType) {
                                    echo('<option value="'. $fenceType . '">' . $fenceType . '</option>');
                                }
                            ?>
                            </select class="btn btn-primary">
                            <input type="hidden" name="background" value="">
                            <input type="hidden" name="price" value="<?php echo($pokemonZoo->getPriceFence()); ?>">
                            <input type="submit" value="Créer un enclos" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
<?php
    include_once('footer.php');
?>