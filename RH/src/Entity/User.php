<?php

namespace App\Entity;
use FOS\UserBundle\Model\User as BaseUser;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->date = new \DateTime();
        // your own logic
    }

    /**
     * Random string
     * @ORM\Column(name="prenom", type="string", length=255)
     * @var string
     */
    protected $prenom;
    /**
     * Random string
     * @ORM\Column(name="secteur", type="string", length=255)
     * @var string
     */
    protected $secteur;
    /**
     * Random date
     * @ORM\Column(name="date", type="date")
     * @var string
     */
    protected $date;
    /**
     * Random string
     * @ORM\Column(name="ville", type="string", length=255)
     * @var string
     */
    protected $ville;
    /**
     * Random string
     * @ORM\Column(name="tl", type="string", length=255)
     * @var string
     */
    protected $tl;
    /**
     * Random string
     * @ORM\Column(name="pays", type="string", length=255)
     * @var string
     */
    protected $pays;

    /**
     * Random string
     * @ORM\Column(name="cin", type="string", length=255)
     * @var string
     */
    protected $cin;
    /**
     * Random string
     * @ORM\Column(name="situationfamiliale", type="string", length=255)
     * @var string
     */
    protected $situationfamiliale;
    /**
     * Random string
     * @ORM\Column(name="nbenfants", type="string", length=255)
     * @var string
     */
    protected $nbenfants;
    /**
     * Random string
     * @ORM\Column(name="lieunaissance", type="string", length=255)
     * @var string
     */
    protected $lieunaissance;
    /**
     * Random string
     * @ORM\Column(name="nationalite", type="string", length=255)
     * @var string
     */
    protected $nationalite;
    /**
     * Random string
     * @ORM\Column(name="numtlfixe", type="string", length=255)
     * @var string
     */
    protected $numtlfixe;
    /**
     * Random string
     * @ORM\Column(name="adressepersonelle", type="string", length=255)
     * @var string
     */
    protected $adressepersonelle;
    /**
     * Random string
     * @ORM\Column(name="rue", type="string", length=255)
     * @var string
     */
    protected $rue;
    /**
     * Random string
     * @ORM\Column(name="cite", type="string", length=255)
     * @var string
     */
    protected $cite;
    /**
     * Random string
     * @ORM\Column(name="codepostal", type="string", length=255)
     * @var string
     */
    protected $codepostal;
    /**
     * Random string
     * @ORM\Column(name="gouvernorat", type="string", length=255)
     * @var string
     */
    protected $gouvernorat;
    /**
     * Random string
     * @ORM\Column(name="numcnss", type="string", length=255)
     * @var string
     */
    protected $numcnss;
    /**
     * Random string
     * @ORM\Column(name="etape", type="string", length=255)
     * @var string
     */
    protected $etape;

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return User
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }






    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set secteur
     *
     * @param string $secteur
     *
     * @return User
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur
     *
     * @return string
     */
    public function getSecteur()
    {
        return $this->secteur;
    }


    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set tl
     *
     * @param string $tl
     *
     * @return User
     */
    public function setTl($tl)
    {
        $this->tl = $tl;

        return $this;
    }

    /**
     * Get tl
     *
     * @return string
     */
    public function getTl()
    {
        return $this->tl;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return User
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return User
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getNumcnss()
    {
        return $this->numcnss;
    }

    /**
     * @param string $numcnss
     */
    public function setNumcnss($numcnss)
    {
        $this->numcnss = $numcnss;
    }

    /**
     * @return string
     */
    public function getSituationfamiliale()
    {
        return $this->situationfamiliale;
    }

    /**
     * @param string $situationfamiliale
     */
    public function setSituationfamiliale($situationfamiliale)
    {
        $this->situationfamiliale = $situationfamiliale;
    }

    /**
     * @return string
     */
    public function getNbenfants()
    {
        return $this->nbenfants;
    }

    /**
     * @param string $nbenfants
     */
    public function setNbenfants($nbenfants)
    {
        $this->nbenfants = $nbenfants;
    }

    /**
     * @return string
     */
    public function getLieunaissance()
    {
        return $this->lieunaissance;
    }

    /**
     * @param string $lieunaissance
     */
    public function setLieunaissance($lieunaissance)
    {
        $this->lieunaissance = $lieunaissance;
    }

    /**
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * @param string $nationalite
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
    }

    /**
     * @return string
     */
    public function getNumtlfixe()
    {
        return $this->numtlfixe;
    }

    /**
     * @param string $numtlfixe
     */
    public function setNumtlfixe($numtlfixe)
    {
        $this->numtlfixe = $numtlfixe;
    }

    /**
     * @return string
     */
    public function getAdressepersonelle()
    {
        return $this->adressepersonelle;
    }

    /**
     * @param string $adressepersonelle
     */
    public function setAdressepersonelle($adressepersonelle)
    {
        $this->adressepersonelle = $adressepersonelle;
    }

    /**
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param string $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return string
     */
    public function getCite()
    {
        return $this->cite;
    }

    /**
     * @param string $cite
     */
    public function setCite($cite)
    {
        $this->cite = $cite;
    }

    /**
     * @return string
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * @param string $codepostal
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;
    }

    /**
     * @return string
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * @param string $gouvernorat
     */
    public function setGouvernorat($gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;
    }

    /**
     * @return string
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * @param string $etape
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;
    }
}
