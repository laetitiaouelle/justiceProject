<?php session_start();
if(isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])){
require('config/bdd.connexion.php');
require('other/fonction.php');
$title= 'Bonus Equipe';

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
            <!-- END STATISTIC-->
<!-- STATISTIC bonus de leadership-->
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!--contenu1-->
                        <div class="row">

                            <h4 class="title-5 m-b-35"><i class="fa fa-dot-circle-o"></i> Bonus d'equipe</h4>
                            <p style="width:76%; text-align:left;margin-left:50px;">
                            Le bonus d'équipe est le bonus perçu sur toute l'équipe établie du niveau 1 au niveau 10. C'est une matrice 3x10 (de 3personnes sur 10 niveaux de profondeur). À chaque fois qu'une personne tombe à l'un des niveaux cela génère automatiquement un gain dans le réseau.
                            <div id='table' class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>niveau 1(200Fcfax3)
                                                <th>niveau 2(200Fcfax9)</th>
                                                <th>niveau 3(200Fcfax27)</th>
                                                <th>niveau 4(200Fcfax81)</th>
                                                <th>niveau 5(200Fcfax243)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <tr class="tr-shadow">
                                               <td><!-- Sélection des enfants du niveau 1 -->
                                               <?php  
						                         $sn1 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0 ');
						                          $sn1->execute(['parrainDir'=>$_SESSION['Ccode']]);
                                                  $rs1 = $sn1->fetchAll(PDO::FETCH_OBJ);
                                   
                                   
                                                 $nb = $sn1->rowCount();
                                   
                                                   if($nb==3){
                                                   $be1 = 200 * $nb;
                                                       echo $be1.' Fcfa';

                                                       $g1 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                      $g1->execute([
                                                              'id'=>$_SESSION['Cid'],
                                                               'code'=>$_SESSION['Ccode'],
                                                               'niveau'=>1
                                                      ]);
                                                      $rt1=$g1->fetch();

                                                         if($rt1['statut']==1){
                                                              echo' <br>Payé';
                                                            }else{
                                                              echo '<br>Impayé';
                                                           }
                                                   }else{
                                                       echo 'niveau incomplet<hr>'. $nb.' personnes pour le moment';
                                                   }

                                                  ?>
                                               </td> 
                                                <td style="margin-top: 0;"><!-- Sélection des enfants du niveau 2 -->
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
                                                          $be2 = 200 * $nv2;

                                                          echo $be2.' Fcfa';
                                                          $g2 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g2->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>2
                                                          ]);
                                                          $rt2=$g2->fetch();
    
                                                             if($rt2['statut']==1){
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
                                                          $be3 = 200 * $nv3;

                                                          echo $be3.' Fcfa';
                                                          $g3 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g3->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>3
                                                          ]);
                                                          $rt3=$g3->fetch();
    
                                                             if($rt3['statut']==1){
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
                                                             $be4 = 200 * $nv4;
   
                                                             echo $be4.' Fcfa';
                                                             $g4 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g4->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>4
                                                          ]);
                                                          $rt4=$g4->fetch();
    
                                                             if($rt4['statut']==1){
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
                                                $codeParrainsN5=array();
                                                   for($i=0; $i<sizeof($codeParrainsN4); $i++){
                                                    $sn5 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn5->execute([ 'parrainDir'=>$codeParrainsN4[$i] ]);
                                                    $rs5 = $sn5->fetchAll(PDO::FETCH_OBJ);
                                                    $nb4 = $sn5->rowCount();
                                                    array_push($table4, $nb4);

                                                    foreach($rs5 as $r5){
                                                        array_push($codeParrainsN5, $r5->code);
                                                        
                                                    }

                                                   }
						                           
                                                   $nv5 =0;
                                                   for($i=0; $i<sizeof($table4); $i++){
                                                        $nv5 += $table4[$i] ;
                                                   }
                                                   //echo $nv3;
   
                                                       if($nv5==243){
                                                             $be5 = 200 * $nv5;
   
                                                             echo $be5.' Fcfa';
                                                             $g5 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g5->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>5
                                                          ]);
                                                          $rt5=$g5->fetch();
    
                                                             if($rt5['statut']==1){
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
            </section> <hr>

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!--contenu1-->
                        <div class="row">
                        <div id='table' class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>niveau 6(200Fcfax729)
                                                <th>niveau 7(100Fcfax2187)</th>
                                                <th>niveau 8(100Fcfax6561)</th>
                                                <th>niveau 9(100Fcfax19683)</th>
                                                <th>niveau 10(100Fcfax59049)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <tr class="tr-shadow">
                                               <td><!-- Sélection des enfants du niveau 6 -->
                                               <?php  
                                                $table5=array();
                                                $codeParrainsN6=array();
                                                   for($i=0; $i<sizeof($codeParrainsN5); $i++){
                                                    $sn6 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn6->execute([ 'parrainDir'=>$codeParrainsN5[$i] ]);
                                                    $rs6 = $sn6->fetchAll(PDO::FETCH_OBJ);
                                                    $nb5 = $sn6->rowCount();
                                                    array_push($table5, $nb5);

                                                    foreach($rs6 as $r6){
                                                        array_push($codeParrainsN6, $r6->code);
                                                        
                                                    }

                                                   }
						                           
                                                   $nv6 =0;
                                                   for($i=0; $i<sizeof($table5); $i++){
                                                        $nv6 += $table5[$i] ;
                                                   }
                                                   //echo $nv3;
   
                                                       if($nv6==729){
                                                             $be6 = 200 * $nv6;
   
                                                             echo $be6.' Fcfa';
                                                             $g6 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g6->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>6
                                                          ]);
                                                          $rt6=$g6->fetch();
    
                                                             if($rt6['statut']==1){
                                                                  echo' <br>Payé';
                                                                }else{
                                                                  echo '<br>Impayé';
                                                               }
                                                       }else{
                                                           echo' Le niveau 6 ne compte <br> pas encore 729 personnes<br><span style="color:blue;">'.$nv6.' personnes pour le moment</span>';
                                                       }
                                                ?>
                                               </td> 
                                                <td style="margin-top: 0;"><!-- Sélection des enfants du niveau 7 -->
                                            <?php  
                                                $table6=array();
                                                $codeParrainsN7=array();
                                                   for($i=0; $i<sizeof($codeParrainsN6); $i++){
                                                    $sn7 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn7->execute([ 'parrainDir'=>$codeParrainsN6[$i] ]);
                                                    $rs7 = $sn7->fetchAll(PDO::FETCH_OBJ);
                                                    $nb6 = $sn7->rowCount();
                                                    array_push($table6, $nb6);

                                                    foreach($rs7 as $r7){
                                                        array_push($codeParrainsN7, $r7->code);
                                                        
                                                    }

                                                   }
						                           
                                                   $nv7 =0;
                                                   for($i=0; $i<sizeof($table6); $i++){
                                                        $nv7 += $table6[$i] ;
                                                   }
                                                   //echo $nv3;
   
                                                       if($nv7==2187){
                                                             $be7 = 100 * $nv7;
   
                                                             echo $be7.' Fcfa';
                                                             $g7 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g7->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>7
                                                          ]);
                                                          $rt7=$g7->fetch();
    
                                                             if($rt7['statut']==1){
                                                                  echo' <br>Payé';
                                                                }else{
                                                                  echo '<br>Impayé';
                                                               }
                                                       }else{
                                                           echo' Le niveau 7 ne compte <br> pas encore 2187 personnes<br><span style="color:blue;">'.$nv7.' personnes pour le moment</span>';
                                                       }
                                            ?>
                                                </td>
                                                <td><!-- Sélection des enfants du niveau 8 -->
                                                <?php  
                                                $table7=array();
                                                $codeParrainsN8=array();
                                                   for($i=0; $i<sizeof($codeParrainsN7); $i++){
                                                    $sn8 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn8->execute([ 'parrainDir'=>$codeParrainsN7[$i] ]);
                                                    $rs8 = $sn8->fetchAll(PDO::FETCH_OBJ);
                                                    $nb7 = $sn8->rowCount();
                                                    array_push($table7, $nb7);

                                                    foreach($rs8 as $r8){
                                                        array_push($codeParrainsN8, $r8->code);
                                                        
                                                    }

                                                   }
						                           
                                                   $nv8 =0;
                                                   for($i=0; $i<sizeof($table7); $i++){
                                                        $nv8 += $table7[$i] ;
                                                   }
                                                   //echo $nv3;
   
                                                       if($nv8==6561){
                                                             $be8 = 100 * $nv8;
   
                                                             echo $be8.' Fcfa';
                                                             $g8 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g8->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>8
                                                          ]);
                                                          $rt8=$g8->fetch();
    
                                                             if($rt8['statut']==1){
                                                                  echo' <br>Payé';
                                                                }else{
                                                                  echo '<br>Impayé';
                                                               }
                                                       }else{
                                                           echo' Le niveau 8 ne compte <br> pas encore 6561 personnes<br><span style="color:blue;">'.$nv8.' personnes pour le moment</span>';
                                                       }
                                            ?>
                                              
                                                </td>
                                                <td><!-- Sélection des enfants du niveau 9 -->
                                                <?php  
                                                $table8=array();
                                                $codeParrainsN9=array();
                                                   for($i=0; $i<sizeof($codeParrainsN8); $i++){
                                                    $sn9 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn9->execute([ 'parrainDir'=>$codeParrainsN8[$i] ]);
                                                    $rs9 = $sn9->fetchAll(PDO::FETCH_OBJ);
                                                    $nb8 = $sn9->rowCount();
                                                    array_push($table8, $nb8);

                                                    foreach($rs9 as $r9){
                                                        array_push($codeParrainsN9, $r9->code);
                                                        
                                                    }

                                                   }
						                           
                                                   $nv9 =0;
                                                   for($i=0; $i<sizeof($table8); $i++){
                                                        $nv9 += $table8[$i] ;
                                                   }
                                                   //echo $nv3;
   
                                                       if($nv9==19683){
                                                             $be9 = 100 * $nv9;
   
                                                             echo $be9.' Fcfa';
                                                             $g9 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g9->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>9
                                                          ]);
                                                          $rt9=$g9->fetch();
    
                                                             if($rt9['statut']==1){
                                                                  echo' <br>Payé';
                                                                }else{
                                                                  echo '<br>Impayé';
                                                               }
                                                       }else{
                                                           echo' Le niveau 9 ne compte <br> pas encore 19683 personnes<br><span style="color:blue;">'.$nv9.' personnes pour le moment</span>';
                                                       }
                                            ?>
                                                </td>
                                                <td><!-- Sélection des enfants du niveau 10 -->
                                                <?php  
                                                $table9=array();
                                                $codeParrainsN10=array();
                                                   for($i=0; $i<sizeof($codeParrainsN9); $i++){
                                                    $sn10 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
                                                    $sn10->execute([ 'parrainDir'=>$codeParrainsN9[$i] ]);
                                                    $rs10 = $sn10->fetchAll(PDO::FETCH_OBJ);
                                                    $nb9 = $sn10->rowCount();
                                                    array_push($table9, $nb9);

                                                    foreach($rs10 as $r10){
                                                        array_push($codeParrainsN10, $r10->code);
                                                        
                                                    }

                                                   }
						                           
                                                   $nv10 =0;
                                                   for($i=0; $i<sizeof($table9); $i++){
                                                        $nv10 += $table9[$i] ;
                                                   }
                                                   //echo $nv3;
   
                                                       if($nv10==59049){
                                                             $be10 = 100 * $nv10;
   
                                                             echo $be10.' Fcfa';
                                                             $g10 = $bdd->prepare('SELECT * FROM equipe WHERE idMembre = :id and codeMembre=:code and niveau=:niveau');
                                                          $g10->execute([
                                                                  'id'=>$_SESSION['Cid'],
                                                                   'code'=>$_SESSION['Ccode'],
                                                                   'niveau'=>10
                                                          ]);
                                                          $rt10=$g10->fetch();
    
                                                             if($rt10['statut']==1){
                                                                  echo' <br>Payé';
                                                                }else{
                                                                  echo '<br>Impayé';
                                                               }
                                                       }else{
                                                           echo' Le niveau 10 ne compte <br> pas encore 59049 personnes<br><span style="color:blue;">'.$nv10.'personnes pour le moment</span>';
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