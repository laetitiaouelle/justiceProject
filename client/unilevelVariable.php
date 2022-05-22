<?php
//Produits Niveau 1
$table1=array(); 
$codeParrainN1=array();

$rqs1= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs1->execute([
    'parrainDir'=>$_SESSION['Ccode'],
]);
$results1 = $rqs1->fetchAll(PDO::FETCH_OBJ);
foreach($results1 as $result1){
    array_push($table1, $result1->produitsAch);
    array_push($codeParrainN1, $result1->code);
}
$produits1=0;
for ($i=0; $i < sizeof($table1); $i++) { 
    $produits1 += intval($table1[$i]);
}
//echo $produits1;   $produits1 représente la somme des produits du niveau 1;
//var_dump($table1);
//var_dump($codeParrainN1);

//Produits Niveau 2
$table2=array(); 
$codeParrainN2=array();
for($i=0; $i < sizeof($codeParrainN1); $i++){
$rqs2= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs2->execute([
    'parrainDir'=>$codeParrainN1[$i],
]);
$results2 = $rqs2->fetchAll(PDO::FETCH_OBJ);
foreach($results2 as $result2){
    array_push($table2, $result2->produitsAch);
    array_push($codeParrainN2, $result2->code);
}
}


$produits2=0;
for ($i=0; $i < sizeof($table2); $i++) { 
    $produits2 += intval($table2[$i]);
}
// $produits représentent les sommes des produits du niveau n;
//var_dump($table2);
//var_dump($codeParrainN2);

//Produits Niveau 3
$table3=array(); 
$codeParrainN3=array();
for($i=0; $i < sizeof($codeParrainN2); $i++){
$rqs3= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs3->execute([
    'parrainDir'=>$codeParrainN2[$i],
]);
$results3 = $rqs3->fetchAll(PDO::FETCH_OBJ);
foreach($results3 as $result3){
    array_push($table3, $result3->produitsAch);
    array_push($codeParrainN3, $result3->code);
}
}


$produits3=0;
for ($i=0; $i < sizeof($table3); $i++) { 
    $produits3 += intval($table3[$i]);
}

//var_dump($table3);
//var_dump($codeParrainN3);
//$produits3;


//Produits Niveau 4
$table4=array(); 
$codeParrainN4=array();
for($i=0; $i < sizeof($codeParrainN3); $i++){
$rqs4= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs4->execute([
    'parrainDir'=>$codeParrainN3[$i],
]);
$results4 = $rqs4->fetchAll(PDO::FETCH_OBJ);
foreach($results4 as $result4){
    array_push($table4, $result4->produitsAch);
    array_push($codeParrainN4, $result4->code);
}
}


$produits4=0;
for ($i=0; $i < sizeof($table4); $i++) { 
    $produits4 += intval($table4[$i]);
}

//var_dump($table4);
//var_dump($codeParrainN4);
//$produits4;


//Produits Niveau 5
$table5=array(); 
$codeParrainN5=array();
for($i=0; $i < sizeof($codeParrainN4); $i++){
$rqs5= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs5->execute([
    'parrainDir'=>$codeParrainN4[$i],
]);
$results5 = $rqs5->fetchAll(PDO::FETCH_OBJ);
foreach($results5 as $result5){
    array_push($table5, $result5->produitsAch);
    array_push($codeParrainN5, $result5->code);
}
}


$produits5=0;
for ($i=0; $i < sizeof($table5); $i++) { 
    $produits5 += intval($table5[$i]);
}

//var_dump($table5);
//var_dump($codeParrainN5);
//$produits5;


//Produits Niveau 6
$table6=array(); 
$codeParrainN6=array();
for($i=0; $i < sizeof($codeParrainN5); $i++){
$rqs6= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs6->execute([
    'parrainDir'=>$codeParrainN5[$i],
]);
$results6 = $rqs6->fetchAll(PDO::FETCH_OBJ);
foreach($results6 as $result6){
    array_push($table6, $result6->produitsAch);
    array_push($codeParrainN6, $result6->code);
}
}


$produits6=0;
for ($i=0; $i < sizeof($table6); $i++) { 
    $produits6 += intval($table6[$i]);
}

//var_dump($table6);
//var_dump($codeParrainN6);
//$produits6;


