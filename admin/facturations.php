<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();
$title= 'Facturations';
?>
<!DOCTYPE html>
<html lang="en">

<?php require('partials/head.php'); ?>


<body class="animsition">
    <div class="page-wrapper">
      <!-- HEADER MOBILE-->
      <?php require('partials/topnav.php'); ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php require('partials/sidenav.php'); ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php require('partials/nav.php'); ?>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="row">
                            
                            <div class="col-lg-12">
                                <!-- TOP CAMPAIGN-->
                                <div class="top-campaign">
                                    <h3 class="title-3 m-b-30">Facturations</h3>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <thead>
                                                <th>Nom && prix</th>
                                                <th style="float:right;"><button type="button" class="btn btn-outline-primary">
                                            <i class="fa fa-star"></i>&nbsp; imprimer</button></th>
                                            </thead>
                                            <tbody>
                                            <?php
                                                 $inser=$bdd->prepare('SELECT * FROM facturations');
                                                 $inser->execute();
                                                 $ts=$inser->fetchAll(PDO::FETCH_OBJ);
                                                 foreach($ts as $t):
                                            ?>
                                                <tr>
                                                    <td><?= $t->id.'.'.$t->nomFacture ?></td>
                                                    <td><?= $t->prix ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--  END TOP CAMPAIGN-->
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

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
<?php }else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>
