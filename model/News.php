<?php

class News {
    private $id;
    private $created;
    private $headline;
    private $textbody;
    private $image;
    private $status;
    private $benutzerId;
    
    
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

    function getBenutzerId() {
        return $this->benutzerId;
    }

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

    function setBenutzerId($userId) {
        $this->benutzerId = $userId;
    }


}

