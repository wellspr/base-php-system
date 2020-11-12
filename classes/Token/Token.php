<?php

namespace Token;

use DB\Document as Document;
use MongoDB\BSON\ObjectID as ID;

class Token extends Document
{

    public function define()
    {

        $this->setCollectionName("tokens");

    }


    public function setProperties()
    {



    }


    public function getProperties()
    {



    }


    public function exists($informedToken){

        $filter = ['token' => $informedToken];
        $options = [];
        $foundToken = $this->read($filter, $options);

        foreach ($foundToken as $row) {

            $dbToken = $row->token;
            return $dbToken==$informedToken;

        }

    }


    public function is_valid($informedToken){

        $filter = ['token' => $informedToken];
        $options = [];
        $foundToken = $this->read($filter, $options);

        foreach ($foundToken as $row) {

            $dbToken = $row->token;
            $serverTimestamp = $row->time[0];
            $dateNow = getdate();
            $tokenLifeTime = $dateNow[0] - $serverTimestamp;
            $tokenMaxLifeTime = 3600;

            return $tokenLifeTime < $tokenMaxLifeTime;

        }

    }


    public function get_email($informedToken){

        $filter = ['token' => $informedToken];
        $options = [];
        $foundToken = $this->read($filter, $options);

        foreach ($foundToken as $row) {

            $email = $row->email;
            return $email;

        }

    }


    public function get_tokens(){

        $filter = [];
        $options = [];
        $foundTokens = $this->read($filter, $options);
        $dateNow = getdate();

        $foundTokensCount = 0;

        foreach ($foundTokens as $row) {

            $foundTokensCount+=1;

            foreach ($row as $key => $value) {

                if($key != 'time'){
                    echo $key . ": " . $value . "<br>";
                } else {
                    echo $key . ": " . $value[0] . "<br>";
                    $tokenServerTime = $value[0];
                    $timeDiff = $dateNow[0] - $tokenServerTime;
                    $maxLifeTime = 3600;

                    if($timeDiff > $maxLifeTime){
                        echo "Expired Token!";
                    } else {
                        echo $timeDiff;
                    }

                }

            }
            echo "<br><br>";
        }
        echo "Total number of tokens: " . $foundTokensCount;

    }


    public function delete_expired_tokens(){

        $filter = [];
        $options = [];
        $foundTokens = $this->read($filter, $options);
        $dateNow = getdate();

        $foundTokensCount = 0;
        $deletedTokensCount = 0;

        foreach ($foundTokens as $row) {

            $foundTokensCount+=1;

            foreach ($row as $key => $value) {

                if ($key == 'time'){

                    $tokenServerTime = $value[0];
                    $timeDiff = $dateNow[0] - $tokenServerTime;
                    $maxLifeTime = 3600;

                    if($timeDiff > $maxLifeTime){

                        $expiredToken = $row->token;
                        $deletedToken = $this->delete(['token' => $expiredToken]);
                        $deletedTokensCount+=1;

                    }

                }

            }

        }

        echo $deletedTokensCount . " expired tokens deleted from server. <br>";

        $remainingTokens = $foundTokensCount - $deletedTokensCount;

        echo $remainingTokens . " unexpired tokens left on the server.";

    }


    public function get_expired_tokens_count(){

        $filter = [];
        $options = [];
        $foundTokens = $this->read($filter, $options);
        $dateNow = getdate();

        $expiredTokensCount = 0;

        foreach ($foundTokens as $row) {

            foreach ($row as $key => $value) {

                if ($key == 'time'){

                    $tokenServerTime = $value[0];
                    $timeDiff = $dateNow[0] - $tokenServerTime;
                    $maxLifeTime = 3600;

                    if($timeDiff > $maxLifeTime){

                        $expiredTokensCount+=1;

                    }

                }

            }

        }

        return $expiredTokensCount;

    }


    public function get_total_tokens_count(){

        $filter = [];
        $options = [];
        $foundTokens = $this->read($filter, $options);
        $dateNow = getdate();

        $totalTokensCount = 0;

        foreach ($foundTokens as $row) {

            $totalTokensCount+=1;

        }

        return $totalTokensCount;

    }



}
