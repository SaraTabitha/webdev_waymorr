<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
<body>
    <?php include_once "PHP/header.php" ?>
    <?php
        require_once("db.php");
        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true){
    
            ?>
            <h1>Edit Home </h1>
            <h3>Edit Urgent Message </h3>
            <p><em>If set to active, then this message will appear at the top of the homepage.</em></p>
            <form method="POST" action="urgent.php">
                  <?php $urgent = get_urgent();
                    foreach($urgent as $row){
                        $id = $row['id'];
                        $message = $row['Message'];
                        $active = $row['Active'];
                    }
                   ?>
                 <input name="id" type="hidden" value="<?= $id ?>"/>
                <label for="message">Message</label>
                <input name="message" type="text" value="<?= $message ?>"/>
                <br>
                <label for="active">Active</label>
                <select name="active">
                    <option value="1" 
                     <?PHP if($active === '1'){ echo 'selected';} ?>
                    >Active</option>
                    <option value="0"
                    <?PHP if($active === '0'){ echo 'selected';}?>
                    >Inactive</option>
                 </select>
                  <br>
                  <input type="submit" value="Update Message" />
            </form>
            <br>
            <br>
            <h3>Update News </h3>
            
            <?php

            
        }
        else{
            redirect("home.php");
        }
    ?>
    
    
    <?php include_once "PHP/footer.php" ?>
</body>
</html>