<?php session_start();
if(isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])){
    $title= 'Accueil';
    require('config/database.php');
	require('other/fonction.php');
  ?>
<?php if(isset($_GET['id']) && !empty($_GET['id'])){
    $update = $bdd->prepare('UPDATE messages SET lu=1 WHERE id = :id');
    $update->execute([
    'id'=>$_GET['id']
    ]);
    if($update){
        echo '<meta http-equiv="refresh" content="0;URL=message.php">';
    }
}else{
    echo 'no';
    echo '<meta http-equiv="refresh" content="10;URL=message.php">';
}

?>
<?php }else{
    echo'<meta http-equiv="refresh" content="0;URL=login.php">';
    $_SESSION['logerr']='Vous êtes hors connexion, Connectez-vous.';
} ?>