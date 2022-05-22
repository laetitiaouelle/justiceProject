<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Rémunération';
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
                        <div class="row">
                        <?php 
                                       $insertion=$bdd->prepare('SELECT * FROM remuneration ORDER BY date DESC');
                                       $insertion->execute();
                                       $results=$insertion->fetchAll(PDO::FETCH_OBJ);
                                       foreach($results as $result):
             ?>
             <?php  
                      $i=$bdd->prepare('SELECT * FROM membres WHERE id = :id and code = :codeMembre');
                      $i->execute(['id'=>$result->idMembre, 'codeMembre'=>$result->codeMembre]);
                      $reslts=$i->fetch();
             ?>
                        <div class="col-md-12">
                            <h5>Palier du niveau <?= ' '.$result->niveau.' ' ?> du bonus <mark><?= ' '.$result->type.' ' ?></mark> Atteint<small style="position:relative; left:10px;"><?= $result->date ?></small></h5>
                            <p>Un nouveau palier à été atteint par : <em style="color:red"><?= $reslts['nom'].' '.$reslts['prenom'] ?></em>. 
                            Ce membre a atteint la bar des filleuls nécesaire pour récuperer son bonus.
                            <br> Nous lui devons: <?= ' '.$result->somme.' Fcfa' ?>
                            <a href="gains.php?id=<?= $result->idMembre ?>&amp;code=<?= $result->codeMembre ?>&amp;del=<?= $result->id ?>"  style="position:relative; right:0px;"role="btn" class="btn ">Aller voir...</a>
                            </p>
                        </div><hr>
                        <?php endforeach ?>
                        
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
