<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
        <h1>Registration</h1>
        <a href="login.php"> Login </a>
        <form>
        <label> First name: </label>
        <input type="text" />
        <label> Last name: </label>
        <input type="text" />
        <br>
        <label> E-mail: </label>
        <input type="text" />
        <br>
        <label>Password:</label>
        <input type="text" />
        <label>Retype Password:</label>
        <input type="text" />
        <br>
        <input type="submit" />
        </form>
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>