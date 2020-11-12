<?php

namespace Router;

class Response
{

    public function render($path, $obj)
    {
        foreach ($obj as $key => $value) {
            ${$key} = $value;
        }

        require "views/" . $path . ".php";

        exit;

    }

    public function send($str)
    {
        echo $str;

        exit;
    }

    public function redirect($url)
    {
        echo <<<EXCERPT

        <script>
            window.location.replace(" $url ");
        </script>
        
EXCERPT;
        exit;
    }

}
