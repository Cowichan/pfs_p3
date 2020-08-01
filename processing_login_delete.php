<?php
include "database_functions.php";
  if(isset($_POST['login'])) {
  global $db;
  $username = $_POST['pseudo'];
  $mdp1 = $_POST['mdp'];


  $req = $db->prepare('SELECT password FROM account WHERE username = :username');
  $req->execute(array(
      'username' => $username));
  $resultat = $req->fetch();

  if(password_verify($mdp1, $resultat['password'])) {
    echo "thank youuuuu";
  } else {
    var_dump($resultat);
    echo '<br>';
    var_dump($mdp1);
    echo "baddddddd";
  }


}
