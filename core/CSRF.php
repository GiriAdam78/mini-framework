<?php 

namespace Core;

class CSRF
{
    public static function token()
    {
        if(!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function validate()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $token = $_POST['_token'] ?? null;

            if(!$token || $token !== ($_SESSION['csrf_token'] ?? null)){
                throw new \Exception("CSRF token mismatch");
            }
        }
    }
}