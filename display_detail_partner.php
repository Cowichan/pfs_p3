  <?php session_start();

include "functions.php";
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display partner</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php
      include("redirection.php") ;


      idVerify();
      readDetailsActeurs();
      voteCouting();

			if(isset($_GET["vote"]) && ((string)$_GET["vote"]=="like" || (string)$_GET["vote"]=='dislike'))
			{
				$new_vote = $_GET["vote"] ;

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

      nombreComments();
      if(isset($_GET["xxx"]))
			{
				$id = (int)$_GET["xxx"] ;
			}
    ?>

    <p>
      <?php
      			// on récupère les commentaires
        $res = $db->prepare('select prenom, date_format(date_add, "%d/%m/%Y") as date, post
                    from post
                    inner join account on post.id_user = account.id_user
                    where id_acteur = ?
                    order by date desc') ;
        $res->execute(array($id)) ;

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
            <button class="btn btn-link" onclick="location.href='display_detail_partner.php?xxx='+<?php echo $id ; ?>+'&vote=like' ;"><img src="icons/like.png"/></button>
            <?php echo $nb_like; ?>
            <button class="btn btn-link" onclick="location.href='display_detail_partner.php?xxx='+<?php echo $id ; ?>+'&vote=dislike' ;"><img src="icons/dislike.png"/></button>
            <?php echo $nb_dislike; ?>
          </p>
        <?php

        while($commentaires = $res->fetch())
        {
          ?><p class="col-lg-12">
            <br /><?php echo $commentaires["prenom"] ; ?>
            <br /><?php echo $commentaires["date"] ; ?>
            <br /><?php echo $commentaires["post"] ; ?>
          </p><?php

        }

        $res->closeCursor() ;
      ?>
    </p>
    <p>
      <form class="col-lg-7 offset-lg-1" method="post" action="processing_comments.php">
        <legend><a name="formulaire">ajouter un commentaire en tant que <?php echo $_SESSION["pseudo"] ; ?> :</a></legend>
        <div class="form-group">
          <label for="commentaire">commentaire</label>
          <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
        </div>
        <input type="hidden" name="acteur" value="<?php echo $_GET['xxx'] ; ?>" />
        <center><input type="submit" value="commenter" /></center>
      </form>
    </p>
    <p>

      <?php
        if (isset($_SESSION['id_user']) AND isset($_SESSION['pseudo']))
        {
            echo 'Bonjour ' . $_SESSION['pseudo'] . ' ton id_user est le ' . $_SESSION['id_user'] . ' et ton nom est ' . $_SESSION['nom'];
        }
      ?>

    </p>

    <script src="" async defer></script>
  </body>
</html>
