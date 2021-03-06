<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="parentId", type="integer", nullable=true)
     */
    public $parentId;

    /**
     * @var int
     *
     * @ORM\Column(name="fixed", type="smallint")
     */
    private $fixed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdTime", type="datetimetz")
     */
    private $createdTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedTime", type="datetimetz")
     */
    private $updatedTime;

    /**
     * @var string
     *
     * @ORM\Column(name="topcategory", type="integer", nullable=true)
     */
    public $topcategory;

    /**
     * @var int
     *
     * @ORM\Column(name="deepest", type="smallint")
     */
    private $deepest;

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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

  
    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return Category
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

   
    
    /**
     * Set fixed
     *
     * @param integer $fixed
     *
     * @return Category
     */
    public function setFixed($fixed)
    {
        $this->fixed = $fixed;

        return $this;
    }

    /**
     * Get fixed
     *
     * @return int
     */
    public function getFixed()
    {
        return $this->fixed;
    }

    /**
     * Set createdTime
     *
     * @param \DateTime $createdTime
     *
     * @return Category
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;

        return $this;
    }

    /**
     * Get createdTime
     *
     * @return \DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * Set updatedTime
     *
     * @param \DateTime $updatedTime
     *
     * @return Category
     */
    public function setUpdatedTime($updatedTime)
    {
        $this->updatedTime = $updatedTime;

        return $this;
    }

    /**
     * Get updatedTime
     *
     * @return \DateTime
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }

 public function __toString() {
   
    return (string) $this->id;
    }
 

 /**
     * Set topcategory
     *
     * @param integer $topcategory
     *
     * @return Category
     */
    public function setTopcategory($topcategory)
    {
        $this->topcategory = $topcategory;

        return $this;
    }

    /**
     * Get topcategory
     *
     * @return int
     */
    public function getTopcategory()
    {
        return $this->topcategory;
    }

    /**
     * Set deepest
     *
     * @param integer $deepest
     *
     * @return Category
     */
    public function setDeepest($deepest)
    {
        $this->deepest = $deepest;

        return $this;
    }

    /**
     * Get deepest
     *
     * @return int
     */
    public function getDeepest()
    {
        return $this->deepest;
    }
}

