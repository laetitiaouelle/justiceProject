<?php
session_start();
require('config/database.php');
require('config/codeGen.php');
require('other/fonction.php');
?>
<?php if (isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])) { 
$rq=$bdd->prepare('SELECT * FROM membres WHERE id=:id');
$rq->execute(['id'=>$_SESSION['Cid']]);
$admin=$rq->fetch();

$title= 'Ajouter un membres';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
<?php
//On vérifie l'envoi du formulaire via la requête POST
 if (isset($_POST)) {
     extract($_POST);
     //Initialisation des conteneurs d'erreurs, de succces et d'avertissement.
     $errors=[];
     $success=[];
     $warnings=[];
     $arrayStatut=[0,1,-1]; // 0 pour les père absolue, 1 pour les pere enfant et -1 pour les enfants absolue
    
     //on vérifie si les champs sont non vides.
     if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($produitsAch))
     {
         //on sécurise les inputs. //protections contre les injections sql non gérer
        $nom_ok=strip_tags($nom);
        $prenom_ok=strip_tags($prenom);
        $email_ok=strip_tags($email);
        $produitsAch_ok=strip_tags($produitsAch);
        $parrainDir_ok = $_SESSION['Ccode'];


        //On définit les conditions de validité avant insertions.
        if(mb_strlen($nom_ok)<3){ $errors[]='Nom cours: Entrer 3 caratères au minimum,'; }
        if(mb_strlen($prenom_ok)<3){ $errors[]='Prenom cours: Entrer 3 caratères au minimum,'; }
        if(is_already_in_use('email',$email_ok, 'membres')){ $errors[]='Cet email existe déjà';}
        if(!filter_var($email_ok, FILTER_VALIDATE_EMAIL)){ $errors[]='Adresse Email Incorrecte'; }
        if(is_numeric($produitsAch_ok)){
            if($produitsAch_ok <3){ $errors[]='Vous ne pouvez ajouter un nouveau membre sans un achat de 3 produits'; }
        }else{ $errors[]='Le nombre de produits achetés doit être un nombre';} 
     }else
     {
         $errors[]='Remplissez les champs obligatoires svp!';
     }
//On compte le nombre d'erreur si vide on passe à la prochaine étape
     if(count($errors)==0){
 //envoi de la notification

                                 $type='user';
                                $titre ='Un nouvel membres a été ajouté par '.$_SESSION['Cnom'].'_'.$_SESSION['Ccode'];
                                 $notification= 'Il recevra un email pour confirmer son ajout';
                                 $sendNotification = $bdd->prepare('INSERT INTO notifications(titre, contenu, date, type) 
                                        VALUE(:titre, :contenu, NOW(), :type)');
                                        $sendNotification->execute([
                                        'titre'=> $titre,
                                        'contenu'=> $notification,
                                        'type'=>$type
                                   ]);

          if(!empty($parrainDir_ok))//On vérifie si le champs parrain code n'est pas vide
          {
              //on selectionne tout les enfants ayant le même code
            $checkChild = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
            $checkChild->execute([
                  'parrainDir'=>$parrainDir_ok
            ]);
            $childNb=$checkChild->rowcount(); // on les compte
            //echo $childNb;
            if($childNb>=3)//si il y a plus de 3 alors les autres deviennent enfants pere absolue.
            {
              $warnings[]='Matrice forcée a trois pieds atteinte, il retombe en parrachutage!';
              $insert=$bdd->prepare('INSERT INTO membres(code, nom, prenom, produitsAch, email, password, statut, parrainDir, date, parachut) 
              VALUE(:code, :nom, :prenom, :produitsAch, :email, :password, :statut, :parrainDir, NOW(), :parachut)');
              $insert->execute([
                'code'=>$mon_code,
                'nom'=>$nom_ok,
                'prenom'=>$prenom_ok,
                'produitsAch'=>$produitsAch_ok,
                'email'=>$email_ok,
                'password'=>$mon_code,
                'statut'=>$arrayStatut[2],
                'parrainDir'=>$parrainDir_ok,
                'parachut'=>1
              ]);
              if($insert){
                $inP=$bdd->prepare('INSERT INTO detail_achat(quantite, CodeAcheteur, dateAchat) VALUE(:quantite, :code, NOW())');
                $inP->execute([
                    'quantite'=>$produitsAch_ok,
                    'code'=>$mon_code
                ]);
               $success[]='Ajout réussi';
               echo'<meta http-equiv="refresh" content="5;URL=index.php">';
              }else{
                  $errors[]='Insertion échoué';
                  echo 'Insertion échoué';
              }
            }else{
                $insert=$bdd->prepare('INSERT INTO membres(code, nom, prenom, produitsAch, email, password, statut, parrainDir, date, parachut) 
                VALUE(:code, :nom, :prenom, :produitsAch, :email, :password, :statut, :parrainDir, NOW(), :parachut)');
                $insert->execute([
                  'code'=>$mon_code,
                  'nom'=>$nom_ok,
                  'prenom'=>$prenom_ok,
                  'produitsAch'=>$produitsAch_ok,
                  'email'=>$email_ok,
                  'password'=>$mon_code,
                  'statut'=>$arrayStatut[2],
                  'parrainDir'=>$parrainDir_ok,
                  'parachut'=>0
                ]);
                if($insert){
                    $inP=$bdd->prepare('INSERT INTO detail_achat(quantite, CodeAcheteur, dateAchat) VALUE(:quantite, :code, NOW())');
               $inP->execute([
                   'quantite'=>$produitsAch_ok,
                   'code'=>$mon_code
               ]);
                 $success[]='Ajout réussi';
                 echo'<meta http-equiv="refresh" content="5;URL=index.php">';
                }else{
                    $errors[]='Insertion échoué';
                }
            }

           
          }
     }else{

     }
    
 }
 foreach($errors as $error){

    echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-danger">Erreur</span>'.$error.'
 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
}
foreach($success as $succes){
    echo '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
     <span class="badge badge-pill badge-primary">Success</span>'.$succes.'
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>';
     //echo ''.$error;
 }

 foreach($warnings as $warning){
     echo '<div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
     <span class="badge badge-pill badge-warning">Success</span>'.$warning.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>';
 }
?>


               <?php  require('contents/insertionM.form.php') ?>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>
</html>
<!-- end document-->
<?php }else{
    $_SESSION['messageadd']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>