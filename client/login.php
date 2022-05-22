<?php session_start();

if(isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])){
    echo'<meta http-equiv="refresh" content="0;URL=index.php">';
    $_SESSION['sessionOn']='Vous êtes déja connecté';
}else{
 
require('config/bdd.connexion.php');
require('other/fonction.php');
$title= 'connectez-vous';

?>
<!DOCTYPE html>
<html lang="en">

<?php require('partials/head.php'); ?>
<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo-simple.png" alt="CoolAdmin">
                            </a>



                            <?php
if(isset($_POST)){
    extract($_POST);
    $errors=[];
    $success=[];
    if(!empty($email) && !empty($password)){
        $select = $bdd->prepare('SELECT * FROM membres WHERE email= :email AND password= :password');
        $select->execute([
            'email'=>$email,
            'password'=>$password
        ]);
        $results=$select->fetch();
        $userFound= $select->rowCount();
        if($userFound!==0){
            $_SESSION['Cid']=$results['id'];
            $_SESSION['Cnom']=$results['nom'];
            $_SESSION['Cprenom']=$results['prenom'];
            $_SESSION['Cemail']=$results['email'];
            $_SESSION['Ccode']=$results['code'];
            $_SESSION['CnbProduit']=$results['produitsAch'];
            $success[]='Bienvenue '.' '.$_SESSION['Cnom'].' '.'Vous allez être rediriger';
            //envoie de la notification

                                $type='user';
                                $titre = $_SESSION['Cnom'].'_'.$_SESSION['Ccode'].' vient de se connecter';
                                 $notification= '';
                                 $sendNotification = $bdd->prepare('INSERT INTO notifications(titre, contenu, date, type) 
                                        VALUE(:titre, :contenu, NOW(), :type)');
                                        $sendNotification->execute([
                                        'titre'=> $titre,
                                        'contenu'=> $notification,
                                        'type'=>$type
                                   ]);
                        echo'<meta http-equiv="refresh" content="3;URL=index.php">';
        }
    }else{
        //$errors[]='Remplissez tous les champs!';
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
 if(isset($_SESSION['logerr']) && !empty($_SESSION['logerr'])){

    echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-danger">Erreur</span>'.$_SESSION['logerr'].'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';

unset($_SESSION['logerr']);
 }
?>





                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Mot de passe">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Se souvenir de moi
                                    </label>
                                    <label>
                                        <a href="#">mot de passe oublié?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Connexion</button>
                                
                            </form>
                            <div class="register-link">
                                <p>
                                    Pas de compte?
                                    <a href="#">Créer en un ici</a>
                                </p>
                            </div>
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
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>
    <script src="vendor/vector-map/jquery.vmap.brazil.js"></script>
    <script src="vendor/vector-map/jquery.vmap.europe.js"></script>
    <script src="vendor/vector-map/jquery.vmap.france.js"></script>
    <script src="vendor/vector-map/jquery.vmap.germany.js"></script>
    <script src="vendor/vector-map/jquery.vmap.russia.js"></script>
    <script src="vendor/vector-map/jquery.vmap.usa.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
</body>

</html>
<!-- end document-->
<?php } ?>