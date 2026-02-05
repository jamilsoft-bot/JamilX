<?php

class JP_Stats{
    public function Get_yesterday($format){
        return JP_get_last("P1D",$format);
    }

    public function Get_last2Days($format){
        return JP_get_last("P2D",$format);
    }



}