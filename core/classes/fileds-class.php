<?php
class JS_Forms{
    public $action, $method, $name;
    private $_controls;

    public function TextFieldb4($name)
    {
      $data = "<div class='input-group mb-3'>";
      $data .= "<span class='input-group-text'>$name</span>";
      $data .= "<input type='text' name='$name' class='form-control' placeholder='Type your $name' aria-label='Username' aria-describedby='basic-addon1'></div>";
      $this->_controls .= $data;
      //return $data;
    }

    public function TextFieldw3($name)
    {
     
      $data  = "<label>$name</label>";
      $data .= "<input type='text' name='$name' class='w3-input w3-border' placeholder='Type your $name'></div>";
      $this->_controls .= $data;
    }
    public function load()
    {
        //$data = "<div class='w3-container'>\n";
        $data = "<form action='$this->action' method='$this->method' name='$this->name' >\n";
        $data .=$this->_controls;
        $data .="\n<input type='submit' value='submit'  class='w3-btn w3-blue' name='submit'/></form>\n";
        echo $data;

        
    }

}
class JS_Pages
{
    public $style, $class, $id, $name;
    public function h3($text)
    {
        return "<h3 class='$this->class'>$text</h3>";
    }

    public function input($type,$placeholder ='')
    {
        return "<input class='$this->class' type='$type' name='$this->name' placeholder='$placeholder'>";
    }
    
    public function h2($text)
    {
        return "<h2>$text</h2>";
    }
    public function h1($text)
    {
        return "<h1>$text</h1>";
    }

    public function p($text)
    {
        return "<p>$text</p>";
    }

    public function a($url,$text)
    {
        return "<a href='$url'>$text</a>";
    }

    public function card($html)
    {
        return "<div class='w3-card'>$html</h1></div>";
    }

    public function MainPanel($sidebar,$mainbody)
    {
        $data = "<div class='w3-row'>";
        $data .="<div class='w3-quarter'>";
        $data .=$sidebar;
        $data .="</div>";
        $data .="<div class='w3-rest'>";
        $data .=$mainbody;
        $data .="</div>";

        $data .="</div>";

        return $data;
    }

    public function alert($header,$body){
       $data =  "<div class='w3-panel w3-leftbar w3-animate-left w3-pale-green w3-xxlarge w3-serif w3-display-container'>";
       $data .= "<span onclick='this.parentElement.style.display=\"none\"' class='w3-button w3-display-topright'>X</span>";
       $data .=" <h3>$header</h3>";
       $data .=" <p>$body.</p></div>";

       return $data;
    }
}
