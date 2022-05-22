<?php
require('partials/bdd.connexionLocal.php');
require('partials/fonction.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GenerateLink</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' >
  <!-- Custom styles for this template -->
    <link href="floating-labels.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" ></script>
    <meta name="author" content="Sport Pluriel">  
    <meta name="description" content="Générateur de lien 1xbet,"/> 
    <meta name="keyworlds" content=""/> 	
    <meta property="og:url" content="https://sportpluriel.com/webtv/adminPage/generatelinkform.php">
	<link rel="canonical" href="https://sportpluriel.com/webtv/adminPage/generatelinkform.php"/>
    <meta property="og:type" content="website">
    <meta property="og:title" content="Outils de publication sportpluriel">
    <meta property="og:description" content="Générateur de lien 1xbet,">
    <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuuSByRIpfCVoRPklhKTCIocuSEsL-cqblO222Uw2lIbnfoI8w" />
    <style>
    body{
        padding-top:10%;
    }
    </style>
</head>
<body> 
<div class="container" style='border:1px solid black;'>
    <hr>
<center><b>Page de génération de lien de partage 1xbet</b></center>
    <hr>
    <?php
    if (isset($_POST)) {
        extract($_POST);
        $errors=[];
        $success=[];
        if (!empty($commentaire) && !empty($lien) ) {
            
            if (mb_strlen($commentaire)<10 || is_already_in_use('description',$commentaire,'1xbetlien')){
                $errors[]='Soit ce commentaire est trop cour, il faut 10 caractères minimum, soit ce commentaire exixte déjà, réessayez svp';
            }
            if(mb_strlen($lien)<3 ){
                $errors[]='Votre lien est trop cour, 3 caractères minimum';
            }
            if(count($errors)==0){
                $insertion=$bdd->prepare('INSERT INTO 1xbetlien(description,image,lien) VALUE(:commentaire, :image, :lien)');
                $insertion->execute([
                'commentaire'=>$commentaire,
                'image'=>$_FILES['image']['name'],
                'lien'=>$lien
                ]);

                if($insertion){
                    $success[]='Votre lien de partage 1xbet a été créer avec success,Patientez svp';
                    
                  $nouveauNom = $_FILES['image']['name'];
                  //$destination='/1xbetimageshare';
                  //$se='\\';
                  $result = move_uploaded_file($_FILES['image']['tmp_name'], '1xbetimageshare/'.$nouveauNom);
                    if($result){
                                            echo '  <meta http-equiv="refresh" content="4;URL=generate.php">';

                    }else{
                                    $errors[]='imageno';

                    }
                }
            }
        }else{
            $errors[]='Remplissez tous les champs';
        }
    }
    ?>
     <?php if (!empty($errors)): ?>
                <?php foreach($errors as $error): ?>
                          
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Notif!<strong> <?= $error ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
             <?php endforeach ?>
    <?php endif ?>
     <?php if (!empty($success)): ?>
                <?php foreach($success as $succes): ?>
                    <div class="alert alert-warning alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Notif!<strong> <?= $succes ?>.
                    </div>    
             <?php endforeach ?>
    <?php endif ?>
    <form enctype="multipart/form-data"  action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-3">
 <div class="form-group">
    <input type="file" accept="image/*" name="image" class="form-control" required id="exampleFormControlInput1">
 </div></div> <br>
    <div class="form-group col-md-7">
      <input type="text" name="commentaire" class="form-control" placeholder="commentaire">
    </div><br>
    <div class="form-group col-md-2">
      <input type="text" name="lien" class="form-control" placeholder="lien">
    </div>
  </div>
  <center><button type="submit" class="btn btn-primary">Submit</button></center>

</div>
</form>
</body>
</html>