<?php session_start();
if(isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])){
require('config/bdd.connexion.php');
require('other/fonction.php');

$title= 'Unilevel';

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
            <?php require('unilevelVariable.php'); ?>
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <?php
                           $verf1 = $bdd->prepare('SELECT * FROM unilevel WHERE idMembre = :idMembre and codeMembre = :codeMembre');
                           $verf1->execute([
                               'idMembre'=>$_SESSION['Cid'],
                               'codeMembre'=>$_SESSION['Ccode']
                           ]);
                           $s1 = $verf1->fetch();
                          
                           $sp = $s1['somme'];
                           $sr = $st - $sp;
                          ?>
                
                        <!--contenu2-->
                        <div class="row">
                             <div class="col-md-12"><br>
                                    <h4 class="title-5 m-b-35"><i class="fa fa-dot-circle-o"></i> Unilevel</h4>
                                    <p style="width:70%; text-align:left;margin-left:50px;">
                                      L'unilevel est la commission payé sur chaque produit acheté par un membre du réseau personnel en fonction du pourcentage attribué au niveau qu'il occupe dans la matrice. L'unilevel est payé uniquement sur notre réseau constitué personnellement à partir
                                      de nos filleuls directs et de leurs filleuls parrainés directement. L'unilevel ne prend pas en compte les filleuls parachutés.                            </p>
                             </div>
                             <div class="col-md-12"><hr><span>Somme Totale = <?= ' '.$st.' Fcfa' ?><br>
                             Somme payé = <?php if(empty($sp)){ $sp=0; echo $sp.' Fcfa'; }else{ echo $sp.' Fcfa'; } ?><br>
                             Somme Restante = <?= ' '.$sr.' Fcfa' ?>
                             </span><hr>
                             
                             <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Niveau</th>
                                                <th>Total produits</th>
                                                <th>Calcul</th>
                                                <th class="text-right">Somme</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Niveau 1</td>
                                                <td><?= $produits1 ?> Produits</td>
                                                <td>30 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits1 * 30  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 2</td>
                                                <td><?= $produits2 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits2 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 3</td>
                                                <td><?= $produits3 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits3 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 4</td>
                                                <td><?= $produits4 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits4 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 5</td>
                                                <td><?= $produits5 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits5 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 6</td>
                                                <td><?= $produits6 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits6 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 7</td>
                                                <td><?= $produits7 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits7 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 8</td>
                                                <td><?= $produits8 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits8 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 9</td>
                                                <td><?= $produits9 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits9 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 10</td>
                                                <td><?= $produits10 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits10 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 11</td>
                                                <td><?= $produits11 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits11 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 12</td>
                                                <td><?= $produits12 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits12 * 15  ?> Fcfa</td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr>
                                            <th>Niveau</th>
                                                <th>Total produits</th>
                                                <th>Calcul</th>
                                                <th class="text-right">Somme</th>
                                            </tr>
                                        </thead>
                                    </table>
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