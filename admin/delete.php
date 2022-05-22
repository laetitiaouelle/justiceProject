<?php session_start() ?>
<?php

require('config/database.php');
require('other/fonction.php');

?>
<?php if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) { 
$title= 'Accueil';

if(isset($_GET['id']) && !empty($_GET['id'])){
    if(isset($_GET['code']) && !empty($_GET['code'])){

        $del=$bdd->prepare('DELETE FROM membres WHERE id=:id and code=:code');
        $del->execute([
        'id'=>$_GET['id'],
        'code'=>$_GET['code']
        ]);
        if($del){
            echo'<meta http-equiv="refresh" content="0;URL=table.php">';
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
