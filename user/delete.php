<?php

use DB\Access as Access;
use User\User as User;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();


if ($_SERVER['REQUEST_METHOD']==='POST') {

    $id = $_POST['id'];

    if ($username!=='admin') {

        $query = ['_id' => $user->sendIdToServer($id)];

        $deleteResult = $user->delete($query);

        if ($deleteResult===1) {

            echo "Usuário removido com sucesso";

        } else {

            echo "Ocorreu um erro";

        }

    } else {

        echo "\" admin \" account can't be deleted!";

    }



}


// $id = '5daa6351f4b84446ba77d312';
// $query = ["_id" => new MongoDB\BSON\ObjectID($id)];
