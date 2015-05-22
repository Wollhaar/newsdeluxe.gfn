<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */

class Category {
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=25) 
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Entities\News", mappedBy="category")
     */
    private $news;
    
    /**
     * @ORM\Column(type="smallint") 
     */
    private $status;
    
    public function __construct() {
        $this->news = new ArrayCollection;
    }
            function getId() {
        return $this->id;
    }

    function getNews() {
        return $this->news;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNews($news) {
        $this->news = $news;
    }

    function addNews(News $news) {
        $this->news = $news;
        
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }



    
}
