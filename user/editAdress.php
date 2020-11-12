<?php
use FormCreate\Form as Form;
use DB\Access as Access;
use User\User as User;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$update = new Form();
$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();


if ($_SERVER['REQUEST_METHOD']==='POST') {

    $id  = $_POST['id'];
    $username = $_POST['username'];

    $filter = ['_id' => $user->sendIdToServer($id)];

    $options = [];

    $foundUser = $user->read($filter, $options);

    foreach ($foundUser as $user) {

        $firstName = $user->name->firstName;
        $lastName = $user->name->lastName;
        $street = $user->adress->street;
        $number = $user->adress->number;
        $complement = $user->adress->complement;
        $bairro = $user->adress->bairro;
        $zip = $user->adress->zip;
        $city = $user->adress->city;
        $state = $user->adress->state;
        $country = $user->adress->country;

    }

}

$update->setFormTitle(
    'Edit adress for <br> User: ' . $username . ": <br>
    Name: " . ucfirst($firstName) . " " . ucfirst($lastName) . "<br>" .
    "ID: " . $id
);
$update->setActionURL("/user/updateAdress");
$update->setCSS('/resources/css/forms.css');

$pathToUpdateFields = $_SERVER['DOCUMENT_ROOT'] . "/config/updateAdress/fields.php";
include($pathToUpdateFields);

$options = [
    'groupField' => 'Dados de Login',
    'field' => 'username',
    'attribute' => 'disabled',
    'value' => true
];

$update->setFields($fields);

$update->setFormAttributeValue($options);

$values = [
    $id,
    $street,
    $number,
    $complement,
    $bairro,
    $zip,
    $city,
    $state,
    $country,
];

$update-> setValues($values);

$pathToEditButtons = $_SERVER['DOCUMENT_ROOT'] . "/config/updateAdress/buttons.php";
include($pathToEditButtons);
$update->setButtons($buttons);

// Cria o formulário
$update->create();

?>


<script>
    document.querySelector("input[name=cancel]").addEventListener("click", function(){
        window.location.replace("/admin/panel");
    });
</script>
