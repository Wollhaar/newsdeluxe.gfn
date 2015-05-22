<?php


namespace Entities;

use Doctrine\ORM\Mapping as ORM,
 Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */

class User {
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    
    /**
     * @ORM\Column(type="string", length=25)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=32, unique=true)
     */
    private $password;
    
    /**
     * @ORM\OneToMany(targetEntity="Entities\News", mappedBy="user")
     */
    private $news;
    
    /**
     * @ORM\Column(type="smallint") 
     */
    private $status;

    public function __construct() {
        $this->news = new ArrayCollection;
    }
    public function getId() {
        return $this->id;
    }

    public function getNews() {
        return $this->news;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNews($news) {
        $this->news = $news;
    }

    function addNews(News $news) {
        $this->news->add($news);
        
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


}
