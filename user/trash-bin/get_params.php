<?php

if(isset($_GET['name'])){

  echo "<h1> Hello " . $_GET['name'] . " </h1>";

}


if(isset($_GET)){

echo '<h1>Query parameters:</h1>';

  foreach ($_GET as $key => $value) {
    echo $key . ": " . $value . "<br>";
  }

}
