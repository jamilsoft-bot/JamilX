<?php

class JP_Catlist extends JXP_list implements JP_list{
    private $_result;
    public function __construct()
    {
        global $JX_db;
        $id  = intval($_SESSION['uid']);
        $sql = "SELECT* FROM `categories` WHERE `author`=$id";
        $this->_result = $JX_db->query($sql);
       
    }

    public function GetArray(){
        return $this->_result;
    }

    public function getName($data){
        return $data['name'];
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
            'created' => $data['date'],
            'updated' => $data['updated']
        ];
    }

    public function getCat($data)
    {
        return $data['parent'];
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
        return strip_tags($data['description']);
    }
    public function getId($data){
        return $data['id'];
    }
    
    public function getAuthor($data){
        global $JX_db, $users;
        $results = $JX_db->query($users->SelectById(intval($data['author'])));
        foreach($results as $r){
            return $r['name'];
        }
      //  return $data['author'];
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