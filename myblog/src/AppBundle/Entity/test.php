<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\testRepository")
 */
class test
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
     * @ORM\Column(name="newscontent", type="text", nullable=true)
     */
    private $newscontent;


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
     * Set newscontent
     *
     * @param string $newscontent
     *
     * @return test
     */
    public function setNewscontent($newscontent)
    {
        $this->newscontent = $newscontent;

        return $this;
    }

    /**
     * Get newscontent
     *
     * @return string
     */
    public function getNewscontent()
    {
        return $this->newscontent;
    }
}

