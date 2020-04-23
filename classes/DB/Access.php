<?php

namespace DB;

class Access
{

    public static function clusterAccessData()
    {
        // Read JSON file
        $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../dbAccess/clusterAccess.json');

        //Decode JSON
        $json_data = json_decode($json,true);

        // Define variables
        $baseUri = $json_data["clusterBaseURI"];

        $username = $json_data["username"];

        $password = $json_data["password"];

        $clusterAdress = $json_data["clusterAdress"];

        $databaseName = $json_data["databaseName"];

        $data = [
            'baseUri' => $baseUri,
            'username' => $username,
            'password' => $password,
            'clusterAdress' => $clusterAdress,
            'databaseName' => $databaseName
        ];

        return $data;
    }


    public static function clusterAccessUri()
    {
        $data = self :: clusterAccessData();

        // Construct access url
        $clusterAccess = "{$data['baseUri']}{$data['username']}:{$data['password']}@{$data['clusterAdress']}/{$data['databaseName']}";

        return $clusterAccess;
    }

}
