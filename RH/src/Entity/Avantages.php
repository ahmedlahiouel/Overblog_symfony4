<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvantagesRepository")
 */
class Avantages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avantage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_avantage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $frequence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $combien;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $formule_calcul;
    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinColumn(name="User_id",referencedColumnName="id",onDelete="cascade")
     */
    private $user;


    public function getId()
    {
        return $this->id;
    }

    public function getAvantage(): ?string
    {
        return $this->avantage;
    }

    public function setAvantage(string $avantage): self
    {
        $this->avantage = $avantage;

        return $this;
    }

    public function getNomAvantage(): ?string
    {
        return $this->nom_avantage;
    }

    public function setNomAvantage(string $nom_avantage): self
    {
        $this->nom_avantage = $nom_avantage;

        return $this;
    }

    public function getFrequence(): ?string
    {
        return $this->frequence;
    }

    public function setFrequence(string $frequence): self
    {
        $this->frequence = $frequence;

        return $this;
    }

    public function getCombien(): ?string
    {
        return $this->combien;
    }

    public function setCombien(string $combien): self
    {
        $this->combien = $combien;

        return $this;
    }

    public function getFormuleCalcul(): ?string
    {
        return $this->formule_calcul;
    }

    public function setFormuleCalcul(string $formule_calcul): self
    {
        $this->formule_calcul = $formule_calcul;

        return $this;
    }
    /**
     * Set user
     *
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get question
     *
     * @return \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add user
     *
     * @param \App\Entity\User $user
     *
     */
    public function addUser(\App\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \App\Entity\User $user
     */
    public function removeUser(\App\Entity\User $user)
    {
        $this->removeElement($user);
    }
}
