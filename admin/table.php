<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Liste des membres';
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
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Tout les membres</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">Voir tous</option>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="time">
                                                <option selected="selected">Actuellement</option>
                                                
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>Données filtrer</button>
                                    </div>
                                    <div class="table-data__tool-right">
                                    <a href="addMembers.php">
                                        <button  class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Ajouter un membres</button>
                                    </a>
                                        
                                        <button onclick="printC('table')" class="au-btn au-btn-icon au-btn--red au-btn--small" style='color:black'>
                                            <i class="zmdi zmdi-plus" ></i>Imprimer</button>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id='table' class="table-responsive table-responsive-data2">
                                    <table class="table table-data2" id="table">
                                        <thead>
                                            <tr>
                                                <th>nom</th>
                                                <th>email</th>
                                                <th>code</th>
                                                <th>Montants gagné</th>
                                                <th>Montants dus</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                             $q=$bdd->prepare('SELECT * FROM membres ORDER BY date DESC');
                                             $q->execute();
                                             $rss=$q->fetchAll(PDO::FETCH_OBJ);
                                        ?>
                                        <?php foreach ($rss as $rs ): ?>
                                            <tr class="tr-shadow">
                                                
                                                <td><?= $rs->nom.'<br>'.$rs->prenom ?></td>
                                                <td>
                                                    <span class="block-email"><?= $rs->email ?></span>
                                                </td>
                                                <td class="desc"><?= $rs->code ?></td>
                                                
                                                <td>$679.00</td>
                                                <td>$679.00</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                       <a href="gains.php?id=<?= $rs->id ?>&amp;code=<?= $rs->code ?>"> <!--On selectionne son id et son code -->
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Gains">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                        </a>
                                                        <a href="sendMessage.php?id=<?= $rs->id ?>&amp;code=<?= $rs->code ?>"">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Envoyer un message">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>
                                                        </a>
                                                        <a href="familytree.php?id=<?= $rs->id ?>&amp;code=<?= $rs->code ?>">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Arbre généalogique">
                                                            <i class="zmdi zmdi-accounts-list-alt"></i>
                                                        </button>
                                                        </a>
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        <?php endforeach ?>  
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
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
