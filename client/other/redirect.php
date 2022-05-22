<?php
require('partials/bdd.connexionLocal.php');
?>
<?php
if(isset($_GET['id']) && !empty($_GET['id'])){ ?>


<?php  
$sq=$bdd->prepare('SELECT * FROM 1xbetlien WHERE id=:id');
              $sq->execute(
              [
              'id'=>$_GET['id']
              ]
              );
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
    <!--<meta http-equiv="refresh" content="0;URL=https://bit.ly/2vwTTK6">-->
    
</head>
<body>
   <script type="text/javascript">
    window.location.href = "https://bit.ly/2vwTTK6";
</script>
</body>
</html>
    <?php }
    else{
    header('Location: generate.php');
    }
    ?>
