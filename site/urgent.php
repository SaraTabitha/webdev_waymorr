﻿<?php
    require_once('db.php');
    $urgent = get_urgent();

    foreach($urgent as $row){
        $message = $row['Message'];
        $active = $row['Active'];
    }

    if($active === '1'){
        $myJSON =  json_encode($message);
        echo $myJSON;
    }
    else{
        $myJSON = json_encode("");
        echo $myJSON;
    }
    
?>