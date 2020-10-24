<?php

use DB\Access as Access;
use Token\Token as Token;

$app -> setRoute("/user/:id1/:id2", function($req, $res) {

    $id1 = $req -> params('id1');
    $id2 = $req -> params('id2');

    if ($id1==='resetPassword'&&$id2=='confirmEmail') {

        $res->render("views", [

            'title' => 'Reset Password',
            'contentDirectory' => "user/resetPassword",
            'contentFileName' => "confirmEmail"

        ]);

    } else if ($id1=='resetPassword'&&$id2=='sendEmailToResetPassword') {

        $res -> render("views", [

            'title' => 'Send Email',
            'contentDirectory' => 'user/resetPassword',
            'contentFileName' => "sendEmailToResetPassword"

        ]);

    } else if ($id1=='resetPassword'&&$id2=='getToken') {

        if(isset($_GET['token'])){

            $token = $_GET['token'];

            $accessUri = Access :: clusterAccessUri();
            $myToken = new Token($accessUri);
            $myToken->define();
            $tokenExists = $myToken->exists($token);

            // Verify if token exists
            if ($tokenExists){

                echo "Ok, token exists.";

                $tokenIsValid = $myToken->is_valid($token);

                // Verify if token is valid
                if ($tokenIsValid){

                    echo "Ok, token is valid.";

                    $userEmail = $myToken->get_email($token);

                    $res -> render("views", [

                        'title' => 'Send Email',
                        'contentDirectory' => 'user/resetPassword',
                        'contentFileName' => "resetPassword",
                        'email' => $userEmail

                    ]);

                } else {

                    echo "Token has expired";

                }

            } else {

                echo "No Token Found";

                $res -> render("views", [

                    'title' => 'Invalid Token',
                    'contentDirectory' => 'content/error',
                    'contentFileName' => "invalidTokenErrorMessage"

                ]);

            }

        } else {

            echo "No token provided!";

        }

    } else if ($id1=='resetPassword'&&$id2=='updatePassword') {

        $res -> render("views", [
            'title' => 'Reset Password',
            'contentDirectory' => "user/resetPassword",
            'contentFileName' => "updatePassword"
        ]);

    }

});
