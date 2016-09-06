<?php

namespace VirtualHealthBundle\Entity;

/**
 * Source
 */
class Source
{
    /**
     * @var integer
     */
    private $cx;

    /**
     * @var string
     */
    private $rx;

    /**
     * @var string
     */
    private $title;


    /**
     * Set cx
     *
     * @param integer $cx
     *
     * @return Source
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
     * Set rx
     *
     * @param string $rx
     *
     * @return Source
     */
    public function setRx($rx)
    {
        $this->rx = $rx;

        return $this;
    }

    /**
     * Get rx
     *
     * @return string
     */
    public function getRx()
    {
        return $this->rx;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Source
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rel
     *
     * @param \VirtualHealthBundle\Entity\Rel $rel
     *
     * @return Source
     */
    public function addRel(\VirtualHealthBundle\Entity\Rel $rel)
    {
        $this->rel[] = $rel;

        return $this;
    }

    /**
     * Remove rel
     *
     * @param \VirtualHealthBundle\Entity\Rel $rel
     */
    public function removeRel(\VirtualHealthBundle\Entity\Rel $rel)
    {
        $this->rel->removeElement($rel);
    }

    /**
     * Get rel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRel()
    {
        return $this->rel;
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
