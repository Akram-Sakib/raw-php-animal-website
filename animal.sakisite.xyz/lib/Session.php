<?php

class Session {
    
    public function init(){
        session_start();
    }

    public function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public function get($key){
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }else {
            return false;
        }
    }

    public function destroy(){
        session_destroy();
        header("Location: login.php");
    }

    public function checkLogin(){
        self::init();
        if(self::get("login") == true){
            header("Location: index.php");
        }
    }

    public function checkSession(){
        self::init();
        if(self::get("login") == false){
            self::destroy();
        }
    }

}

?>