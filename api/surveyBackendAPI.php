<?php
function createSurvey($conn){
    $sql = "INSERT INTO surveydb (survey_date) VALUES('" . date("Y/m/d") . "')";
    mysqli_query($conn, $sql);
    $sql = "SELECT max(survey_id) as id FROM surveydb";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['id'];
}

function freeResponse($ans, $questionID, $surveyID, $conn){
    if (str_contains($ans, '"')){
        return;
    }
    $sql = 'INSERT INTO responsedb (answer, questionID, surveyID) VALUES("' . $ans . '", ' . $questionID . ', ' . $surveyID . ')';
    mysqli_query($conn, $sql);
    $sql = "UPDATE questiondb SET times_answered = times_answered+1 WHERE question_id = " . $questionID;
    mysqli_query($conn, $sql);
}

function answer($ansID, $questionID, $conn){
    $sql = "UPDATE answerdb SET times_answered = times_answered+1 WHERE answerID = " . $ansID;
    mysqli_query($conn, $sql);
    $sql = "UPDATE questiondb SET times_answered = times_answered+1 WHERE question_id = " . $questionID;
    mysqli_query($conn, $sql);
}
?>