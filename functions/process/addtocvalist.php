<?php 

function AddToCVAList($name, $list) {
    
    $name = str_replace(" ", "+", $name);
    $list = $list . $name;
    
    return $list;    
}

?>