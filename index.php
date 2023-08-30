<?php
    include_once('header.php');
    if(isset($_SESSION['LOGGED_USER'])){ 
        $fences= $pokemonZoo->getFences();
?>
    <main class="text-center" id="infosFence">
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
    <?php 
    }
    else {
        if (isset($_GET['error'])){
            echo('<h5 class="text-center text-danger">' . $_GET['error'] . '</h5>');
        }
    ?>
    <div class="text-center">
        <h4 class="m-3"> Veuillez vous connecter</h4>
        <form action="process/connect.php" method="POST" class="m-3">
            <label for="pseudo" >Identifiant (nom du zoo) : </label>
            <input type="text" id="pseudo" name="pseudo" required class="m-3" placeholder="Nom du Zoo" ><br />
            <label for="password">Mot de passe : </label>
            <input type="password" id="password" name="password" required class="mb-3 ms-3"><br />
            <input type="submit" id="submit" value="Se connecter">
        </form>
        <h4> Ou créer un compte </h4>
        <form action="process/post-create-user.php" method="POST" class="m-3">
            <label for="pseudo" >Choisissez un nom pour votre zoo : </label>
            <input type="text" id="pseudo" name="pseudo" required class="m-3" placeholder="Nom du Zoo" ><br />
            <label for="pseudoUser">Choisissez un nom pour votre employé : </label>
            <input type="text" id="pseudoUser" name="pseudoUser" required placeholder="Nom de l'employé">
            <label for="sex">Choisissez le sexe votre employé : </label>
            <select name="sex" id="sex" required>
                <option value="" selected disabled hidden>Choisir</option>
                <option value="male" >Homme</option>
                <option value="female" >Femme</option>
            </select>
            <label for="age">Choisissez l'âge de votre employé : </label>
            <input type="number" id="age" name="age" required placeholder="Âge de l'employé" class="mb-3" min="16"><br />
            <label for="password">Mot de passe : </label>
            <input type="password" id="password" name="password" required class="mb-3 ms-3"><br />
            <input type="submit" id="submit" value="Se connecter">
        </form>
    </div>
    <?php
    }
    ?>
    </main>
    
<?php
    include_once('footer.php');
?>