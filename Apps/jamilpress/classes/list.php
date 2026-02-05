<?php

interface JP_list{
    public function getNames();
    public function getContents();
    public function getIds();
    public function getowners();
    public function getImages();
    public function getAuthors();   
}

class JXP_list{
    protected $_names = [],$_dates = [],$_types = [], $_Images =[] ,$_blogs = [],$_cats = [];
    protected $_contents = [], $_ids = [],$_keyword = [],$_data = [], $_owners = [], $_authors = [];
    protected function setNames( $names = []){
        $this->_names[] = $names;
    }
    protected function setContents($contents = []){
        $this->_contents = $contents;
    }
    protected function setIds(){}
    protected function setowners(){}
    protected function setAuthors(){}
    
    public function getKeywords()
    {
        return $this->_keyword;
    }
    public function getBlogs()
    {
        return $this->_blogs;
    }
    public function getData()
    {
        return $this->_data;
    }
    public function getowners(){
        return $this->_owners;
    }

    public function getDates()
    {
        return $this->_dates;
    }

    public function getCats()
    {
        return $this->_cats;
    }

    public function getImages()
    {
        return $this->_Images;
    }
    public function getTypes()
    {
        return $this->_types;
    }
    public function getNames(){
        return $this->_names;
    }
    public function getContents(){
        return $this->_contents;
    }
    public function getIds(){
        return $this->_ids;
    }
    
    public function getAuthors(){
        return $this->_authors;
    }
}
