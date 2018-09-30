<?php

namespace test\testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="test\testBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\ManyToMany(targetEntity="Qcm")
     * @ORM\JoinColumn(name="qcm_id",referencedColumnName="id",onDelete="cascade")
     */
    private $Qcm;
    /**
     * @ORM\OneToOne(targetEntity="reponse")
     * @ORM\JoinColumn(name="reponse_correct_id",referencedColumnName="id",onDelete="cascade")
     */
    private $reponsecorrect;

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
     * @return Question
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
     * Set reponsecorrect
     *
     * @param \test\testBundle\Entity\reponse $reponsecorrect
     *
     * @return Question
     */
    public function setReponsecorrect(\test\testBundle\Entity\reponse $reponsecorrect = null)
    {
        $this->reponsecorrect = $reponsecorrect;

        return $this;
    }

    /**
     * Get reponsecorrect
     *
     * @return \test\testBundle\Entity\reponse
     */
    public function getReponsecorrect()
    {
        return $this->reponsecorrect;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Qcm = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Add qcm
     *
     * @param \test\testBundle\Entity\Qcm $qcm
     *
     * @return Question
     */
    public function addQcm(\test\testBundle\Entity\Qcm $qcm)
    {
        $this->Qcm[] = $qcm;

        return $this;
    }

    /**
     * Remove qcm
     *
     * @param \test\testBundle\Entity\Qcm $qcm
     */
    public function removeQcm(\test\testBundle\Entity\Qcm $qcm)
    {
        $this->Qcm->removeElement($qcm);
    }

    /**
     * Get qcm
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQcm()
    {
        return $this->Qcm;
    }
}
