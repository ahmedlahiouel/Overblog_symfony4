<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmploisRepository")
 */
class Emplois
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $embauche;

    /**
     * @ORM\Column(type="date")
     */
    private $depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etablissement;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secteur;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fonction;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salaire_net;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motif_depart;
    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinColumn(name="User_id",referencedColumnName="id",onDelete="cascade")
     */
    private $user;




    public function getId()
    {
        return $this->id;
    }

    public function getEmbauche(): ?\DateTimeInterface
    {
        return $this->embauche;
    }

    public function setEmbauche(\DateTimeInterface $embauche): self
    {
        $this->embauche = $embauche;

        return $this;
    }

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->depart;
    }

    public function setDepart(\DateTimeInterface $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function setEtablissement(string $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return mixed
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * @param mixed $secteur
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;
    }

    /**
     * @return mixed
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * @param mixed $fonction
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
    }

    /**
     * @return mixed
     */
    public function getSalaireNet()
    {
        return $this->salaire_net;
    }

    /**
     * @param mixed $salire_net
     */
    public function setSalaireNet($salaire_net)
    {
        $this->salaire_net = $salaire_net;
    }

    /**
     * @return mixed
     */
    public function getMotifDepart()
    {
        return $this->motif_depart;
    }

    /**
     * @param mixed $motif_depart
     */
    public function setMotifDepart($motif_depart)
    {
        $this->motif_depart = $motif_depart;
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
