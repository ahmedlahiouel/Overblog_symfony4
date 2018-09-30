<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguesRepository")
 */
class Langues
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
    private $langues;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveaux;
    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinColumn(name="User_id",referencedColumnName="id",onDelete="cascade")
     */
    private $user;

    public function getId()
    {
        return $this->id;
    }

    public function getLangues(): ?string
    {
        return $this->langues;
    }

    public function setLangues(string $langues): self
    {
        $this->langues = $langues;

        return $this;
    }

    public function getNiveaux(): ?string
    {
        return $this->niveaux;
    }

    public function setNiveaux(string $niveaux): self
    {
        $this->niveaux = $niveaux;

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
