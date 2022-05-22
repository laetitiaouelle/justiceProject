<?php session_start();
if(isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])){
require('config/bdd.connexion.php');
require('other/fonction.php');
require('unilevelVariable.php');
$title= 'Global Pool Profit';


//calcule du point volume

$pointVolumes = $produits1 +$produits2 + $produits3 + $produits4 + $produits5 + $produits6 + $produits7 + $produits8 + $produits9 + $produits10 + $produits11 + $produits12;
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
                                                <a href="#">Gains</a>
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

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!--contenu2-->
                        <div class="row">
                             <div class="col-md-12"><br>
                                    <h4 class="title-5 m-b-35"><i class="fa fa-dot-circle-o"></i>  Stairstep</h4>
                                    <p style="width:90%; text-align:left;margin-left:50px;">
                                    Le Stairstep est une commission calculée sur la commission Unilevel des filleuls directs uniquement. Il constitue les grades à atteindre par les distributeurs pour bénéficier de cette commission. Il y a 3 grades:
<br>ELITE 1: reçoit 10℅ de l'Unilevel des filleuls directs uniquement de 1ère génération
<br>ELITE 2: reçoit 10℅ de l'Unilevel des filleuls directs uniquement de 1ère génération et 5℅ de l'Unilevel des filleuls de 2e génération (les filleuls directs des filleuls de 1ère génération)
<br>ELITE 3: reçoit 10℅ de l'Unilevel des filleuls directs uniquement de 1ère génération, 5℅ de l'Unilevel des filleuls de 2e génération (les filleuls directs des filleuls de 1ère génération); 5℅ de l'Unilevel des filleuls de 3e génération (les filleuls directs des filleuls de 2e génération) et 5℅ de l'Unilevel des filleuls de 4e génération (les filleuls directs des filleuls de 3e génération).
<br><br>Les conditions pour atteindre ces grades:
<br>ÉLITE 1: 5000PV. Niveau 1: 10%
<br>ÉLITE 2: 50.000PV. Niveau 1: 10℅; Niveau 2: 5℅
<br>ÉLITE 3: 500.000PV. Niveau 1: 10℅; Niveau 2: 5℅; Niveau 3: 5℅ et Niveau 4: 5℅
Les PV sont les points cumulés sur tout achat de produits dans la descendance y compris les achats personnels. <br><br>
Récompenses liés aux différents grades:
    <br>ÉLITE 1: une enveloppe de 750.000Fcfa
    <br>ÉLITE 2: une voiture d'une valeur de 8.000.000Fcfa + un séjour tout frais payé à Dubaï.
    <br>ÉLITE 4: un véhicule de type 4x4 d'une valeur de 15.000.000Fcfa
                                    </p>
                                      </div>
                             <div class="col-md-12"><hr>
                                   <b>vous avez : <?= ' '.$pointVolumes ?>  points volumes</b><br><br><br>
                             </div>
                        </div>
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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!--contenu2-->
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