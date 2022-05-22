<?php


function valid_mail($evt){
     $keyCode = $evt.which ? $evt.which : $evt.keyCode;
    $interdit = 'àâäãçéèêëìîïòôöõùûüñ &*?!:;,\t#~"^¨%$£?²¤§%*()]{}<>|\\/`\'';
        if ($interdit.indexOf(String.fromCharCode(keyCode)) >= 0) {
            return false;
        }
}
?>