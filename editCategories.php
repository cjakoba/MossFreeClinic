<?php

// Include session and header of webpage
    include('session.php');
    include('layouts/header.php');
    include('layouts/navbar.php');
    include('backendAPI.php');
    include_once('../classes/dbh.classes.php');
        
    // Check if the user has the necessary permissions
    if (!isset($_SESSION['permissions']) || $_SESSION['permissions'] < 3) {
        die("You do not have permission to access this page.");
    }
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
    <h1>Edit category</h1>
    <?php
    // Import and establish database connection
    include_once('database/dbinfo.php');
    $connection = connect();
    // Check if new category should be created
    if (isset($_POST['editcategory']) and strcmp($_POST['editcategory'], 'C') == 0 and strlen($_POST['newcategory']) > 0){
        // Run sql statement to add new category with name given by user and set category to edit to be new category
        $_POST['editcategory'] = createcategory($_POST['newcategory'], $connection);
    }
    // Check if category to edit has been selected and if the category needs to be removed
    if (isset($_POST['editcategory']) and strcmp(substr($_POST['editcategory'], -1), 'E') == 0){
        // Remove erase key
        $_POST['editcategory'] = substr($_POST['editcategory'], 0, -1);
        // Check if second delete button was pressed if not display secondary delete button
        if (strcmp(substr($_POST['editcategory'], -1), 'E') == 0){
            echo "<form method=post><br></br><button type='submit' name=editcategory value='". $_POST['editcategory'] . "'>Click Here to Permantly Delete category</button><br></br>";
        }
        // Delete category if secondary delete button was pressed
        else{
            // Run delete from em_categorydb
            deletecategory($_POST['editcategory'], $connection);
            // Unset category to edit
            unset($_POST['editcategory']);
        }
    }
    // Check if category to edit has been selected and if the category needs to be added to educational material
    if (isset($_POST['editcategory']) and strcmp(substr($_POST['editcategory'], -1), 'A') == 0){
        // Remove ADD key
        $_POST['editcategory'] = substr($_POST['editcategory'], 0, -1);
        // Run sql statement to get all educational material
        $sql = "SELECT * FROM em_posts";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)){
                // Check if the educational material and category needs to be added to em_categorydb
                if (isset($_POST['aem' . $rows['post_id']])){
                    // Add junction to database
                    addCatToEM($_POST['editcategory'], $rows['post_id'], $connection);
                }
            }
    }
}
    // Check if category to edit has been selected and if the category needs to be removed from educational material
    if (isset($_POST['editcategory']) and strcmp(substr($_POST['editcategory'], -1), 'D') == 0){
        // Remove delete key
        $_POST['editcategory'] = substr($_POST['editcategory'], 0, -1);
        // Get educational material id from database
        $sql = "SELECT * FROM em_categorydb where category_id =" . $_POST['editcategory'];
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
                        removeCatFromEM($_POST['editcategory'], $rows['post_id'], $connection);
                    }
                }
            }
        }
    }
}
    // Check if the category to be edited has been set and if so enter edit mode
    if(isset($_POST['editcategory'])){
        $emList = array();
        if (strcmp(substr($_POST['editcategory'], -1), 'E') == 0){
            $_POST['editcategory'] = substr($_POST['editcategory'], 0, -1);
        }
            // Allow user to return to category list
            echo "<form method=post><button name='return' type='submit'>Go back to list</button></form><br><br>";
        // Check if the category name needs to be changed
        if(isset($_POST['categoryName']) and strlen($_POST['categoryName']) > 0){
            // Update database to use new name for category
            editcategory($_POST['editcategory'], $_POST['categoryName'], $connection);
        }
        // Get name of category from database
        $sql = "SELECT * FROM categorydb where category_id =" . $_POST['editcategory'];
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form for changing category name
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                echo "<input type='text' name='categoryName' placeholder='" . $row['category_name'] . "'>";
            }
            // Create button for submitting
            echo "<button type='submit' name='editcategory' value=" . $_POST['editcategory'] . ">Change Name</button>";
            echo "</form>";
        } else {
            // Exit if category doesn't exist
            exit();
        }
        // Get educational material id from database
        $sql = "SELECT * FROM em_categorydb where category_id =" . $_POST['editcategory'];
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form for removing educational material category relationship
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                // Get educational material information from database
                array_push($emList, $row['post_id']);
                $sql = "SELECT * FROM em_posts where post_id = ". $row['post_id'];
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)){
                        // Display educational material that has the selected category
                        echo "<table><tr><th class='title'><input type='checkbox' name='em" . $rows['post_id'] . "'>Title</th><th class='udate'>Upload date</th></tr>";
                        echo "<tr><td class='title'>" . $rows['post_title'] . "</td><td class='udate'>" . $rows['post_date'] . "</td></tr>";
                        echo "</table>";
                    }
                }
            }
            // Create button for deleting category from educational material
            echo "<br></br><button type='submit' name=editcategory value='". $_POST['editcategory'] . "D'>Delete category from checked Educational Material</button>";
            echo "</form>";
        }
            // Create form for adding educational material category relationship
            echo "<br></br><form method=post>";
                // Get educational material information from database
                $sql = "SELECT * FROM em_posts where post_id not in (";
                // Initialize boolean to know if at least one educational material has category
                $boo = False;
                // Loop and add educational material that has category to exlusion list
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
                // Run sql statement to gather posts that do not have the selected category
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)){
                        // Display educational material that does not have the selected category
                        echo "<table><tr><th class='title'><input type='checkbox' name='aem" . $rows['post_id'] . "'>Title</th><th class='udate'>Upload date</th></tr>";
                        echo "<tr><td class='title'>" . $rows['post_title'] . "</td><td class='udate'>" . $rows['post_date'] . "</td></tr>";
                        echo "</table>";
                    }
            // Create button for adding category to educational material
            echo "<br></br><button type='submit' name=editcategory value='". $_POST['editcategory'] . "A'>Add category to checked Educational Material</button>";
            echo "</form>";
        }
        // Create button for deleting category
        echo "<form method=post><br></br><button type='submit' name=editcategory value='". $_POST['editcategory'] . "EE'>Delete category</button><br></br>";
        echo "</form>";
        // close database connection
        mysqli_close($connection);
    // Else runs if a category has not been set to be edited
    } else {
        // Get information about categories to create a list
        $sql = "SELECT * FROM categorydb";
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form to allow user to enter edit mode
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                // Create list as buttons to allow category information to be transferred
                echo "<button type='submit' name='editcategory' value=". $row['category_id'] .">" . $row['category_name'] . "</button>";
            }
            // Allow user to create categories
            echo "<br></br><br></br><input name='newcategory' type='text' placeholder='category Name'>";
            echo "<button type='submit' name='editcategory' value='C'>Create category</button>";
            echo "</form>";
        } else {
            // Allow user to create category if no categories exist
            echo "<form>";
            echo "<br></br><br></br><input name='newcategory'type='text' placeholder='category Name'>";
            echo "<button type='submit' name='editcategory' value='C'>Create category</button>";
            echo "</form>";
        // close database connection
        mysqli_close($connection);
    }
}
// Include footer of webpage
include('layouts/footer.php'); 
?>

</html>