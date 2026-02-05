<?php

class JP_Pagelist extends JXP_list implements JP_list{
    private $_result;
    public function __construct($filter = null)
    {
        global $JX_db,$BLOG_URL;

        if($filter !== null){
            $sql = "SELECT* FROM `posts` WHERE `type` = 'page' AND `status`= '$filter' AND `blog`='$BLOG_URL'";
            $this->_result = $JX_db->query($sql);
        }else{
            $sql = "SELECT* FROM `posts` WHERE `type` = 'page' AND `blog`='$BLOG_URL'";
            $this->_result = $JX_db->query($sql);
        }
       
    }

    public function GetArray(){
        return $this->_result;
    }

    public function getName($data){
        return $data['title'];
    }
    public function getKeyword($data)
    {
        return $data['keywords'];;
    }
    public function getBlog($data)
    {
        return $data['blog'];
    }
    public function getDataf($data)
    {
        return $data['data'];
    }
    public function getowner($data){
        return $data['owner'];
    }

    public function getDateAll($data)
    {
        return [
            'created' => $data['date_created'],
            'updated' => $data['date_updated']
        ];
    }

    public function getCat($data)
    {
        return $data['cat'];
    }

    public function getImage($data)
    {
        return $data['image'];
    }
    public function getType($data)
    {
        return $data['type'];
    }
   
    public function getContent($data){
        return $data['content'];
    }
    public function getId($data){
        return $data['id'];
    }
    
    public function getAuthor($data){
        return $data['author'];
    }
    public function getCommentNum($id){
        global $JX_db;
        $sql2 = "SELECT *FROM `comments` WHERE `post_id`=$id";
        $re = $JX_db->query($sql2);
        return $re->num_rows;
    }

    public function ExeAll(){
        $result = $this->_result;
        foreach($result as $r){
            $this->_names[]  = $r['title'];
            $this->_contents[]  = $r['content'];
            $this->_ids[]  = $r['id'];
            $this->_owners[]  = $r['owner'];
            $this->_Images[]  = $r['image'];
            $this->_blogs[] = $r['blog'];
            $this->_authors[] = $r['author'];
            $this->_cats [] = $r['cat'];

            $this->_types[]  = $r['type'];
            
            $this->_dates [] = [
                'updated' => $r['date_updated'],
                'created' => $r['date_created'] ];

        }
    }

    
    
}