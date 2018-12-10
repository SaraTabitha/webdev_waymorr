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
            $arr = array();
            $message = $row['Message'];
            array_push($arr, $message);
            $active = $row['Active'];

        }
        if($active === '1'){
               $myJSON =  json_encode($arr);
               echo $myJSON;
       }
        else{
        $arr = array();
        array_push($arr, " ");
        $myJSON = json_encode($arr);
        echo $myJSON;
        }

        

?>