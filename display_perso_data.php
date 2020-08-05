<?php session_start() ; ?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display Perso Data</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
  </head>
  <body>

    <p>
      <?php
        if (isset($_SESSION['id_user']) AND isset($_SESSION['pseudo']))
        {
            echo 'Bonjour ' . $_SESSION['pseudo'] . ' ton id_user est le ' . $_SESSION['id_user'] . ' et ton nom est ' . $_SESSION['nom'] . ' et ton prénom est ' . $_SESSION['prenom'] . ' et ta question secrète est ' . $_SESSION['question'] . ' et ta réponse à la question secrète est ' . $_SESSION['reponse'];
        }
      ?>
    </p>
    <p>
      Wanna go <a href="index.php">to accueil ?</a>
    </p>
    <p>
      <form class="col-lg-7 offset-lg-1" method="post" action="updating_perso_data.php">
        <div class="form-group">
          <label for="nom">nom</label> :
          <input type="text" name="nom" id="nom" class="form-control" required maxlength="20" value="<?php echo $_SESSION["nom"] ; ?>" />
        </div>
        <div class="form-group">
          <label for="prenom">prénom</label> :
          <input type="text" name="prenom" id="prenom" class="form-control" required maxlength="20" value="<?php echo $_SESSION["prenom"] ; ?>" />
        </div>
        <div class="form-group">
          <label for="pseudo">nom d'utilisateur</label> :
          <input type="text" name="pseudo" id="pseudo" class="form-control" required maxlength="20" value="<?php echo $_SESSION["pseudo"] ; ?>" />
        </div>
        <div class="form-group">
          <label for="password">password</label> :
          <input type="text" name="password" id="password" class="form-control" required maxlength="20" value="<?php echo $_SESSION["pseudo"] ; ?>" />
        </div>
        <div class="form-group">
          <label for="question">question secrète</label> :
          <select name="question" id="question" class="form-control" required>
            <option value="<?php  echo $_SESSION["question"]; ?>"><?php  echo $_SESSION["question"]; ?>
            </option>
            <option value="Quel est le nom de jeune fille de votre mère ?">Quel est le nom de jeune fille de votre mère ?
            </option>
            <option value="Où avez-vous grandi ?">Où avez-vous grandi ?
            </option>
            <option value="Quel était le nom de votre premier animal de compagnie ?">Quel était le nom de votre premier animal de compagnie ?
            </option>
            <option value="Quel est votre film préféré ?">Quel est votre film préféré ?
            </option>
            <option value="Quel a été votre premier métier ?">Quel a été votre premier métier ?
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="reponse">réponse à la question secrète</label> :
          <input type="text" name="reponse" id="reponse" maxlength="100" required class="form-control" value="<?php echo $_SESSION["reponse"] ; ?>" />
        </div>
        <center>
          <input type="reset" class="btn btn-secondary" value="réinitialiser" />
          <input type="submit" name="submit" class="btn btn-primary" value="enregistrer les modifications" />
        </center>
      </form>
    </p>

    <script src="" async defer></script>
  </body>
</html>
