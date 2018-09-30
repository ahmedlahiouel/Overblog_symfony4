<?php

namespace test\testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Qcm
 *
 * @ORM\Table(name="qcm")
 * @ORM\Entity(repositoryClass="test\testBundle\Repository\QcmRepository")
 */
class Qcm
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="enance", type="string", length=255)
     */
    private $enance;

    /**
     * @var int
     *
     * @ORM\Column(name="note_accepter", type="integer")
     */
    private $noteAccepter;


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
     * @return Qcm
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
     * Set noteAccepter
     *
     * @param integer $noteAccepter
     *
     * @return Qcm
     */
    public function setNoteAccepter($noteAccepter)
    {
        $this->noteAccepter = $noteAccepter;

        return $this;
    }

    /**
     * Get noteAccepter
     *
     * @return int
     */
    public function getNoteAccepter()
    {
        return $this->noteAccepter;
    }


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Qcm
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
    }


}
