<?php

// Include session and header of webpage
    include('layouts/header.php');
    include('layouts/navbar.php');
    include('../api/backendAPI.php');
//$sessionManager = new SessionManager();
//$sessionManager->startSession();
//$sessionManager->checkLogin();
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <!-- Style rules for webpage-->
        <style>
        h1 {
                color: #4b6c9e;
                font-size: 36px;
                margin-bottom: 20px;
                text-align: center;
                margin: 0 auto;
            }
            input[type="text"]{
                width: 25%;
                padding: 8px;
                border-radius: 5px;
                border: 1px solid #cccccc;
                margin-bottom: 20px;
                box-sizing: border-box;
            }
            input[type="checkbox"]{
                width: 5%;
                padding: 8px;
                border-radius: 5px;
                border: 1px solid #cccccc;
                margin-bottom: 20px;
                box-sizing: border-box;
            }
            table{
                width: 100%;
                padding: 8px;
                border-radius: 5px;
                border: 1px solid #cccccc;
                margin-bottom: 20px;
                box-sizing: border-box;
                background-color: lightskyblue;
            }
            td{
                width: 10%;
                padding: 8px;
                border-radius: 5px;
                border: 1px solid #cccccc;
                margin-bottom: 20px;
                box-sizing: border-box;
            }
            th{
                width: 10%;
                padding: 8px;
                border-radius: 5px;
                border: 1px solid #cccccc;
                margin-bottom: 20px;
                box-sizing: border-box;
            }
            button{
                width: 25%;
                padding: 8px;
                border-radius: 5px;
                border: 3px solid #cccccc;
                margin-bottom: 20px;
                box-sizing: border-box;
                background-color:lightblue;
            }
            </style> 
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
    // Print error statements from check password
    if (isset($_POST['newpass']) and checkPassword($_POST['newpass'])){
        if (checkPassword($_POST['newpass']) == 1){
            echo "<p>Error password needs to be longer then 8 characters<p>";
        }
        else if (checkPassword($_POST['newpass']) == 2){
            echo "<p>Error password must contain at least one capital letter<p>";
        }
        else if (checkPassword($_POST['newpass']) == 3){
            echo "<p>Error password must contain at least one number<p>";
        }
        unset($_POST['newpass']);
    }
    // Check if new user should be created
    if (isset($_POST['edituser']) and strcmp($_POST['edituser'], 'C') == 0 and strlen($_POST['newuser']) > 1 and checkPassword($_POST['newpass']) == 0){
        // Run sql statement to add new user with name given by user and set user to edit to be new user
        $_POST['edituser'] = createuser($_POST['newuser'], $_POST['newpass'], $connection);
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
            // Run delete from em_userdb
            deleteuser($_POST['edituser'], $connection);
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
        // Run sql statement to update user
        editUserPassword($_POST['edituser'], $_POST['newpass'], $connection);
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
            }
            // Create button for submitting
            echo "<input type='password' name='newpass' placeholder='password'><br></br>";
            echo "<input type= 'checkbox' name='newtype' value='Admin'>Admin";
            echo "<input type='checkbox' name='newtype' value='Executive Admin'>Executive Admin<br></br>";
            echo "<button type='submit' name='edituser' value=" . $_POST['edituser'] . ">Submit Changes</button><br></br>";
            echo "</form>";
            // Create button for deleting user
        echo "<form method=post><br></br><button type='submit' name=edituser value='". $_POST['edituser'] . "EE'>Delete user</button><br></br>";
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
// close database connection
mysqli_close($connection);
// Include footer of webpage
include('layouts/footer.php'); 
?>

</html>