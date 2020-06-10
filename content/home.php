<div class="home-container">

    <h1>The Base PHP Webpage</h1>

    <?php

    if (isset($_SESSION['id'])) {

        echo "<h2>Welcome " . $_SESSION['name'] . "! </h2>";

    } else {

        // echo <<<EXCERPT
        echo "<h2>Welcome user!</h2>";

        echo "<p>Faça <a href='/login'>login</a> para acessar sua conta ou <a href='/user/register'>crie uma nova conta</a></p>";
        // EXCERPT;
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . "/content/user/profile_short.php";

    ?>

</div>
