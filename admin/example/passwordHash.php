<?php

use Crypto\Encrypt as Encrypt;
use DB\Access as Access;
use User\User as User;

echo "Hello...";
echo "Hacking starting...";
$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

$crypt = new Encrypt();

$filter=['username'=>'admin'];
$password='admin';
$hash = $crypt->encrypt($password);
$options=['$set'=>[
            'account'=>[
                'password' => $hash
            ]
        ]
    ];
$result = $user->update($filter, $options);


echo <<<EXCERPT
<p>
    <a href="https://stackoverflow.com/questions/4795385/how-do-you-use-bcrypt-for-hashing-passwords-in-php" target="_blank" rel="nofollow">https://stackoverflow.com/questions/4795385/how-do-you-use-bcrypt-for-hashing-passwords-in-php</a>
</p>

<p>
    bcrypt is a hashing algorithm which is scalable with hardware (via a configurable number of rounds). Its slowness and multiple rounds ensures that an attacker must deploy massive funds and hardware to be able to crack your passwords. Add to that per-password <a href="https://en.wikipedia.org/wiki/Salt_%28cryptography%29" target="_blank" rel="nofollow">salts</a> (bcrypt REQUIRES salts) and you can be sure that an attack is virtually unfeasible without either ludicrous amount of funds or hardware.
</p>

<p>
    bcrypt uses the Eksblowfish algorithm to hash passwords. While the encryption phase of Eksblowfish and Blowfish are exactly the same, the key schedule phase of Eksblowfish ensures that any subsequent state depends on both salt and key (user password), and no state can be precomputed without the knowledge of both. Because of this key difference, bcrypt is a one-way hashing algorithm. You cannot retrieve the plain text password without already knowing the salt, rounds and key (password). [Source]
</p>

<p>
    How to use bcrypt:
    Using PHP >= 5.5-DEV
    Password hashing functions have now been built directly into PHP >= 5.5. You may now use <a href="https://www.php.net/password_hash" target="_blank" rel="nofollow">password_hash()</a> to create a bcrypt hash of any password:
</p>
EXCERPT;


// Usage 1:
echo "<b>Resultado pelo método 1</b>: \n";
echo password_hash('rasmuslerdorf', PASSWORD_DEFAULT);
echo "<br>";

// $2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
// For example:
// $2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a

// Usage 2:
$options = [
  'cost' => 11
];
echo "<b>Resultado pelo método 2</b>: \n";
echo password_hash('rasmuslerdorf', PASSWORD_BCRYPT, $options);
echo "<br>";
// $2y$11$6DP.V0nO7YI3iSki4qog6OQI5eiO6Jnjsqg7vdnb.JgGIsxniOn4C

// To verify a user provided password against an existing hash, you may use the password_verify() as such:

// See the password_hash() example to see where this came from.

echo "<b>Resultado da verificação</b>: \n";
$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}


echo <<<EXCERPT

<p>
<a href="https://www.php.net/password_hash" target="_blank" rel="nofollow">https://www.php.net/password_hash</a>
</p>

<p>
<a href="https://www.php.net/password_verify" target="_blank" rel="nofollow">https://www.php.net/password_verify</a>
</p>

<p>
    <a href="https://en.wikipedia.org/wiki/Salt_%28cryptography%29" target="_blank" rel="nofollow">Salt</a>
</p>

<p>
<a href="https://en.wikipedia.org/wiki/Bcrypt" target="_blank" rel="nofollow">Bcrypt</a>
</p>

<p>
    <a href="https://pt.stackoverflow.com/questions/105689/password-hash-ou-crypt-qual-traz-mais-seguran%C3%A7a" target="_blank" rel="nofollow">https://pt.stackoverflow.com/questions/105689/password-hash-ou-crypt-qual-traz-mais-seguran%C3%A7a</a>
</p>

<p>
<a href="https://www.php.net/manual/pt_BR/function.crypt.php" target="_blank" rel="nofollow">Crypt</a>
</p>

EXCERPT;



/**
 * This code will benchmark your server to determine how high of a cost you can
 * afford. You want to set the highest cost that you can without slowing down
 * you server too much. 8-10 is a good baseline, and more is good if your servers
 * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
 * which is a good baseline for systems handling interactive logins.
 */
$timeTarget = 0.05; // 50 milliseconds

$cost = 8;
do {
    $cost++;
    $start = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
} while (($end - $start) < $timeTarget);

echo "Appropriate Cost Found: " . $cost;
