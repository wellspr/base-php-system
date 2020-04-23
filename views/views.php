<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/partials/head.php")?>

<body>

<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . "/menu/menu.php");

    $file = $contentDirectory . "/" . $contentFileName . ".php";
    if (file_exists($file)) {
        include_once $file;
    }

?>

</body>

</html>
