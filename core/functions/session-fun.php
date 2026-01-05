<?php

function is_session_start(){
    if(session_start() == true){
       return true;
  
      }else{
  
return false;  
      }
}