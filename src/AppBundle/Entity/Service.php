<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="service", options={"comment":"Услуга"})
 */
class Service {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", options={"comment":"Название услуги, как его будет видеть пользователь"})
     */
    private $name;
    /**
     * @ORM\Column(type="string", options={"comment":"Шифр услуги, на основании которого будет формироваться роль"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Count", mappedBy="services")
     */
    private $counts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
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
     * @return Service
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Service
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
 
    /**
     * Add count
     *
     * @param \AppBundle\Entity\Count $count
     *
     * @return Service
     */
    public function addCount(\AppBundle\Entity\Count $count)
    {
        $this->counts[] = $count;

        return $this;
    }

    /**
     * Remove count
     *
     * @param \AppBundle\Entity\Count $count
     */
    public function removeCount(\AppBundle\Entity\Count $count)
    {
        $this->counts->removeElement($count);
    }

    /**
     * Get counts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCounts()
    {
        return $this->counts;
    }
}
