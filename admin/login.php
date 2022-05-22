<?php session_start();

if(isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])){
    echo'<meta http-equiv="refresh" content="0;URL=index.php">';
    $_SESSION['sessionOn']='Vous êtes déja connecté';
}else{
 
require('config/database.php');
require('other/fonction.php');
$title= 'connectez-vous';

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
    <title><?= $title ?></title>

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
if(isset($_POST)){
    extract($_POST);
    $errors=[];
    $success=[];
    if(!empty($email) && !empty($password)){
        $select = $bdd->prepare('SELECT * FROM admin WHERE email= :email AND password= :password');
        $select->execute([
            'email'=>$email,
            'password'=>$password
        ]);
        $results=$select->fetch();
        $userFound= $select->rowCount();
        if($userFound!==0){
            $_SESSION['pseudo']=$results['pseudo'];
            $_SESSION['email']=$results['email'];
            $success[]='Bienvenue '.' '.$_SESSION['pseudo'].' '.'Vous allez être rediriger';
            //envoie de la notification

                                $type='user';
                                $titre ='Un nouvel administrateur vient de se connecter';
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
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Se souvenir de moi
                                    </label>
                                    <label>
                                        <a href="forget-pass.php">Mot de passe oublié?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">Connexion</button>
                                <div class="social-login-content">
                                    
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    pas de compte?
                                    <a href="register.php">Creer en un ici</a>
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

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
<?php } ?>