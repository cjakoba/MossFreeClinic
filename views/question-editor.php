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
    <h1>Edit question</h1>
    <?php
    // Import and establish database connection
    //include_once('database/dbinfo.php');
    $servername = "localhost";
    $questionname = "homebasedb";
    $password = "homebasedb";
    $db = "homebasedb";
    $connection = mysqli_connect($servername, $questionname, $password, $db);
    // Check if new question should be created
    if (isset($_POST['createquestion'])){
        // Ask user for type of question they want created
        echo "<form method=post>";
        echo "<input type= 'radio' checked name='questiontype' value='FRQ'>Free Response<br></br>";
        echo "<input type='radio' name='questiontype' value='Choose One'>Choose one<br></br>";
        echo "<input type='radio' name='questiontype' value='Choose Multiple'>Select all that apply<br></br>";
        echo "<button type='submit' >Submit</button><br></br>";
        echo "</form>";
        echo "<form method=post>";
        echo "<button type='submit' name='goback' value=1>Return to Question List</button><br></br>";
        echo "</form>";
    }
    // Check if question type has been set
    if (isset($_POST['questiontype'])){
        // Check if number of answers has been set and that the first answer has not been set
        if (isset($_POST['numAnswers']) and !isset($_POST['answer0'])){
            // Ask user for question
            echo "<form method=post>";
            echo "<input type='text' name='createnewquestion' placeholder='Question'><br></br>";
            // Loop to ask user for each answer
            for ($i=0; $i < $_POST['numAnswers']; $i++){
                echo "<input type='text' name='answer" . $i . "' placeholder='Answer'><br></br>";
            }
            // Create buttons to submit, return to question type selection, and return to question list 
            echo "<button type='submit' name=questiontype value='" . $_POST['questiontype'] . "'>Submit</button><br></br>";
            echo "<button type='submit' name='createquestion' value=1>Return to Question Type Selection</button><br></br>";
            echo "<button type='submit' name='goback' value=1>Return to Question List</button><br></br>";
            echo "</form>";
        }
        // Check if the first answer has been set
        else if (isset($_POST['answer0'])){
            $i = 0;
            $array = array();
            while(isset($_POST['answer' . $i])){
                // Create an array with the answers the user gave
                $array[$i] = $_POST['answer' . $i];
                $i++;
            }
            // Create question and set edit question to new question
            $_POST['editquestion'] = createQuestion($_POST['questiontype'], $_POST['createnewquestion'], $array, $connection);
        }
        // Check if question type is FRQ and createnewquestion is set
        else if (!strcmp($_POST['questiontype'], "FRQ") and !isset($_POST['createnewquestion'])){
            echo "<form method=post>";
            echo "<input type='text' name='createnewquestion' placeholder='Question'><br></br>";
            echo "<button type='submit' name=questiontype value='" . $_POST['questiontype'] . "'>Submit</button><br></br>";
            echo "<button type='submit' name='createquestion' value=1>Return to Question Type Selection</button><br></br>";
            echo "<button type='submit' name='goback' value=1>Return to Question List</button><br></br>";
            echo "</form>";
        }
        // Check if question type is FRQ and createnewquestion is set
        else if (!strcmp($_POST['questiontype'], "FRQ") and isset($_POST['createnewquestion'])){
            // Create question and set editquestion to new question
            $_POST['editquestion'] = createQuestion($_POST['questiontype'], $_POST['createnewquestion'], array(), $connection);
        }
        // Check if question type is Choose one or Choose multiple
        else if (!strcmp($_POST['questiontype'], "Choose One") or !strcmp($_POST['questiontype'], "Choose Multiple")){
            echo "<form method=post>";
            echo "<label for='numAnswers'>Number of Answers (2-20):</label>";
            echo "<input type='number' id='numAnswers' name='numAnswers' min='2' max='20'><br></br>";
            echo "<button type='submit' name=questiontype value='" . $_POST['questiontype'] . "'>Submit</button><br></br>";
            echo "<button type='submit' name='createquestion' value=1>Return to Question Type Selection</button><br></br>";
            echo "<button type='submit' name='goback' value=1>Return to Question List</button><br></br>";
            echo "</form>";
        }
    }

    // Check if question to edit has been selected and if the question needs to be removed
    if (isset($_POST['editquestion']) and strcmp(substr($_POST['editquestion'], -1), 'E') == 0){
        // Remove erase key
        $_POST['editquestion'] = substr($_POST['editquestion'], 0, -1);
        // Check if second delete button was pressed if not display secondary delete button
        if (strcmp(substr($_POST['editquestion'], -1), 'E') == 0){
            echo "<form method=post><br></br><button type='submit' name=editquestion value='". $_POST['editquestion'] . "'>Click Here to Permantly Delete question</button><br></br>";
        }
        // Delete question if secondary delete button was pressed
        else{
            // Run delete from em_questiondb
            deleteQuestion($_POST['editquestion'], $connection);
            // Unset question to edit
            unset($_POST['editquestion']);
        }
    }
    // Check if question to edit has been selected and if the question needs to update question
    if (isset($_POST['editquestion']) and isset($_POST['newquestion'])){
        if (strlen($_POST['newquestion'] < 1)){
            unset($_POST['newquestion']);
        }
        else{
        // Run sql statement to update question
        editQuestion($_POST['editquestion'], $_POST['newquestion'], $connection);
        }
}
// Check if question to edit has been selected and if the question needs to update priority
if (isset($_POST['editquestion']) and isset($_POST['newpriority'])){
    if (strlen($_POST['newpriority']) < 1){
        unset($_POST['newpriority']);
    }
    else{
    // Run sql statement to update question prioriy
    editQuestionPriority($_POST['editquestion'], $_POST['newpriority'], $connection);
    }
}
    // Check if the question to be edited has been set and if so enter edit mode
    if(isset($_POST['editquestion'])){
        if (strcmp(substr($_POST['editquestion'], -1), 'E') == 0){
            $_POST['editquestion'] = substr($_POST['editquestion'], 0, -1);
        }
            // Allow user to return to question list
            echo "<form method=post><button name='return' type='submit'>Go back to list</button></form><br><br>";
        // Get question from database
        $sql = "SELECT * FROM questiondb where question_id =" . $_POST['editquestion'] . " ORDER BY question_priority";
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form for changing question
            echo "<form method=post>";
            $row = mysqli_fetch_assoc($results);
                echo "<input type='text' name='newquestion' placeholder='" . $row['question'] . "'>";
                echo "<input type='number' name='newpriority' placeholder='" . $row['question_priority'] . "'><br></br>";
                if (isset($_POST['newpriority'])){
                    editQuestionPriority($_POST['editquestion'], $_POST['newpriority'], $connection);
                }
                if (strcmp($row['question_type'], "FRQ")){
                    $sql = "SELECT * from answerdb WHERE questionid =" . $_POST['editquestion'] . " ORDER BY answer_priority";
                    $result = mysqli_query($connection, $sql);
                    while ($rows = mysqli_fetch_assoc($result)){
                        if (isset($_POST['newanswer' . $rows['answerID']]) and strlen($_POST['newanswer' . $rows['answerID']]) > 0){
                            editAnswer($rows['answerID'], $_POST['newanswer' . $rows['answerID']], $connection);
                        }
                        
                        if (isset($_POST['newapriority' . $rows['answerID']]) and strlen($_POST['newapriority' . $rows['answerID']]) > 0){
                            editAnswerPriority($rows['answerID'], $_POST['newapriority' . $rows['answerID']], $connection);
                        }
                    }
                    $sql = "SELECT * from answerdb WHERE questionid =" . $_POST['editquestion'] . " ORDER BY answer_priority";
                    $result = mysqli_query($connection, $sql);
                    while ($rows = mysqli_fetch_assoc($result)){
                        echo "<input type='text' name='newanswer" . $rows['answerID'] . "' placeholder='" . $rows['answer'] . "'>";
                        echo "<input type='number' name='newapriority" . $rows['answerID'] . "' placeholder='" . $rows['answer_priority'] . "'>";
                    }
            }
            // Create button for submitting
            echo "<br></br><button type='submit' name=editquestion value='". $_POST['editquestion'] . "'>Submit Changes</button><br></br>";
            echo "</form>";
            // Create button for deleting question
        echo "<form method=post>";
        echo "<br></br><button type='submit' name=editquestion value='". $_POST['editquestion'] . "EE'>Delete question</button><br></br>";
        echo "</form>";
        } else {
            // Exit if question doesn't exist
            exit();
        }
    }
    else if (!isset($_POST['createquestion']) and !isset($_POST['questiontype'])){
        // Get information about questions to create a list
        $sql = "SELECT * FROM questiondb ORDER BY question_priority";
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
            // Create form to allow question to enter edit mode
            echo "<form method=post>";
            while ($row = mysqli_fetch_assoc($results)){
                // Create list as buttons to allow question information to be transferred
                echo "<button type='submit' name='editquestion' value=". $row['question_id'] .">" . $row['question'] . "</button>";
            }
            // Allow question to create questions
            echo "<br></br><button type='submit' name='createquestion' value='C'>Create question</button>";
            echo "</form>";
        } else {
            // Allow question to create question if no questions exist
            echo "<form method=post>";
            echo "<button type='submit' name='createquestion' value='C'>Create question</button>";
            echo "</form>";
    }
}
// close database connection
mysqli_close($connection);
// Include footer of webpage
include('layouts/footer.php'); 
?>

</html>