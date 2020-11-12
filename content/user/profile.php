<style>
.profile{
    text-align: center;
    margin-top: 100px;
}
</style>


<?php
if(isset($_SESSION['id'])){
?>

  <div class="profile">

    <p>Nome: <?=$_SESSION['name']?> </p>

    <p> Email: <?=$_SESSION['email']?> </p>

    <?php if (isset($_SESSION['locale'])) {

        echo "<p> Local:" . $_SESSION['locale'] . "</p>";

    }?>

    <?php if (isset($_SESSION['picture'])) {

        $profilePic = $_SESSION['picture'];

        echo '<p><img src="' . $profilePic . '" alt="profile picture" width="100px"> <br></p>';

    } else {

        $profilePic = "/resources/images/user/default/profile_pics/anonimous.png";

        echo '<p><img src="' . $profilePic . '" alt="profile picture" width="100px"> <br></p>';

        // Imagem de <a href="https://pixabay.com/pt/users/Clker-Free-Vector-Images-3736/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=294480">Clker-Free-Vector-Images</a> por <a href="https://pixabay.com/pt/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=294480">Pixabay</a>

    }?>


      <p>
          <?php if (isset($_SESSION['verified_email'])) {

              if ($_SESSION['verified_email']) {

                  echo 'Email Verificado';

              } else {

                  echo 'Email não verificado';

              }

          }?>
      </p>

      <p> Id: <?=$_SESSION['id']?></p>

      <a href="/login">Trocar Usuário</a> |
      <a href="/logout">Log out</a>

  </div>

<?php } ?>
