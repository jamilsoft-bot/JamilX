<?php

class JP_Blog extends JXP_Content implements JP_Content{
    private $_Array,$_summary, $_bkeywords, $_theme, $_setting,$url;
    public function __construct($url = null)
    {
        if(!is_null($url)){
            $this->url = $url;
            global $JX_db;
        //$intid = intval($id);
        $sql = "SELECT* FROM `blogs` WHERE `url`= '$url' AND  `type` = 'blog'";
        $result = $JX_db->query($sql);
        $this->_Array = $result;
        foreach($result as $r){
            $this->_name  = $r['name'];
            $this->_content  = $r['description'];
            $this->_id = $r['id'];
            $this->_owner  = $r['owner'];
            $this->_Image  = $r['logo'];
            $this->_theme = $r['theme'];
            $this->_data = $r['data'];
            $this->_summary = $r['summary'];
            $this->_keywords = $r['keywords'];
            $this->_author = $r['author'];
            $this->_cat = $r['category'];

            $this->_type  = $r['type'];
            
            $this->_date = [
                'updated' => $r['date_update'],
                'created' => $r['date_reg'] ];

        }
        }else{
            return null;
        }
    }
    
    
    public function check(){
        $url = $this->url;
        global $JX_db;
        $sql = "SELECT* FROM `blogs` WHERE `url`= '$url' AND  `type` = 'blog'";
        $result = $JX_db->query($sql);
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    public function getAll(){
        return $this->_All;
    }

    public function getArray(){
        return $this->_Array;
    }

    // public function getKeywords()
    // {
    //     return $this->_bkeywords;
    // }
    public function getTheme()
    {
        return $this->_theme;
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
    public function getSummary(){
        return $this->_summary;
    }
    
    public function getAuthor(){
        return $this->_author;
    }

    // public function getCommentNum($id){
    //     global $JX_db;
    //     $sql2 = "SELECT *FROM `comments` WHERE `post_id`=$id";
    //     $re = $JX_db->query($sql2);
    //     return $re->num_rows;
    // }

}