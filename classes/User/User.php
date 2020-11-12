<?php

namespace User;

use DB\Document as Document;
use MongoDB\BSON\ObjectID as ID;

class User extends Document
{

    public function define()
    {

        $this->setCollectionName("users");

    }


    public function setProperties()
    {



    }


    public function getProperties()
    {



    }


    public function exists(string $usernameInformed):bool
    {

        $filter = [];

        $options = [];

        $results = $this->read($filter, $options);

        $users = [];

        foreach ($results as $row) {

            foreach ($row as $value) {

                array_push($users, $value);

            }

        }

        return array_search($usernameInformed, $users, true);

    }


    public function email_exists(string $email){

        $filter = ['email' => $email];
        $options = [];
        $results = $this->read($filter, $options);

        foreach ($results as $row) {
            $foundEmail = $row->email;
            return $foundEmail;
        }

    }


    public function username_exists(string $username){

        $filter = ['username' => $username];
        $options = [];
        $results = $this->read($filter, $options);

        foreach ($results as $row) {
            $foundUsername = $row->username;
            return $foundUsername;
        }

    }


    // Verify if user has a Google Id registered in database
    public function hasGoogleID(string $googleID)
    {

        $filter = ['googleID' => $googleID];

        $options = [];

        $results = $this->read($filter, $options);

        foreach ($results as $row) {

            if (isset($row->googleID)) {
                return true;
            }

        }

    }

    // get the database MongoDB id of a given user
    public function getID($username)
    {

        $filter = ['username' => $username];

        $options = [];

        $result = $this->read($filter, $options);

        foreach ($result as $user) {

            foreach ($user as $key => $value) {

                if ($key==='_id') {

                    foreach ($value as $id) {

                        return $id;

                    }

                }

            }

        }

    }

    // Converts the id to BSON format before sending it to server
    public function sendIdToServer($id)
    {

        return new ID($id);

    }


}
