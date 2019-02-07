<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="theme",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="themes_name_place_unique", columns={"name"})}
 * )
 */
class Theme
{
    /**
     * @ORM\Column(type="string")
     */protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Place", mappedBy="themes")
     * @var Place
     */protected $places;

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @var string
     */private $id;

    public function __construct(){
        $this->places = new ArrayCollection();
    }

    /**
     * @return mixed
     */public function getId(){
    return $this->id;
}

    /**
     * @param $id
     * @return $this
     */public function setId($id){
    $this->id = $id;
    return $this;

}

    /**
     * @return mixed
     */public function getName(){
    return $this->name;
}

    /**
     * @param $name
     * @return $this
     */public function setName($name){
    $this->name = $name;
    return $this;

}


    /**
     * @param Place $place
     * @return Theme
     */public function addPlace(Place $place): self{
    if (!$this->places->contains($place)) {
        $this->places[] = $place;
    }

    $place->setThemes($this);

     return $this;
    }

    /**
     * @param Place $place
     * @return Theme
     */public function removePlace(Place $place): self{
    $this->places->removeElement($place);
    $this->setPlaces(null);

    return $this;
}

    /**
     * @return Place
     */public function getPlaces(): Place{
    return $this->places;
}

    /**
     * @param Place $places
     */public function setPlaces(Place $places){
    $this->places = $places;
}
}