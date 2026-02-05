<?php

class JP_CommentList extends JXP_list implements JP_list{
    private $_result,$id;
    public function __construct($id)
    {
        global $JX_db;
        if($id !== null){
            $this->id= $id;
            
        $sql = "SELECT* FROM `comments` WHERE `post_id` = $id";
        $this->_result = $JX_db->query($sql);
        }
       
    }

    public function GetArray(){
        return $this->_result;
    }

    public function getName($data){
        return $data['author'];
    }
    public function getKeyword($data)
    {
       // return $data['keywords'];;
    }
    public function getBlog($data)
    {
       // return $data['blog'];
    }
    public function getDataf($data)
    {
        return $data['json'];
    }
    public function getowner($data){
        return $data['owner'];
    }

    public function getDateAll($data)
    {
        return [
            'created' => $data['date'],
            'updated' => null
        ];
    }

    public function getCat($data)
    {
        return $data['cat'];
    }

    public function getImage($data)
    {
        return null;
    }
    public function getEmail($data)
    {
        return $data['email'];
    }
   
    public function getContent($data){
        return  strip_tags(html_entity_decode($data['message']));
    }
    public function getId($data){
        return $data['id'];
    }
    
    public function getAuthor($data){
        return $data['author'];
    }
    public function getCommentNum(){
        global $JX_db;
        $sql2 = "SELECT *FROM `comments` WHERE `post_id`=$this->id";
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