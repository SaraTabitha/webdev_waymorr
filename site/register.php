<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
        <h1>Registration</h1>
        <a href="login.php"> Go to Login </a>
        <form>
        <label> E-mail: </label>
        <input type="text" />
        <br>
        <label>Password:</label>
        <input type="text" />
        <label>Retype Password:</label>
        <input type="text" />
        <br>
		<!-- required -->
            <h3>Parent/Guardian 1*</h3>
            <label>First Name:</label>
            <input type="text"/>
            <label>Last Name:</label>
            <input type="text"/>
            </br>
            <label>Phone Number:</label>
            <input type="text"/>
            <label>Phone Number Type:</label>
            <select>
                <option>Cell</option>
                <option>Landline</option>
            </select>
            </br>
            <label>E-mail:</label>
            <input type="text"/>
            </br>
            <label>Mailing Address:</label>
            <input type="text"/>
            </br>
            </br>
            <!-- required -->
            <h3>Parent/Guardian 2*</h3>
            <label>First Name:</label>
            <input type="text"/>
            <label>Last Name:</label>
            <input type="text"/>
            </br>
            <label>Phone Number:</label>
            <input type="text"/>
            <label>Phone Number Type:</label>
            <select>
                <option>Cell</option>
                <option>Landline</option>
            </select>
            </br>
            <label>E-mail:</label>
            <input type="text"/>
            </br>
            <label>Mailing Address:</label>
            <input type="text"/>
            </br>
            </br>
        <input type="submit" />
        </form>
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>