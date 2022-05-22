<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$title= 'Accueil';

if(isset($_GET['niv']) && !empty($_GET['niv'])){
    if(isset($_GET['membre']) && !empty($_GET['membre'])){

        $del=$bdd->prepare('UPDATE leadership SET statut= :statut WHERE idMembre = :idMembre and niveau=:niv');
        $del->execute([
            'statut'=>1,
        'idMembre'=>$_GET['membre'],
        'niv'=>$_GET['niv']
        ]);
        if($del){
            //on selectionne dans la table leadership
            $a=$bdd->prepare('SELECT * FROM leadership WHERE niveau=:niveau and idMembre= :id');
            $a->execute([
                 'niveau'=>$_GET['niv'],
                     'id'=>$_GET['membre']
            ]);
            $ok=$a->fetch();
            if($ok){
 //on insert cela dans les détails de payement
 $enr=$bdd->prepare('INSERT INTO detail_payement(typePayement, montantPayement, idDestinataire, codeDestinataire, date)
 VALUE(:type, :montant, :idDes, :codeDes, NOW())');
$enr->execute([
      'type'=>'leadership',
      'montant'=>$ok['somme'],
      'idDes'=>$_GET['membre'],
      'codeDes'=>$ok['codeMembre']
]);
            }if($enr){
                $sel=$bdd->prepare('SELECT * FROM membres WHERE id=:id');
                $sel->execute(['id'=>$_GET['membre']]);
                $us=$sel->fetch();
                echo'<meta http-equiv="refresh" content="0;URL=gains.php?id='.$us['id'].'&amp;code='.$us['code'].'">';
           
            }
            }

      }else{
        echo'<meta http-equiv="refresh" content="0;URL=table.php">';
    }
} else{
    echo'<meta http-equiv="refresh" content="0;URL=table.php">';
}
?>
    

<?php }else{
    $_SESSION['message']='Vous êtes hors connection, connectez-vous!';
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
}?>
<!-- end document-->
