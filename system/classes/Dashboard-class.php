<?php

class JX_Dashboard{
    public $Sidebar, $List, $Nav, $etc;

    public function getSidebar(){
        return $this->Sidebar = new JX_Sidebar();
    }
}


class JX_DSidebar extends JX_Sidebar{
    
}