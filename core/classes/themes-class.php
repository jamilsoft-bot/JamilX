<?php

class JS_Themes{

    public function ThemesList(){
        global $CONF_THEME_DIR;

        $themes = scandir($CONF_THEME_DIR,1);
        array_pop($themes);
        array_pop($themes);

        return $themes;

    }
}