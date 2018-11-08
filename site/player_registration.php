<!DOCTYPE html>
<html lang="en">
    <?php include_once 'PHP/head.php' ?>
    <body>
        <?php include_once "PHP/header.php" ?>
        
        <h1>Player Registration</h2>
        <section>
            <form>
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
            <!-- required -->
            <h3>Player 1*</h3>
            <label>First Name:</label>
            <input type="text"/>
            <label>Last Name:</label>
            <input type="text"/>
            </br>
            <label>Gender:</label>
            <input type="text">
            </br>
            <label>Birthdate:</label>
            <input type="date"/>
            </br>
            <label>Shirt size:</label>
            <input type="text"/>

            <!-- TODO: allow user to add players to sign up more than one kid at a time -->
            </br>
            </br>
            <input type="submit">
            </form>
        </section>
        <?php include_once "PHP/footer.php" ?>
    </body>
</html>