<!--
	This page is where and admin can edit information displayed on the home page
	A user must be logged in and have admin permissions to view this page
-->
<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
<body>
    <?php include_once "PHP/header.php" ?>
    <h1>Edit Home </h1>
    <?php
    require_once("db.php");
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true){

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        if($_REQUEST['add_news']){
            $title = $_POST['title'];
            $content = $_POST['content'];
             date_default_timezone_set("America/Chicago");
            $date = date("Y/m/d");

            if(isset($_POST['url'])){
                $url = $_POST['url'];
                add_news_with_image($title, $date, $url, $content);
                 ?>
                    <p style="color:green">Your news has successfully been added to the homepage.</p>
                <?php
            }
            else{
             add_news($title,$date, $content);
                ?>
                     <p style="color:green">Your news has successfully been added to the homepage.</p>
                <?php
            
            }
            
        }
        else if($_REQUEST['action_news']){
            $action = $_POST['action'];
            if($action === 'update'){
                //TODO load selected news item for the admin to edit it
                //redirect("edit_home.php");
            }
            else if($action === 'delete'){
                delete_news($id);
                //redirect("edit_home.php");
            }
        }

    }

    ?>
    
    <h3>Edit Urgent Message </h3>
    <p><em>If set to active, then this message will appear at the top of the homepage.</em></p>
    <form method="POST" action="urgent.php">
        <?php
        $urgent = get_urgent();
        foreach($urgent as $row){
        $id = $row['id'];
        $message = $row['Message'];
        $active = $row['Active'];
        }
        ?>
        <input name="id" type="hidden" value="<?= $id ?>" />
        <label for="message"><strong>Message: </strong></label>
        <input name="message" type="text" value="<?= $message ?>" />
        <br>
        <label for="active"><strong>Active: </strong></label>
        <select name="active">
            <option value="1" <?php if($active === '1'){ echo 'selected';} ?> >Active</option>
            <option value="0" <?php if($active === '0'){ echo 'selected';}?> >Inactive</option>
        </select>
        <br>
        <input type="submit" value="Update Message" />
    </form>

    <h3>Submit News</h3>
     <span id="add_news_message"></span>
    <form method="POST" action="edit_home.php">
        <label for="title"><strong>Title: </strong></label>
        <input type="text" name="title" />
        <br>
        <label for="url"><strong>Image URL: </strong></label>
        <input type="text" name="url" />
        <br>
        <label for="content"><strong>Content: </strong></label>
        <br>
        <textarea cols="75" rows="4" name="content"></textarea>
        <br>
        <input type="submit" name="add_news" value="Add News" />
    </form>

    <?php
    //TODO set up submit news form to actually add news
    //TODO set up editing news (news appears that they selected/fills in?) (maybe edit/add new could utilize the same space)


    }
    else{
    redirect("home.php");
    }
    ?>
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
        </select>
        <input type="submit" name="action_news" value="Submit" />
    </form>


    <?php include_once "PHP/footer.php" ?>
</body>
</html>