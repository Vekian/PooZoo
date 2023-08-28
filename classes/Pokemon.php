<?php
    abstract class Pokemon {
        protected int $id;
        protected int $age;
        protected string $sex;
        protected int $weight;
        protected int $height;
        protected int $health;
        protected bool $hungry;
        protected bool $sleepy;
        protected bool $sleeping;
        protected bool $sick;
        protected int $fenceId;

        /**
         * Get the value of id
         */
        public function getId(): int
        {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId(int $id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of age
         */
        public function getAge(): int
        {
                return $this->age;
        }

        /**
         * Set the value of age
         */
        public function setAge(int $age): self
        {
                $this->age = $age;

                return $this;
        }

        /**
         * Get the value of sex
         */
        public function getSex(): string
        {
                return $this->sex;
        }

        /**
         * Set the value of sex
         */
        public function setSex(string $sex): self
        {
                $this->sex = $sex;

                return $this;
        }

        /**
         * Get the value of weight
         */
        public function getWeight(): int
        {
                return $this->weight;
        }

        /**
         * Set the value of weight
         */
        public function setWeight(int $weight): self
        {
                $this->weight = $weight;

                return $this;
        }

        /**
         * Get the value of height
         */
        public function getHeight(): int
        {
                return $this->height;
        }

        /**
         * Set the value of height
         */
        public function setHeight(int $height): self
        {
                $this->height = $height;

                return $this;
        }

        /**
         * Get the value of health
         */
        public function getHealth(): int
        {
                return $this->health;
        }

        /**
         * Set the value of health
         */
        public function setHealth(int $health): self
        {
                $this->health = $health;

                return $this;
        }

        /**
         * Get the value of hungry
         */
        public function getHungry(): bool
        {
                return $this->hungry;
        }

        /**
         * Set the value of hungry
         */
        public function setHungry(bool $hungry): self
        {
                $this->hungry = $hungry;

                return $this;
        }

        /**
         * Get the value of sleepy
         */
        public function getSleepy(): bool
        {
                return $this->sleepy;
        }

        /**
         * Set the value of sleepy
         */
        public function setSleepy(bool $sleepy): self
        {
                $this->sleepy = $sleepy;

                return $this;
        }

        /**
         * Get the value of sick
         */
        public function getSick(): bool
        {
                return $this->sick;
        }

        /**
         * Set the value of sick
         */
        public function setSick(bool $sick): self
        {
                $this->sick = $sick;

                return $this;
        }

        public function getFenceId(): int
        {
                return $this->fenceId;
        }

        /**
         * Set the value of fenceId
         */
        public function setFenceId(int $fenceId): self
        {
                $this->fenceId = $fenceId;

                return $this;
        }
        public function hydrate ($data){
                $this->setId($data['idPokemon']);
                $this->setAge($data['age']);
                $this->setSex($data['sex']);
                $this->setWeight($data['weight']);
                $this->setHeight($data['height']);
                $this->setHealth($data['health']);
                $this->setHungry($data['hungry']);
                $this->setSleepy($data['sleepy']);
                $this->setSick($data['sick']);
                $this->setFenceId($data['fence_id']);
        }

        public function showPokemon($fenceId, $employee){
                $sex = "";
                $priceFeed = round(2 + (1 + ($this->getWeight() / 50)));
                $fences = $employee->findCompatibleFences($this);
                $imgMoney = "<img src='images/pokedollar.png' height='20px' />";
                if ($this->getSex() == "female"){
                        $sex = '<i class="fa-solid fa-venus" style="color: #dc8add;"></i>';
                }
                else {
                        $sex = '<i class="fa-solid fa-mars" style="color: #1c71d8;"></i>';
                }
                echo('<div class="card text-center" style="width: 17rem;">
                <img src="' . $this->getAvatar() . '" class="col-4 offset-4" alt="' . $this->getNameSpecies() . '" height="100px" >
                <div class="card-body">
                    <h5 class="card-title">' . $this->getNameSpecies() . ' ' . $sex . '</h5>' . $this->getHealth() . ' <i class="fa-solid fa-heart" style="color: #e01b24;"></i>
                    <p class="card-text">'. $this->showStateOfPokemon($fenceId) .'</p>');
                    if ($this->getHungry() === true) {
                        echo('<a href="process/processFeedPokemon.php?id='. $this->getId() .'&fenceId=' . $this->getFenceId() . '&price=' . $priceFeed . '" class="btn btn-primary">Nourrir : '. $priceFeed . ' ' . $imgMoney .'</a>');
                    }
                    if ($this->getSleepy() === true) {
                        echo('<a href="process/processSleepPokemon.php?id='. $this->getId() .'&fenceId=' . $this->getFenceId() . '" class="btn btn-primary">Reposer</a>');
                    }
                    if (($this->getSick() === true) || ($this->getHealth() < 100)) {
                        echo('<a href="process/processHealPokemon.php?id='. $this->getId() .'&fenceId=' . $this->getFenceId() . '&price=10" class="btn btn-primary">Soigner : 10 '. $imgMoney .'</a>');
                    }
                echo('</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Type : ' . $this->getFirstType()); 
                if ($this->getSecondType() !== "none") {
                        echo('/' . $this->getSecondType()); 
                };
                echo('</li>
                    <li class="list-group-item">Âge : ' . $this->getAge() . ' jours, <br/>Poids: ' . $this->getWeight() . ' kg, Taille: ' . $this->getHeight() . ' cm</li>
                </ul>
                <div class="card-body d-flex justify-content-center">
                        <button type="button" id="movePokemon'. $this->getId().'" class="btn btn-primary  mt-2" data-bs-toggle="modal" data-bs-target="#moveModal'. $this->getId().'">
                                Déplacer le pokemon : -5 <img src="images/pokedollar.png" height="20px" />
                        </button>
                </div>
                </div>');

                echo('<div class="modal fade" id="moveModal'. $this->getId().'" tabindex="-1" aria-labelledby="moveModalLabel'. $this->getId().'" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="moveModalLabel'. $this->getId().'">Déplacer un pokemon de l\'enclos</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <form action="process/movePokemonFromFence.php" method="POST" class="text-center m-4">
                                <input type="hidden" value="' . $fenceId . '" name="fenceId">
                                <input type="hidden" value="'. $this->getId() .'" name="pokemonId">
                                <label for="newFence" class="mt-1">Choisissez un enclos </label>
                                <select name="newFenceId" id="newFence" required>');
                                    echo('<option value="" selected disabled hidden>Choisir</option>
                                    <option value="1">Réserve</option>');
                                    foreach($fences as $fence) {
                                        echo('<option value="'. $fence->getId() . '">' . $fence->getName() . '</option>');
                                        };
                echo('</select>
                                <input type="submit" value="Enlever de l\'enclos" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
                </div>');
        }

        public function showStateOfPokemon($fenceId){
                $state = "";
                if ($this->getSleepy() === true) {
                        $state .= $this->getNameSpecies() . " a sommeil";
                        if ($this->getHungry() === true) {
                                $state .= ", a faim";
                                if ($this->getSick() === true) {
                                        $state .= ", est malade";
                                }
                        }
                        else if ($this->getSick() === true) {
                                $state .= ", est malade";
                        }
                }
                else if ($this->getHungry() === true) {
                        $state = $this->getNameSpecies() . " a faim";
                        if ($this->getSick() === true) {
                                $state .= ", est malade ";
                        }
                }
                else if ($this->getSick() === true){
                        $state = $this->getNameSpecies() . " est malade";
                }
                else {
                        $state= $this->move($fenceId);
                }
                return $state;
        }

        public function gainWeight($type){
                $maxWeight = $type::$maxWeight;

                if ($this->getWeight() < $maxWeight) {
                $gainWeight = $maxWeight * 0.3;
                        if ($this->getHungry() === true) {
                                $this->setWeight(($this->getWeight()) + ($gainWeight * 0.3));
                        }
                        else {
                                $this->setWeight(($this->getWeight()) + ($gainWeight));
                        }}
                return $this->getWeight();
        }
        public function gainHeight($type){
                $maxHeight = $type::$maxHeight;

                if ($this->getHeight() < $maxHeight) {
                $gainHeight = $maxHeight * 0.3;
                        if ($this->getSick() === true) {
                                $this->setHeight(($this->getHeight()) + ($gainHeight * 0.5));
                        }
                        else {
                                $this->setHeight(($this->getHeight()) + ($gainHeight));
                        }}
                return $this->getHeight();
        }

        public function checkHealth(){
                $health = $this->getHealth();
                if($this->getHungry() === true) {
                        $health -= 5;
                }
                if ($this->getSick() === true) {
                        $health -= (rand(10, 15));
                }
                if ($this->getFenceId() == 1){
                        $health -= (rand(10, 20));
                }
                $this->setHealth($health);
                return $this->getHealth();
        }

        public function gainState() {
                if($this->getHungry() === false) {
                        $random = rand(0, 10);
                        if ($random > 5) {
                                $this->setHungry(true);
                        }
                }
                if ($this->getSick() === false) {
                        $random = rand(0, 10);
                        if (($random > 6) && ($this->getHungry() === true)) {
                                $this->setHungry(true);
                        }
                        else if ($random > 8) {
                                $this->setSick(true);
                        }
                }
                if ($this->getSleepy() === false) {
                        $random = rand(0, 10);
                        if ($random > 7) {
                                $this->setSleepy(true);
                        }
                }
        }
}
?>