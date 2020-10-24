<?php

use DB\Access as Access;
use Token\Token as Token;

/*  Generate a randon token
to compose the temporary link
to change password
*/
$n=30; //The size of the token string

function random_string($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

// Generate token
$token = random_string($n);

// Generate random link
$link = "http://" . $_SERVER['SERVER_NAME'] . "/user/resetPassword/getToken?token=". $token;

if ($_SERVER['REQUEST_METHOD']==='POST') {

    // Get the user's email
    $email  = $_POST['email'];

    // Send temporary token to server
    $accessUri = Access :: clusterAccessUri();
    $newToken = new Token($accessUri);
    $newToken->define();

    $tempToken = [

        'email' => $email,
        'token' => $token,
        'time' => getdate()

    ];

    $tokenStored = $newToken->create($tempToken);

    if($tokenStored){

        // Send email to user
        $to = $email;
        $subject = "Test Message From Base PHP";
        $msg = "
        <html>
            <head>
                <title>Reset Password</title>
            </head>
            <body>

            Follow this link to reset your password: \n
            <a href='$link' target='_blank'>$link</a>

            If this link doesn't work please copy and paste the following on a browser: \n $link

            </body>
        </html>
        ";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        // $headers .= 'Cc: myboss@example.com' . "\r\n";

        // send email
        mail($to, $subject,$msg, $headers);

        echo <<<End

        <h1>Success!!!</h1>

        <p>A link to reset your password was sent to $email. </p>

End;

    } else {
        echo "Ocorreu um erro na solicitação. Por favor tente novamente.";
    }

}

?>
