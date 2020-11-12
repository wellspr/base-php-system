<?php

// Rotas para tratamentos de erros
$app -> setRoute("/error/:id", function($req, $res) {

    $id = $req->params("id");

    if ($id==='403') {

        $res -> render("views", [
            'title' => '403',
            'contentDirectory' => "content/error",
            'contentFileName' => "403"
        ]);

    } else if ($id==='404'){

        $res -> render("views", [
            'title' => '404',
            'contentDirectory' => "content/error",
            'contentFileName' => "404"
        ]);

    }

});
