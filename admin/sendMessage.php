<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Envoyer messages';
?><!DOCTYPE html>
<html lang="en">
<?php require('partials/head.php'); ?>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
<?php require('partials/topnav.php'); ?>
        <!-- END HEADER MOBILE-->
<?php require('partials/sidenav.php'); ?>
        <!-- MENU SIDEBAR-->

        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php require('partials/nav.php'); ?>
            <!-- HEADER DESKTOP-->


            <!-- MAIN CONTENT-->
            <div class="main-content">
            <?php if(isset($_GET['id']) && !empty($_GET['id'])){
                if(isset($_GET['code']) && !empty($_GET['code'])){
                                                        $select = $bdd->prepare('SELECT * FROM membres WHERE id=:id AND code=:code');
                                                        $select->execute([
                                                            'id'=>$_GET['id'],
                                                            'code'=>$_GET['code']
                                                        ]);
                                                        $user = $select->fetch();
                                                        $des=$_GET['code'];
                                                        if(isset($_POST)){
                                                            extract($_POST);
                                                            if(!empty($to) && !empty($message)){
                                                            $ins=$bdd->prepare('INSERT INTO messages(contenu, auteur, destinataire) VALUE(:contenu, :auteur, :destinataire)');
                                                            $ins->execute([
                                                                'contenu'=>$message,
                                                                'auteur'=>'admin',
                                                                'destinataire'=>$des
                                                            ]);
                                                            if($ins){
                                                                echo 'Message envoyé <a href="table.php">Tous les membres ici...</a>';
                                                            }
                                                        }
                                                        }
                                                     }}else{
                                                         $user['nom']='';
                                                         $user['prenom']='';
                                                         $user['code']='';
                                                         if(isset($_POST)){
                                                            extract($_POST);
                                                            if(!empty($to) && !empty($message)){
                                                            $ins=$bdd->prepare('INSERT INTO messages(contenu, auteur, destinataire) VALUE(:contenu, :auteur, :destinataire)');
                                                            $ins->execute([
                                                                'contenu'=>$message,
                                                                'auteur'=>'admin',
                                                                'destinataire'=>$to
                                                            ]);
                                                            if($ins){
                                                                echo 'Message envoyé <a href="table.php">Tous les membres ici...</a>';
                                                            }
                                                        }
                                                        }
                                                     } ?>
                <div class="section__content section__content--p30">
                        <div class="row">

                        <div class="col-md-12">
                       <center> <span>Vous envoyez un message à <?= $user['nom'].' '.$user['prenom'] ?></span></center>
                       <form action="" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <input type="text" id="to" value="<?= $user['code'] ?>" name="to" placeholder="message a..." class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        
                                                        <textarea id="message" name="message" class="form-control"></textarea>
                                                        <div class="input-group-addon">.abc</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <input type="submit" value="envoi" class="form-control btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                </form>
                                <?php 

?>
                        </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                            <div class="copyright" style="display:none;">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
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
       <script src="config/script.js"></script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
</body>

</html>
<!-- end document-->
<?php }else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>
