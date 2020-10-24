<?php
use FormCreate\Form as Form;
use DB\Access as Access;
use User\User as User;

$update = new Form();
$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

$result = $user->read(['email' => $email],[]);

?>

<h1>Password Reset</h1>

<form class="forms" action="/user/resetPassword/updatePassword" method="post">

        <input type="text" name="email" value="<?php echo $email ?>">

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
