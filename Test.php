<?php
    include_once('header.php');
    if (isset($_GET['fenceId'])){
        $fenceId = $_GET['fenceId'];
    }
    $employee = $pokemonZoo->getEmployee();
    $pokemons = $employee->examinePokemons($fenceId);
    $species = $employee->findCompatiblePokemons($fenceId);
    $priceSpecies = [];
    $priceFree= [];
    $jsonSpecies = json_encode($species);
    $fence = $pokemonZoo->getFence($fenceId);
    ?>
<section >
    
    <div class="d-flex flex-wrap" id="infosFence">
        <?php
            $employee->displayFence($fenceId, $pokemons);
        ?>
    </div>
    <div id="infos">

    </div>
    <div id="pokemons" class="d-flex justify-content-center flex-wrap mt-1">
        <div id="indicatorBefore">
        </div>
        <?php
            foreach($pokemons as $pokemon){
                $type=$pokemon->getNameSpecies();
                $popularityFree = $type::$popularity / 5;
                $priceFree[$pokemon->getNameSpecies()] = $popularityFree;
                $pokemon->showPokemon($fenceId, $employee);
            }
            $jsonPriceFree = json_encode($priceFree);
        ?>
         <div id="indicatorNext"> 
        </div>
    </div>
</section>
<script>
    let cards = document.getElementsByClassName('card');
    function detectWidth(cards) {
        if (window.innerWidth < 1200) {
            let buttonBefore = document.createElement('button');
            buttonBefore.setAttribute('id', 'before');
            buttonBefore.textContent = "Before";
            let parentBefore = document.getElementById('indicatorBefore');
            parentBefore.appendChild(buttonBefore);

            let buttonNext = document.createElement('button');
            buttonNext.setAttribute('id', 'next');
            buttonNext.textContent = "Next";
            let parentNext = document.getElementById('indicatorNext');
            parentNext.appendChild(buttonNext);
            for (let i=0; i < cards.length; i++) {
            if (i >= 3) {
                cards[i].classList.add('d-none');
            }
            }
            nextCard(cards);
            beforeCard(cards);
        }

    }
    function nextCard(cards) {
    document.getElementById('next').addEventListener('click', function(e){
        for (let i=0; i < cards.length; i++) {
            if (i < 3) {
                cards[i].classList.add('d-none');
            }
            else {
                cards[i].classList.remove('d-none')
            }
        }
    });};

    function beforeCard(cards){
    document.getElementById('before').addEventListener('click', function(e){
        for (let i=0; i < cards.length; i++) {
            if (i >= 3) {
                cards[i].classList.add('d-none');
            }
            else {
                cards[i].classList.remove('d-none')
            }
        }
    }
    );};

    detectWidth(cards);
    
</script>
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addModalLabel">Ajouter un pokemon dans l'enclos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="process/addPokemon.php" method="POST" class="text-center m-4">
                            <input type="hidden" value="<?php echo($fenceId); ?>" name="fenceId">
                            <label for="idSpecies" class="mt-1">Choisissez votre pokemon : </label>
                            <select name="idSpecies" id="idSpecies" class="m-2" required >
                            <?php
                                echo('<option value="" selected disabled hidden>Choisir</option>');
                                foreach($species as $specie) {
                                    $type = $specie['name'];
                                    array_push($priceSpecies, $type::$popularity);
                                    echo('<option value="'. $specie['id'] . '">' . $specie['name'] . '</option>');
                                }
                                $jsonPriceSpecies = json_encode($priceSpecies);
                            ?>
                            </select class="btn btn-primary">
                            <input type="hidden" id="name1" name="name" value="">
                            <div>
                                Prix du pokemon : <span id="priceSpecies"></span>
                            </div>
                            <input type="hidden" id="price" name="price" value="">
                            <img id="img" src="" width="100px"/> 
                            <input type="submit" value="Ajouter à l'enclos" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="removeModalLabel">Libérer un pokemon de l'enclos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-danger">ATTENTION ! Cette action enlèvera définitivement le pokémon.</p>
                        <p id='priceFree'></p>
                        <form action="process/removePokemonFromFence.php" method="POST" class="text-center m-4">
                            <input type="hidden" value="<?php echo($fenceId); ?>" name="fenceId">
                            <input type="hidden" value="" name="price" id="price2">
                            <label for="idSpecies2" class="mt-1">Choisissez un pokemon </label>
                            <select name="idPokemon" id="idSpecies2" class="m-2" required >
                            <?php
                                echo('<option value="" selected disabled hidden>Choisir</option>');
                                foreach($pokemons as $pokemon) {
                                    echo('<option value="'. $pokemon->getId() . '">' . $pokemon->getNameSpecies() . '</option>');
                                }
                            ?>
                            </select class="btn btn-primary">
                            <input type="submit" value="Enlever de l'enclos" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
<script>
    let image = document.getElementById('img');
    let contentPrice = document.getElementById('priceSpecies');
    let species = <?= $jsonSpecies ?>;
    let priceSpecies = <?= $jsonPriceSpecies ?>;
    document.getElementById('idSpecies').addEventListener("change", function (e) {
        let idSpecies = e.target.value;
        let src;
        let name;
        let price;
        for(let i =0; i < species.length; i++) {
            if (idSpecies == species[i]['id']){
                src = species[i]['avatar'];
                name = species[i]['name'];
                price = priceSpecies[i] * 3;
            }
        }
        image.setAttribute("src", src);
        contentPrice.innerHTML = price + " <img src='images/pokedollar.png' height='20px' />";
        document.getElementById('name1').value = name;
        document.getElementById('price').value = price;
    });

    let pricesFree = <?= $jsonPriceFree ?>;
    let selectFree = document.getElementById('idSpecies2');
    selectFree.addEventListener("change", function (e) {
        let nameFree = selectFree.options[selectFree.selectedIndex].text;
        let price = pricesFree[nameFree];
        document.getElementById('price2').value = price;
        document.getElementById('priceFree').innerHTML = 'Redonnez sa liberté à ce pokemon vous accordera ' + price + ' <img src="images/pokedollar.png" height="20px" /> par la Société Protectrice des Pokemons';
    });

    let population = document.getElementById('population').textContent;
    let inputAdd = document.getElementById('addPokemon');
    if (population === ' Population : 6') {
        document.getElementById('population').textContent += ' (max)';
        inputAdd.classList.add('d-none');
    }

    cleanliness = '<?php echo($fence->getCleanliness()); ?>';
    if(cleanliness === 'Sale'){
        document.getElementById('imgFence').classList.add('dirty');
    }
</script>
<?php
    include_once('footer.php');
?>