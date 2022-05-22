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



                                                    //on verifie si la table est vide
                                      $verif2=$bdd->prepare('SELECT * FROM leadership WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif2->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>2
                                      ]);
                                      $p2 = $verif2->fetch();
                                      $ligne2 = $verif2->rowCount();
                                      if($ligne2==0){
                                          $req2=$bdd->prepare('INSERT INTO leadership(idMembre, codeMembre, statut, somme, niveau, date) VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req2->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$bl2,
                                            'niveau'=>2
                                        ]);
                                        if($req2){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m2=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m2->execute([
                                                'type'=>'leadership',
                                                'somme'=>$bl2,
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
      

                                                        echo $bl2.' Fcfa';
                                                       $a2=$bdd->prepare('SELECT statut FROM leadership WHERE niveau= :niveau and idMembre= :membre');
                                                       $a2->execute([
                                                              'niveau'=>2,
                                                              'membre'=>$_GET['id']
                                                       ]);
                                                       $b2=$a2->fetch();
                                                       if($b2['statut'] == 0){
                                                        echo '<br>Statut : <a href="payl.php?niv=2&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                       }else if($b2['statut']==1){
                                                        echo '<br>Statut:  <span class="fa fa-hand-o-right">Payé</span>';
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




                                                          //on verifie si la table est vide
                                      $verif3=$bdd->prepare('SELECT * FROM leadership WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif3->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>3
                                      ]);
                                      $p3 = $verif3->fetch();
                                      $ligne3 = $verif3->rowCount();
                                      if($ligne3==0){
                                          $req3=$bdd->prepare('INSERT INTO leadership(idMembre, codeMembre, statut, somme, niveau, date) VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req3->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$bl3,
                                            'niveau'=>3
                                        ]);
                                        if($req3){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m3=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m3->execute([
                                                'type'=>'leadership',
                                                'somme'=>$bl3,
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


                                                          echo $bl3.' Fcfa';

                                                          $a3=$bdd->prepare('SELECT statut FROM leadership WHERE niveau= :niveau and idMembre= :membre');
                                                          $a3->execute([
                                                                 'niveau'=>3,
                                                                 'membre'=>$_GET['id']
                                                          ]);
                                                          $b3=$a3->fetch();
                                                          if($b3['statut'] == 0){
                                                           echo '<br>Statut : <a href="payl.php?niv=3&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                          }else if($b3['statut']==1){
                                                           echo '<br>Statut:  <span class="fa fa-hand-o-right">Payé</span>';
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



                                                              //on verifie si la table est vide
                                      $verif4=$bdd->prepare('SELECT * FROM leadership WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif4->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>4
                                      ]);
                                      $p4 = $verif4->fetch();
                                      $ligne4 = $verif4->rowCount();
                                      if($ligne4==0){
                                          $req4=$bdd->prepare('INSERT INTO leadership(idMembre, codeMembre, statut, somme, niveau, date) VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req4->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$bl4,
                                            'niveau'=>4
                                        ]);
                                        if($req4){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m4=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m4->execute([
                                                'type'=>'leadership',
                                                'somme'=>$bl4,
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
   
                                                             echo $bl4.' Fcfa';
                                                             $a4=$bdd->prepare('SELECT statut FROM leadership WHERE niveau= :niveau and idMembre= :membre');
                                                             $a4->execute([
                                                                    'niveau'=>4,
                                                                    'membre'=>$_GET['id']
                                                             ]);
                                                             $b4=$a4->fetch();
                                                             if($b4['statut'] == 0){
                                                              echo '<br>Statut : <a href="payl.php?niv=2&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                             }else if($b4['statut']==1){
                                                              echo '<br>Statut:  <span class="fa fa-hand-o-right">Payé</span>';
                                                             }                                                            }else{
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




                                                              //on verifie si la table est vide
                                      $verif5=$bdd->prepare('SELECT * FROM leadership WHERE idMembre = :idMembre and codeMembre = :codeMembre and niveau = :niveau');
                                      $verif5->execute([
                                          'idMembre'=>$_GET['id'],
                                          'codeMembre'=>$_GET['code'],
                                          'niveau'=>5
                                      ]);
                                      $p5 = $verif5->fetch();
                                      $ligne5 = $verif5->rowCount();
                                      if($ligne5==0){
                                          $req5=$bdd->prepare('INSERT INTO leadership(idMembre, codeMembre, statut, somme, niveau, date) VALUE(:idMembre, :codeMembre, :statut, :somme, :niveau, NOW())');
                                          $req5->execute([
                                            'idMembre'=>$_GET['id'],
                                            'codeMembre'=>$_GET['code'],
                                            'statut'=>0,
                                            'somme'=>$bl5,
                                            'niveau'=>5
                                        ]);
                                        if($req5){
                                            //on envoie une notification pour signaler le nouveau niveau
                                            //echo 'ok';
                                            $m5=$bdd->prepare('INSERT INTO remuneration(type, somme, niveau, idMembre, codeMembre, date) 
                                            VALUE(:type, :somme, :niveau, :idMembre, :codeMembre, NOW())');
                                            $m5->execute([
                                                'type'=>'leadership',
                                                'somme'=>$bl5,
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
   
                                                             echo $bl5.' Fcfa';
                                                             $a5=$bdd->prepare('SELECT statut FROM leadership WHERE niveau= :niveau and idMembre= :membre');
                                                             $a5->execute([
                                                                    'niveau'=>5,
                                                                    'membre'=>$_GET['id']
                                                             ]);
                                                             $b5=$a5->fetch();
                                                             if($b5['statut'] == 0){
                                                              echo '<br>Statut : <a href="payl.php?niv=2&amp;membre='.$_GET['id'].'" class="btn" title="cliquez pour marquer comme payer"> impayé</a>';
                                                             }else if($b5['statut']==1){
                                                              echo '<br>Statut:  <span class="fa fa-hand-o-right">Payé</span>';
                                                             }                                                            }else{
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