<?php session_start();
if(isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])){
require('config/bdd.connexion.php');
require('other/fonction.php');

$title= 'Bonus parrainage directe & leadership';

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

            <!-- STATISTIC bonus de parrainage directe-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                            <h4 class="title-5 m-b-35"><i class="fa fa-dot-circle-o"></i> Bonus de parrainage Direct</h4>
                            <p style="width:70%; text-align:left;margin-left:50px;">
                            Tout partenaire qui faire adhérer une nouvelle personne gagne 2000frs. Et ce, à chaque fois qu'il parraine une nouvelle personne.
                            </p>
                              <!-- on va calucler la somme sur chaque enfants direct-->
                              <?php  
						           $sn1 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir');
						           $sn1->execute(['parrainDir'=>$_SESSION['Ccode']]);
                                   $rs1 = $sn1->fetchAll(PDO::FETCH_OBJ);
                                   //foreach ($rs1 as $rs) {
                                       # code...
                                      // echo $rs->code.'<br>';
                                       
                                   //}
                                   
                                   $nb = $sn1->rowCount();
                                   
                                   if($nb!==0){
                                        $bp = 2000 * $nb;

                                        $g1 = $bdd->prepare('SELECT * FROM bonus_direct WHERE idMembre = :id and codeMembre=:code');
                                        $g1->execute([
                                            'id'=>$_SESSION['Cid'],
                                            'code'=>$_SESSION['Ccode']
                                        ]);
                                        $rt=$g1->fetch();

                                        $somDu = $bp;
                                        $somPa=$rt['somme'];
                                        $somRe=$somDu-$somPa;

                                   ?>

                                    <div id='table' class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                
                                                <th>Gain</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <tr class="tr-shadow">
                                                <td>
                                                   Vous avez <?= ' '.$nb.' ' ?> enfant(s) direct(s), Somme Engendrée: <?= ' '.$bp.' ' ?>Fcfa. <hr>
                                                   <?php if($somRe==0){
                                                       echo 'statut: Payé';
                                                   }else if($somRe >0){
                                                       echo 'Somme Due:'.$somDu.' Fcfa';
                                                       echo'<br> Somme Payé:'.$somPa.' Fcfa';
                                                       echo '<br>Somme Restante: '.$somRe.' Fcfa';
                                                   }?>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        </tbody>
                                    </table>
                            </div>
                                   <?php     
                                   }else{
                                      echo "Vous n'avez pas encore d'enfants parainés.";
                                   }
	                       ?>
                        </div>
                    </div>
                </div>
            </section><br><br><br>
            <!-- END STATISTIC-->
<!-- STATISTIC bonus de leadership-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!--contenu1-->
                        <div class="row">

                            <h4 class="title-5 m-b-35"><i class="fa fa-dot-circle-o"></i> Bonus de leadership</h4>
                            <p style="width:70%; text-align:left;margin-left:50px;">
                            Le bonus de leadership est le bonus qu'on obtient lorsque notre filleul parraine lui aussi une nouvelle personne dans le réseau. Il commence à partir du niveau 2 et s'obtient jusqu'au niveau 5                            </p>

                            <div id='table' class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                
                                                <th>niveau 2(1000Fcfax9)</th>
                                                <th>niveau 3(1000Fcfax27)</th>
                                                <th>niveau 4(500Fcfax81)</th>
                                                <th>niveau 5(500Fcfax243)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <tr class="tr-shadow">
                                                
                                                <td><!-- Sélection des enfants du niveau 2 -->
                                                <?php
                                                $table1=array(); // la table du nombre d'enfants nv2
                                                $codeParrainsN2=array(); // la table ou sera enregistrer les code des parrains nv2
                                                  foreach ($rs1 as $rs) {
						                           $sn2 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                           $sn2->execute([ 'parrainDir'=>$rs->code ]);
						                           $rs2 = $sn2->fetchAll(PDO::FETCH_OBJ);
                                                   $nb1 = $sn2->rowCount();
                                                   
                                                   // A chaque itération on push le result dans un tableau.
                                                   array_push($table1, $nb1);
                                                   foreach($rs2 as $r2){
                                                       array_push($codeParrainsN2, $r2->code);
                                                       //echo $r2->code;
                                                   }

                                            }
                                            
                                                //var_dump($table1);
                                                //on additionne maintenant les nombres du tableau.
                                                $nv2 =0;
                                                for($i=0; $i<sizeof($table1); $i++){
                                                     $nv2 += $table1[$i] ;
                                                }
                                                //echo $nv2;

                                                    if($nv2==9){
                                                          $bl2 = 1000 * $nv2;

                                        echo $bl2.' Fcfa';
                                        $g2 = $bdd->prepare('SELECT * FROM leadership WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                        $g2->execute([
                                            'id'=>$_SESSION['Cid'],
                                            'code'=>$_SESSION['Ccode'],
                                            'niveau'=>2
                                        ]);
                                        $rt1=$g2->fetch();

                                        if($rt1['statut']==1){
                                            echo' <br>Payé';
                                        }else{
                                            echo '<br>Impayé';
                                        }
                                                    }else{
                                                        echo' Le niveau 2 ne compte <br> pas encore 9 personnes<br><span style="color:blue;">'.$nv2.' personnes pour le moment</span>';
                                                    }
                                                ?>
                                                </td>
                                                <td><!-- Sélection des enfants du niveau 3 -->
                                                <?php
                                                $table2=array();
                                                $codeParrainsN3=array();
                                                   for($i=0; $i<sizeof($codeParrainsN2); $i++){
                                                    $sn3 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn3->execute([ 'parrainDir'=>$codeParrainsN2[$i] ]);
                                                    $rs3 = $sn3->fetchAll(PDO::FETCH_OBJ);
                                                    $nb2 = $sn3->rowCount();
                                                    array_push($table2, $nb2);

                                                    foreach($rs3 as $r3){
                                                        array_push($codeParrainsN3, $r3->code);
                                                        
                                                    }
                                                   }
                                                    // A chaque itération on push le result dans un tableau.
                                                    
                                                    //var_dump($table2);
                                                   //on additionne maintenant les nombres du tableau.
                                                $nv3 =0;
                                                for($i=0; $i<sizeof($table2); $i++){
                                                     $nv3 += $table2[$i] ;
                                                }
                                                //echo $nv3;

                                                    if($nv3==27){
                                                          $bl3 = 1000 * $nv3;

                                                          echo $bl3.' Fcfa';
                                        $g3 = $bdd->prepare('SELECT * FROM leadership WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                        $g3->execute([
                                            'id'=>$_SESSION['Cid'],
                                            'code'=>$_SESSION['Ccode'],
                                            'niveau'=>3
                                        ]);
                                        $rt2=$g3->fetch();

                                        if($rt2['statut']==1){
                                            echo' <br>Payé';
                                        }else{
                                            echo '<br>Impayé';
                                        }
                                                    }else{
                                                        echo' Le niveau 3 ne compte <br> pas encore 27 personnes<br><span style="color:blue;">'.$nv3.' personnes pour le moment</span>';
                                                    }
                                                
                                                 ?>  
                                                </td>
                                                <td><!-- Sélection des enfants du niveau 4 -->
                                                <?php  
                                                $table3=array();
                                                $codeParrainsN4=array();
                                                   for($i=0; $i<sizeof($codeParrainsN3); $i++){
                                                    $sn4 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn4->execute([ 'parrainDir'=>$codeParrainsN3[$i] ]);
                                                    $rs4 = $sn4->fetchAll(PDO::FETCH_OBJ);
                                                    $nb3 = $sn4->rowCount();
                                                    array_push($table3, $nb3);

                                                    foreach($rs4 as $r4){
                                                        array_push($codeParrainsN4, $r4->code);
                                                        
                                                    }
                                                   }
						                           
                                                   $nv4 =0;
                                                   for($i=0; $i<sizeof($table3); $i++){
                                                        $nv4 += $table3[$i] ;
                                                   }
                                                   //echo $nv3;
   
                                                       if($nv4==81){
                                                             $bl4 = 500 * $nv4;
   
                                                             echo $bl4.' Fcfa';
                                        $g4 = $bdd->prepare('SELECT * FROM leadership WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                        $g4->execute([
                                            'id'=>$_SESSION['Cid'],
                                            'code'=>$_SESSION['Ccode'],
                                            'niveau'=>4
                                        ]);
                                        $rt3=$g4->fetch();

                                        if($rt3['statut']==1){
                                            echo' <br>Payé';
                                        }else{
                                            echo '<br>Impayé';
                                        }
                                                       }else{
                                                           echo' Le niveau 4 ne compte <br> pas encore 81 personnes<br><span style="color:blue;">'.$nv4.' personnes pour le moment</span>';
                                                       }
                                                ?>
                                                </td>
                                                <td><!-- Sélection des enfants du niveau 5 -->
                                                <?php  
                                                $table4=array();
                                                   for($i=0; $i<sizeof($codeParrainsN4); $i++){
                                                    $sn5 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn5->execute([ 'parrainDir'=>$codeParrainsN4[$i] ]);
                                                    $rs5 = $sn5->fetchAll(PDO::FETCH_OBJ);
                                                    $nb4 = $sn5->rowCount();
                                                    array_push($table4, $nb4);

                                                   }
						                           
                                                   $nv5 =0;
                                                   for($i=0; $i<sizeof($table4); $i++){
                                                        $nv5 += $table4[$i] ;
                                                   }
                                                   //echo $nv3;
   
                                                       if($nv5==243){
                                                             $bl5 = 500 * $nv5;
   
                                                             echo $bl5.' Fcfa';
                                                             $g5 = $bdd->prepare('SELECT * FROM leadership WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                        $g5->execute([
                                            'id'=>$_SESSION['Cid'],
                                            'code'=>$_SESSION['Ccode'],
                                            'niveau'=>5
                                        ]);
                                        $rt4=$g5->fetch();

                                        if($rt4['statut']==1){
                                            echo' <br>Payé';
                                        }else{
                                            echo '<br>Impayé';
                                        }
                                                       }else{
                                                           echo' Le niveau 5 ne compte <br> pas encore 243 personnes<br><span style="color:blue;">'.$nv5.' personnes pour le moment</span>';
                                                       }
                                                ?>
                                                </td>
                                                
                                            </tr>
                                            <tr class="spacer"></tr>
                                        </tbody>
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