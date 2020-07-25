<?php

/* Helps to validate the image input */

function validImage($file) {
    $size = getimagesize($file);
    return (strtolower(substr($size['mime'], 0, 5)) == 'image' ? true : false);  
 }

?>