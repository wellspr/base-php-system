<?php

namespace DB;

class Crud
{

    // C is for Create
    public function create()
    {
        $connection = new MongoDB\Driver\Manager('mongodb+srv://admin-wells:teste123@cluster0-etjm8.mongodb.net/test');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $item = $_POST["item"];
        }

        $today = date("d/m/Y") . " " . date("h:i:a");

        $completed = false;

        $bulk = new MongoDB\Driver\BulkWrite;

        $list = [
            "_id" => new MongoDB\BSON\ObjectID,
            "name" => $name,
            "item" => $item,
            "creation_date" => $today,
            "last_modify_date" => $today,
            "completed" => $completed
        ];

        $bulk->insert($list);

        $connection->executeBulkWrite('test.list', $bulk);

        echo "Item successfully created!";
    }

    // R is for Read
    public function read($filter, $options)
    {
        $this->filter = $filter; //=[];
        $this->options = $options; //=['sort' => ['_id' => -1]];

        $connection = new MongoDB\Driver\Manager('mongodb+srv://admin-wells:teste123@cluster0-etjm8.mongodb.net/test');

        $query = new MongoDB\Driver\Query($filter, $options);
        $list = $connection->executeQuery("test.list", $query);

        return $list;
    }

    // U is for Update
    public function update()
    {
        $connection = new MongoDB\Driver\Manager('mongodb+srv://admin-wells:teste123@cluster0-etjm8.mongodb.net/test');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $item = $_POST["item"];
            $completed = $POST["completed"];
        }

        $today = date("d/m/Y") . " " . date("h:i:a");

        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);

        $filter = ["_id" => new MongoDB\BSON\ObjectID($id)];

        $options = [
            '$set'=>[
                "name" => $name,
                "item" => $item,
                "completed" => $completed
            ]
        ];

        $bulk->update($filter, $options);

        $connection->executeBulkWrite('test.list', $bulk);
        echo "Item successfully updated!";
    }

    // Inserir nota e atualizar dados
    public function insertNote()
    {
        $connection = new MongoDB\Driver\Manager('mongodb+srv://admin-wells:teste123@cluster0-etjm8.mongodb.net/test');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $listName = $_POST["listName"];
            $listItem = $_POST["listItem"];
            $notes = $_POST["notes"];
        }

        $today = date("d/m/Y") . " " . date("h:i:a");

        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);

        $filter = ["_id" => new MongoDB\BSON\ObjectID($id)];

        $options = [
            '$set'=>[
                "name" => $listName,
                "item" => $listItem,
                "notes" => $notes,
                "last_modify_date" => $today
            ]
        ];

        $bulk->update($filter, $options);

        $connection->executeBulkWrite('test.list', $bulk);
        echo "Notes successfully updated!";
    }

    // D is for Delete
    public function delete()
    {
        $connection = new MongoDB\Driver\Manager('mongodb+srv://admin-wells:teste123@cluster0-etjm8.mongodb.net/test');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id_do_item"];
        }

        $bulk = new MongoDB\Driver\BulkWrite;

        $bulk->delete(['_id' => new MongoDB\BSON\ObjectID($id)]);

        $connection->executeBulkWrite('test.list', $bulk);
        echo "Item successfully deleted!";
    }

  // Marcar a terafa como comcluída
    public function complete()
    {
        $connection = new MongoDB\Driver\Manager('mongodb+srv://admin-wells:teste123@cluster0-etjm8.mongodb.net/test');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
        }

        $completed = true;

        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);

        $filter = ["_id" => new MongoDB\BSON\ObjectID($id)];
        $options = ['$set'=>["completed" => $completed]];

        $bulk->update($filter, $options);

        $connection->executeBulkWrite('test.list', $bulk);
        echo "Task marked as completed!";
    }


    // Update http_post_field
    public function updateField($field_to_update)
    {
        $connection = new MongoDB\Driver\Manager('mongodb+srv://admin-wells:teste123@cluster0-etjm8.mongodb.net/test');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $field = $_POST['$field_to_update'];
        }

        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);

        $filter = ["_id" => new MongoDB\BSON\ObjectID($id)];
        $options = ['$set'=>['$field_to_update' => $field]];

        $bulk->update($filter, $options);

        $connection->executeBulkWrite('test.list', $bulk);
        echo "Notes successfully updated!";
    }

}
