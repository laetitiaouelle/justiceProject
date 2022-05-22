<?php session_start();
if(isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])){
require('config/bdd.connexion.php');
require('other/fonction.php');
$title= 'Voir les enfants directes';

  ?>
<!DOCTYPE html>
<html lang="en">

<?php require('partials/head.php'); ?>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <?php require('partials/aside.php'); ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <?php require('partials/header_desktop.php'); ?>
            
            <!-- END HEADER DESKTOP-->
            <?php require('partials/aside2.php'); ?>
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">Vous êtes ici:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="#">Enfants directs</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Administration</li>
                                        </ul>
                                    </div>
                                    <a href="addMembers.php">
                                    <button class="au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>Ajouter un membre</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- STATISTIC-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                    <span class="fa  fa-circle"> Point volume = </span> <hr>

                        <div id='table' class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>name</th>
                                                <th>email</th>
                                                <th>code</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php  
						                 $sn1 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                 $sn1->execute(['parrainDir'=>$_SESSION['Ccode']]);
						                 $rs1 = $sn1->fetchAll(PDO::FETCH_OBJ);
						                 foreach($rs1 as $r1):
	                                    ?>
                                            <tr class="tr-shadow">
                                                <td><?= $r1->nom.'<br>'.$r1->prenom ?></td>
                                                <td>
                                                    <span class="block-email"><?= $r1->email ?></span>
                                                </td>
                                                <td class="desc"><?= $r1->code ?></td>                                            </tr>
                                            <tr class="spacer"></tr>
                                            <?php  endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!--contenu1-->
                    </div>
                </div>
            </section>

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!--contenu2-->
                    </div>
                </div>
            </section>

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright" style="display:none;">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
<?php }else{
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
    $_SESSION['logerr']='Vous êtes hors connexion, Connectez-vous.';
} ?>