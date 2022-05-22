<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Gains';
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
            <!-- on compte le nombre de produit dans ta table d'achat-->
            <?php
                 $pv=$bdd->prepare('SELECT quantite FROM detail_achat');
                 $pv->execute();
                 $rs=$pv->fetchAll(PDO::FETCH_OBJ);
                 //$ln=$pv->rowCount();
                 $tp=0;
                 foreach ($rs as $key ) {
                     $tp+=$key->quantite;
                 }
            ?>

            <!-- on compte l'argent total de la table de payement-->
            <?php
                 $pb=$bdd->prepare('SELECT montantPayement FROM detail_payement');
                 $pb->execute();
                 $res=$pb->fetchAll(PDO::FETCH_OBJ);
                 //$ln=$pv->rowCount();
                 $tpb=0;
                 foreach ($res as $ke ) {
                     $tpb+=$ke->montantPayement;
                 }
            ?>
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="container">
                             <div class="card">
                                  <div class="card-header">Donne des calculs en fonction des données de la base de données</div>
                                  <div class="card-body">
                                     <div class="row">
                                          <div class="container">
                                              <div class="col-md-12">
                                              Nombre de Produits vendus au total:<mark> <?= $tp ?></mark>
                                              </div><hr>
                                              <div class="col-md-12">
                                              Entrées d'argents engendrées: <mark><?= $tp * 2500 ?> Fcfa</mark>
                                              </div><hr>
                                              <div class="col-md-12">
                                              Sorties d'argents engendrées par les bonus: <mark><?= $tpb ?> Fcfa</mark>
                                              </div><hr>
                                              <div class="col-md-12">
                                              Reste: <mark><?= ($tp * 2500) - $tpb ?> Fcfa</mark>
                                              </div>
                                          </div>
                                     </div>
                                  </div>
                                  <div class="card-footer">Ces statisque se mettent a jour en fonction des vos entrées</div>
                             </div>
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
