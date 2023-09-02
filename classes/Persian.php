<?php
class Persian extends Pokemon {
    private int $speciesId;
    private string $nameSpecies;
    private string $diet;
    private string $firstType;
    private string $secondType;
    private string $avatar;
    public static $minWeight = 4;
    public static $minHeight = 40;
    public static $maxWeight = 32;
    public static $maxHeight = 100;
    public static $lifeExpectancy = 18;
    public static $popularity = 30;
    public static $babyId = 66;

    /**
     * Get the value of species_id
     */
    public function getSpeciesId(): int
    {
        return $this->speciesId;
    }

    /**
     * Set the value of speciesId
     */
    public function setSpeciesId(int $speciesId): self
    {
        $this->speciesId = $speciesId;

        return $this;
    }

    /**
     * Get the value of nameSpecies
     */
    public function getNameSpecies(): string
    {
        return $this->nameSpecies;
    }

    /**
     * Set the value of nameSpecies
     */
    public function setNameSpecies(string $nameSpecies): self
    {
        $this->nameSpecies = $nameSpecies;

        return $this;
    }

    /**
     * Get the value of diet
     */
    public function getDiet(): string
    {
        return $this->diet;
    }

    /**
     * Set the value of diet
     */
    public function setDiet(string $diet): self
    {
        $this->diet = $diet;

        return $this;
    }

    /**
     * Get the value of firstType
     */
    public function getFirstType(): string
    {
        return $this->firstType;
    }

    /**
     * Set the value of firstType
     */
    public function setFirstType(string $firstType): self
    {
        $this->firstType = $firstType;

        return $this;
    }

    /**
     * Get the value of secondType
     */
    public function getSecondType(): string
    {
        return $this->secondType;
    }

    /**
     * Set the value of secondType
     */
    public function setSecondType(string $secondType): self
    {
        $this->secondType = $secondType;

        return $this;
    }

    /**
     * Get the value of avatar
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
    public function __construct (array $data){
        $this->hydrate($data);
    }
    public function hydrate ($data) {
        parent::hydrate($data);
        $this->setSpeciesId($data['species_id']);
        $this->setNameSpecies($data['name']);
        $this->setDiet($data['diet']);
        $this->setFirstType($data['Type1']);
        if ($data['Type2'] !== null){
            $this->setSecondType($data['Type2']);
        } 
        else {
            $this->setSecondType("none");
        }
        $this->setAvatar($data['avatar']);
    }

    public function move($fenceId){
        if($fenceId == 1){
            $state = $this->getNameSpecies(). " s'ennuie dans la réserve.";
        }
        else {
        $state = $this->getNameSpecies(). " s'allonge avec paresse sur le sol";
        }
        return $state;
    }
}
?>