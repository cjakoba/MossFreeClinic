<?php

// Include session and header of webpage
    include('layouts/header.php');
    include('layouts/navbar.php');
    include('../api/backendAPI.php');
    
    // Check if the user has the necessary permissions
    $sessionManager->startSession();
    $sessionManager->checkLogin();
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
    <h1>Edit tag</h1>
    <?php
    // Import and establish database connection
    $servername = "localhost";
    $username = "homebasedb";
    $password = "homebasedb";
    $db = "homebasedb";
    $connection = mysqli_connect($servername, $username, $password, $db);
    // Check if new tag should be created
    if (isset($_POST['edittag']) and strcmp($_POST['edittag'], 'C') == 0 and strlen($_POST['newtag']) > 0){
        // Run sql statement to add new tag with name given by user
        $sql = "INSERT INTO tagdb (tag_name) VALUE ('" . $_POST['newtag'] . "')";
        mysqli_query($connection, $sql);
        // Get and set edittag as new tag
        $sql = "SELECT * FROM tagdb WHERE tag_name = '" . $_POST['newtag'] . "'";
        $results = mysqli_query($connection, $sql);
        $rows = mysqli_fetch_assoc($results);
        $_POST['edittag'] = $rows['tag_id'];
    }
    // Check if tag to edit has been selected and if the tag needs to be removed
    if (isset($_POST['edittag']) and strcmp(substr($_POST['edittag'], -1), 'E') == 0){
        // Remove erase key
        $_POST['edittag'] = substr($_POST['edittag'], 0, -1);
        // Check if second delete button was pressed if not display secondary delete button
        if (strcmp(substr($_POST['edittag'], -1), 'E') == 0){
            echo "<form method=post><br></br><button type='submit' name=edittag value='". $_POST['edittag'] . "'>Click Here to Permantly Delete tag</button><br></br>";
        }
        // Delete tag if secondary delete button was pressed
        else{
            // Run delete from em_tagdb
            $sql = "DELETE FROM em_tagdb where tag_id = " . $_POST['edittag'];
            mysqli_query($connection, $sql);
            // Run delete from tagdb
            $sql = "DELETE FROM tagdb where tag_id = " . $_POST['edittag'];
            mysqli_query($connection, $sql);
            // Unset edittag
            unset($_POST['edittag']);
        }
    }
    // Check if tag to edit has been selected and if the tag needs to be added to educational material
    if (isset($_POST['edittag']) and strcmp(substr($_POST['edittag'], -1), 'A') == 0){
        // Remove ADD key
        $_POST['edittag'] = substr($_POST['edittag'], 0, -1);
        // Run sql statement to get all educational material
        $sql = "SELECT * FROM em_posts";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)){
                // Check if the educational material and tag needs to be added to em_tagdb
                if (isset($_POST['aem' . $rows['post_id']])){
                    // Add junction to database
                    $sql = "INSERT INTO em_tagdb(post_id, tag_id) VALUES (" . $rows['post_id'] . ", " . $_POST['edittag'] . ")";
                    mysqli_query($connection, $sql);
                }
            }
    }
}
    // Check if tag to edit has been selected and if the tag needs to be removed from educational material
    if (isset($_POST['edittag']) and strcmp(substr($_POST['edittag'], -1), 'D') == 0){
        // Remove delete key
        $_POST['edittag'] = substr($_POST['edittag'], 0, -1);
        // Get educational material id from database
        $sql = "SELECT * FROM em_tagdb where tag_id =" . $_POST['edittag'];
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {                    
        while ($row = mysqli_fetch_assoc($results)){
            // Get educational material information from database
            $sql = "SELECT * FROM em_posts where post_id = ". $row['post_id'];
            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)){
                    // Check if marked for deletion
                    if (isset($_POST['em' . $rows['post_id']])){
                        // Delete em that were selected
                        $sql = "DELETE FROM em_tagdb where post_id = ". $rows['post_id'] . " and tag_id = " . $_POST['edittag'];
                        mysqli_query($connection, $sql);
                    }
                    //echo "<input type='checkbox' name='em" . $rows['post_id'] . "'>" . $rows['post_title'];
                }
            }
        }
    }
}
    // Check if the tag to be edited has been set and if so enter edit mode
    if(isset($_POST['edittag'])){
        $emList = array();
        if (strcmp(substr($_POST['edittag'], -1), 'E') == 0){
            $_POST['edittag'] = substr($_POST['edittag'], 0, -1);
        }
            // Allow user to return to tag list
            echo "<form method=post><button name='return' type='submit'>Go back to list</button></form><br><br>";
        // Check if the tag name needs to be changed
        if(isset($_POST['tagName']) and strlen($_POST['tagName']) > 0){
            // Update database to use new name for tag
            $sql = "update tagdb set tag_name ='" . $_POST['tagName'] . "' where tag_id =" . $_POST['edittag'];
            $results = mysqli_query($connection, $sql);
        }
        // Get name of tag from database
        $sql = "SELECT * FROM tagdb where tag_id =" . $_POST['edittag'];
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form for changing tag name
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                echo "<input type='text' name='tagName' placeholder='" . $row['tag_name'] . "'>";
            }
            // Create button for submitting
            echo "<button type='submit' name='edittag' value=" . $_POST['edittag'] . ">Change Name</button>";
            echo "</form>";
        } else {
            // Exit if tag doesn't exist
            exit();
        }
        // Get educational material id from database
        $sql = "SELECT * FROM em_tagdb where tag_id =" . $_POST['edittag'];
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form for removing educational material tag relationship
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                // Get educational material information from database
                array_push($emList, $row['post_id']);
                $sql = "SELECT * FROM em_posts where post_id = ". $row['post_id'];
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)){
                        // Display educational material that has the selected tag
                        echo "<table><tr><th class='title'><input type='checkbox' name='em" . $rows['post_id'] . "'>Title</th><th class='udate'>Upload date</th></tr>";
                        echo "<tr><td class='title'>" . $rows['post_title'] . "</td><td class='udate'>" . $rows['post_date'] . "</td></tr>";
                        echo "</table>";
                    }
                }
            }
            // Create button for deleting tag from educational material
            echo "<br></br><button type='submit' name=edittag value='". $_POST['edittag'] . "D'>Delete tag from checked Educational Material</button>";
            echo "</form>";
        }
            // Create form for adding educational material tag relationship
            echo "<br></br><form method=post>";
                // Get educational material information from database
                $sql = "SELECT * FROM em_posts where post_id not in (";
                // Initialize boolean to know if at least one educational material has tag
                $boo = False;
                // Loop and add educational material that has tag to exlusion list
                foreach($emList as $em){
                    $sql = $sql . $em . ", ";
                    $boo = True;
                }
                // If commas were added remove last comma and close parentheses 
                if ($boo){
                    $sql = substr($sql, 0, strlen($sql)-2);
                    $sql = $sql . ")";
                }
                // Otherwise set sql statement to grab all posts
                else{
                    $sql = "SELECT * FROM em_posts";
                }
                // Run sql statement to gather posts that do not have the selected tag
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)){
                        // Display educational material that does not have the selected tag
                        echo "<table><tr><th class='title'><input type='checkbox' name='aem" . $rows['post_id'] . "'>Title</th><th class='udate'>Upload date</th></tr>";
                        echo "<tr><td class='title'>" . $rows['post_title'] . "</td><td class='udate'>" . $rows['post_date'] . "</td></tr>";
                        echo "</table>";
                    }
            // Create button for adding tag to educational material
            echo "<br></br><button type='submit' name=edittag value='". $_POST['edittag'] . "A'>Add tag to checked Educational Material</button>";
            echo "</form>";
        }
        // Create button for deleting tag
        echo "<form method=post><br></br><button type='submit' name=edittag value='". $_POST['edittag'] . "EE'>Delete tag</button><br></br>";
        echo "</form>";
        // close database connection
        mysqli_close($connection);
    // Else runs if a tag has not been set to be edited
    } else {
        // Get information about tags to create a list
        $sql = "SELECT * FROM tagdb";
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form to allow user to enter edit mode
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                // Create list as buttons to allow tag information to be transferred
                echo "<button type='submit' name='edittag' value=". $row['tag_id'] .">" . $row['tag_name'] . "</button>";
            }
            // Allow user to create tags
            echo "<br></br><br></br><input name='newtag' type='text' placeholder='tag Name'>";
            echo "<button type='submit' name='edittag' value='C'>Create tag</button>";
            echo "</form>";
        } else {
            // Allow user to create tag if no tags exist
            echo "<form>";
            echo "<br></br><br></br><input name='newtag'type='text' placeholder='tag Name'>";
            echo "<button type='submit' name='edittag' value='C'>Create tag</button>";
            echo "</form>";
        // close database connection
        mysqli_close($connection);
    }
}
// Include footer of webpage
include('layouts/footer.php'); 
?>

</html>