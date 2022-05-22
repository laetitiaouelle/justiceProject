<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();

$title= 'Mon arbre généalogique';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<style>
    /*Now the CSS*/
	 
   
	 * {margin: 0; padding: 0;}
	html{
		width:1000%;
		height:1000%;
	}
	body{
		box-sizing:border-box;
		width:1000%;
		height:1000%;
		background:linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.8)), url('images/family.png');
	}
   .tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
   }

  .tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
   }

   /*Nous allons utiliser :: before et :: after pour dessiner les connecteurs*/

   .tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 2px solid black;
	width: 50%; height: 20px;
   }
   .tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
   }

   /*Nous devons retirer les connecteurs gauche-droite des éléments sans des frères et sœurs*/
   .tree li:only-child::after, .tree li:only-child::before {
	display: none;
   }

   /*Supprimer l'espace du sommet des enfants célibataires*/
   .tree li:only-child{ padding-top: 0;}

   /*Retirez le connecteur gauche du premier enfant et
   connecteur droit du dernier enfant*/
   .tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
   }
   /*Ajout du connecteur vertical aux derniers nœuds*/
   .tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
   }
   .tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
   }

   /*Il est temps d'ajouter des connecteurs descendants des parents*/
   .tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
   }

   .tree li a{
	border: 1px solid #ccc;
	padding: 5px 10px;
	text-decoration: none;
	color: #666;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
  }

   /*Temps pour des effets de survol*/
   /*Nous appliquerons également l'effet de survol de la lignée de l'élément*/
   .tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
   }
   /*Styles de connecteur en vol stationnaire*/
   .tree li a:hover+ul li::after, 
   .tree li a:hover+ul li::before, 
   .tree li a:hover+ul::before, 
   .tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
   }


</style>
</head>
<body>
       <!--
