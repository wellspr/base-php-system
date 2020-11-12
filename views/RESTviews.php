<?php

    $file = $contentDirectory . "/" . $contentFileName . ".php";
    if (file_exists($file)) {
        include_once $file;
    }
