<?php

/* Converts a number of seconds to hours, minutes and seconds.

*/

function convert_seconds_to_hour($time){
    echo "Time diff in seconds: " . $time . "<br>";
    $numHours = $time / 3600;
    echo $numHours;
    echo "<br>";

    echo "Time diff in hours: " . (int)$numHours . "<br>";
    $numMinutes = ($time % 3600) / 60;
    echo $numMinutes;
    echo "<br>";

    echo "Time diff in minutes: " . (int)$numMinutes . "<br>";
    $numSeconds = ($time % 3600) % 60;
    echo "Time diff in seconds: " . $numSeconds . "<br>";
}