Nous allons créer un arbre généalogique en utilisant simplement CSS (3)
Le balisage sera de simples listes imbriquées
-->
<?php  
  if(isset($_GET['id']) && !empty($_GET['id'])){
	if(isset($_GET['code']) && !empty($_GET['code'])){
?>

<div class="tree">
	<ul> <!-- niv0 -->
	<?php
              $sn0 = $bdd->prepare('SELECT * FROM membres WHERE id = :id and code = :code');
				  $sn0->execute([
					  'id'=>$_GET['id'],
					  'code'=>$_GET['code']
				  ]);
				  $rs0 = $sn0->fetch();
	?>
		<li>
		<img style="border-radius:50%; width:50px;" src="<?php if(!empty($r0->avatar)){ echo 'images/'.$r0->id.'_'.$r0->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
			<a href="#"><?= $rs0['nom'].' '.$rs0['prenom'] ?></a>
			<ul><!-- niv1  on selectionne les enfant directs-->
			<?php  
						  $sn1 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						  $sn1->execute(['parrainDir'=>$rs0['code']]);
						  $rs1 = $sn1->fetchAll(PDO::FETCH_OBJ);
						  foreach($rs1 as $r1):
	       ?>    
				<li>
				<img style="border-radius:50%; width:50px;" src="<?php if(!empty($r1->avatar)){ echo 'images/'.$r1->id.'_'.$r1->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					<a href="#"><?= $r1->nom.' '.$r1->prenom ?></a>

					<ul><!-- niv2  on selectionne les enfant directs -->
					<?php  
						  $sn2 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						  $sn2->execute(['parrainDir'=>$r1->code]);
						  $rs2 = $sn2->fetchAll(PDO::FETCH_OBJ);
						  foreach($rs2 as $r2):
	            ?> 
                      <li>
							 <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r2->avatar)){ echo 'images/'.$r2->id.'_'.$r2->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					           <a href="#"><?= $r2->nom.' '.$r2->prenom ?></a>
								  <ul><!-- niv3  on selectionne les enfant directs -->
								  <?php  
						               $sn3 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						               $sn3->execute(['parrainDir'=>$r2->code]);
						               $rs3 = $sn3->fetchAll(PDO::FETCH_OBJ);
						               foreach($rs3 as $r3):
	                       ?> 
								        <li>
										  <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r3->avatar)){ echo 'images/'.$r3->id.'_'.$r3->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					                      <a href="#"><?= $r3->nom.' '.$r3->prenom ?></a>
												 <ul><!-- niv4  on selectionne les enfant directs -->
												 <?php  
						                      $sn4 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                      $sn4->execute(['parrainDir'=>$r3->code]);
						                      $rs4 = $sn4->fetchAll(PDO::FETCH_OBJ);
						                      foreach($rs4 as $r4):
	                                 ?>
												<li>
										          <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r4->avatar)){ echo 'images/'.$r4->id.'_'.$r4->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					                         <a href="#"><?= $r4->nom.' '.$r4->prenom ?></a>
													 <ul><!-- niv5  on selectionne les enfant directs -->
													   <?php  
						                           $sn5 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                           $sn5->execute(['parrainDir'=>$r4->code]);
						                           $rs5 = $sn5->fetchAll(PDO::FETCH_OBJ);
						                           foreach($rs5 as $r5):
	                                       ?>
														<li>
										               <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r5->avatar)){ echo 'images/'.$r5->id.'_'.$r5->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					                              <a href="#"><?= $r5->nom.' '.$r5->prenom ?></a>
															<ul><!-- niv6  on selectionne les enfant directs -->
															 <?php  
						                               $sn6 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                               $sn6->execute(['parrainDir'=>$r5->code]);
						                               $rs6 = $sn6->fetchAll(PDO::FETCH_OBJ);
						                               foreach($rs6 as $r6):
	                                          ?>
															       <li>
										                         <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r6->avatar)){ echo 'images/'.$r6->id.'_'.$r6->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					                                        <a href="#"><?= $r6->nom.' '.$r6->prenom ?></a>
																		 <ul><!-- niv7  on selectionne les enfant directs -->
																		   <?php  
						                                          $sn7 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                                          $sn7->execute(['parrainDir'=>$r6->code]);
						                                          $rs7 = $sn7->fetchAll(PDO::FETCH_OBJ);
						                                             foreach($rs7 as $r7):
	                                                       ?>
																			    <li>
										                                  <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r7->avatar)){ echo 'images/'.$r7->id.'_'.$r7->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					                                                 <a href="#"><?= $r7->nom.' '.$r7->prenom ?></a>
																					 <ul><!-- niv8  on selectionne les enfant directs -->
																					    <?php  
						                                                    $sn8 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                                                    $sn8->execute(['parrainDir'=>$r7->code]);
						                                                    $rs8 = $sn8->fetchAll(PDO::FETCH_OBJ);
						                                                    foreach($rs8 as $r8):
	                                                               ?>
																					  <li>
										                                     <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r8->avatar)){ echo 'images/'.$r8->id.'_'.$r8->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					                                                    <a href="#"><?= $r8->nom.' '.$r8->prenom ?></a>
																						 <ul><!-- niv9  on selectionne les enfant directs -->
																						<?php  
						                                                    $sn9 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                                                    $sn9->execute(['parrainDir'=>$r8->code]);
						                                                    $rs9 = $sn9->fetchAll(PDO::FETCH_OBJ);
						                                                    foreach($rs9 as $r9):
	                                                               ?>
																						<li>
										                                     <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r9->avatar)){ echo 'images/'.$r9->id.'_'.$r9->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					                                                    <a href="#"><?= $r9->nom.' '.$r9->prenom ?></a>
																						 <ul><!-- niv9  on selectionne les enfant directs -->
																						 <?php  
						                                                    $sn10 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                                                    $sn10->execute(['parrainDir'=>$r9->code]);
						                                                    $rs10 = $sn10->fetchAll(PDO::FETCH_OBJ);
						                                                    foreach($rs10 as $r10):
	                                                               ?>
																						<li>
										                                     <img style="border-radius:50%; width:50px;" src="<?php if(!empty($r10->avatar)){ echo 'images/'.$r10->id.'_'.$r10->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
					                                                    <a href="#"><?= $r10->nom.' '.$r10->prenom ?></a>
																						 </li>
																						 <?php  endforeach ?> 
																						 </ul>
																						 </li>
																						 <?php  endforeach ?> 
																					 </li>
																					   
																						</ul>
																					    <?php  endforeach ?>
																					 </ul>
																				</li>
																				<?php  endforeach ?> 
																		 </ul>
															       </li>
																   <?php  endforeach ?> 
															</ul>
													 </li>
													 <?php  endforeach ?>	
													 </ul>
												</li>
												<?php  endforeach ?>
												 </ul>
										  </li>
										  <?php  endforeach ?>	
								  </ul>
							</li>
							<?php  endforeach ?>	
					</ul>
					
				</li>
				<?php  endforeach ?>	
			</ul><!-- niv1 -->
		</li>
	</ul><!-- niv0 -->
</div>
<style>
	#para{
 position:fixed;
 left:0;
 top:0;
 bottom:0;
 width:300px;
 background-color:#555;
 padding: 1% 2%;
 display:none;
	}
	.cont{
		width:25%;
		height:100px;
	}
	.cont span{
		width:100%;
	}
	#para .cont{
		display:inline-block;
	}
	#enfp{
		position:fixed;
		right:10px;
		top:10px;
		padding:7px;
		border-radius:10px;
	}

</style>
<?php
$paE=$bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=1');
$paE->execute([
	'parrainDir'=>$_GET['code']
]);
$enfs=$paE->fetchAll(PDO::FETCH_OBJ); ?>
<button id="enfp">Les parachutés</button>
<div class='para' id='para'>
<?php foreach($enfs as $p): ?>
  <div class='cont'>
  <img style="border-radius:50%; width:50px;" src="<?php if(!empty($p->avatar)){ echo 'images/'.$p->id.'_'.$p->avatar; }else{ echo 'images/avatar.png'; } ?>"><br>
  <span> <?= $p->nom.' '.$p->prenom  ?></span>
  </div>
  <?php   endforeach ?>
</div>
<script src="css/jquery-3-4-1.min.js"></script>
<script>
$( "button" ).click(function() {
  $( "#para" ).toggle( "slow" );
});
</script>


<?php	}else{
     echo "Paramètre d'affichage 2 manquant";
	}
} else{
   echo "Paramètre d'affichage 1 manquant";
}
?>
</body>
</html>
<?php }else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>
