<?php

class JX_DateInterval{
    private $flags, $interval, $date;
    public function __construct()
    {
        $this->date = new DateTime();
    }
    public function getd_Last($num = null){
        $rem = $this->date->sub(new DateInterval("PnumD"));

        return get_default_date($rem);
        
    }
}