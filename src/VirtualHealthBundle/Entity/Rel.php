<?php

namespace VirtualHealthBundle\Entity;

/**
 * Rel
 */
class Rel
{
    /**
     * @var integer
     */
    private $cx;

    /**
     * @var string
     */
    private $ndc;


    /**
     * Set cx
     *
     * @param integer $cx
     *
     * @return Rel
     */
    public function setCx($cx)
    {
        $this->cx = $cx;

        return $this;
    }

    /**
     * Get cx
     *
     * @return integer
     */
    public function getCx()
    {
        return $this->cx;
    }

    /**
     * Set ndc
     *
     * @param string $ndc
     *
     * @return Rel
     */
    public function setNdc($ndc)
    {
        $this->ndc = $ndc;

        return $this;
    }

    /**
     * Get ndc
     *
     * @return string
     */
    public function getNdc()
    {
        return $this->ndc;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $source;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->source = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add source
     *
     * @param \VirtualHealthBundle\Entity\Source $source
     *
     * @return Rel
     */
    public function addSource(\VirtualHealthBundle\Entity\Source $source)
    {
        $this->source[] = $source;

        return $this;
    }

    /**
     * Remove source
     *
     * @param \VirtualHealthBundle\Entity\Source $source
     */
    public function removeSource(\VirtualHealthBundle\Entity\Source $source)
    {
        $this->source->removeElement($source);
    }

    /**
     * Get source
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSource()
    {
        return $this->source;
    }
    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
