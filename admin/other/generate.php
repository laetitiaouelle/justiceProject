<?php
require('partials/bdd.connexionLocal.php');
?>
<?php  
$sq=$bdd->prepare('SELECT * FROM 1xbetlien WHERE id=(SELECT max(id) FROM 1xbetlien )');
              $sq->execute();
              $rs=$sq->fetch(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' >
  <!-- Custom styles for this template -->
    <link href="floating-labels.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" ></script>
    
    <title><?= $rs['description']  ?></title>
    <meta name="author" content="Sport Pluriel">  
    <meta name="description" content="<?= $rs['description']  ?>"/> 
    <meta name="keyworlds" content=""/> 	
    <meta property="og:url" content="redirect.php">
	<link rel="canonical" href="redirect.php"/>
    <link href="https://sportpluriel.com/webtv/adminPage/1xbetimageshare/<?= $rs['image']?>" rel='image_src'/>
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $rs['description']  ?>">
    <meta property="og:description" content="<?= $rs['description']  ?>">
	<meta property="og:image" itemprop="image" content="https://sportpluriel.com/webtv/adminPage/1xbetimageshare/<?= $rs['image']?>" />
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="1040">
     <style>
    body{
        padding-top:10%;
    }
    </style>
</head>
<body>
    <!-- The text field -->
<div class="container" style='border:1px solid black;'>
     <hr>
<center><b>Page de génération de lien de partage 1xbet</b></center>
    <hr>
    <div class="row">
    <div class="form-group col-md-8">
      <input type="link" name="commentaire" value="https://sportpluriel.com/webtv/adminPage/redirect.php?id=<?= $rs['id'] ?>" class="form-control" id="myInput" placeholder="commentaire">
    </div>
    <div class="form-group col-md-4"><button onclick="myFunction()">Copier le lien</button></div>
  </div><br><br>
    </div>
</body>
    <script>
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
    </script>
</html>