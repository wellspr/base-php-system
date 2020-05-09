<a class="menu-link" href="/">Home</a>

<?php

    /* If there's no logged in user
    *  Show Login and Register
    */
    if (!isset($_SESSION['id'])) {

        echo <<<EXCERPT

        <a class="menu-link" href="/login">Login</a>

        <a class="menu-link" href="/user/register">Registrar</a>

EXCERPT;

    }
    // Show more options for user admin
    else {

        if ($_SESSION['username']==='admin') {

            echo <<<EXCERPT

            <a class="menu-link"href="/admin/panel">Painel</a>

            <a class="menu-link"href="/user/register">Registrar Usuário</a>

            <a class="menu-link"href="/user/profile">Perfil</a>

EXCERPT;

        }
        // Show profile for normal users
         else {

            echo <<<EXCERPT

            <a class="menu-link" href="/user/profile">Perfil</a>

EXCERPT;

        }

    }
