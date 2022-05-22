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
		width:100%;
		height:100%;
	}
	body{
		box-sizing:border-box;
		width:100%;
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
	border-top: 1px solid #ccc;
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
<div class="tree">
	<ul> <!-- niv0 -->
		<li>
			<a href="#">Parent</a>
			<ul><!-- niv1 -->
				<li>
					<a href="#">Child</a>
					<ul>
						<li>
							<a href="#">Grand Child</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">Child</a>
					<ul>
						<li><a href="#">Grand Child</a></li>
						<li>
							<a href="#">Grand Child</a>
							<ul>
								<li>
									<a href="#">Great Grand Child</a>
									<ul>
										<li><a href="#">Jhon smith</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
							</ul>
						</li>
						<li><a href="#">Grand Child</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Child</a>
					<ul>
						<li><a href="#">Grand Child</a></li>
						<li>
							<a href="#">Grand Child</a>
							<ul>
								<li>
									<a href="#">Great Grand Child</a>
									<ul>
										<li><a href="#">Jhon smith</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
							</ul>
						</li>
						<li><a href="#">Grand Child</a></li>
					</ul>
				</li>
			</ul><!-- niv1 -->
		</li>
	</ul><!-- niv0 -->
</div>
</body>
</html>