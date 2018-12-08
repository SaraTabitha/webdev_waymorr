<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
<body>
    <?php include_once "PHP/header.php" ?>
    <?php
        require_once("db.php");
        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true){

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $id = $_POST['news'];
					    $action = $_POST['action'];
                        

                        if($action === 'update'){
                            //TODO load selected news item for the admin to edit it
                            //redirect("edit_home.php");
                        }
                        else if($action === 'delete'){
                            delete_news($id);
                            //redirect("edit_home.php");
                        }
                        else if($action === 'add'){
                        }
            }   
    
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
                <label for="message"><strong>Message: </strong></label>
                <input name="message" type="text" value="<?= $message ?>"/>
                <br>
                <label for="active"><strong>Active: </strong></label>
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
            <h3>Update News</h3>
            <form method="POST" action="edit_home.php">
                <label for="title"><strong>Select: </strong></label>
                <select name="news">
                <?php 
                    $arr = get_all_news();
                    foreach($arr as $row){
                        $id = $row['Id'];
                        $title = $row['Title'];
                        ?>
                        <option value="<?= $id ?>"><?= $title ?></option>
                        <?php
                    }
                ?>
                </select>
                <label for="action"><strong>Action:</strong></label>
                <select name="action">
                    <option value="update">Edit</option>
                    <option value="delete">Delete</option>
                <select>
                <input type="submit" value="Submit"/>
            </form>
            <h3>Submit News</h3>
            <form method="POST" action="edit_home.php">
                <input type="hidden" name="action" value="add"/>
                <label for="title"><strong>Title: </strong></label>
                <input type="text" name="title" />
                <br>
                <label for="url"><strong>Image URL: </strong></label>
                <input type="text" name="url"/>
                <br>
                <label for="content"><strong>Content: </strong></label>
                <input type="text" name="content"/>
                <input type="submit" value="Add News"/>
            </form>
            <?php

            
        }
        else{
            redirect("home.php");
        }
    ?>
    
    
    <?php include_once "PHP/footer.php" ?>
</body>
</html>