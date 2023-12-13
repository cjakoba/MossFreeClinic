<?php

// Include session and header of webpage
    include('layouts/header.php');
    include('layouts/navbar.php');
    include('../api/backendAPI.php');
$sessionManager = new SessionManager();
$sessionManager->startSession();
$sessionManager->checkLogin();
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../css/editor.css" type="text/css" />
    </head>
    <h1>Edit user</h1>
    <?php
    // Import and establish database connection
    //include_once('database/dbinfo.php');
    $servername = "localhost";
    $username = "homebasedb";
    $password = "homebasedb";
    $db = "homebasedb";
    $connection = mysqli_connect($servername, $username, $password, $db);
    $sql = 'SELECT * FROM userdb WHERE userid = ' . $_SESSION['user_id'];
    $results = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($results);
    if (!strcmp($row['user_type'], 'Admin')){
        // Print error statements from check password
    if (isset($_POST['newpass']) and checkPassword($_POST['newpass'])){
        if (checkPassword($_POST['newpass']) == 1){
            echo "<p>Error password needs to be longer then 8 characters";
        }
        else if (checkPassword($_POST['newpass']) == 2){
            echo "<p>Error password must contain at least one capital letter<p>";
        }
        else if (checkPassword($_POST['newpass']) == 3){
            echo "<p>Error password must contain at least one number<p>";
        }
        unset($_POST['newpass']);
    }
        // Check if the user needs to update password
        if (isset($_POST['newpass']) and !checkPassword($_POST['newpass']) and isset($_POST['newpass2']) and !strcmp($_POST['newpass'], $_POST['newpass2'])){
            $hash = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
            // Run sql statement to update user
            editUserPassword($_SESSION['user_id'], $hash, $connection);
        }
        else if (isset($_POST['newpass']) and !checkPassword($_POST['newpass'])){
            echo "<p>ERROR passwords must match</p>";
        }
    echo "<form method=post>";
    // Create way to change password
    echo "<input type='password' name='newpass' placeholder='New Password'><br></br>";
    echo "<input type='password' name='newpass2' placeholder='Retype New Password'><br></br>";
    echo "<input type='submit'>";
    echo "</form>";
    }
    else if (!strcmp($row['user_type'], 'Executive Admin')){
    // Print error statements from check password
    if (isset($_POST['newpass']) and checkPassword($_POST['newpass'])){
        if (checkPassword($_POST['newpass']) == 1){
            echo "<p>Error password needs to be longer then 8 characters";
        }
        else if (checkPassword($_POST['newpass']) == 2){
            echo "<p>Error password must contain at least one capital letter<p>";
        }
        else if (checkPassword($_POST['newpass']) == 3){
            echo "<p>Error password must contain at least one number<p>";
        }
        unset($_POST['newpass']);
        if (!strcmp($_POST['edituser'], 'C')){
            unset($_POST['edituser']);
        }
    }
    // Check if new user should be created
    if (isset($_POST['edituser']) and strcmp($_POST['edituser'], 'C') == 0 and strlen($_POST['newuser']) > 1 and checkPassword($_POST['newpass']) == 0){
        // Run sql statement to add new user with name given by user and set user to edit to be new user
        $hash = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
        $_POST['edituser'] = createuser($_POST['newuser'], $hash, $connection);
    }
    // Check if user to edit has been selected and if the user needs to be removed
    if (isset($_POST['edituser']) and strcmp(substr($_POST['edituser'], -1), 'E') == 0){
        // Remove erase key
        $_POST['edituser'] = substr($_POST['edituser'], 0, -1);
        // Check if second delete button was pressed if not display secondary delete button
        if (strcmp(substr($_POST['edituser'], -1), 'E') == 0){
            echo "<form method=post><br></br><button type='submit' name=edituser value='". $_POST['edituser'] . "'>Click Here to Permantly Delete user</button><br></br>";
        }
        // Delete user if secondary delete button was pressed
        else{
            // Run delete from userdb
            deleteUser($_POST['edituser'], $connection);
            // Unset user to edit
            unset($_POST['edituser']);
        }
    }
    // Check if user to edit has been selected and if the user needs to update type
    if (isset($_POST['edituser']) and isset($_POST['newtype'])){
        // Run sql statement to update user
        editUserType($_POST['edituser'], $_POST['newtype'], $connection);
}
    // Check if user to edit has been selected and if the user needs to update password
    if (isset($_POST['edituser']) and isset($_POST['newpass']) and !checkPassword($_POST['newpass'])){
        $hash = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
        // Run sql statement to update user
        editUserPassword($_POST['edituser'], $hash, $connection);
}
    // Check if the user to be edited has been set and if so enter edit mode
    if(isset($_POST['edituser'])){
        if (strcmp(substr($_POST['edituser'], -1), 'E') == 0){
            $_POST['edituser'] = substr($_POST['edituser'], 0, -1);
        }
            // Allow user to return to user list
            echo "<form method=post><button name='return' type='submit'>Go back to list</button></form><br><br>";
        // Check if the user name needs to be changed
        if(isset($_POST['userName']) and strlen($_POST['userName']) > 1){
            // Update database to use new name for user
            editUserName($_POST['edituser'], $_POST['userName'], $connection);
        }
        // Get name of user from database
        $sql = "SELECT * FROM userdb where userid =" . $_POST['edituser'];
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form for changing user name
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                echo "<input type='text' name='userName' placeholder='" . $row['username'] . "'>";
                $admin = False;
                $eAdmin = False;
                // Check if user is currently an admin or executive admin
            if (!strcmp($row['user_type'], "Admin")){
                $admin = True;
            }
            if (!strcmp($row['user_type'], "Executive Admin")){
                $eAdmin = True;
            }
            }
            // Create way to change password
            echo "<input type='password' name='newpass' placeholder='password'><br></br>";
            // Create way to switch between admin and executive admin
            if ($admin){
                echo "<input type= 'radio' checked name='newtype' value='Admin'>Admin";
                echo "<input type='radio' name='newtype' value='Executive Admin'>Executive Admin<br></br>";
            }
            else{
                echo "<input type= 'radio' name='newtype' value='Admin'>Admin";
                echo "<input type='radio' checked name='newtype' value='Executive Admin'>Executive Admin<br></br>";
            }
            // Create button for submitting
            echo "<button type='submit' name='edituser' value=" . $_POST['edituser'] . ">Submit Changes</button><br></br>";
            echo "</form>";
            // Create button for deleting user
        echo "<form method=post>";
        echo "<br></br><button type='submit' name=edituser value='". $_POST['edituser'] . "EE'>Delete user</button><br></br>";
        echo "</form>";
        } else {
            // Exit if user doesn't exist
            exit();
        }
    }
    else{
        // Get information about users to create a list
        $sql = "SELECT * FROM userdb";
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form to allow user to enter edit mode
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                // Create list as buttons to allow user information to be transferred
                echo "<button type='submit' name='edituser' value=". $row['userid'] .">" . $row['username'] . "</button>";
            }
            // Allow user to create users
            echo "<br></br><br></br><input name='newuser' type='text' placeholder='Username'>";
            echo "<input name='newpass' type='password' placeholder='Password'>";
            echo "<button type='submit' name='edituser' value='C'>Create user</button>";
            echo "</form>";
        } else {
            // Allow user to create user if no users exist
            echo "<form>";
            echo "<br></br><br></br><input name='newuser' type='text' placeholder='Username'>";
            echo "<input name='newpass' type='password' placeholder='Password'>";
            echo "<button type='submit' name='edituser' value='C'>Create user</button>";
            echo "</form>";
    }
}
}
// close database connection
mysqli_close($connection);
// Include footer of webpage
include('layouts/footer.php'); 
?>

</html>