<a class="menu-link" href="/">Home</a>

<?php

    /* User not logged in
    *  Show Login and Register
    */
    if (!isset($_SESSION['id'])) {

        echo <<<EXCERPT

        <a class="menu-link" href="/login">Login</a>

        <a class="menu-link" href="/register">Registrar</a>

EXCERPT;

    }
    // User logged in
    else {

        echo <<<here

        <a class="menu-link" href="/sites">Sites</a>

here;


        // If user is admin -> Show admin options
        if ($_SESSION['username']==='admin') {

            echo <<<EXCERPT

            <a class="menu-link"href="/admin/dashboard">Dashboard</a>

            <a class="menu-link"href="/register">Registrar</a>

            <a class="menu-link"href="/user/profile">Perfil</a>

EXCERPT;

        }
        // If user is a normal user
         else {

            echo <<<EXCERPT

            <a class="menu-link" href="/user/profile">Perfil</a>

EXCERPT;

        }

    }
