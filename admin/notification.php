<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();
$title= 'Notification';
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
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<i class="mr-2 fa fa-align-justify"></i>
										<strong class="card-title" v-if="headerText">notifications &nbsp;  <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <?php 
                                       $inser=$bdd->prepare('SELECT count(*) as nb FROM notifications');
                                       $inser->execute();
                                       $t=$inser->fetch();
                                       ?>
                                        <span class="quantity"><?=  $t['nb'] ?></span>
                                        
                                        </div></strong>
									</div>
									<div class="card-body">
                                       <?php 
                                       $insertion=$bdd->prepare('SELECT * FROM notifications ORDER BY date DESC');
                                       $insertion->execute();
                                       $results=$insertion->fetchAll(PDO::FETCH_OBJ);
                                       foreach($results as $result):
                                       ?>
                                    
                                     <div>
                                        <h4><?= $result->titre ?></h4>
                                        <p><?= $result->contenu?></p>
                                        <small><?= $result->date?></small>
                                        <hr>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                
								</div>
                                






							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
		<!-- END PAGE CONTAINER-->

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
