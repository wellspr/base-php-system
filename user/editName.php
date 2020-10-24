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

    }

}

$update->setFormTitle('Edit Name');
$update->setActionURL("/user/updateName");
$update->setCSS('/resources/css/forms.css');

$pathToUpdateFields = $_SERVER['DOCUMENT_ROOT'] . "/config/updateName/fields.php";
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
    $firstName,
    $lastName,
];

$update-> setValues($values);

$pathToEditButtons = $_SERVER['DOCUMENT_ROOT'] . "/config/updateName/buttons.php";
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
