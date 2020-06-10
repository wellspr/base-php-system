<div class="db-container">

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/admin/menu.php"); ?>

    <h1>Data Base Query Access</h1>

    <form action="" method="post">

        <label for="user">Search for a user:</label>
        <input id="user" type="text" name="username" value="">

        <button type="submit" name="button">Enviar</button>

    </form>

    <div class="data">
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/user/read.php") ?>
    </div>
    
</div>
