<?php
$name = "shaun 123 shaju";
$input_name = trim($name);
if(empty($input_name)){
     $name_err = "Please enter a name.";
     echo "1";
} elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $name_err = "Please enter a valid name.";
    echo "1";
}
?>