<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
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
    private $rep;
    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinColumn(name="User_id",referencedColumnName="id",onDelete="cascade")
     */
    private $user;
    /**
     * @ORM\ManyToMany(targetEntity="Questions")
     * @ORM\JoinColumn(name="Questions_id",referencedColumnName="id",onDelete="cascade")
     */
    private $questions;
    public function getId()
    {
        return $this->id;
    }

    public function getRep(): ?string
    {
        return $this->rep;
    }

    public function setRep(string $rep): self
    {
        $this->rep = $rep;

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
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();

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
    /**
     * Set Questions
     *
     */
    public function setQuestions(\App\Entity\Questions $questions = null)
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * Get question
     *
     * @return \App\Entity\Questions
     */
    public function getQuestions()
    {
        return $this->questions;
    }
    /**
     * Add Questions
     *
     * @param \App\Entity\Questions $questions
     *
     */
    public function addQuestions(\App\Entity\Questions $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \App\Entity\Questions $Questions
     */
    public function removeQuestions(\App\Entity\Questions $questions)
    {
        $this->removeElement($questions);
    }
}
