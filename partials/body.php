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
            $file = $contentDirectory . "/" . $contentFileName . ".php";
            if (file_exists($file)) {
                include_once $file;
            }
        ?>
    </main>

    <footer class="footer-container">
        <?php
            include_once($_SERVER['DOCUMENT_ROOT'] . "/partials/footer.php");
        ?>
    </footer>

</div>
