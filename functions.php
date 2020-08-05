<?php
include "database_functions.php";

// function new_session($nom, $prenom, $pseudo, $id)
// {
//   $_SESSION["nom"] = $nom ;
//   $_SESSION["prenom"] = $prenom ;
//   $_SESSION["pseudo"] = $pseudo ;
//   $_SESSION["id"] = $id ;
// }

function addVotes() {
    global $db;
    if(isset($_GET["xxx"]))
    {
      $id = (int)$_GET["xxx"] ;
    }
      $query = $db->query("select count(vote) as nb_like from vote where vote='like'") ;
      $data = $query->fetch() ;
      $nb_like = $data["nb_like"] ;
      $query->closeCursor() ;

      $query = $db->query("select count(vote) as nb_dislike from vote where vote='dislike'") ;
      $data = $query->fetch() ;
      $nb_dislike = $data["nb_dislike"] ;
      $query->closeCursor() ;
    ?>
      <p class="offset-lg-1 col-lg-6">
        <button class="btn btn-link" onclick="location.href='display_detail_partner.php?xxx='+<?php echo $id ; ?>+'&votex=like' ;"><img src="icons/like.png"/></button>
        <?php echo $nb_like; ?>
        <button class="btn btn-link" onclick="location.href='display_detail_partner.php?xxx='+<?php echo $id ; ?>+'&votex=dislike' ;"><img src="icons/dislike.png"/></button>
        <?php echo $nb_dislike; ?>
      </p>
    <?php
}

function voteCouting() {
  global $db;

  if(isset($_GET["votex"]) && ((string)$_GET["votex"]=="like" || (string)$_GET["votex"]=='dislike'))
  {
    $new_vote = $_GET["votex"] ;

    // on cherche si l'utilisateur a déjà voté pour ce partenaire
    $res = $db->prepare("select count(vote) as nb_vote from vote where id_user=:user and id_acteur=:acteur") ;
    $res->execute(array("user"=>$_SESSION["id_user"], "acteur"=>$_GET['xxx'])) ;
    $nb_vote = $res->fetch() ;

    // si oui :
    if ($nb_vote["nb_vote"] > 0)
    {
      // on récupère le vote de l'utilisateur
      $query = $db->prepare("select vote from vote where id_user=:user and id_acteur=:acteur") ;
      $query->execute(array("user"=>$_SESSION["id_user"], "acteur"=>$_GET['xxx'])) ;
      $vote = $query->fetch() ;

      // on compare le vote enregistré à celui qu'il vient de faire
      if($vote["vote"]==$new_vote)
      {
        // si les deux votes sont identiques on affiche un message
        if($new_vote=="like")
        {
          ?><script>alert("vous avez déjà liké ce partenaire") ;</script><?php
        }

        else
        {
          ?><script>alert("vous avez déjà disliké ce partenaire") ;</script><?php
        }
      }

      else
      {
        // mise à jour du vote dans la base de données
        $query->closeCursor() ;
        $query = $db->prepare("update vote set vote=:vote where id_user=:user and id_acteur=:acteur") ;
        $query->execute(array("user"=>$_SESSION["id_user"], "acteur"=>$_GET['xxx'], "vote"=>$new_vote)) ;
        $query->closeCursor() ;
      }
    }

    // si non : on créé une nouvelle entrée
    else
    {
      $res->closeCursor() ;
      $res = $db->prepare("insert into vote(id_user, id_acteur, vote) values(:user, :acteur, :vote)") ;
      $res->execute(array("user"=>$_SESSION["id_user"], "acteur"=>$_GET['xxx'], "vote"=>$new_vote)) ;
    }
  }
}

function nombreComments() {
  global $db;
    // on compte le nombre de commentaires
  // if(isset($_GET["xxx"]))
  //   {
  //     $id = (int)$_GET["xxx"] ;
  //   }
  $res = $db->prepare('select count(id_post) as nb_com from post where id_acteur=?') ;
  $res->execute(array($_GET["xxx"])) ;

  $nb_com = $res->fetch();
  ?>
  <p>
    <?php echo $nb_com["nb_com"] ; ?> commentaires
  </p>
  <?php

  $res->closeCursor() ;
}

