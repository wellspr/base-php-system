<?php

/*
    Creates a new session for user,
    based on the user's data.
*/

namespace User;

class Session
{

    public function setUser($user)
    {

        $this->user = $user;

    }


    public function start($username)
    {

        $filter = ['username' => $username];
        $options = [];
        $data = $this->user->read($filter, $options);

        foreach ($data as $user) {
            $firstName = $user->name->firstName;
            $lastName = $user->name->lastName;
            $username = $user->username;
            if(isset($user->email)){
                $email = $user->email;
            } else{
                $email = $user->account->email;
            }
            $id = $user->_id;
        }

        $_SESSION['name'] = $firstName . " " . $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['newlogin'] = true;

    }

}
