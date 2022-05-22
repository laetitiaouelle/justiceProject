<?php

/***********************************/
/*     Génère un mot de passe      */
/***********************************/
// $size : longueur du mot passe voulue
function Genere_Password($size)
{
    // Initialisation des caractères utilisables
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    $code=0;
    for($i=0;$i<$size;$i++)
    {
        $code .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
		
    return $code;
}

// Petit exemple

$mon_code = Genere_Password(10);

//echo $mon_mot_de_passe;

?>