function idVerify() {
  global $db;

  $res = $db->prepare("select count(id_acteur) as id_partner from acteur where id_acteur=?") ;
  $res->execute(array($_GET['xxx'])) ;

  $nb_id=$res->fetch() ;
  $res->closeCursor() ;
  if($nb_id["id_partner"]==0)
  {
    ?><script>
      alert("Partenaire inconnu") ;
      document.location.href="index.php" ;
    </script><?php
  }
}

function readDetailsActeurs() {
    global $db;
			if(isset($_GET["xxx"]))
			{
				$id = (int)$_GET["xxx"] ;
			}
    $req = $db->prepare('select logo, acteur, description from acteur where id_acteur=:id') ;
    $req->execute(array('id'=>$id)) ;
    $donnees = $req->fetch();
    ?>
    <section class="row">
      <p><img class="col-lg-8 offset-lg-2" src="pictures/<?php echo $donnees['logo'] ; ?>" alt="logo du partenaire" /></p>
      <h2 class="col-lg-12"><?php echo $donnees["acteur"] ; ?></h2>
      <p class="col-lg-12"><?php echo $donnees["description"] ; ?></p>
    </section>
<?php
}


function readActeurs() {
  global $db;
  $res = $db->query('select * from acteur') ;
  while($data = $res->fetch())
  {
    ?>
    <tr class="row">
      <td class="col-lg-4">
        <p class="row">
          <img class="col-8 col-md-8 col-lg-12" src="pictures/<?php echo $data['logo'] ; ?>" alt="logo de <?php echo $data['acteur'] ; ?>" />
        </p>
      </td>

      <td class="col-lg-4">
        <h3><?php echo $data['acteur'] ;?></h3>
      </td>

      <td class="col-lg-4">
        <a href="display_detail_partner.php?xxx=<?php echo $data['id_acteur'] ;?>">[lire la suite]</a>
      </td>
    </tr>
  <?php
  }

$res->closeCursor() ;

}

function processingLogin() {

  if(isset($_POST['login'])) {
    global $db;
    $username = $_POST['pseudo'];
    $mdp1 = $_POST['mdp1'];
    // $id_user = $_POST['id_user'];
    // $nom = $_POST['nom'];

    $req = $db->prepare('SELECT * FROM account WHERE username = :username');
    $req->execute(array(
        'username' => $username));
    $resultat = $req->fetch();

    if(password_verify($mdp1, $resultat['password'])) {
    session_start();
    $_SESSION['id_user'] = $resultat['id_user'];
    $_SESSION['pseudo'] = $username;
    $_SESSION['nom'] = $resultat['nom'];
    $_SESSION['prenom'] = $resultat['prenom'];
    $_SESSION['question'] = $resultat['question'];
    $_SESSION['reponse'] = $resultat['reponse'];
    echo 'Vous êtes connecté !';

      // new_session($data["nom"], $data["prenom"], $pseudo, $data["id_user"]) ;

    ?>

    <script type="text/javascript">
			document.location.href="index.php" ;
		</script>

    <?php
    } else {
      var_dump($resultat);
      echo '<br>';
      var_dump($mdp1);
      echo "baddddddd";
    }

  }
}


function createRows() {
  if(isset($_POST['submit'])) {
  global $db;

  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $username = $_POST['pseudo'];
  $mdp1 = $_POST['mdp1'];
  $question = $_POST['question'];
  $reponse = $_POST['reponse'];

  // $hashFormat = "$2y$10$";
  // $salt = "abc22waawqqwqeccgjuhte";
  // $hashF_and_salt = $hashFormat . $salt;

  // $mdp = crypt($mdp, $hashF_and_salt);

  $pass_hache = password_hash($mdp1, PASSWORD_DEFAULT);

  $req = $db->prepare("INSERT INTO account (nom, prenom, username, password, question, reponse) VALUES (:nom, :prenom, :pseudo, :mdp1, :question, :reponse)");

    if
    ($req->execute(array("nom"=>$nom, "prenom"=>$prenom, "pseudo"=>$username, "mdp1"=>$pass_hache, "question"=>$question, "reponse"=>$reponse)))
    {
      print_r($req);
      echo "recorded";
    ?>

    <script type="text/javascript">
      alert("Votre compte a bien été créé !") ;
      document.location.href="login_form.php" ;
    </script>

    <?php
    }
    else {
      echo "not recorded <br>";
      print_r($db);
      echo "<br>";
      print_r($req);
      die(print_r($db->errorInfo()));
      echo "not recorded";
    }

  }
}
// on redirige l'utilisateur vers le formulaire de connxion
