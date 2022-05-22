<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Accueil';
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
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                   <a href="addMembers.php"> <button  class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>Ajouter un membres</button>
                                   </a>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>00</h2>
                                                <span>membres en ligne</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>00</h2>
                                                <span>produits vendu</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2>0 visite</h2>
                                                <span>cette semaine</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2>00 Franc</h2>
                                                <span>Gagné au total</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                            <?php
                                 $q=$bdd->prepare('SELECT * FROM membres ORDER BY date DESC');
                                 $q->execute();
                                 $rss=$q->fetchAll(PDO::FETCH_OBJ);
                                 
                            ?>
                                <h2 class="title-1 m-b-25">Achat récents</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Nom + Prenom</th>
                                                <th>Produits achetés</th>
                                                <th class="text-right">Email</th>
                                                <th class="text-right">statut</th>
                                                <th class="text-right">parrain Directe</th>
                                                <th class="text-right">Membre Depuis</th>
                                                <th class="text-right">En ligne?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php foreach ($rss as $rs ): ?>
                                                <td><?= $rs->code ?></td>
                                                <td><?= $rs->nom.' '.$rs->prenom ?></td>
                                                <td class="text-right"><?= $rs->produitsAch ?></td>
                                                <td><?= $rs->email ?></td>
                                                <td class="text-right"><?php if($rs->statut == 0){
                                                    echo'<ititle="sans parrain" >Pere Absolut</i>';
                                                }elseif($rs->statut == 1){
                                                    echo'<ititle="les deux" >Pere et Enfant</i>';
                                                }elseif($rs->statut == -1){
                                                    echo'<ititle="Sans enfants" >Enfant Absolue</i>';
                                                }else{
                                                    echo'<ititle="non connu" >erreur</i>';
                                                }
                                                  ?></td>
                                                <td class="text-right"><?= $rs->parrainDir ?></td>
                                                <td class="text-right"><?= $rs->date ?></td>
                                                <td class="text-right"><?= $rs->online ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Nom + Prenom</th>
                                                <th>Produits achetés</th>
                                                <th class="text-right">Email</th>
                                                <th class="text-right">statut</th>
                                                <th class="text-right">parrain Directe</th>
                                                <th class="text-right">Membre Depuis</th>
                                                <th class="text-right">En ligne?</th>
                                            </tr>
                                        </thead>
                                    </table>
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
