<?php

if (isset($_SESSION['id'])) {

    echo 'Logado como ' . $_SESSION['email'] . "<br>";

    echo 'Id de usuário: ' . $_SESSION['id'];

    echo '<br>';

    echo '<a href="/login">Trocar Usuário</a>';

    echo ' | ';

    echo '<a href="/logout">Log out</a>';

}
