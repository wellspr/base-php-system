<div class="loginPage">

<div class="login">

<?php

if (!isset($_SESSION['id'])) {

    ?>

    <div class="login-box">

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/content/forms/login.html");

    include_once($_SERVER['DOCUMENT_ROOT'] . "/auth/loginValidate.php");
    ?>

    </div>

    <div class="google-signin">

    <?php
    echo "<div><p>Ou</p></div>";

    echo "<div class='google-signin-button'>";
    include_once($_SERVER['DOCUMENT_ROOT'] . "/resources/google/buttons/googleLoginButton.php");
    echo "</div>";
    ?>

    </div>

</div>

<?php
} else {
?>

    <div class="user-logged-in">

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . "/content/user/profile_login.php");
    ?>

    </div>

<?php
}
?>

</div>
