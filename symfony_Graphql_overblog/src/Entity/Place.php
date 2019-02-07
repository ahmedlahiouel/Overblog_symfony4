<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="place",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="places_name_unique",columns={"name"})}
 * )
 */
class Place
{
    /**
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="places", cascade={"persist"})
     * @ORM\JoinColumn(name="themes_id", referencedColumnName="id")
     * @var Theme[]
     *
     */protected $themes;

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @var string
     */private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */private $name;


    /**
     * Get id
     *
     * @return int
     */public function getId(){
    return $this->id;
}


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Place
     */public function setName($name){
    $this->name = $name;

    return $this;
}

    /**
     * Get name
     *
     * @return string
     */public function getName(){
    return $this->name;
}

    /**
     * @param string $created_at
     */public function setCreatedAt($created_at){
    $this->created_at = $created_at;
}

    /**
     * @return mixed
     */public function getThemes(): Theme{
    return $this->themes;
}


    /**
     * @param mixed $themes
     */public function setThemes($themes){
    $this->themes = $themes;
}

}