<?php

namespace test\testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table(name="offre")
 * @ORM\Entity(repositoryClass="test\testBundle\Repository\OffreRepository")
 */
class Offre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="salaire", type="string", length=255)
     */
    private $salaire;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    /**
     * @ORM\ManyToOne(targetEntity="categorie")
     * @ORM\JoinColumn(name="categorie_id",referencedColumnName="id",onDelete="cascade")
     */
    private $categorie;
    /**
     * @ORM\ManyToOne(targetEntity="Qcm")
     * @ORM\JoinColumn(name="Qcm_id",referencedColumnName="id",onDelete="cascade")
     */
    private $Qcm;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Offre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Offre
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set salaire
     *
     * @param string $salaire
     *
     * @return Offre
     */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;

        return $this;
    }

    /**
     * Get salaire
     *
     * @return string
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Offre
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Offre
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set categorie
     *
     * @param \test\testBundle\Entity\categorie $categorie
     *
     * @return Offre
     */
    public function setCategorie(\test\testBundle\Entity\categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \test\testBundle\Entity\categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set qcm
     *
     * @param \test\testBundle\Entity\Qcm $qcm
     *
     * @return Offre
     */
    public function setQcm(\test\testBundle\Entity\Qcm $qcm = null)
    {
        $this->Qcm = $qcm;

        return $this;
    }

    /**
     * Get qcm
     *
     * @return \test\testBundle\Entity\Qcm
     */
    public function getQcm()
    {
        return $this->Qcm;
    }
}
