<?php
session_start();
include "functions.php";

	// on récupère les données envoyées par le formulaire
	if(isset($_POST["commentaire"]) && isset($_POST["acteur"]))
	{
		$commentaire = htmlspecialchars($_POST["commentaire"]) ;
    $id_acteurx = (int)$_POST["acteur"] ;

      // global $db;
          // $username = $_POST['pseudo'];

    // $res = $db->prepare("select * from account where id_user=:id_user") ;
    // $res->execute(array("id_user"=>$_SESSION["id_user"])) ;
    // // $res = $db->prepare("select id_user from account where username=?") ;
    // // $res->execute(array($_SESSION["pseudo"])) ;

    // $user = $res->fetch() ;

    // // enregistrer les données dans la base
    // $res->closeCursor() ;

    // $_SESSION['id_user'] = $resultat['id_user'];

    $res2 = $db->prepare("insert into post(id_user, id_acteur, date_add, post) values(:user, :acteur, now(), :commentaire)") ;
    $res2->execute(array("user"=>$_SESSION["id_user"], "acteur"=>$id_acteurx, "commentaire"=>$commentaire)) ;
    echo "données récup !<br>";
    ?>
    <!-- <script type="text/javascript">
      document.location.href="display_detail_partner.php?xxx=<?php echo $id_acteur ;?>";
    </script> -->
      <a href="display_detail_partner.php?xxx=<?php echo $id_acteurx;?>">return list acteurs</a>
    <?php
  }
  	else
	{
    echo 'recupere pas les données !';
  }

  	if(!isset($_SESSION["pseudo"]))
	{
		echo 'ya pas le pseudo';
  } else {

  echo "ya le pseudo et c est " . $_SESSION['pseudo'] . " et l'id_user est " . $_SESSION["id_user"];
  }


  // addComments();

  ?>



