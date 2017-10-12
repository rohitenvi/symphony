<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catlisting
 *
 * @ORM\Table(name="catlisting")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CatlistingRepository")
 */
class Catlisting
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
     * @var int
     *
     * @ORM\Column(name="cat_top_id", type="integer")
     */
    private $catTopId;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_childs", type="text")
     */
    private $subChilds;


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
     * Set catTopId
     *
     * @param integer $catTopId
     *
     * @return Catlisting
     */
    public function setCatTopId($catTopId)
    {
        $this->catTopId = $catTopId;

        return $this;
    }

    /**
     * Get catTopId
     *
     * @return int
     */
    public function getCatTopId()
    {
        return $this->catTopId;
    }

    /**
     * Set subChilds
     *
     * @param string $subChilds
     *
     * @return Catlisting
     */
    public function setSubChilds($subChilds)
    {
        $this->subChilds = $subChilds;

        return $this;
    }

    /**
     * Get subChilds
     *
     * @return string
     */
    public function getSubChilds()
    {
        return $this->subChilds;
    }
}

