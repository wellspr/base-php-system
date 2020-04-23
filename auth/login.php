<style>
    .loginPage{
        text-align: center;
    }
</style>

<div class="loginPage">

<?php

if (!isset($_SESSION['id'])) {

    include_once($_SERVER['DOCUMENT_ROOT'] . "/content/forms/login.html");

    echo "<h3>Ou</h3>";

    include_once($_SERVER['DOCUMENT_ROOT'] . "/resources/google/buttons/googleLoginButton.php");

} else {

    include_once($_SERVER['DOCUMENT_ROOT'] . "/content/user/profile_login.php");

}

?>

</div>
