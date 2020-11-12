<?php

function displayObject($x)
{

    if($x){

        foreach ($x as $value) {

            // echo "<======================>";

            $array = [];
            $string = "";

            if (gettype($x)==='object') {

                $var = json_decode(json_encode(($value)), true);

                if (gettype($var)==='array') {

                    $array = $var;

                } else if (gettype($var)==='string') {

                    $string = $var;

                }

            }

            if (gettype($array)==='array'){

                displayArray($array);

            } else if (gettype($array)==='string') {

                displayString($array);

            }

        }

    } else {

        echo "Nada a exibir";

    }

}


function displayVar($var) {

    if (gettype($var)==='string'){

        displayString($var);

    } else if (gettype($var)==='array'){

        displayArray($var);

    }

}


function displayArray(array $array) {

    echo "<ul>";

    foreach ($array as $key => $value) {

        if (gettype($value)==='string') {

            echo "<li>" . ucfirst($key) . ": <span class='editable'>" . $value . "</span></li>";

        } else if (gettype($value)==='array') {

            echo "<li>" . ucfirst($key) . ": </li>";

            displayArray($value);

        }

    }

    echo "</ul>";
}


function displayString(string $string) {

    echo "<ul>";

    echo "<li>" . $string . "</li>";

    echo "</ul>";

}
