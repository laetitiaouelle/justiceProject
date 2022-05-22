<?php session_start();
if(isset($_SESSION['Cid']) && !empty($_SESSION['Cid'])){
    $title= 'Profil';
    require('config/bdd.connexion.php');
    require('other/fonction.php');
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
                                                <a href="#">Accueil</a>
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

            <?php
                       $user=$bdd->prepare('SELECT * FROM membres WHERE id=:id and code=:code');
                       $user->execute([
                           'id'=>$_SESSION['Cid'],
                           'code'=>$_SESSION['Ccode']
                       ]);
                       $reslt=$user->fetch();
            ?>
            <section>
                <div class="section__content section__content--p30">
                <div class="container-fluid">
                        <div class="row">
                        <div class="container">
<?php
if(isset($_POST)){
    extract($_POST);
    $errors=[];
    $success=[];
    if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($password)){
                 $nom_ok=strip_tags($nom);
                 $prenom_ok=strip_tags($prenom);
                 $email_ok=strip_tags($email);

                 if(!filter_var($email_ok, FILTER_VALIDATE_EMAIL)){ $errors[]='Email invalide'; }
                 if(is_already_in_use('email',$email_ok,'membres') && $email_ok!==$reslt['email']){ $errors[]='Email dèjà utilisé'; }
                 if(count($errors)==0){
                     $updade = $bdd->prepare('UPDATE membres SET nom=:nom, prenom=:prenom, avatar=:avatar, email=:email, password=:password WHERE id=:id');
                     $updade->execute([
                          'nom'=>$nom_ok,
                          'prenom'=>$prenom_ok,
                          'avatar'=>$_FILES['image']['name'],
                          'email'=>$email_ok,
                          'password'=>$password,
                          'id'=>$_SESSION['Cid']
                     ]);
                     if($updade){
//$success[]='mise a jour parfaite';
                  $nouveauNom = $reslt['id'].'_'.$_FILES['image']['name'];
                  $destination='images/';
                  $se='\\';
                  $result = move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$nouveauNom);

                  if ($result) {

                    $success[]='Image Sauvegardée. et mise a jour réussie';
                    echo'<meta http-equiv="refresh" content="1;URL=profil.php">';
                  }else{
                    $errors[]='image non sauvegardée';
                  }

                     }
                 }else{
                     $errors[]='réessayer';
                 }

    }else{
        //rien il ne sera jamais vide
    }
}

?>
<?php
foreach($errors as $error){

    echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-danger">Erreur</span>'.$error.'
 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
}
foreach($success as $succes){
    echo '<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
     <span class="badge badge-pill badge-primary">Success</span>'.$succes.'
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>';
     //echo ''.$error;
 }?>
<form action="" method="post" enctype="multipart/form-data" class="form-group">
                             <div class="card">
                                  <div class="card-header">Modifier votre Profil</div>
                                  <div class="card-body">
                                     <div class="row">
                                          <div class="container">
                                          <div class="row">
                                              <div class="col-md-6">
                                              <div class="form-group">
    <label for="nom"></label>
    <input type="text" class="form-control" value="<?= $reslt['nom'] ?>" id="nom" aria-describedby="nom" name="nom" placeholder="<?= $reslt['nom'] ?>">
    <small id="nom" class="form-text text-muted">Entrer le nouveau nom</small>
  </div> 
                                              </div><hr>
                                              <div class="col-md-6">
                                              <div class="form-group">
    <label for="email"></label>
    <input type="email" class="form-control" value="<?= $reslt['email'] ?>" id="email" aria-describedby="email" name="email" placeholder="<?= $reslt['email'] ?>">
    <small id="email" class="form-text text-muted">Entrer le nouveau email.</small>
  </div>
                                              </div>
                                              </div>
                                              <hr>
                                              <div class="row">
                                              <div class="col-md-6">
                                              <div class="form-group">
    <label for="password"></label>
    <input type="password" class="form-control" value="<?= $reslt['password'] ?>" id="password" aria-describedby="password" name="password" placeholder="<?= $reslt['password'] ?>">
    <small id="nom" class="form-text text-muted">Entrer le nouveau password</small>
  </div> 
                                              </div><hr>
                                              <div class="col-md-6">
                                              <div class="form-group">
    <label for="prenom"></label>
    <input type="text" class="form-control" value="<?= $reslt['prenom'] ?>" id="prenom" aria-describedby="prenom" name="prenom" placeholder="<?= $reslt['prenom'] ?>">
    <small id="prenom" class="form-text text-muted">Entrer le nouveau prenom.</small>
  </div>
                                              </div>
                                              </div>
                                              <div class="row">
                                                     <div class="col-md-12">
                                                     <div style="text-align:center;" class="form-group">
    <label for="image">Uploder une nouvelle photo de profil</label>
    <center> <input  type="file" class="form-control-file" id="image" name="image"></center>
  </div>
                                                     </div>
                                              </div>
                                          </div>
                                     </div>
                                  </div>
                                  <div class="card-footer"><input style="float:right;" type="submit" value="modifier" class="btn btn-success"></div>
                             </div>
                        </form>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="copyright" style="display:none;">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
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