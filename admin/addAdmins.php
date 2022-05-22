<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Ajouter un admin';
?>
<!DOCTYPE html>
<html lang="en">

<?php require('partials/head.php'); ?>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
<?php
if(isset($_POST)){
    extract($_POST);
    $errors=[];
    $success=[];
    if(!empty($pseudo) && !empty($email) && !empty($grade)){
        
            //echo'<meta http-equiv="refresh" content="3;URL=index.php">';
            if(mb_strlen($pseudo)<=3){ $errors[]='Pseudo trop cours, 4 caractère au minimum'; }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ $errors[]='Adresse Email invalide'; }
            if(is_already_in_use('pseudo', $pseudo, 'admin')){ $errors[]='Ce pseudo est déja utilisé'; }
            if(is_already_in_use('email', $email, 'admin')){ $errors[]='Ce email est déja utilisé'; }
            if(count($errors)==0){
                            $insert=$bdd->prepare('INSERT INTO admin(pseudo, email, password, grade) 
                            VALUE(:pseudo, :email, :password, :grade)');
                            $insert->execute([
                                'pseudo'=>$pseudo,
                                'email'=>$email,
                                'password'=>$pseudo,
                                'grade'=>$grade
                            ]);
                            if ($insert) {
                                $success[]='Nouvel Admin ajouter un email de confirmation lui a été envoyé.';
                                //envoie de l'email.
                                //envoie de la notification
                                $type='user';
                                $titre ='Un nouvel administrateur a été ajouté';
                                 $notification= 'Il recevra un email pour confirmer son ajout';
                                 $sendNotification = $bdd->prepare('INSERT INTO notifications(titre, contenu, date, type) 
                                        VALUE(:titre, :contenu, NOW(), :type)');
                                        $sendNotification->execute([
                                        'titre'=> $titre,
                                        'contenu'=> $notification,
                                        'type'=>$type
                                   ]);
                                //echo 'Nouvel Admin ajouter un email de confirmation lui a été envoyé.';
                                echo'<meta http-equiv="refresh" content="3;URL=setting.php">';
                            }else{
                                $errors[]='Une erreur est arrivé.';
                                //echo 'Une erreur est arrivé.';
                            }
            }else{
                //echo'no';
            }
        
    }else{
        $errors[]='Remplissez tous les champs!';
    }
}
?>
                 

                <div class="login-wrap">
<?php
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
?>

                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo-simple.png" alt="CoolAdmin">

                               <?php  if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
                       echo '<div class="sufee-alert alert with-close alert-dark alert-dismissible fade show">
                        <span class="badge badge-pill badge-dark">Success</span>'.$_SESSION['message'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                     </button>
                                   </div>';
                                   unset($_SESSION['message']);
                                 }?>
                                 <?php  if(isset($_SESSION['messageadd']) && !empty($_SESSION['messageadd'])){
                       echo '<div class="sufee-alert alert with-close alert-dark alert-dismissible fade show">
                        <span class="badge badge-pill badge-dark">Success</span>'.$_SESSION['messageadd'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                     </button>
                                   </div>';
                                   unset($_SESSION['messageadd']);
                                 }?>

                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                            <div class="card">
                                    <div class="card-header">
                                        <strong>Ajouter un </strong> Administrateur
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-inline">
                                            <div class="form-group">
                                                <label  class="pr-1  form-control-label">pseudo</label>
                                                <input type="text" name="pseudo" placeholder="pseudo" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label  class="px-1  form-control-label">Email</label>
                                                <input type="email" name="email"  placeholder="pseudo@example.com" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                            <select name="grade" id="select" class="form-control">
                                                        <option >Grade</option>
                                                        <option value="3">SuperAdmin</option>
                                                        <option value="2">Admin</option>
                                                        <option value="1">Looker</option>
                                                    </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Ajouter
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reinitialiser
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
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
<?php }else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>
<!-- end document-->
