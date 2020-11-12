<div class="db-container">

    <h1>Dashboard</h1>

    <div class="admin-panel">

    <?php

    echo "<div class='panel-item'><h2>Document root: </h2><p>" . $_SERVER['DOCUMENT_ROOT'] . "</p></div>";

    echo "<div class='panel-item'><h2>Server name: : </h2><p>" . $_SERVER['SERVER_NAME'] . "</p></div>";

    echo "<div class='panel-item'><h2>Session data: </h2>";

    foreach ($_SESSION as $key => $value) {
        echo $key . ": " . $value . "<br>";
    }

    echo "</div>";

    ?>

    </div>

</div>
