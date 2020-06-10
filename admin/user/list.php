<div class="db-container">

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/admin/menu.php"); ?>

    <h1>List Users</h1>

    <div class="data">
        
    <!-- Receive a list of all users -->
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/user/get-users.php");

    // Select information of username and email only.
    foreach ($users as $user) {
        echo "<ul>";

        echo "<li><spam>username</spam>: <spam class='editable'>" . $user->username . "</spam></li>";

        echo "<li><spam>email</spam>: <spam class='editable'>" . $user->account->email . "</spam></li>";

        echo "</ul>";
    }

    ?>

    </div>

</div>
