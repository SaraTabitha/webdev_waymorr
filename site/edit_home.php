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

    if( isset($_REQUEST['add_news'])){
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

    }//end if REQUEST  = 'add_news'
    //delete news
    else if(isset($_REQUEST['delete_news'])){
    $id = $_POST['news'];
    delete_news($id);

    ?>
    <p style="color:green;">Successfully Deleted</p>
    <?php
    } //end if REQUEST == 'delete_news'
    } //end if request_method == POST

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

    <h3>Add News</h3>
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
    <br>
    <h3>Delete News</h3>

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

        <input type="submit" name="delete_news" value="Delete" />
    </form>

    <?php

    } //end of if = user is admin

    else{ //else user is not an admin
    redirect("home.php");
    }
    ?>

    <?php include_once "PHP/footer.php" ?>
</body>
</html>