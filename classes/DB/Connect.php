<?php

namespace DB;

use MongoDB\Driver\Manager as Connection;

use MongoDB\Client as Client;

class Connect
{

    private $clusterAccessUri;

    public function __construct($clusterAccessUri)
    {

        $this->clusterAccessUri = $clusterAccessUri;

    }

    public function connect()
    {

        $connection = new Connection($this->clusterAccessUri);

        return $connection;

    }

    public function client()
    {

        $client = new Client($this->clusterAccessUri);

        return $client;

    }

}
