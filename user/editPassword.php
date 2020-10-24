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

}
 
?>

<h1>Password Reset</h1>

<form class="forms" action="/user/updatePassword" method="post">

        <input type="hidden" id="user_id" name="id" value="<?php echo $id ?>" placeholder="User ID">

    <br>

    <label> New Password </label><br>
        <input type="password" name="password" value="" placeholder="Informe uma nova senha">

    <br>

    <input type="submit" name="submit" value="Confirmar">

</form>



<!-- <script>
    document.querySelector("input[name=cancel]").addEventListener("click", function(){
        window.location.replace("/admin/panel");
    });
</script> -->