//Produits Niveau 7
$table7=array(); 
$codeParrainN7=array();
for($i=0; $i < sizeof($codeParrainN6); $i++){
$rqs7= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs7->execute([
    'parrainDir'=>$codeParrainN6[$i],
]);
$results7 = $rqs7->fetchAll(PDO::FETCH_OBJ);
foreach($results7 as $result7){
    array_push($table7, $result7->produitsAch);
    array_push($codeParrainN7, $result7->code);
}
}


$produits7=0;
for ($i=0; $i < sizeof($table7); $i++) { 
    $produits7 += intval($table7[$i]);
}

//var_dump($table7);
//var_dump($codeParrainN7);
//$produits7;


//Produits Niveau 8
$table8=array(); 
$codeParrainN8=array();
for($i=0; $i < sizeof($codeParrainN7); $i++){
$rqs8= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs8->execute([
    'parrainDir'=>$codeParrainN7[$i],
]);
$results8 = $rqs8->fetchAll(PDO::FETCH_OBJ);
foreach($results8 as $result8){
    array_push($table8, $result8->produitsAch);
    array_push($codeParrainN8, $result8->code);
}
}


$produits8=0;
for ($i=0; $i < sizeof($table8); $i++) { 
    $produits8 += intval($table8[$i]);
}

//var_dump($table8);
//var_dump($codeParrainN8);
//$produits8;


//Produits Niveau 9
$table9=array(); 
$codeParrainN9=array();
for($i=0; $i < sizeof($codeParrainN8); $i++){
$rqs9= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs9->execute([
    'parrainDir'=>$codeParrainN8[$i],
]);
$results9 = $rqs9->fetchAll(PDO::FETCH_OBJ);
foreach($results9 as $result9){
    array_push($table9, $result9->produitsAch);
    array_push($codeParrainN9, $result9->code);
}
}


$produits9=0;
for ($i=0; $i < sizeof($table9); $i++) { 
    $produits9 += intval($table9[$i]);
}

//var_dump($table9);
//var_dump($codeParrainN9);
//$produits9;


//Produits Niveau 10
$table10=array(); 
$codeParrainN10=array();
for($i=0; $i < sizeof($codeParrainN9); $i++){
$rqs10= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs10->execute([
    'parrainDir'=>$codeParrainN9[$i],
]);
$results10 = $rqs10->fetchAll(PDO::FETCH_OBJ);
foreach($results10 as $result10){
    array_push($table10, $result10->produitsAch);
    array_push($codeParrainN10, $result10->code);
}
}


$produits10=0;
for ($i=0; $i < sizeof($table10); $i++) { 
    $produits10 += intval($table10[$i]);
}

//var_dump($table10);
//var_dump($codeParrainN10);
//$produits10;


//Produits Niveau 11
$table11=array(); 
$codeParrainN11=array();
for($i=0; $i < sizeof($codeParrainN10); $i++){
$rqs11= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs11->execute([
    'parrainDir'=>$codeParrainN10[$i],
]);
$results11 = $rqs11->fetchAll(PDO::FETCH_OBJ);
foreach($results11 as $result11){
    array_push($table11, $result11->produitsAch);
    array_push($codeParrainN11, $result11->code);
}
}


$produits11=0;
for ($i=0; $i < sizeof($table11); $i++) { 
    $produits11 += intval($table11[$i]);
}

//var_dump($table11);
//var_dump($codeParrainN11);
//$produits11;


//Produits Niveau 12
$table12=array(); 
$codeParrainN12=array();
for($i=0; $i < sizeof($codeParrainN11); $i++){
$rqs12= $bdd->prepare('SELECT * FROM membres WHERE parrainDir = :parrainDir AND parachut=0');
$rqs12->execute([
    'parrainDir'=>$codeParrainN11[$i],
]);
$results12 = $rqs12->fetchAll(PDO::FETCH_OBJ);
foreach($results12 as $result12){
    array_push($table12, $result12->produitsAch);
    array_push($codeParrainN12, $result12->code);
}
}


$produits12=0;
for ($i=0; $i < sizeof($table12); $i++) { 
    $produits12 += intval($table12[$i]);
}

//var_dump($table12);
//var_dump($codeParrainN12);
//$produits12;


$sa = $produits1 *30;
$sb = ($produits2 + $produits3 + $produits4 + $produits5 + $produits6 + $produits7 + $produits8 + $produits9 + $produits10 + $produits11 + $produits12)*15;

$st = $sa + $sb;
?>