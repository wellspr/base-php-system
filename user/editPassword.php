<?php
use FormCreate\Form as Form;
use DB\Access as Access;
use User\User as User;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$updatePasswdForm = new Form();
$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $id  = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

// Set password to empty value
$password = '';

$updatePasswdForm->setFormTitle('Change Password for user: <br>' . $username);
$updatePasswdForm->setActionURL("/user/updatePasswd");
$updatePasswdForm->setCSS('/resources/css/forms.css');

// Define path to available fields file
$pathToUpdateFields = $_SERVER['DOCUMENT_ROOT'] . "/config/updatePasswd/fields.php";
include($pathToUpdateFields);

// Read available fields file
$updatePasswdForm->setFields($fields);

// Set field's values
$values = [
    $username,
    $email,
    $password,
    $id
];

$updatePasswdForm-> setValues($values);

$pathToEditButtons = $_SERVER['DOCUMENT_ROOT'] . "/config/updatePasswd/buttons.php";
include($pathToEditButtons);
$updatePasswdForm->setButtons($buttons);

// Cria o formulário
$updatePasswdForm->create();

}
?>


<script>
    document.querySelector("input[name=cancel]").addEventListener("click", function(){
        window.location.replace("/admin/panel");
    });
</script>
