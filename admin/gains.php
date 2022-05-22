<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();
$title= 'Voir les gains';

if(isset($_GET['id']) && !empty($_GET['id'])){
	if(isset($_GET['code']) && !empty($_GET['code'])){
	 //on vérife que le user existe.
	 $verf = $bdd->prepare('SELECT * FROM membres WHERE id=:id and code=:code');
	 $verf->execute([
		 'id'=> $_GET['id'],
		 'code'=>$_GET['code']
	 ]);
	 $membres=$verf->fetchAll(PDO::FETCH_OBJ);
	 $membres_T=$verf->rowcount();

	 if($membres_T !== 0){

		//on passe les informations id et code en session
		$idM = $_GET['id'];
		$codeM = $_GET['code'];
		$_SESSION['fid'] = $idM;
		$_SESSION['fcode'] = $codeM;

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
										<h4>Gains du client <span style="position:relative; left:100px; font-weight:250; color:red;">
											 <?php
											   if(isset($_SESSION['err'])){
												   echo $_SESSION['err'];
												   unset($_SESSION['err']);
											   }
											   if(isset($_SESSION['succ'])){
												echo $_SESSION['succ'];
												unset($_SESSION['succ']);
											}
											 ?>
										</span></h4>
									</div>
									<div class="card-body">
										<div class="custom-tab">

											<nav>
												<div class="nav nav-tabs" id="nav-tab" role="tablist">
													<a class="nav-item nav-link active" id="custom-nav-1-tab" data-toggle="tab" href="#custom-nav-1" role="tab" aria-controls="custom-nav-1"
													 aria-selected="true">parrainage direct</a>
													<a class="nav-item nav-link" id="custom-nav-2-tab" data-toggle="tab" href="#custom-nav-2" role="tab" aria-controls="custom-nav-2"
													 aria-selected="false">leadership</a>
													<a class="nav-item nav-link" id="custom-nav-3-tab" data-toggle="tab" href="#custom-nav-3" role="tab" aria-controls="custom-nav-3"
													 aria-selected="false">Bonus Equipe</a>
													<a class="nav-item nav-link" id="custom-nav-4-tab" data-toggle="tab" href="#custom-nav-4" role="tab" aria-controls="custom-nav-4"
													 aria-selected="false">Unilevel</a>
													<a class="nav-item nav-link" id="custom-nav-5-tab" data-toggle="tab" href="#custom-nav-5" role="tab" aria-controls="custom-nav-5"
													 aria-selected="false">Stairstep</a>
													<a class="nav-item nav-link" id="custom-nav-6-tab" data-toggle="tab" href="#custom-nav-6" role="tab" aria-controls="custom-nav-6"
													 aria-selected="false">Global pool profit</a>
												</div>
											</nav>
											<div class="tab-content pl-3 pt-2" id="nav-tabContent">
												<div class="tab-pane fade show active" id="custom-nav-1" role="tabpanel" aria-labelledby="custom-nav-1-tab">
													<!--<p>1</p>--><?php require('contents/gains/direct.php');  ?>
													<a href="clientSessionClose.php" role="btn" style="float:right" class="btn btn-danger">Fermer la session de ce client</a>
												</div>
												<div class="tab-pane fade" id="custom-nav-2" role="tabpanel" aria-labelledby="custom-nav-2-tab">
												<p><marquee><mark>Une fois que vous marquez un bonus comme payer, il n'y a plus de changement possible</mark></marquee><p>
												<?php require('contents/gains/leadership.php');  ?>
												<a href="clientSessionClose.php" role="btn" style="float:right" class="btn btn-danger">Fermer la session ce se client</a>
												</div>
												<div class="tab-pane fade" id="custom-nav-3" role="tabpanel" aria-labelledby="custom-nav-3-tab">
												<p><marquee><mark>Une fois que vous marquez un bonus comme payer, il n'y a plus de changement possible</mark></marquee><p>
												<?php require('contents/gains/equipe.php');  ?>
												<a href="clientSessionClose.php" role="btn" style="float:right" class="btn btn-danger">Fermer la session ce se client</a>
												</div>
												<div class="tab-pane fade" id="custom-nav-4" role="tabpanel" aria-labelledby="custom-nav-4-tab">
												<?php require('contents/gains/unilevel.php');  ?><br>
												<a href="clientSessionClose.php" role="btn" style="float:right" class="btn btn-danger">Fermer la session de ce client</a>
												</div>
												<div class="tab-pane fade" id="custom-nav-5" role="tabpanel" aria-labelledby="custom-nav-5-tab">
												<?php require('contents/gains/stairstep.php');  ?>
													<a href="clientSessionClose.php" role="btn" style="float:right" class="btn btn-danger">Fermer la session de ce client</a>
												</div>
												<div class="tab-pane fade" id="custom-nav-6" role="tabpanel" aria-labelledby="custom-nav-6-tab">
												<?php require('contents/gains/profit.php');  ?>
												<a href="clientSessionClose.php" role="btn" style="float:right" class="btn btn-danger">Fermer la session de ce client</a>
												</div>
											</div>

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
<?php
	 }else{
		 echo "Utilisateur Non Trouver <br> Redirection...";
		 echo'<meta http-equiv="refresh" content="2;URL=table.php">';
	 }
}else{
	echo'<meta http-equiv="refresh" content="0;URL=table.php">';
}

}else{
	echo'<meta http-equiv="refresh" content="0;URL=table.php">';
}
}else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>
<!-- end document-->
