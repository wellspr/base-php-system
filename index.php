<?php

/* Checks if there is an active session;
* If not, creates a new one with session_start()
*/
if (!isset($_SESSION['id'])) {

    session_start();

    /* Checks if a user has logged in;
    * If a user logs in, $_SESSION['newlogin'] is set to true;
    * If that is the case a new session id is generated
    * with session_regenerate_id()
    * $_SESSION['newlogin'] is then set to false to prevent
    * new id's being generated
    */
    if (isset($_SESSION['newlogin'])) {

        if ($_SESSION['newlogin']===true) {

            session_regenerate_id();

            $_SESSION['newlogin'] = false;

        }

    }

}

// print_r($_SESSION);
// echo "<br>";
//
// echo "PHPSID: " . session_id();
// echo "<br>";

require_once __DIR__ . '/autoload.php';

// require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/controller/router.php';

require_once __DIR__ . '/content/error/page-not-found.php';
