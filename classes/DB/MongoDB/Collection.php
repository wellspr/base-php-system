<?php

namespace DB\MongoDB;

class Collection extends Database
{

    public function setCollectionName(string $name) {

        $this->collectionName = $name;

    }

    public function getCollectionName() {

        return $this->collectionName;

    }

    public function getCollection(string $collectionName) {

        $database = $this->getDatabase();

        return $database->$collectionName;

    }


}
