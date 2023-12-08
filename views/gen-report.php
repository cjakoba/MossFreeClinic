<html>
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
<?php
    // Include session and header of webpage
    include('layouts/header.php');
    include('layouts/navbar.php');
    // Establish database connection
    $servername = "localhost";
    $questionname = "homebasedb";
    $password = "homebasedb";
    $db = "homebasedb";
    $connection = mysqli_connect($servername, $questionname, $password, $db);
    // If a question has been set
    if (isset($_POST['question'])){
        // Get question
        $sql = "SELECT * FROM questiondb WHERE question_id = " . $_POST['question'];
        $result = mysqli_query($connection, $sql);
        while ($rows = mysqli_fetch_assoc($result)){
            // Print question and how many times it was answered
            echo "<h1>" . $rows['question'] . "</h1>";
            echo "<h1>This question was answered " . $rows['times_answered'] . " amount of times</h1>";
            // If question is of type FRQ
        if (!strcmp($rows['question_type'], "FRQ")){
            // Create table with columns user answer and date
            echo "<table><tr><th>User Answer</th><th>Date</th></tr>";
            // Get responses from database
            $sql = "SELECT * FROM responsedb WHERE questionID = " . $_POST['question'] . " ORDER BY surveyID DESC";
            $results = mysqli_query($connection, $sql);
            // While there is more responses
            while ($row = mysqli_fetch_assoc($results)){
                // Set SQL statement for getting date from database
                $sql = "SELECT * FROM surveydb WHERE survey_id = " . $row['surveyID'];
                $date = mysqli_query($connection, $sql);
                $dateRow = mysqli_fetch_assoc($date);
                // Print response and date response was given
                echo '<tr><td>' . $row['answer'] . '</td><td>' . $dateRow['survey_date'] . '</td></tr>';
            }
            echo "</table>";
        }
        // If question is of type choose one or choose multiple
        if (!strcmp($rows['question_type'], "Choose One") || !strcmp($rows['question_type'], "Choose Multiple")){
            // Set SQL statement for getting answers from database
            $sql = "SELECT * FROM answerdb WHERE questionID =" . $rows['question_id'] . " ORDER BY answer_priority";
            $results = mysqli_query($connection, $sql);
            // Create table with columns times answer was given and percent times answered
            echo "<table><tr><th>Answer</th><th>Times answer was given</th><th>Percent times answered</th></tr>";
            // While there are more answers
            while ($row = mysqli_fetch_assoc($results)){
                // To prevent divide by zero error if question has not been answered before
                if ($rows['times_answered'] ==0){
                    $percent = '0';
                }
                else{
                // Get percent times answered
                $percent = strval(100 * ($row['times_answered'] / $rows['times_answered']));
                if (strlen($percent) >= 3){
                    $percent = substr($percent, 0, 4);
                }
            }
            // Print answer, times answered, and percent answered
                echo "<tr><td>" . $row['answer'] . "</td><td>" . $row['times_answered'] . "</td><td>" . $percent . " %</td></tr>";
            }
            echo "</table>";
        }
        // Allow user to return to question list
            echo "<form method=post>";
            echo "<button type='submit' name='goback' value=1>Return to Question List</button><br></br>";
            echo "</form>";
        }
    }else{
        // Set SQL to get questions from database
    $sql = "SELECT * FROM questiondb ORDER BY question_priority";
    $result = mysqli_query($connection, $sql);
    // Create table with columns question and most popular answer
    echo "<form method=post>";
    echo "<table><tr><th>Question</th><th>Most Popular Answer</th></tr>";
    // While there are more questions
    while ($rows = mysqli_fetch_assoc($result)){
        // If question is of type FRQ
        if (!strcmp($rows['question_type'], "FRQ")){
            // Print just the question
            echo "<tr><td><button type=submit name='question' value=" . $rows['question_id'] . ">" . $rows['question'] . "</button><td></tr>";
        }
        // If question is of type choose one or choose multiple
        if (!strcmp($rows['question_type'], "Choose One") || !strcmp($rows['question_type'], "Choose Multiple")){
            // Set SQL statement for getting answers from database
            $sql = "SELECT * FROM answerdb WHERE questionID =" . $rows['question_id'] . " ORDER BY times_answered";
            $results = mysqli_query($connection, $sql);
            // If there is an answer print question and most popular answer
            if ($row = mysqli_fetch_assoc($results)){
                echo "<tr><td><button id='Choose" . $rows['question_id'] . "' type=submit name='question' value=" . $rows['question_id'] . ">" . $rows['question'] . "</button></td><td>";
                echo $row['answer'] . "</td></tr>";
            }
        }
    }
    echo "</table></form>";
}
// Include footer of webpage
include('layouts/footer.php'); 
?>