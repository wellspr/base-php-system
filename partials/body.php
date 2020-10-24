<div class="container">

    <header class="header-container">
        <div class="website-logo">
            <h1>Base PHP</h1>
        </div>
        <nav class="navbar">
            <?php
                include_once($_SERVER['DOCUMENT_ROOT'] . "/menu/menu.php");
            ?>
        </nav>

    </header>

    <main class="main-container">

        <?php

            $uri = $_SERVER['REQUEST_URI'];

            $file = $contentDirectory . "/" . $contentFileName . ".php";

            if (file_exists($file)) {

                if(isset($_SESSION['id']) && $_SESSION["username"]=="admin" && $uri != "/"){

                    include_once($_SERVER['DOCUMENT_ROOT'] . "/admin/menu.php");

                    include_once $file;

                } else {

                    include_once $file;

                }

            }

        ?>

    </main>

    <footer class="footer-container">
        <?php
            include_once($_SERVER['DOCUMENT_ROOT'] . "/partials/footer.php");
        ?>
    </footer>

</div>
