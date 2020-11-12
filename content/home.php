<div class="home-container">

    <h1>The Base PHP Webpage</h1>

    <?php


    if (!isset($_SESSION['id'])) {

        echo "<h2>Welcome user!</h2>";

        echo "<p>Faça <a href='/login'>login</a> para acessar sua conta ou <a href='/user/register'>crie uma nova conta</a></p>";

    } else {

        if ($_SESSION['username'] === 'admin'){

            echo "<br>";
            echo "<hr>";

            include_once $_SERVER['DOCUMENT_ROOT'] . "/content/user/profile_short.php";

            echo "<hr>";
            echo "<br>";
            echo "<p>";
                print_r($_SESSION);
                echo "<br>";
            echo "</p>";

            echo "<p>";
                echo "PHPSID: " . session_id();
            echo "</p>";
            echo "<br>";

        } else {

            echo "<h2>Welcome " . $_SESSION['name'] . "! </h2>";

            include_once $_SERVER['DOCUMENT_ROOT'] . "/content/user/profile_short.php";

            echo "<hr>";
            echo "<br>";
            echo "<p>";
                print_r($_SESSION);
                echo "<br>";
            echo "</p>";

            echo "<p>";
                echo "PHPSID: " . session_id();
            echo "</p>";
            echo "<br>";

        }

    }

    ?>

</div>
