<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Paramètres';
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
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Gestions des admins</h3>
                                    <div class="filters m-b-45">
                                        <a href="addAdmins.php"> <button  class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>Ajouter un admin</button>
                                   </a>
                                    </div>
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    
                                                    <td>Nom</td>
                                                    <td>role</td>
                                                    <td>type</td>
                                                    <td></td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  //lancement de la requête.
                                                $q=$bdd->prepare('SELECT * FROM admin');
                                                $q->execute();
                                                $adfs=$q->fetchAll(PDO::FETCH_OBJ);
                                                foreach($adfs as $adf):
                                                 ?>
                                                <tr>
                                                    
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?= $adf->pseudo ?></h6>
                                                            <span>
                                                                <a href="#"><?= $adf->email ?></a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="role <?php  
                                                        if($adf->grade ==1){ echo 'member';}
                                                        elseif($adf->grade ==2){echo 'user';}
                                                        elseif($adf->grade ==3){ echo 'admin';}
                                                        ?>"><?php  
                                                        if($adf->grade ==1){ echo 'looker';}
                                                        elseif($adf->grade ==2){echo 'Admin';}
                                                        elseif($adf->grade ==3){ echo 'SuperAdmin';}
                                                        ?> </span>
                                                    </td>
                                                    <td>
                                                        <div class="rs-select2--trans rs-select2--sm">
                                                            <select class="js-select2" name="property">
                                                                <option selected="selected" >Changer grade</option>
                                                                <option value=""  title="Controle total">superAdmin</option>
                                                                <option value="" title="Controle moyen">Admin</option>
                                                                <option value="" title="vérifieur">Looker</option>
                                                            </select>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="more">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                <!-- END USER DATA-->
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