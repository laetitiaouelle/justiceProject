<?php session_start(); 

require('config/database.php');
require('other/fonction.php');

 if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
  $rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
  $rq->execute(['pseudo'=>$_SESSION['pseudo']]);
  $admin=$rq->fetch();
//on verifie l'envoi du formulaire.

$nb=$bdd->prepare('SELECT * FROM membres WHERE parrainDir=:parrainDir');
$nb->execute([
  'parrainDir'=>$_SESSION['fcode']
]);
$nben=$nb->fetchAll(PDO::FETCH_OBJ);
$lg=$nb->rowCount();

//somme total en fonction des enfants

$st=2000*$lg;


if(isset($_POST)){
    //echo 'yes';
    extract($_POST);
    $errors=[];
    $success=[];
    // on verifie qu'aucun champ n'est vide
    if(!empty($bonus) && !empty($montant) && !empty($password)){
        $bonus_ok = strip_tags($bonus);
        $montant_ok = strip_tags($montant);

        //on vérifie que le mot de passe de l'admin est correcte
        $verifPasswordAdmin= $bdd->prepare('SELECT * FROM admin WHERE  password= :password');
        $verifPasswordAdmin->execute([ 'password'=>$password]);
        $rs = $verifPasswordAdmin->fetch();
        $password_found = $verifPasswordAdmin-> rowCount();
// si le résultat est différent de 0 alors
    if($password_found !==0){
     //echo 'diff';
     //on vérifie que le code et l'id de l'utilisateur en session saisie existe.
     $verifCodeUser = $bdd->prepare('SELECT * FROM membres WHERE id= :id and code= :code');
     $verifCodeUser->execute([
          'id'=>$_SESSION['fid'],
         'code'=>$_SESSION['fcode']
         ]);
     $rs2 = $verifCodeUser->fetch();
     $userCode_Found = $verifCodeUser->rowCount();

     if($userCode_Found !== 0){
         //echo 'utilisateur trouvé';
        
         // maintenant nous pouvons passer à l'enregistrement de l'achat dans la table detailpayement de la bd.
         $insertion1= $bdd->prepare('INSERT INTO detail_payement(typePayement, montantPayement, idDestinataire, codeDestinataire, date)
          VALUE(:type, :montant, :idDes, :codeDes, NOW())');
         $insertion1->execute([
            'type' => $bonus_ok,
            'montant' => $montant_ok,
            'idDes' => $_SESSION['fid'],
            'codeDes' => $_SESSION['fcode']
         ]);
         // si la première insertion a fonctionné alors on passe a la seconde
         if($insertion1){
             //echo 'insert';
          if($bonus =='parrainageDirect'){
              //on recherche si la table contient des information de payement ou si la somme des payement pour ce user est supérieur
              // a 6000fcfa.
              $check = $bdd->prepare('SELECT * FROM bonus_direct WHERE idMembre = :idMembre');
              $check->execute(['idMembre' => $_SESSION['fid']]);
              $rets=$check->fetch();
              $row = $check->rowCount();
              if($row !== 0){
                  //si la table n'est pas vide on vérifie que la somme total n'excède pas 6000fr
                  if($rets['somme'] >= $st){
                      //echo'Insertion impossible, Vous avez déjà payer 6000 frc a cette personne';
                          $_SESSION['err']='Insertion impossible, Vous avez déjà payer '.$st.' frc a cette personne';
                          echo ' <meta http-equiv="refresh" content="0;URL=gains.php?id='.$_SESSION['fid'].'&amp;code='.$_SESSION['fcode'].'#custom-nav-1">';
                        }else{
                      //on update
                     $nvMontant = $rets['somme'] + $montant_ok;
                       //on met a jour la colone somme de  la table des bonnus de parrainage directe
                  $a = $bdd->prepare('UPDATE bonus_direct SET somme = :somme WHERE idMembre = :idMembre');

                  $a->execute([
                    'somme'=>$nvMontant,
                    'idMembre'=> $_SESSION['fid']
                  ]);

                  if($a){
                    $_SESSION['succ']='payement Ajouter avec success. Il ne sera plus modifier ';
                      //redirection
                      echo ' <meta http-equiv="refresh" content="0;URL=gains.php?id='.$_SESSION['fid'].'&amp;code='.$_SESSION['fcode'].'#custom-nav-1">';
                  }
                  }
              }else{
                  //on insert dans la table des bonnus de parrainage directe
                  $a = $bdd->prepare('INSERT INTO bonus_direct(codeMembre, statut, somme, idMembre) 
                  VALUE(:codeMembre, :statut, :somme, :idMembre)');

                  $a->execute([
                    'codeMembre'=> $_SESSION['fcode'],
                    'statut'=>1,
                    'somme'=>$montant_ok,
                    'idMembre'=> $_SESSION['fid']
                  ]);

                  if($a){
                    $_SESSION['succ']='payement Ajouter avec success. Il ne sera plus modifier ';
                    
                      //redirection
                      echo ' <meta http-equiv="refresh" content="0;URL=gains.php?id='.$_SESSION['fid'].'&amp;code='.$_SESSION['fcode'].'#custom-nav-1">';
                  }
                }
          }else if($bonus=='unilevel'){
              //on recherche si la table contient des information de payement ou si la somme des payement pour ce user est supérieur
              // a 6000fcfa.
              $check = $bdd->prepare('SELECT * FROM unilevel WHERE idMembre = :idMembre');
              $check->execute(['idMembre' => $_SESSION['fid']]);
              $rets=$check->fetch();
              $row = $check->rowCount();
              if($row !== 0){
                  //si la ligne existe

                  //on update
                  $nvMontant = $rets['somme'] + $montant_ok;
                  //on met a jour la colone somme de  la table des bonnus de parrainage directe
             $a = $bdd->prepare('UPDATE unilevel SET somme = :somme WHERE idMembre = :idMembre');

             $a->execute([
               'somme'=>$nvMontant,
               'idMembre'=> $_SESSION['fid']
             ]);

             if($a){
               $_SESSION['succ']='payement Ajouter avec success. Il ne sera plus modifier ';
                 //redirection
                 echo ' <meta http-equiv="refresh" content="0;URL=gains.php?id='.$_SESSION['fid'].'&amp;code='.$_SESSION['fcode'].'#custom-nav-4">';
             }

              }else{
                  //si la ligne n'existe pas


                  $a = $bdd->prepare('INSERT INTO unilevel(codeMembre, somme, idMembre) 
                  VALUE(:codeMembre, :somme, :idMembre)');

                  $a->execute([
                    'codeMembre'=> $_SESSION['fcode'],
                    'somme'=>$montant_ok,
                    'idMembre'=> $_SESSION['fid']
                  ]);

                  if($a){
                    $_SESSION['succ']='payement Ajouter avec success. Il ne sera plus modifier ';
                    
                      //redirection
                      echo ' <meta http-equiv="refresh" content="0;URL=gains.php?id='.$_SESSION['fid'].'&amp;code='.$_SESSION['fcode'].'#custom-nav-4">';
                  }

              }
            
          }else{
              //
          }
         }else{
            $_SESSION['err'] = "un problème est survenu lors de l'insertion veuillez rééssayer ";
            echo ' <meta http-equiv="refresh" content="0;URL=gains.php?id='.$_SESSION['fid'].'&amp;code='.$_SESSION['fcode'].'#custom-nav-1">';

         }
     }else{
        echo "Nous ne trouvons aucun utilisateur avec le code : ".$_SESSION['fcode'];
     }
    }else{
        $_SESSION['err']='Le mot de passe saisi est incorrect';
        echo ' <meta http-equiv="refresh" content="0;URL=gains.php?id='.$_SESSION['fid'].'&amp;code='.$_SESSION['fcode'].'#custom-nav-1">';

    }
    }else{
        $_SESSION['err']='Remplissez tous les champs';
        echo ' <meta http-equiv="refresh" content="0;URL=gains.php?id='.$_SESSION['fid'].'&amp;code='.$_SESSION['fcode'].'#custom-nav-1">';

    }
    
}




}else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>