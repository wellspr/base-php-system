<?php

/*
This is the first file of the project;
*/

/* First, it checks if there is an active session;
* If not, creates a new one with session_start()
*/
if (!isset($_SESSION['id'])) {

    session_start();

    /* Checks if a user has logged in;
    * When a user logs in:
    * 1) $_SESSION['newlogin'] is set to true and;
    * 2) a new session id is generated
    *    with session_regenerate_id();
    * 3) $_SESSION['newlogin'] is then set to false to prevent
    * new id's being generated
    */
    if (isset($_SESSION['newlogin'])) {

        if ($_SESSION['newlogin']===true) {

            session_regenerate_id();

            $_SESSION['newlogin'] = false;

        }

    }

}

require_once __DIR__ . '/autoload.php';

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/controller/router.php';

require_once __DIR__ . '/content/error/page-not-found.php';
