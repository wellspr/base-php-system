<?php

    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $id = $_SESSION['id'];

    if (isset($_SESSION['picture'])) {

        $picture = $_SESSION['picture'];

    }

    if (isset($_SESSION['locale'])) {

        $locale = $_SESSION['locale'];

    }

    if (isset($_SESSION['verified_email'])) {

        $verified_email = $_SESSION['verified_email'];

    }


if(isset($name)){
  echo '<h1>Hello ' . $name . '</h1>';
}
else{
  echo '<h1>Hello User</h1>';
}

if(isset($picture)){
  echo '<p><img src="' . $picture . '" alt="profile picture" width="100px"> <br></p>';
}

if(isset($email)){
  echo '<p>Email da conta: ' . $email . '</p>';
}

if(isset($id)){
  echo '<p>Id = ' . $id . '</p>';
}

echo <<<EXCERPT
<p>
<a href="/logout">Logout</a>
</p>
EXCERPT;
