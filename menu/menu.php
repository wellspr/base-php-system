<nav class="navbar">

<a href="/">Home</a>

<?php

    /* If there's no logged in user
    *  Show Login and Register
    */
    if (!isset($_SESSION['id'])) {

        echo <<<EXCERPT

        | <a href="/login">Login</a>

        | <a href="/user/register">Registrar</a>

EXCERPT;

    }
    // Show more options for user admin
    else {

        if ($_SESSION['username']==='admin') {

            echo <<<EXCERPT

            <style>
            body{
                background-color: lightgray;
            }
            </style>

            | <a href="/admin/panel">Painel</a>

            | <a href="/user/register">Registrar Usuário</a>

            | <a href="/user/profile">Perfil</a>

EXCERPT;

        }
        // Show profile for normal users
         else {

            echo <<<EXCERPT

            | <a href="/user/profile">Perfil</a>

EXCERPT;

        }

    }

?>

</nav>
