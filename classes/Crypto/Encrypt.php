<?php

namespace Crypto;

class Encrypt
{

    public function encrypt($password)
    {

        $options = [
          'cost' => 11
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);

    }

    public function verify($password, $hash)
    {

        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }

    }

}
