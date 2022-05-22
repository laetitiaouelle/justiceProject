<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Messages';
?>
    

<!DOCTYPE html>
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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                         <!-- STATISTIC-->
            <?php
                $selm = $bdd->prepare('SELECT * FROM messages WHERE destinataire="admin" AND lu=0 ORDER BY date DESC LIMIT 10');
                $selm->execute();
                $m = $selm->fetchAll(PDO::FETCH_OBJ);
               // 
               $r=$selm->rowCount();
            ?>
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <?php if($r !==0) {  ?>
                    <?php foreach($m as $a): ?>
                    <?php
                      $user=$bdd->prepare('SELECT * FROM membres WHERE code=:code');
                      $user->execute(['code'=>$a->auteur]);
                      $rt=$user->fetch();
                    ?>
                      <div class="card">
                      <div class="card-header">
                           <?= $rt['nom'].' '.$rt['prenom'] ?> vous a envoyé un message  date: <small><?= $a->date ?></small>
                           <a style="float:right;" href="lu.php?id=<?= $a->id ?>" title="marqué comme lu"><span class="fa fa-eye"></span></a>
                      </div>
                      <div class="card-body">
                      <div class="card-footer">
                      <?=  $a->contenu ?>
                      </div>
                       Copier son code => <mark><?= $rt['code']?></mark> et <a href="sendMessage.php">cliquer ici</a> si vous voulez repondre. 
                      </div>
                       
                    <?php endforeach  ?>
                    <?php }else{

                        echo '<center>Boite de messagerie vide</center>';
                    }  ?>
                      </div> 
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

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
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
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
