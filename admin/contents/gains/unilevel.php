<?php require('var.php'); ?>

<?php
 //on va vérifier qu'il n'a pas depasser 6000fr.

 $verf1 = $bdd->prepare('SELECT * FROM unilevel WHERE idMembre = :idMembre and codeMembre = :codeMembre');
 $verf1->execute([
     'idMembre'=>$_GET['id'],
     'codeMembre'=>$_GET['code']
 ]);
 $s1 = $verf1->fetch();

 $sp = $s1['somme'];
 $sr = $st - $sp;
?>
<section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!--contenu2-->
                        <div class="row">
                             <div class="col-md-12"><br>
                                    <h4 class="title-5 m-b-35"><i class="fa fa-dot-circle-o"></i> Unilevel <?php if($sr!==0){require('IntForm.php');}else{
                                echo'<div style="position: relative; left:100px;" class="noti__item js-item-menu">
                                <i title="Payement Intermediaire désactivé. La somme total a été versée" class="fa fa-indent"></i></div>';
                            } ?></h4>
                                    <p style="width:70%; text-align:left;margin-left:50px;">
                                      L'unilevel est la commission payé sur chaque produit acheté par un membre du réseau personnel en fonction du pourcentage attribué au niveau qu'il occupe dans la matrice. L'unilevel est payé uniquement sur notre réseau constitué personnellement à partir
                                      de nos filleuls directs et de leurs filleuls parrainés directement. L'unilevel ne prend pas en compte les filleuls parachutés.                            </p>
                             </div>
                             <div class="col-md-12"><hr><span>Somme Totale = <?= ' '.$st.' Fcfa' ?><br>
                             Somme payé = <?php if(empty($sp)){ $sp=0; echo $sp.' Fcfa'; }else{ echo $sp.' Fcfa'; } ?><br>
                             Somme Restante = <?= ' '.$sr.' Fcfa' ?>
                             </span><hr>
                             
                             <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Niveau</th>
                                                <th>Total produits</th>
                                                <th>Calcul</th>
                                                <th class="text-right">Somme</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Niveau 1</td>
                                                <td><?= $produits1 ?> Produits</td>
                                                <td>30 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits1 * 30  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 2</td>
                                                <td><?= $produits2 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits2 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 3</td>
                                                <td><?= $produits3 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits3 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 4</td>
                                                <td><?= $produits4 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits4 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 5</td>
                                                <td><?= $produits5 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits5 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 6</td>
                                                <td><?= $produits6 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits6 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 7</td>
                                                <td><?= $produits7 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits7 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 8</td>
                                                <td><?= $produits8 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits8 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 9</td>
                                                <td><?= $produits9 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits9 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 10</td>
                                                <td><?= $produits10 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits10 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 11</td>
                                                <td><?= $produits11 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits11 * 15  ?> Fcfa</td>
                                            </tr>
                                            <tr>
                                                <td>Niveau 12</td>
                                                <td><?= $produits12 ?> Produits</td>
                                                <td>15 fcfa X Produits</td>
                                                <td class="text-right"><?= $produits12 * 15  ?> Fcfa</td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr>
                                            <th>Niveau</th>
                                                <th>Total produits</th>
                                                <th>Calcul</th>
                                                <th class="text-right">Somme</th>
                                            </tr>
                                        </thead>
                                    </table>
                             </div>
                        </div>
                    </div>
                </div>
            </section>