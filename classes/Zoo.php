<?php
    class Zoo {
        private PDO $db;
        private int $id;
        private string $name;
        private $employee;
        private int $numberMaxFences;
        private array $fences;
        private int $pokedollars;
        private int $time;
        private int $popularity = 0;


        /**
         * Get the value of name
         */
        public function getName(): string
        {
                return $this->name;
        }

        /**
         * Set the value of name
         */
        public function setName(string $name): self
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of employee
         */
        public function getEmployee()
        {
                return $this->employee;
        }

        /**
         * Set the value of employee
         */
        public function setEmployee( $employee): self
        {
                $this->employee = $employee;

                return $this;
        }

        /**
         * Get the value of numberMaxFences
         */
        public function getNumberMaxFences(): int
        {
                return $this->numberMaxFences;
        }

        /**
         * Set the value of numberMaxFences
         */
        public function setNumberMaxFences(int $numberMaxFences): self
        {
                $this->numberMaxFences = $numberMaxFences;

                return $this;
        }

        /**
         * Get the value of fences
         */
        public function getFences(): array
        {
                return $this->fences;
        }

        /**
         * Set the value of fences
         */
        public function setFences(array $fences): self
        {
                $this->fences = $fences;

                return $this;
        }
    
        /**
         * Get the value of db
         */
        public function getDb(): PDO
        {
                return $this->db;
        }

        /**
         * Set the value of db
         */
        public function setDb(PDO $db): self
        {
                $this->db = $db;

                return $this;
        }

        /**
         * Get the value of Id
         */
        public function getId(): int
        {
                return $this->id;
        }

        /**
         * Set the value of Id
         */
        public function setId(int $id): self
        {
                $this->id = $id;

                return $this;
        }


        /**
         * Get the value of pokedollars
         */
        public function getPokedollars(): int
        {
                return $this->pokedollars;
        }

        /**
         * Set the value of pokedollars
         */
        public function setPokedollars(int $pokedollars): self
        {
                $this->pokedollars = $pokedollars;

                return $this;
        }

        /**
         * Get the value of time
         */
        public function getTime(): int
        {
                return $this->time;
        }

        /**
         * Set the value of time
         */
        public function setTime(int $time): self
        {
                $this->time = $time;

                return $this;
        }
        public function getPopularity(): int
        {
                return $this->popularity;
        }

        /**
         * Set the value of time
         */
        public function setPopularity(int $popularity): self
        {
                $this->popularity = $popularity;

                return $this;
        }

        public function __construct (PDO $db, $id){
            $this->setDb($db);
            $this->hydrate($this->getZooData($id));
        }

        public function hydrate($data){
            $this->setId($data['zoo_id']);
            $this->setName($data['nameZoo']);
            $this->setEmployee(new Employee($this->getDb(), $data));
            $this->setNumberMaxFences($data['numberMaxFences']);
            $this->setFences($this->getFencesData());
            $this->setPokedollars($data['pokedollars']);
            $this->setTime($data['time']);
        }

        public function getZooData($id) {
            $query = $this->db->query('SELECT * FROM zoo 
                                        JOIN staff on zoo.id = staff.zoo_id
                                        WHERE zoo.id = ' . $id);
            $zooData = $query->fetch(PDO::FETCH_ASSOC);
            return $zooData;
        }

        public function getFencesData(){
            $query = $this->db->query('SELECT * FROM fences WHERE zoo_id = "' . $this->getId() .'"');
            $fencesData = $query->fetchAll(PDO :: FETCH_ASSOC);
            $fencesArray = [];
            foreach($fencesData as $fenceData) {
                array_push($fencesArray, new Fence($fenceData));
            }
            return $fencesArray;
        }

        public function getReserve(){
                foreach($this->fences as $fence){
                        if($fence->getType() == 'Reserve') {
                                return $fence;
                        }
                }
        }

        public function getPokemonsData(){
        $query = $this->db->query('SELECT * FROM pokemons
                        JOIN fences ON pokemons.fence_id = fences.id
                        JOIN species ON pokemons.species_id = species.id
                        WHERE zoo_id = "' . $this->getId() .'"');
        $pokemonsData = $query->fetchAll(PDO :: FETCH_ASSOC);
        $pokemons = [];
        foreach($pokemonsData as $pokemonData) {
                array_push($pokemons, new $pokemonData['name']($pokemonData));
            }
        return $pokemons;
        }

        public function getPriceFence(){
                $price = pow( 6, count($this->fences));
                return $price;
        }

        public function displayFences() {
        $i=1;
            foreach ($this->fences as $fence) {
                if($fence->getName() !== "Reserve") {
                echo('<div class="card m-3" style="width: 18rem;">');
                echo('<img src="' . $fence->getBackground() . '" class="card-img-top" alt="'. $fence->getType() . '" height="200px">
                        <div class="card-body">
                                <h5 class="card-title">'. $fence->getName() .'</h5>
                                <p class="card-text">Contient : ' . $fence->getPopulation() . ' pokemons</p>
                                <p class="card-text">L\'état de l\'enclos est : ' . $fence->getCleanliness() . '</p>
                                <div class="d-flex justify-content-center">
                                        <form action="fence.php" method="GET">
                                                <input type="hidden" name="fenceId" value="' . $fence->getId() . '">
                                                <input type="submit" value="Voir l\'enclos" class="btn btn-primary">
                                        </form>
                                        <button type="button" id="deleteFence'. $i . '" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#deleteFenceModal'. $i .'">
                                        Détruire
                                        </button>
                                </div>
                        </div>
                </div>
                <div class="modal fade" id="deleteFenceModal'. $i .'" tabindex="-1" aria-labelledby="deleteFenceModalLabel'.$i.'" aria-hidden="true">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteFenceModalLabel'.$i.'">Détruire l\'enclos</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        Êtes-vous sûr de détruire l\'enclos ? <br />
                                        Les pokémons présents dans l\'enclos seront déplacés dans la réserve.
                                </div>
                                <div class="modal-footer d-flex justify-content-around">
                                        <button type="button" class="btn btn-primary col-4" data-bs-dismiss="modal">Non</button>
                                        <a class="btn btn-danger col-4" href="process/deleteFence.php?fenceId='. $fence->getId().'">Oui</a>
                                </div>
                                </div>
                        </div>
                </div>
                ');
                $i++;
        }
        }}

        public function numberTotal() {
                $count = 0;
                foreach ($this->fences as $fence) {
                        $count += $fence->getpopulation();
                }
                return $count;
        }

        public function addFence($nameFence, $typeFence, $background, $zoo_id) {
        $q = $this->db->prepare('INSERT INTO fences (nameFence, cleanliness, type, background, population, zoo_id) VALUES (:nameFence, :cleanliness, :type, :background, :population, :zoo_id)');
        $q->bindValue(':nameFence', $nameFence);
        $q->bindValue(':cleanliness', 'Propre');
        $q->bindValue(':type', $typeFence);
        $q->bindValue(':background', $background);
        $q->bindValue(':population', 0);
        $q->bindValue(':zoo_id', $zoo_id);
        $q->execute();
        }

        public function getFence($fenceId){
                foreach($this->fences as $fence){
                        if($fence->getId() == $fenceId) {
                                return $fence;
                        }
                }
        }

        public function deleteFence($fenceId){
        $this->db->exec('DELETE FROM fences WHERE id = '.$fenceId);
        }
        public function addDay(){
        $q = $this->db->prepare('UPDATE zoo SET time = time + 1 WHERE id = ' . $this->getId());
        $q->execute(); 
        }

        public function addMoney($money) {
        $q = $this->db->prepare('UPDATE zoo SET pokedollars = pokedollars + '. $money . ' WHERE id = ' . $this->getId());
        $q->execute(); 
        }

        public function updatePopularity($popularity){
        $q = $this->db->prepare('UPDATE zoo SET popularity = '. $popularity . ' WHERE id = ' . $this->getId());
        $q->execute(); 
        }

        public function gainPopularity($popularity){
                $gain = $this->getPopularity() + $popularity;
                $this->setPopularity($gain);
        }
        
        public function growPokemons($pokemons){
        foreach($pokemons as $pokemon){
                $id = $pokemon->getId();
                $reserve = $this->getReserve();
                $health = $pokemon->checkHealth($reserve->getId());
                $type = $pokemon->getNameSpecies();
                $age = ($pokemon->getAge()) + 1;
                if (($health <= 0) || ($age >= ($type::$lifeExpectancy + rand(0,5)))) {
                        $this->employee->removePokemonFromFence($id, $pokemon->getFenceId());
                        $this->gainPopularity(-30);
                }
                else {
                $pokemon = $this->employee->evolution($pokemon, $this);
                if ($pokemon->getFenceId() != $reserve->getId()) {
                        $this->gainPopularity($type::$popularity);
                        if ($pokemon->getHeight() >= $type::$maxHeight){
                                $this->gainPopularity(10);
                        }
                        if ($pokemon->getSleeping() === true){
                        $this->gainPopularity(-5);
                }
                }
                if ($pokemon->getSick() === true){
                        $this->gainPopularity(-5);
                }
                $weight = $pokemon->gainWeight($pokemon->getNameSpecies());
                $height = $pokemon->gainHeight($pokemon->getNameSpecies());
                $pokemon->gainState();
                $hungry = $this->convertBool($pokemon->getHungry());
                $sleepy = $this->convertBool($pokemon->getSleepy());
                $sleeping = $this->convertBool($pokemon->getSleeping());
                $sick = $this->convertBool($pokemon->getSick());
                $species_id = $pokemon->getSpeciesId();
                $this->employee->updatePokemon($id, $age, $weight, $height, $health, $hungry, $sleepy, $sleeping, $sick, $species_id);
                }    
        }
        $money = $this->popularity;
        $this->addMoney($money);
        $this->updatePopularity($this->popularity);
        }

        public function endOfTheDay(){
        $this->addDay();
        foreach($this->fences as $fence){
                $fence->checkCleanliness($this->db);
                $fence->getDirty($this->db);
        }
        $pokemons = $this->getPokemonsData();
        $this->growPokemons($pokemons);
        $employee = $this->employee;
        $employee->reproduce($pokemons, $this->getReserve());
        }

        public function convertBool($bool) {
                if ($bool === true) {
                        return 1;
                }
                else {
                        return 0;
                }
        }
}
?>