<?php

class Theme
{
    public static function checkTheme(){
        if (!isset($_COOKIE['mode'])) {
            setcookie('mode', 'dark', time() + (86400 * 30), "/");
        }
    }


    public static function changeTheme(){
        if($_COOKIE['mode'] == 'dark'){
            $_COOKIE['mode'] == 'light';
        }else{
            $_COOKIE['mode'] == 'dark';
        }
    }
}