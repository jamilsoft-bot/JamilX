<?php

class JP_Page extends JXP_Content implements JP_Content{
    private $_Array, $_summary,$_status, $privacy;
    public function __construct($id = null)
    {
        if(!is_null($id)){
            global $JX_db;
        $intid = intval($id);
        $sql = "SELECT* FROM `posts` WHERE `id`= $intid AND  `type` = 'page'";
        $result = $JX_db->query($sql);
        $this->_Array = $result;
        foreach($result as $r){
            $this->_name  = $r['title'];
            $this->_content  = $r['content'];
            $this->_id = $r['id'];
            $this->_summary = $r['summary'];
            $this->_owner  = $r['owner'];
            $this->_status = $r['status'];
            $this->_privacy  = $r['privacy'];
            $this->_keywords  = $r['keywords'];
            $this->_Image  = $r['image'];
            $this->_blog = $r['blog'];
            $this->_author = $r['author'];
            $this->_cat = $r['cat'];

            $this->_type  = $r['type'];
            
            $this->_date = [
                'updated' => $r['date_updated'],
                'created' => $r['date_created'] ];

        }
        }else{
            $this->_All = new JP_Postlist();
        }
    }
    
    

    public function getAll(){
        return $this->_All;
    }

    public function getArray(){
        return $this->_Array;
    }

    public function getStatus(){
        return $this->_status;
    }
    public function getPrivacy(){
        return $this->_privacy;
    }

    
    public function getSummary(){
        return $this->_summary;
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

    public function getCommentNum($id){
        global $JX_db;
        $sql2 = "SELECT *FROM `comments` WHERE `post_id`=$id";
        $re = $JX_db->query($sql2);
        return $re->num_rows;
    }

}