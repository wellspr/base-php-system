<div class="db-container">

<?php

include($_SERVER['DOCUMENT_ROOT'] . "/admin/menu.php");

use DB\Access as Access;
use User\User as User;
use HttpRequest\Http as Http;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

// Lista os usernames dos usuários
$filter = [];

$options = [
    'projection' => []
];

$foundUsers = $user->read($filter, $options);

$users = [];

foreach ($foundUsers as $row) {

    $id = $row->_id;
    if (isset($row->username)) {$username = $row->username;}
    if (isset($row->account->email)) {$email = $row->account->email;}

    $user = [];

    $user = [
        'id' => $id,
        'username' => $username,
        'email' => $email
    ];

    array_push($users, $user);

}

echo "<div class='data'>";
foreach ($users as $user) {

    echo "<ul>";
    echo "<li><span class='loginSelect'> Username: </spam><spam class='editable'>" . $user['username']. "</span></li>";
    echo "<li><span class='loginSelect'> Email: </spam><spam class='editable'>" . $user['email']. "</span></li>";
    echo "<li><span class='loginSelect'> ID: </spam><spam class='editable'>" . $user['id']. "</span></li>";
    echo "<li><span class='showDetails_".$user['id']."'></span></li>";
    echo "</ul>";

    echo "<table><tr>";

    echo "<td>"; // Show account details
    echo "<form>
    <input type='hidden' name='id' value='" . $user['id'] . "'>
    <input type='hidden' name='username' value='" . $user['username'] . "'>
    <input type='button' name='showDetails' value='Ver Detalhes'></form>";
    echo "</td>";

    echo "<td>"; // Edit user account
    echo "<form action='/user/edit' method='post'>
    <input type='hidden' name='id' value='" . $user['id'] . "'>
    <input type='hidden' name='username' value='" . $user['username'] . "'>
    <input type='submit' name='update' value='Editar Cadastro'></form>";
    echo "</td>";

    echo "<td>"; // Change user's password
    echo "<form action='/user/editPassword' method='post'>
    <input type='hidden' name='id' value='" . $user['id'] . "'>
    <input type='hidden' name='username' value='" . $user['username'] . "'>
    <input type='hidden' name='email' value='" . $user['email'] . "'>
    <input type='submit' name='changePassword' value='Alterar Senha'></form>";
    echo "</td>";

    echo "<td>"; // Change user's email
    echo "<form action='/user/editEmail' method='post'>
    <input type='hidden' name='id' value='" . $user['id'] . "'>
    <input type='hidden' name='username' value='" . $user['username'] . "'>
    <input type='hidden' name='email' value='" . $user['email'] . "'>
    <input type='submit' name='changeEmail' value='Alterar Email'></form>";
    echo "</td>";

    echo "<td>"; // Delete user account
    echo "<form>
    <input type='hidden' name='id' value='" . $user['id'] . "'>
    <input type='hidden' name='username' value='" . $user['username'] . "'>
    <input type='button' name='delete' value='Deletar Usuário'></form>";
    echo "</td>";

    echo "</table></tr>";

}
echo "</div>"; //Close div with class 'data'.

// Fim da listagem dos usernames dos usuários

?>

</div>

<style>

    .hideDetails{
        display: none;
    }

</style>

<script>

let showDetailsBtn = document.querySelectorAll("input[name=showDetails]");

showDetailsBtn.forEach((btn) => {
    let details = false;

    btn.addEventListener("click", (event) => {

        console.log("1o listener");

        let thisTarget = event.target;
        let username = thisTarget.previousElementSibling.value;
        let id = thisTarget.parentElement.children[0].value;

        if (details===false) {

            var xhttp = new XMLHttpRequest();

            xhttp.open("POST", "/user/read", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("username="+username);

            xhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {

                    document.querySelector(".showDetails_"+id).innerHTML=this.response;
                    thisTarget.value="Esconder Detalhes";
                    details = true;

                    if (details===true) {

                        hidden=false;
                        thisTarget.addEventListener("click", function(){

                            console.log("2o listener");

                            if (hidden===false) {

                                document.querySelector(".showDetails_"+id).style.display="none";
                                thisTarget.value="Ver Detalhes";
                                hidden=true;

                            } else if (hidden===true) {

                                document.querySelector(".showDetails_"+id).style.display="block";
                                thisTarget.value="Esconder Detalhes";
                                hidden=false;

                            }

                        });

                    }

                }

            }

        }

    });

});


// Programação dos botões de delete user
let deleteBtns = document.querySelectorAll("input[name=delete]");

deleteBtns.forEach((btn) => {

    btn.addEventListener("click", (event) => {

        let id = event.target.parentElement.children[0].value;
        console.log("ID: "+id);

        let username = event.target.parentElement.children[1].value;
        console.log("Username: "+username);

        // let username =

        let action = confirm("Deseja deletar usuário " + username + "? \nEsta ação não pode ser revertida.");

        if (action===true) {

            var xhttp = new XMLHttpRequest();

            xhttp.open("POST", "/user/delete", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id="+id);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  location.reload();
                }
            };
        }
    });
});



document.addEventListener("click", function(event){

    // let usernameInput = document.querySelector("input[name='username']");
    // input.addEventListener("change", function(){
    //     document.querySelector(".searchBox").submit();
    // });
    //
    // let IdInput = document.querySelector("input[name='id']");
    // input.addEventListener("change", function(){
    //     document.querySelector(".searchBox").submit();
    // });

    if (event.target.classList.contains("loginSelect")) {

        let thisTarget = event.target;
        let username = thisTarget.innerText;
        let usernameInput = document.querySelector("input[name='username']");

        usernameInput.value=username;
        IdInput.value=id;

    }

});


let count = 0;
let value = "";

document.addEventListener("click", function(event){

    console.log(event.target.innerHTML);
    let thisTarget = event.target;

    if (thisTarget.classList.contains("editable")&&count===0) {

        count+=1;

        console.log(thisTarget);
        console.log(value);
        console.log(count);

        value = thisTarget.innerText;

        thisTarget.classList.add("myTarget");

        thisTarget.innerHTML="<input class='myInput' type='text' name='myChange' value=' " + value + " '> <input type='submit' name='submit' value='Confirma'>";

    } else if (thisTarget.classList.contains("myInput")) {

        console.log(thisTarget);
        console.log(value);


    } else {

        console.log("clicked outside...");
        // console.log(value);

        let input = document.querySelector(".myInput");

        // let value = input.value;
        console.log(value);

        let myTarget = document.querySelector(".myTarget")
        console.log(myTarget);

        // myTarget.innerHTML=value;

        myTarget.classList.remove("myTarget");

        count = 0;
        console.log(count);

        value = "";

    }

});


</script>
