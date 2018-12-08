<?php
    require_once('db.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $id = $_POST['id'];
					    $message = $_POST["message"];
					    $active = $_POST["active"];

					    update_urgent_message($id, $message, $active);
                    redirect("edit_home.php");
    }

    
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