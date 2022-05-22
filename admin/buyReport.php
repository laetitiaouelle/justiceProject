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
                            <div class="table-data__tool">
                            <form action="buyReport.php?date=<?= $_GET['date'] ?>" method="get">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <input  type="date" name="date" id="date" class="form-group">
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md">
                                            <input type="submit" class="btn btn-primary" name="submit" value="voir le rapport...">
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        
                                    </div>

                                    </form>
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
                            </div>
                        </div>
                <?php if(!isset($_GET['date'])){  ?>
                        <div class="row">
                              <div class="container-fluid">
                              <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <?php   
                                   $select = $bdd->prepare('SELECT * FROM detail_achat ORDER BY dateAchat desc');
                                   $select->execute();
                                   $datas=$select->fetchAll(PDO::FETCH_OBJ);
                                ?>
                                <div id="table" class="table-responsive m-b-40">
                                <center><h3>Rapport Général</h3></center><br>
                                    <table   class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>identifiant</th>
                                                <th>date</th>
                                                <th>Nb produits</th>
                                                <th>Achéteur</th>
                                                <th>prix</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($datas as $data):
                                            $fmem=$bdd->prepare('SELECT * FROM membres WHERE code = :code');
                                            $fmem->execute(['code'=>$data->CodeAcheteur]);
                                            $rs=$fmem->fetch();
                                        ?>

                                            <tr>
                                                <td><?= $data->idAchtat ?></td>
                                                <td><?= $data->dateAchat ?></td>
                                                <td><?= $data->quantite ?></td>
                                                <td class="process"><?= $rs['nom'].' '.$rs['prenom'] ?></td>
                                                <td><?= $data->quantite * 2500 ?>  Fcfa</td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                    </div>
                </div>

                        <?php
             }else{
    
    $date1=$_GET['date'];
    //echo $date1.'<br>';
    $hours = 23;
    $min = 59;
    $sec = 59; 
    $date2 =date('Y-m-d H:i:s',strtotime("+$hours hours +$min min +$sec sec", strtotime($date1)));
    $upreport=$bdd->prepare("SELECT * FROM detail_achat WHERE dateAchat BETWEEN  :date1 AND :date2 ");
$upreport->execute([
    'date1'=>$date1,
    'date2'=>$date2
]);
$rest=$upreport->fetchAll(PDO::FETCH_OBJ);
$lig=$upreport->rowCount();
if($lig == 0){ //si aucune ligne n'est  trouvé ?>

<div class="row">
                              <div class="container-fluid">
                              <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div id="table" class="table-responsive m-b-40">
                                    <table  class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                Aucune activité n'a été trouvé pour ce jour &nbsp; &nbsp; <a href="buyReport.php" role="btn" class="btn btn-primary">Revenir...</a>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                              </div>
                        </div>

<?php }else{ //si il y a au moins 1 ligne trouvé
//on sélectionne les données dans les membres.    

?>

<div class="row">
                              <div class="container-fluid">
                              <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <?php   
                                   $select = $bdd->prepare('SELECT * FROM detail_achat');
                                   $select->execute();
                                   $datas=$select->fetchAll(PDO::FETCH_OBJ);
                                ?>
                                <div id="table" class="table-responsive m-b-40">
                               <center> <h3>Rapport du <?= $_GET['date'] ?> </h3></center><br>
                                    <table   class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>identifiant</th>
                                                <th>date</th>
                                                <th>Nb produits</th>
                                                <th>Achéteur</th>
                                                <th>prix</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($rest as $ret):
                                            $fmem=$bdd->prepare('SELECT * FROM membres WHERE code = :code');
                                            $fmem->execute(['code'=>$ret->CodeAcheteur]);
                                            $rs=$fmem->fetch();
                                        ?>

                                            <tr>
                                                <td><?= $ret->idAchtat ?></td>
                                                <td><?= $ret->dateAchat ?></td>
                                                <td><?= $ret->quantite ?></td>
                                                <td class="process"><?= $rs['nom'].' '.$rs['prenom'] ?></td>
                                                <td><?= $ret->quantite * 2500 ?>  Fcfa</td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                              </div>
                        </div>

<?php } } ?>
<!-- on selectionne la liste de la meme date -->

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
    <script src="config/script.js"></script>
</body>

</html>


<?php
   }else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>
<!-- end document-->
