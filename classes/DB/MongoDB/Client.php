<?php

namespace DB\MongoDB;

use MongoDB\Client as MongoDBClient;

class Client
{

    private static function clusterAccessData()
    {
        // Read JSON file
        $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../dbAccess/clusterAccess.json');

        //Decode JSON
        $json_data = json_decode($json,true);

        // Define variables
        $username = $json_data["username"];

        $password = $json_data["password"];

        $clusterAdress = $json_data["clusterAdress"];

        $databaseName = $json_data["databaseName"];

        $data = [
            'username' => $username,
            'password' => $password,
            'clusterAdress' => $clusterAdress,
            'databaseName' => $databaseName
        ];

        return $data;
    }


    private static function clusterAccessUri()
    {
        $data = self :: clusterAccessData();

        // Construct access url
        $clusterAccess = "mongodb+srv://".
        $data['username'] .  ":" .
        $data['password'] . "@" .
        $data['clusterAdress'] . "/" .
        $data['databaseName'];

        return $clusterAccess;
    }


    public function startConnection() {
    /*  Returns a new client based on information provided on
        clusterAccessUri(), from class Access;
        This is an instance of MongoDB\Client;
    */
        return new MongoDBClient(self :: clusterAccessUri());

    }


    public function listDatabases() {
    /*  Returns an object with the databases information;
    */
        $client = $this->startConnection();

        return $client->listDatabases();

    }


    public function listDatabaseNames() {
    /*  Returns an array with the names of the databases on
        server;
    */
        $client = $this->startConnection();
        $list = $client->listDatabases();
        $databaseNames = [];
        foreach ($list as $item) {
            array_push($databaseNames, $item["name"]);
        }

        return $databaseNames;

    }


    public function getDatabaseName() {
    /*  Returns the databaseName
    */
        $access = self :: clusterAccessData();
        return $access['databaseName'];

    }

    public function databaseName() {

        return $this->getDatabaseName();

    }


}
