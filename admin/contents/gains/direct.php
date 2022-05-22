<div class="container-fluid">
                        <div class="row">
                       <?php 
                          //on va vérifier qu'il n'a pas depasser 6000fr.

                          $verf = $bdd->prepare('SELECT * FROM bonus_direct WHERE idMembre = :idMembre and codeMembre = :codeMembre');
                          $verf->execute([
                              'idMembre'=>$_GET['id'],
                              'codeMembre'=>$_GET['code']
                          ]);
                          $s = $verf->fetch();



                          $sn1 = $bdd->prepare('SELECT * FROM membres WHERE  parrainDir = :parrainDir ');
                          $sn1->execute(['parrainDir'=>$_GET['code']]);
                          $rs1 = $sn1->fetchAll(PDO::FETCH_OBJ);
                          //foreach ($rs1 as $rs) {
                              # code...
                             // echo $rs->code.'<br>';
                              
                          //}
                          
                          $nb = $sn1->rowCount();
                          $st=2000*$nb;
                       ?>
                            <h4 class="title-5 m-b-35"><i class="fa fa-dot-circle-o"></i> Bonus de parrainage Direct </h4>
                            <?php 
                                if($nb==0){
                                    echo'<div style="position: relative; left:100px;" class="noti__item js-item-menu">
                                    <i title="Payement Intermediaire désactivé. Aucun parrainné" class="fa fa-indent"></i></div>';
                                }else{
                                if($s['somme'] < $st){require('IntForm.php');}else{
                                echo'<div style="position: relative; left:100px;" class="noti__item js-item-menu">
                                <i title="Payement Intermediaire désactivé. La somme total a été versée" class="fa fa-indent"></i></div>';
                            } }
                            ?>
                            <p style="width:70%; text-align:left;margin-left:50px;">
                            Tout partenaire qui faire adhérer une nouvelle personne gagne 2000frs. Et ce, à chaque fois qu'il parraine une nouvelle personne.
                            <hr></p>
                              <!-- on va calucler la somme sur chaque enfants direct-->
                              <?php  
						          
                                   
                                   if($nb!==0){
                                        $bp = 2000 * $nb;

                                   ?>

                                    <div id='table' class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                
                                                <th>Gain</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <style>
                                        #swt .a {
                                                   display:inline;
                                        }
                                        </style>
                                            <tr class="tr-shadow">
                                                <td>
                                                     <?php  if($s['somme'] == $bp){ ?>
                                                        Il a <?= $nb ?> enfant(s) directs. Gain: <?= $bp ?> Fcfa <br>
                                                        SOMME PAYE: <?= $s['somme'] ?> Fcfa <br>
                                                        SOMME DUE: <?= $s['somme'] - $bp ?> Fcfa<br>
                                                        <span id="swt"> <b class="a"> Statut : </b>
                                                   <form class="a" method="post" action="setPayementTrue.php">
                                                       <label class="switch switch-text switch-success switch-pill">
                                                       <input style="width:60px;" type="checkbox" class="switch-input" checked desable >
                                                       <span data-on="Payé" data-off="Impayé" class="switch-label"></span>
                                                       <span class="switch-handle"></span>
                                                        </label>
                                                   </form></span>
                                                        <?php }else if($s['somme'] <$bp){ ?>
                                                            Il a <?= $nb ?> enfant(s) directs. Gain: <?= $bp ?> Fcfa <br>
                                                        SOMME PAYE: <?= $s['somme'] ?> Fcfa <br>
                                                        SOMME DUE: <?= $s['somme'] - $bp ?> Fcfa<br> 
                                                      <?php   if(empty($s['somme']) || $s['somme']==0 ) { ?>  
                                                    <span id="swt"> <b class="a"> Statut : </b>
                                                   <form class="a" method="post" action="setPayementTrue.php">
                                                       <label class="switch switch-text switch-success switch-pill">
                                                       <input style="width:60px;" type="checkbox" class="switch-input"  >
                                                       <span data-on="Payé" data-off="Impayé" class="switch-label"></span>
                                                       <span class="switch-handle"></span>
                                                        </label>
                                                   </form></span>
                                                   <?php  } } ?>                                                  
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        </tbody>
                                    </table>
                            </div>
                                   <?php     
                                   }else{
                                      echo "<br><br><span class='fa fa-user' >Ce Membre n'a aucun fieul pour l'instant</span>";
                                   }
	                       ?>
                        </div>
                    </div>