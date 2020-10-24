<?php

namespace DB\MongoDB;

class Database extends Client
{

    public function getDatabase() {

        $client = $this->startConnection();

        $databaseName = $this->databaseName();

        return $client->$databaseName;

    }

}
