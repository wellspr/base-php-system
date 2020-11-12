<?php

namespace Auth;

use Crypto\Encrypt as Encrypt;

// use User\User as User;

class Login extends Encrypt
{

    public function setUser($user)
    {

        $this->user = $user;

    }

    public function validate($username, $password)
    {

        if ($this->user->exists($username)) {

            // echo "<p>Ok, user exists</p>";

            if ($this->passwordsMatch($username, $password)) {

                // echo "<p>Passwords match!!! Success!!!</p>";

                return true;

                // echo '<script> window.location.replace("/"); </script>';

            } else {

                echo "<p><span class='error_message'>Sorry, wrong username or password</span></p>";

            }

        } else {

            echo "<p><span class='error_message'>Sorry, user not found on server</p>";

        }

    }

    public function passwordsMatch(string $usernameInformed, $passwordInformed):bool
    {

        $filter = ['username' => $usernameInformed];

        $options = [];

        $result = $this->user->read($filter, $options);

        foreach ($result as $row) {

            $passwordServer = $row->password;

            if ($this->verify($passwordInformed, $passwordServer)) {

                return true;

            } else {

                return false;

            }

        }

    }


}
