<?php

class Newsmapper {
    
    private $dbh = null;
    
    const TABLE = 'news';
    
    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
    }
    
    public function find(){
        $sql = 'SELECT * FROM '.self::TABLE.' WHERE id = ?';
        $stmt = $this->dbh->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'News');
        $stmt->execute(array($id));
        getDebug($this->dbh, $stmt);
        $data = $stmt->fetch();
        $stmt = null;
        return $data;        
    }
    public function findByString($str){
        $sql = 'SELECT * FROM '.self::TABLE.' WHERE headline LIKE ? OR textbody LIKE ?';
        $stmt = $this->dbh->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'News');
        $stmt->execute(array($str, $str));
        getDebug($this->dbh, $stmt);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function findLatest(){
        $sql = 'SELECT * FROM news WHERE status > 0 ORDER BY id DESC LIMIT 3';
        $stmt = $this->dbh->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'News');
        getDebug($this->dbh, $stmt);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function findAll(){
        $sql = 'SELECT * FROM '.self::TABLE;
        $stmt = $this->dbh->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'News');
        getDebug($this->dbh, $stmt);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function save(){
        
    }
    private function insert(){
        
    }
    public function update(){
        
    }
    public function delete(News $news){
        
        $sql = 'DELETE FROM '.self::TABLE.' WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($news->getId()));
        
        getDbDebugger($this->$dbh);
        if ($stmt->rowCount() > 0) {
            unlink(IMAGE_PATH.$news->getImage());
            return true;
        } 
        return false;
    } 
    
}
