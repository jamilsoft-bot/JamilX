<?php



class JX_Dashboard{
    public $Sidebar, $List, $Nav, $etc;

    public function getSidebar(){
        return $this->Sidebar = new JX_Sidebar();
    }
}


class JX_Sidebar{
    private $item = [];

    public function add($item){
        $this->item[] = $item;
    }

    public function get_list(){
        return $this->item;
    }
}

class JS_Sidebar{
    private $_label = array();
    private $_link = array();
    private $_icon = array();
    private $_labels = array();
    private $_links = array();
    private $_icons = array();

    public function add($link, $label,$icon ="fa fa-external-link-square-alt")
    {
        $this->_label[] = $label;
        $this->_link[] = $link;
        $this->_icon[] = $icon;
    }

    public function add_special($link, $label,$icon ="fa fa-external-link-square-alt")
    {
        $this->_labels[] = $label;
        $this->_links[] = $link;
        $this->_icons[] = $icon;
    }

    public function gethtml_s($classes = "w3-hover-black")
    {
        foreach($this->_labels as $key => $label){
           echo "<a href='?serve=".$this->_links[$key]."' class='w3-bar-item w3-button $classes'><i class='".$this->_icons[$key]."' style='padding-right:2pt;'></i>$label</a>";
            
            
        }

       
    }

    public function gethtml($classes = "w3-hover-black")
    {
        foreach($this->_label as $key => $label){
           echo "<a href='?serve=".$this->_link[$key]."' class='w3-bar-item w3-button $classes'><i class='".$this->_icon[$key]."' style='padding-right:2pt;'></i>$label</a>";
            
            
        }

       
    }

    public function getlinkArr()
    {
        return $this->_link;

       
    }

    public function getlabelArr()
    {
        return $this->_label;

       
    }

    public function getAll()
    {
        foreach($this->_label as $key => $label){
           echo "Label: $label<br>";
            echo "Link:". $this->_link[$key]."<br>";
            
        }

       
    }
}

class JX_DSidebar extends JX_Sidebar{
    
}

