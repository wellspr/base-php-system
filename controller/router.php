<?php

use Router\Route as App;
$app = new App();

// Home page
$app -> setRoute("/", function($req, $res) {
    $res -> render("views", [
        'title' => 'Home',
        'contentDirectory' => "content",
        'contentFileName' => "home"
    ]);
});


require_once __DIR__ . '/register.php';

require_once __DIR__ . '/auth.php';

require_once __DIR__ . '/user.php';

require_once __DIR__ . '/sites.php';

require_once __DIR__ . '/user_forgot_password.php';

require_once __DIR__ . '/admin.php';

require_once __DIR__ . '/errors.php';

require_once __DIR__ . '/examples.php';
