<!DOCTYPE html>
<html lang="en">

<?php 
$title= 'Enregistrer un nouvel achat';

require('partials/head.php');

?>

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
                    <h4 class=""><span class="fas fa-shopping-basket"></span> Enregistrer un nouvel achat</h4>
                    <br><br><br><br>

                       <div class="row">
                          <div class="col-md-6">
                                            <form action="addBuy.php" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <input type="text" id="userCode" name="userCode" placeholder="code de l'acheteur" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-sort-numeric-asc"></i>
                                                        </div>
                                                        <input type="number" id="quantite" name="quantite" placeholder="quantité" class="form-control">
                                                        <div class="input-group-addon">.00</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <input type="password" id="password" name="password" placeholder="Votre mot de passe" class="form-control">
                                                        <div class="input-group-addon">
                                                            <i class="fa  fa-key"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <div class="input-group">
                                                        <input type="submit" value="envoi" class="form-control btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </form>
                          </div>
                          <div class="col-md-6">
                             <?php
                                 foreach($errors as $error){

                                   echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Erreur </span>'.'<br>'.$error.'
 
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                    </button>
                                     </div>';
                                 }
                                      foreach($success as $succes){
                                  echo '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                  <span class="badge badge-pill badge-primary">Success </span>'.'<br>'.$succes.'
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                     </button>
                                    </div>';
                                     //echo ''.$error;
                                       }
                             ?>
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

