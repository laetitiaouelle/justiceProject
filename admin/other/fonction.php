<?php
$encodetable=[
['a','01'],
['b','02'],
['c','03'],
['d','04'],
['e','05'],
['f','06'],
['g','07'],
['h','08'],
['i','09'],
['j','10'],
['k','11'],
['l','12'],
['m','13'],
['n','14'],
['o','15'],
['p','16'],
['q','17'],
['r','18'],
['s','19'],
['t','20'],
['u','21'],
['v','22'],
['w','23'],
['x','24'],
['y','25'],
['z','26'],
[' ','27'],
['.','28'],
['0','29'],
['1','30'],
['2','31'],
['3','32'],
['4','33'],
['5','34'],
['6','35'],
['7','36'],
['8','37'],
['9','38'],
['#','40'],
['*','41'],
['/','42']
             ];


if (! function_exists('e')) {
    function e($string){
        if ($string) {
         // return htmlspecialchars($string);
         return strip_tags($string);
        }
    }
}

if (!defined('not_empty')) {
    function not_empty($fields = []){
        if (count($fields)!= 0) {
              foreach ($fields as $field) {
                  if (empty($_POST[$field]) || trim($_POST[$field] == "")) {
                      return false;
                  }
              }

              return true;
        }
    }
}

if (! function_exists('get_input')) {
    function get_input($key){
    return !empty($_SESSION['input'][$key])
    ? e($_SESSION['input'][$key])
    : null;
}
} 

if (!function_exists('save_input_data')) {
    function save_input_data(){
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'pwd') === false) {
                $_SESSION['input'][$key] = $value;            }
          
        }
    }
}

/*
Fonction pour vérifier si une donnée existe déjà dans la base de donnée.
*/
if(!function_exists('is_already_in_use')){
    function is_already_in_use($field, $value,$table){
        global $bdd; 
        $q = $bdd-> prepare("SELECT id FROM $table WHERE $field = ?");
        $q->execute([$value]);
        $count = $q->rowCount();
        $q->closeCursor();
        return $count;
    }
}

if (!function_exists('clear_input_data')) {
    function clear_input_data(){
        if(isset($_SESSION['input'])){
            $_SESSION['input'] = [];
        }
    }
}
/*
Fonction pour afficher un message après ou avant qu'une action ne soit terminer.
*/
if (!function_exists ('set_flash')) {
    
    function set_flash($message, $type='info'){
        $_SESSION ['notification'] ['message'] = $message;
        $_SESSION ['notification'] ['info'] = $type;
    }
}

/*
Fonction pour rediriger le client vers une autre page.
*/
if (!function_exists('redirect')) {
    function redirect($page){
        header('Location: ' . $page);
        exit();
    }
}

//gère l'état actif de nos différents liens(fonction non utilisé),permettre de mettre en activité les liens dans l'onglet de navigation 
if (!function_exists ('set_active')) {
    function set_active($file){
        $page=array_pop(explode('/', $_SERVER['SCRIPT_NAME']));
          if ($page == $file.'.php') {
             return 'active';
        }else{
             return '';
      }
    }
}

if (!function_exists('ActiveNumber')) {
    function ActiveNumber(){
        $nb = rand(1000,9999);
        return $nb;
    }
}

//envoie des notifications
if(!function_exists('noticeIt')){
    function noticeIt($titre, $notification, $tipeOfNotification ){
      $sendNotification = $bdd->prepare('INSERT INTO notifications(titre, contenu, date, type) 
      VALUE(:titre, :contenu, NOW(), :type)');
      $sendNotification->execute([
          'titre'=> $titre,
          'contenu'=> $notification,
          'type'=>$tipeOfNotification
      ]);
    }
}




//fonction encode
  if (!function_exists('encode')){ 
      function encode($lettre)
   {
          $encodetable=[
['a','01'],
['b','02'],
['c','03'],
['d','04'],
['e','05'],
['f','06'],
['g','07'],
['h','08'],
['i','09'],
['j','10'],
['k','11'],
['l','12'],
['m','13'],
['n','14'],
['o','15'],
['p','16'],
['q','17'],
['r','18'],
['s','19'],
['t','20'],
['u','21'],
['v','22'],
['w','23'],
['x','24'],
['y','25'],
['z','26'],
[' ','27'],
['.','28'],
['0','29'],
['1','30'],
['2','31'],
['3','32'],
['4','33'],
['5','34'],
['6','35'],
['7','36'],
['8','37'],
['9','38'],
['#','40'],
['*','41'],
['/','42']
             ];
          if(!empty($lettre) && strlen($lettre)==1){
            for($i= 0; $i<sizeof($encodetable); $i++)
{
    if(strtolower($lettre) == $encodetable[$i][0]){
    //echo 'mot trouvé et remplacé par : '.$encodetable[$i][1];
                                                  }                         
}
                              }elseif(strlen($lettre)>1){
        
                                        //$lettrediscipe=explode(',',$lettre);
                                         for($a=0; $a<strlen($lettre); $a++){
                                        //echo $lettre[$a].' ';
                                             
                                             for($i= 0; $i<sizeof($encodetable); $i++){
                                              if(strtolower($lettre[$a]) == $encodetable[$i][0]){
                                                echo ''.$encodetable[$i][1];
                                                  return $encodetable[$i][1];
                                                  
                                                  }    
                                                                        }
                                   } 


}

   }
                                 }

   //fonction decode
  if(!function_exists('dencode')){
   function decode($code)
   {
       $encodetable=[
['a','01'],
['b','02'],
['c','03'],
['d','04'],
['e','05'],
['f','06'],
['g','07'],
['h','08'],
['i','09'],
['j','10'],
['k','11'],
['l','12'],
['m','13'],
['n','14'],
['o','15'],
['p','16'],
['q','17'],
['r','18'],
['s','19'],
['t','20'],
['u','21'],
['v','22'],
['w','23'],
['x','24'],
['y','25'],
['z','26'],
[' ','27'],
['.','28'],
['0','29'],
['1','30'],
['2','31'],
['3','32'],
['4','33'],
['5','34'],
['6','35'],
['7','36'],
['8','37'],
['9','38'],
['#','40'],
['*','41'],
['/','42']
             ];
       if(!empty($code) && strlen($code)>=2 && strlen($code)%2==0){
    //echo 'decodé';
        $codediscipe=str_split($code, 2);
       //print_r( $codediscipe);
        for($v=0; $v<sizeof($codediscipe); $v++){
        //echo $codediscipe[$v].'<br>';
            for($w= 0; $w<sizeof($encodetable); $w++){
                if($codediscipe[$v] == $encodetable[$w][1]){
                echo ''.$encodetable[$w][0];
                       return $encodetable[$w][0];

                }
            }
        }
        
    }
   }
  }
?>