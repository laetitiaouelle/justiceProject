<?php session_start(); 

require('config/database.php');
require('other/fonction.php');

 if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$rq=$bdd->prepare('SELECT * FROM admin WHERE pseudo=:pseudo');
$rq->execute(['pseudo'=>$_SESSION['pseudo']]);
$admin=$rq->fetch();
$title="Nouvel Achat";
//on verifie l'envoi du formulaire.

if(isset($_POST)){
    //echo 'yes';
    extract($_POST);
    $errors=[];
    $success=[];
    // on verifie qu'aucun champ n'est vide
    if(!empty($userCode) && !empty($quantite) && !empty($password)){
        $userCode_ok = strip_tags($userCode);
        $quantite_ok = strip_tags($quantite);

        //on vérifie que le mot de passe de l'admin est correcte
    $verifPasswordAdmin= $bdd->prepare('SELECT * FROM admin WHERE  password= :password');
    $verifPasswordAdmin->execute([ 'password'=>$password]);
    $rs = $verifPasswordAdmin->fetch();
    $password_found = $verifPasswordAdmin-> rowCount();
// si le résultat est différent de 0 alors
    if($password_found !==0){
     //echo 'diff';
     //on vérifie que le code de l'utilisateur saisie existe.
     $verifCodeUser = $bdd->prepare('SELECT * FROM membres WHERE  code= :code');
     $verifCodeUser->execute(['code'=>$userCode_ok]);
     $rs2 = $verifCodeUser->fetch();
     $userCode_Found = $verifCodeUser->rowCount();

     if($userCode_Found !== 0){
         //echo 'utilisateur trouvé';
        
         // maintenant nous pouvons passer à l'enregistrement de l'achat dans la table detailachat de la bd.
         $insertion1= $bdd->prepare('INSERT INTO detail_achat(quantite, CodeAcheteur, dateAchat) VALUE(:quantite, :codeAcheteur, NOW())');
         $insertion1->execute([
            'quantite' => $quantite_ok,
            'codeAcheteur' =>$userCode_ok
         ]);
         // si la première insertion a fonctionné alors on passe a la seconde
         if($insertion1){
             //echo 'insert';
             // on additionne le total d'achat de produit de l'acheteur
             $success[]='insertion1 Ok';
             $total1 = intval($rs2['produitsAch']);

             $totalG = $total1 + $quantite_ok;

             //echo $totalG;

             //on fais la seconde isertion(un update) dans le tableau membre de la bd
             $miseAjour = $bdd->prepare('UPDATE membres SET produitsAch = :qt WHERE code = :code');
             $miseAjour->execute([
                 'qt'=>$totalG,
                 'code'=>$userCode_ok
             ]);
             if($miseAjour){
                $success[] = 'mise a jour réussi';
                require('formAddBuy.php');
             }else{
                $errors[] = "un problème est survenu lors de l'insertion veuillez rééssayer ";
                 require('formAddBuy.php');
            }
         }else{
            $errors[] = "un problème est survenu lors de l'insertion veuillez rééssayer ";
             require('formAddBuy.php');
         }
     }else{
        $errors[]="Nous ne trouvons aucun utilisateur avec le code : ".$userCode_ok;
         require('formAddBuy.php');
     }
    }else{
        $errors[]='Le mot de passe saisi est incorrect';
        require('formAddBuy.php');
    }
    }else{
        $errors[]='Remplissez tous les champs';
        require('formAddBuy.php');
    }
    
}




}else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>