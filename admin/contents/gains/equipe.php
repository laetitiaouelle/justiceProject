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
						                         $sn1 = $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
						                          $sn1->execute(['parrainDir'=>$_GET['code']]);
                                                  $rs1 = $sn1->fetchAll(PDO::FETCH_OBJ);
                                   
                                   
                                                 $nb = $sn1->rowCount();
                                   
                                                   if($nb==3){
                                                   $be1 = 200 * $nb;

                                      //on verifie si la table est vide
                                      $verif1=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif1->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>1
                                      ]);
                                      $p1 = $verif1->fetch();
                                      $ligne1 = $verif1->rowCount();
                                      if($ligne1==0){
                                          $req1=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req1->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be1,
                                            'niveau'=>1
                                        ]);
                                        if($req1){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m1=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre)');
                                            $m1->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be1,
                                                'niveau'=>1,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m1){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }


                                                       echo $be1.' Fcfa';

                                                       $a1=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                       $a1->execute([
                                                              'niveau'=>1,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b1=$a1->fetch();
                                                       if($b1['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=1&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b1['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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



                                                          //on verifie si la table est vide
                                      $verif2=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif2->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>2
                                      ]);
                                      $p2 = $verif2->fetch();
                                      $ligne2 = $verif2->rowCount();
                                      if($ligne2==0){
                                          $req2=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req2->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be2,
                                            'niveau'=>2
                                        ]);
                                        if($req2){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m2=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m2->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be2,
                                                'niveau'=>2,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m2){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }

                                                          echo $be2.' Fcfa';
                                                          $a2=$bdd->prepare('SELECT * FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                          $a2->execute([
                                                                 'niveau'=>2,
                                                                 'membre'=>$_GET['id']
                                                          ]);
                                                          $b2=$a2->fetch();
                                                       if($b2['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=2&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b2['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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

                                                    if($nv3==5){
                                                          $be3 = 200 * $nv3;


                                       //on verifie si la table est vide
                                      $verif3=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif3->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>3
                                      ]);
                                      $p3 = $verif3->fetch();
                                      $ligne3 = $verif3->rowCount();
                                      if($ligne3==0){
                                          $req3=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) 
                                          VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req3->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be3,
                                            'niveau'=>3
                                        ]);
                                        if($req3){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m3=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m3->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be3,
                                                'niveau'=>3,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m3){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }


                                                          echo $be3.' Fcfa';
                                                          $a3=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                          $a3->execute([
                                                                 'niveau'=>3,
                                                                 'membre'=>$_GET['id']
                                                          ]);
                                                          $b3=$a3->fetch();
                                                          if($b3['statut'] == 0){
                                                           echo '<br>Statut : <a href="paye.php?niv=3&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                          }else if($b3['statut']==1){
                                                           echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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
   

                                                    //on verifie si la table est vide
                                      $verif4=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif4->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>4
                                      ]);
                                      $p14= $verif4->fetch();
                                      $ligne4 = $verif4->rowCount();
                                      if($ligne4==0){
                                          $req4=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) 
                                          VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req4->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be4,
                                            'niveau'=>4
                                        ]);
                                        if($req4){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m4=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m4->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be4,
                                                'niveau'=>4,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m4){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }


                                                             echo $be4.' Fcfa';
                                                             $a4=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                           $a4->execute([
                                                              'niveau'=>4,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b4=$a4->fetch();
                                                       if($b4['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=4&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b4['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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


                                                      //on verifie si la table est vide
                                      $verif5=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif5->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>5
                                      ]);
                                      $p5 = $verif5->fetch();
                                      $ligne5 = $verif5->rowCount();
                                      if($ligne5==0){
                                          $req5=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) 
                                          VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req5->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be5,
                                            'niveau'=>5
                                        ]);
                                        if($req5){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m5=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m5->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be5,
                                                'niveau'=>5,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m5){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }


   
                                                             echo $be5.' Fcfa';
                                                             $a5=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                       $a5->execute([
                                                              'niveau'=>5,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b5=$a5->fetch();
                                                       if($b5['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=5&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b5['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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


                                                             //on verifie si la table est vide
                                      $verif6=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif6->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>6
                                      ]);
                                      $p6 = $verif6->fetch();
                                      $ligne6 = $verif6->rowCount();
                                      if($ligne6==0){
                                          $req6=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau,date) 
                                          VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req6->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be6,
                                            'niveau'=>6
                                        ]);
                                        if($req6){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m6=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m6->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be6,
                                                'niveau'=>6,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m6){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }
   
                                                             echo $be6.' Fcfa';
                                                             $a6=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                       $a6->execute([
                                                              'niveau'=>6,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b6=$a6->fetch();
                                                       if($b6['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=6&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b6['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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
   


                                                         //on verifie si la table est vide
                                      $verif7=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif7->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>7
                                      ]);
                                      $p7 = $verif7->fetch();
                                      $ligne7 = $verif7->rowCount();
                                      if($ligne7==0){
                                          $req7=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) 
                                          VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req7->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be7,
                                            'niveau'=>7
                                        ]);
                                        if($req7){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m7=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m7->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be7,
                                                'niveau'=>7,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m7){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }


                                                             echo $be7.' Fcfa';
                                                             $a7=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                       $a7->execute([
                                                              'niveau'=>7,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b7=$a7->fetch();
                                                       if($b7['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=7&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b7['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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
   

                                                        //on verifie si la table est vide
                                      $verif8=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif8->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>8
                                      ]);
                                      $p8 = $verif8->fetch();
                                      $ligne8 = $verif8->rowCount();
                                      if($ligne8==0){
                                          $req8=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) 
                                          VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req8->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be8,
                                            'niveau'=>8
                                        ]);
                                        if($req8){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m8=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m8->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be8,
                                                'niveau'=>8,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m8){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }



                                                             echo $be8.' Fcfa';
                                                             $a8=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                       $a8->execute([
                                                              'niveau'=>8,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b8=$a8->fetch();
                                                       if($b8['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=8&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b8['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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
   



                                                            //on verifie si la table est vide
                                      $verif9=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif9->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>9
                                      ]);
                                      $p9 = $verif9->fetch();
                                      $ligne9 = $verif9->rowCount();
                                      if($ligne9==0){
                                          $req9=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) 
                                          VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req9->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be9,
                                            'niveau'=>9
                                        ]);
                                        if($req9){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m9=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m9->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be9,
                                                'niveau'=>9,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m9){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }




                                                             echo $be9.' Fcfa';
                                                             $a9=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                       $a9->execute([
                                                              'niveau'=>9,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b9=$a9->fetch();
                                                       if($b9['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=9&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b9['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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


                                                             //on verifie si la table est vide
                                      $verif10=$bdd->prepare('SELECT * FROM equipe WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif10->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>10
                                      ]);
                                      $p10 = $verif10->fetch();
                                      $ligne10 = $verif10->rowCount();
                                      if($ligne10==0){
                                          $req10=$bdd->prepare('INSERT INTO equipe(idMembre, codeMembre, statut, somme, niveau, date) 
                                          VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req10->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$be10,
                                            'niveau'=>10
                                        ]);
                                        if($req10){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m10=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m10->execute([
                                                'type'=>'equipe',
                                                'somme'=>$be10,
                                                'niveau'=>10,
                                                'idMembre'=>$_GET['id'],
                                                'codeMembre'=>$_GET['code']
                                            ]);
                                            if($m10){
                                                //echo 'okok';
                                            }else{
                                                //echo 'no';
                                            }
                                        }
                                      }else{

                                      }
   
                                                             echo $be10.' Fcfa';
                                                             $a10=$bdd->prepare('SELECT statut FROM equipe WHERE  niveau= :niveau and idMembre= :membre');
                                                       $a10->execute([
                                                              'niveau'=>10,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b10=$a10->fetch();
                                                       if($b10['statut'] == 0){
                                                        echo '<br>Statut : <a href="paye.php?niv=10&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b10['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right"> Payé</span>';
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