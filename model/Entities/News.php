<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM,
Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News {
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;
    
    /**
     * @ORM\Column(type="string", length=200)
     */
    private $headline;
    
    /**
     * @ORM\Column(type="string")
     */
    private $textbody;
    
    /**
     * @ORM\Column(type="string", length=200, nullable=true) 
     */
    private $image;
    
    /**
     * @ORM\ManyToOne(targetEntity="Entities\Category", inversedBy="news") 
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Entities\User", inversedBy="news") 
     */
    private $user;

    /**
     * @ORM\Column(type="smallint") 
     */
    private $status;
    //private $benutzerId;
    
    
    function getId() {
        return $this->id;
    }

    function getCreated() {
        return $this->created;
    }

    function getHeadline() {
        return $this->headline;
    }

    function getTextbody() {
        return $this->textbody;
    }

    function getImage() {
        return $this->image;
    }

    function getStatus() {
        return $this->status;
    }

    /*function getBenutzerId() {
        return $this->benutzerId;
    }*/

    function setId($id) {
        $this->id = $id;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function setHeadline($headline) {
        $this->headline = $headline;
    }

    function setTextbody($textbody) {
        $this->textbody = $textbody;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    
    public function getCategory() {
        return $this->category;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    
    /*function setBenutzerId($userId) {
        $this->benutzerId = $userId;
    }*/


}

