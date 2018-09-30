<?php

namespace test\testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="test\testBundle\Repository\reponseRepository")
 */
class reponse
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
     * @ORM\Column(name="enance", type="string", length=255)
     */
    private $enance;
    /**
     * @ORM\ManyToMany(targetEntity="Question")
     * @ORM\JoinColumn(name="question_id",referencedColumnName="id",onDelete="cascade")
     */
    private $question;

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
     * Set enance
     *
     * @param string $enance
     *
     * @return reponse
     */
    public function setEnance($enance)
    {
        $this->enance = $enance;

        return $this;
    }

    /**
     * Get enance
     *
     * @return string
     */
    public function getEnance()
    {
        return $this->enance;
    }

    /**
     * Set question
     *
     * @param \test\testBundle\Entity\Question $question
     *
     * @return reponse
     */
    public function setQuestion(\test\testBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \test\testBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->question = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add question
     *
     * @param \test\testBundle\Entity\Question $question
     *
     * @return reponse
     */
    public function addQuestion(\test\testBundle\Entity\Question $question)
    {
        $this->question[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \test\testBundle\Entity\Question $question
     */
    public function removeQuestion(\test\testBundle\Entity\Question $question)
    {
        $this->question->removeElement($question);
    }
}
