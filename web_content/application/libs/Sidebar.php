<?php

Class Sidebar{
    public static function adminFunction(){
        if ($_SESSION['role'] == 'Admin') {
            echo 'flex';
        } else {
            echo 'none';
        }
    }
    public static function sidebarActivate($page){
        if ($_SESSION['currentPage'] == $page) {
            echo 'active';
        }
    }
}
