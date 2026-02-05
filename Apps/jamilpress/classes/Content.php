<?php

interface JP_Content{
    public function getName();
    public function getContent();
    public function getId();
    public function getowner();
    public function getAuthor();   
}

class JXP_Content{
    protected $_name,$_content, $_id, $_owner, $_author;
    protected $_date,$_type, $_Image, $_blog, $_cat, $_All;
    protected  $_keywords, $_data;
    private function setName(){}
    private function setContent(){}
    private function setId(){}
    private function setowner(){}
    private function setAuthor(){} 

    public function getAll(){
        return $this->_All;
    }

    public function getKeywords()
    {
        return $this->_keywords;
    }
    public function getBlog()
    {
        return $this->_blog;
    }
    public function getData()
    {
        return $this->_data;
    }
    public function getowner(){
        return $this->_owner;
    }

    public function getDate()
    {
        return $this->_date;
    }

    public function getCat()
    {
        return $this->_cat;
    }

    public function getImage()
    {
        return $this->_Image;
    }
    public function getType()
    {
        return $this->_type;
    }
    public function getName(){
        return $this->_name;
    }
    public function getContent(){
        return $this->_content;
    }
    public function getId(){
        return $this->_id;
    }
    
    public function getAuthor(){
        return $this->_author;
    }
}
