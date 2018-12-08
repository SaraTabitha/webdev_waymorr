<?php
    require_once("db.php");

    $id = $_POST['id'];
    $team_name = $_POST['team'];
    $opponent = $_POST['opponent'];

    if($_POST['isHome'] === 'true'){
        $isHome = '1';
    }
    else{
        $isHome = '0';
    }
    $date = $_POST['date'];
    $time = $_POST['time'];
    $action = $_POST['action'];

    if($action === "update"){
        update_scheduled_game($id, $team_name, $opponent, $isHome, $date, $time);
        redirect("team_schedule.php");
    }
    else if($action === "delete"){

        delete_scheduled_game($id);
        redirect("team_schedule.php");

    }

    
?>