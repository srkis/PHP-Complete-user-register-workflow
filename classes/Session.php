<?php

class Session{

    public function start()
    {
        if(empty(session_id()) && session_status() == PHP_SESSION_NONE){
            session_start();
        }else{

            return false;
        }
    }

    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public function get($key)
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{

            return false;
        }
    }

    public function checkSession()
    {
        $this->start();
        if(!$this->get("userLogin")){
          $this->destroy();
        }else{
           return true;
        }
    }

    public function destroy()
    {
        session_unset();
        session_destroy();
        header("Location:index.php");
    }

    public function checkLogin()
    {
        $this->start();
        if($this->get("userLogin")){
            return true;
        }else{
            header("Location:index.php");
        }

    }


}