<?php

    function view($path, $data = [])
    {

     extract($data);

     $file = __DIR__ . "/../app/Views/" . $path . ".php";

     if(!file_exists($file)){
        throw new Exception("View {$path} not found");
    }

        require $file;

    }

    function csrf_field(){
        $token = \Core\CSRF::token();

        return '<input type="hidden" name="_token" value="'.$token.'">';
    }

    function old($key)
    {
        return $_SESSION['old'][$key] ?? '';
    }

    function error($key)
    {  
        return $_SESSION['errors'][$key][0] ?? '';
    }