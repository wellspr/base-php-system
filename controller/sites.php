<?php

use Router\Route as App;
$app = new App();

$app -> setRoute("/sites", function($req, $res) {

    if (isset($_SESSION['id'])) {

        $res -> render("views", [
            'title' => 'Home of Example Site',
            'contentDirectory' => "sites",
            'contentFileName' => "index"
        ]);

    } else {

        $res->redirect("/login");

    }
    
});
