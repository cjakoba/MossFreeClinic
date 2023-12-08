<?php
    include('../api/surveyBackendAPI.php');
    // Include session and header of webpage
    include('layouts/header.php');
    include('layouts/navbar.php');
    // Establish database connection
    $servername = "localhost";
    $questionname = "homebasedb";
    $password = "homebasedb";
    $db = "homebasedb";
    $connection = mysqli_connect($servername, $questionname, $password, $db);
    // Set SQL to gather questions
    $sql = "SELECT * FROM questiondb ORDER BY question_priority";
    $result = mysqli_query($connection, $sql);
    // Check if user has submitted
    if (isset($_POST['submit'])){
        // Display thank you message
        echo "<h1>Thanks for completing the survey you may now leave this page</h1>";
        // Loop through questions
        while ($rows = mysqli_fetch_assoc($result)){
            // Check if question type is FRQ and guest has answered this question
        if (!strcmp($rows['question_type'], "FRQ") and isset($_POST['question' . $rows['question_id']]) and strlen($_POST['question' . $rows['question_id']]) > 0){
            // Submit guest answer
            freeResponse($_POST['question' . $rows['question_id']], $rows['question_id'], $_POST['submit'], $connection);
        }
            // Check if question type is choose one
        if (!strcmp($rows['question_type'], "Choose One")){
            // Check if answer for question has been selected and if so update database
            if (isset($_POST['answer' . $rows['question_id']])){
                answer($_POST['answer' . $rows['question_id']], $rows['question_id'] , $connection);
            }
        }
        // Check if question type is choose multiple
        if (!strcmp($rows['question_type'], "Choose Multiple")){
            // Set sql statment to get answers from database
            $sql = "SELECT * FROM answerdb WHERE questionID =" . $rows['question_id'] . " ORDER BY answer_priority";
            $results = mysqli_query($connection, $sql);
            $count = 0;
            // Loop through each possible answer
            while ($row = mysqli_fetch_assoc($results)){
                $count++;
                // If answer was set update database
                if (isset($_POST['answer'. $count])){
                    answer($_POST['answer' . $count], $rows['question_id'], $connection);
                }
            }
        }
        }
        // If user has not submitted display survey questions in a form so the user can answer
    }else{
        // Create survey and set survey equal to the new survey's id
    $survey = createSurvey($connection);
    echo "<form method=post>";
    while ($rows = mysqli_fetch_assoc($result)){
        // Print the question
        echo "<h1>" . $rows['question'] . "</h1>";
        // Check if question type is FRQ
        if (!strcmp($rows['question_type'], "FRQ")){
            // Allow user to answer
            echo "<input type=text name='question" . $rows['question_id'] . "'>";
        }
        // Check if question type is choose one
        if (!strcmp($rows['question_type'], "Choose One")){
            // Post question type to "question + questionid"
            echo "<input type=hidden value='Choose One' name='question" . $rows['question_id'] . "'>";
            // Set sql statement to grab answers from database
            $sql = "SELECT * FROM answerdb WHERE questionID =" . $rows['question_id'] . " ORDER BY answer_priority";
            $results = mysqli_query($connection, $sql);
            // While there is more answers print answer and allow user to select one
            while ($row = mysqli_fetch_assoc($results)){
                echo "<input type=radio value=" . $row['answerID'] . " name='answer" . $rows['question_id'] . "'>" . $row['answer'];
            }
        }
        // Check if question type is choose multiple
        if (!strcmp($rows['question_type'], "Choose Multiple")){
            // Set question + questionid as choose multiple
            echo "<input type=hidden value='Choose Multiple' name='question" . $rows['question_id'] . "'>";
            // Set SQL statement to get answers from database
            $sql = "SELECT * FROM answerdb WHERE questionID =" . $rows['question_id'] . " ORDER BY answer_priority";
            $results = mysqli_query($connection, $sql);
            $count = 0;
            // While there are more answers print answer and allow user to select as many as they want
            while ($row = mysqli_fetch_assoc($results)){
                $count++;
                echo "<input type=checkbox value=" . $row['answerID'] . " name='answer" . $count . "'>" . $row['answer'];
            }
        }
    }
    echo "<br></br><button type='submit' name=submit value=" . $survey . ">Submit</button>";
    echo "</form>";
}
// Include footer of webpage
include('layouts/footer.php'); 
?>