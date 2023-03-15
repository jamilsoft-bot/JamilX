<?php

class searchx extends JX_Serivce implements JX_service{
    public function __construct()
    {
        $this->setTitle('Search Page');
    }
    public function main(){
        include('containers/searchpage.php');
    }

    public function postsearch($offset = 0){
        global $Url, $db;
        $q = $Url->post('q');
        $sql = "SELECT *FROM `campaigns` WHERE `title` LIKE '%$q%';";
        $result = $db->Query($sql);

        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($result as $dt) {
                $title = $dt['title'];
                $ct = strip_tags($dt['content']);
                $cp = substr($ct, 0, 200);
                $content = $cp;
                

                echo "<h3>$title </h3>";
                $blog = $dt['brand'];
                echo "<small class='w3-tag w3-green'> $blog</small>";
                echo "<p> $content...</p>";
                echo "<small class='w3-text-red'> Posts</small>";

                
            }
        }


    }

    public function sitesearch(){

        global $Url, $db;
        $q = $Url->post('q');
        $sql = "SELECT *FROM `campaigns`";
        $result = $db->Query($sql);

        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($result as $dt) {
                if (stristr($q, substr($dt['title'], 0, $len))) {
                $title = $dt['title'];
                $ct = strip_tags($dt['content']);
                $cp = substr($ct, 0, 200);
                $content = $cp;

                echo "<h3>$title</h3>";
                $blog = $dt['brand'];
                echo "<small class='w3-tag w3-green'> $blog</small>";
                echo "<p> $content...</p>";
                //echo "<small class='w3-text-red'> Posts</small>";
                }
            }
        }


        
    }

    public function offersearch(){

        global $Url, $db;
        $q = $Url->post('q');
        $sql = "SELECT *FROM `offers` WHERE `name` LIKE '%$q%'";
        $result = $db->Query($sql);

        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($result as $dt) {
                $title = $dt['name'];
                $ct = strip_tags($dt['content']);
                $cp = substr($ct, 0, 200);
                $content = $cp;

                echo "<h3>$title</h3>";
                $blog = $dt['brand'];
                echo "<small class='w3-tag w3-green'> $blog</small>";
                echo "<p> $content...</p>";
                echo "<small class='w3-text-blue'> Offers</small>";
            }
        }


        
    }

    public function productsearch(){
        global $Url, $db;
        $q = $Url->post('q');
        $sql = "SELECT *FROM `products` WHERE `name` LIKE '%$q%'";
        $result = $db->Query($sql);

        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($result as $dt) {
                $title = $dt['name'];
                $ct = strip_tags($dt['content']);
                $cp = substr($ct, 0, 200);
                $content = $cp;

                echo "<h3>$title</h3>";
                echo "<p> $content...</p>";
                $blog = $dt['brand'];
                echo "<small class='w3-tag w3-green'> $blog</small>";
                echo "<small class='w3-text-green'> Products</small>";
            }
        }


        
    }

    public function businesssearch(){
        global $Url, $db;
        $q = $Url->post('q');
        $sql = "SELECT *FROM `business`";
        $result = $db->Query($sql);

        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($result as $dt) {
                $json = $dt['data'];
                $data = json_decode($json);
                $name = $data->Bname;
                $des = $data->Bdec;
                if (stristr($q, substr($name, 0, $len))) {
                $title = $name;
                $ct = strip_tags($des);
                $cp = substr($ct, 0, 200);
                $content = $cp;

                echo "<h3>$title</h3>";
                echo "<p> $content...</p>";
                }
            }
        }


        
    }

}