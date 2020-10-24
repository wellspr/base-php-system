<form class="forms" action="" method="post">
    <input type="submit" name="submit" value="List Tokens">
    <input type="submit" name="submit" value="Delete Expired Tokens">
</form>

<?php

use DB\Connect as Connection;
use DB\Access as Access;
use User\User as User;
use Token\Token as Token;

$accessData = Access :: clusterAccessData();
$accessUri = Access :: clusterAccessUri();
$token = new Token($accessUri);
$token->define();

$totalTokensCount = $token->get_total_tokens_count();
$expiredTokensCount = $token->get_expired_tokens_count();

if ($_SERVER["REQUEST_METHOD"]=="POST"){

    if ($_POST['submit']=="List Tokens"){

        $token->get_tokens();

    } else if ($_POST['submit']=="Delete Expired Tokens"){

        $token->delete_expired_tokens();

    }

} else {

    echo "Tokens count: " . $totalTokensCount . "<br>";
    echo "Expired tokens: " . $expiredTokensCount . "<br><br>";

}
