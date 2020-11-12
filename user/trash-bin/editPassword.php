<h1>Password Reset</h1>

<?php

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $id  = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    echo $id;
    echo $username;
    echo $email;

}
?>

<form action="/user/resetPassword" method="post">

    <input type="text" name="username" value="<?php echo $username ?>">

    <input type="password" name="password" value="" placeholder="Informe a nova senha">

    <input type="submit" name="submit" value="Confirmar">

</form>
