<?php
/* function which encodes an EM row as JSON */
function encode($name, $date, $author, $fileType, $description, $filePath){
    $data = new stdClass();
    $data->title = $name;
    $data->date = $date;
    $data->author = $author;
    $data->filetype = $fileType;
    $data->description = $description;
    $data->filepath = $filePath;
    echo json_encode($data);
}

/** function which queries emdb database with material ID number,
    returning EM unique to that ID,
    and finally calls function encode() which stores EM in JSON data structure
    **/
function getEM($materialid, $conn){
    $stmt = $conn->prepare("SELECT * FROM emdb WHERE materialid=?");
    $stmt->bind_param("i", $materialid);
    $results = $stmt->execute();
    while($row = $results->fetch_assoc()) {
        encode($row["name"], $row["upload_date"], $row["uploaded_by"], $row["file_type"], $row["description"], $row["upload_file_path"]);
    }
}

/**
 * Function for creating a tag takes in the name of the tag to create, and the connection to the database
 * Returns the id of the tag
 */
function createTag($tagName, $conn){
    $sql = "SELECT * from tagdb WHERE tag_name = '" . $tagName . "'";
    $results = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($results);
    while ($rows = mysqli_fetch_assoc($results)){
        return $rows['tag_id'];
    }
    $sql = "INSERT INTO tagdb (tag_name) VALUE ('" . $tagName . "')";
    mysqli_query($conn, $sql);
    $sql = "SELECT * from tagdb WHERE tag_name = '" . $tagName . "'";
    $results = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($results);
    return $rows['tag_id'];
}

/**
 * Function for creating a category takes in the name of the category to create, and the connection to the database
 * Returns the id of the category
 */
function createCategory($catName, $conn){
    $sql = "SELECT * from categorydb WHERE category_name = '" . $catName . "'";
    $results = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($results);
    while ($rows = mysqli_fetch_assoc($results)){
        return $rows['category_id'];
    }
    $sql = "INSERT INTO categorydb (category_name) VALUE ('" . $catName . "')";
    mysqli_query($conn, $sql);
    $sql = "SELECT * from categorydb WHERE category_name = '" . $catName . "'";
    $results = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($results);
    return $rows['category_id'];
}

/**
 * Function for adding a tag to educational material
 * takes in the id of the tag, the id of the educational material, and the connection to the database
 */
function addTagToEM($tagID, $emID, $conn){
    $sql = "INSERT INTO em_tagdb (tag_id, post_id) VALUE (" . $tagID . ", " . $emID .")";
    mysqli_query($conn, $sql);
}

/**
 * Function for adding a category to educational material
 * takes in the id of the category, the id of the educational material, and the connection to the database
 */
function addCatToEM($catID, $emID, $conn){
    $sql = "INSERT INTO em_categorydb (category_id, post_id) VALUE (" . $catID . ", " . $emID .")";
    mysqli_query($conn, $sql);
}

/**
 * Function for deleting a tag from educational material
 * takes in the id of the tag, the id of the educational material, and the connection to the database
 */
function removeTagFromEM($tagID, $emID, $conn){
    $sql = "DELETE FROM em_tagdb WHERE tag_id = " . $tagID . " AND post_id = ". $emID;
    mysqli_query($conn, $sql);
}

/**
 * Function for deleting a category from educational material
 * takes in the id of the category, the id of the educational material, and the connection to the database
 */
function removeCatFromEM($catID, $emID, $conn){
    $sql = "DELETE FROM em_categorydb WHERE category_id = " . $catID . " AND post_id = ". $emID;
    mysqli_query($conn, $sql);
}

/**
 * Function for deleting a tag
 * takes in the id of the tag, and the connection to the database
 */
function deleteTag($tagID, $conn){
    $sql = "DELETE FROM em_tagdb WHERE tag_id = " . $tagID;
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM tagdb WHERE tag_id = " . $tagID;
    mysqli_query($conn, $sql);
}

/**
 * Function for deleting a category
 * takes in the id of the category, and the connection to the database
 */
function deleteCategory($catID, $conn){
    $sql = "DELETE FROM em_categorydb WHERE category_id = " . $catID;
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM categorydb WHERE category_id = " . $catID;
    mysqli_query($conn, $sql);
}

/**
 * Function for editing a tag
 * takes in the id of the tag, the new name for the tag, and the connection to the database
 */
function editTag($tagID, $tagName, $conn){
    $sql = "UPDATE tagdb SET tag_name ='" . $tagName . "' WHERE tag_id =" . $tagID;
    mysqli_query($conn, $sql);
}

/**
 * Function for editing a category
 * takes in the id of the category, the new name for the category, and the connection to the database
 */
function editCategory($catID, $catName, $conn){
    $sql = "UPDATE categorydb SET category_name ='" . $catName . "' WHERE category_id =" . $catID;
    mysqli_query($conn, $sql);
}

/**
 * Function for creating a user takes in the username and password of the user to create, and the connection to the database
 * Returns the id of the category
 */
function createUser($name, $pass, $conn){
    $sql = "SELECT * from userdb WHERE username = '" . $name . "'";
    $results = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($results);
    if ($rows = mysqli_fetch_assoc($results)){
        return $rows['userid'];
    }
    $sql = "INSERT INTO userdb (username, password, user_type) VALUES ('" . $name . "', '" . $pass ."', 'Admin')";
    mysqli_query($conn, $sql);
    $sql = "SELECT * from userdb WHERE username = '" . $name . "'";
    $results = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($results);
    return $rows['userid'];
}

/**
 * Function for deleting a user
 * takes in the id of the user, and the connection to the database
 */
function deleteUser($userID, $conn){
    $sql = "DELETE FROM userdb WHERE userid = " . $userID;
    mysqli_query($conn, $sql);
}

/**
 * Function for editing a username
 * takes in the id of the user, the new username, and the connection to the database
 */
function editUserName($userID, $name, $conn){
    $sql = "UPDATE userdb SET username ='" . $name . "' WHERE userid =" . $userID;
    mysqli_query($conn, $sql);
}

/**
 * Function for editing a users password
 * takes in the id of the user, the new password, and the connection to the database
 */
function editUserPassword($userID, $userPass, $conn){
    $sql = "UPDATE userdb SET password ='" . $userPass . "' WHERE userid =" . $userID;
    mysqli_query($conn, $sql);
}

/**
 * Function for editing a users type
 * takes in the id of the user, the new type, and the connection to the database
 */
function editUserType($userID, $userType, $conn){
    $sql = "UPDATE userdb SET user_type ='" . $userType . "' WHERE userid =" . $userID;
    mysqli_query($conn, $sql);
}

/**
 * Function for checking a password for complexity
 * takes in the password to be checked
 * checks password and if it is accepted returns 0 if accepted
 * returns 1 if length error
 * returns 2 if no capital letters
 * returns 3 if no numbers
 */
function checkPassword($pass){
    if (strlen($pass)<7){
        return 1;
    }
    if (strtolower($pass) == $pass){
        return 2;
    }
    $i = 0;
    while($i <= 10){
        if (str_contains($pass, strval($i))){
            break;
        }
        else if ($i == 10){
            return 3;
        }
        $i++;
    }

}

/**
 * Function creates a question
 * takes in a string question type, string question, array of answers, and the connection to the db 
 * returns id of question
 */
function createQuestion($questionType, $question, $ans, $conn){
    $sql = "INSERT INTO questiondb (question, question_type) Values ('" . $question . "', '" . $questionType . "')";
    mysqli_query($conn, $sql);
    $sql = "SELECT * FROM questiondb WHERE question = '". $question . "'";
    $results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($results);
    if (strcmp($questionType, "FRQ")){
        $numAnswers = 0;
        foreach ($ans as $answer){
            if (strlen($answer) > 0){
                $numAnswers++;
                $sql = "INSERT INTO answerdb (times_answered, answer_priority, questionID, answer)
                VALUES (0, 0, " . $row['question_id'] . ", '" . $answer . "')";
                mysqli_query($conn, $sql);
            }
        }
        $sql = "UPDATE questiondb SET 
        numAnswers = " . $numAnswers . ", question_type ='" . $questionType . "', question_priority = 0, times_answered = 0
        WHERE question_id = " . $row['question_id'];
        mysqli_query($conn, $sql);
    }
    else{
        $sql = "UPDATE questiondb SET 
        numAnswers = 1, question_type ='FRQ', question_priority = 0, times_answered = 0
        WHERE question_id = " . $row['question_id'];
        mysqli_query($conn, $sql);
    }
    return $row['question_id'];
}

/**
 * Function edits a question
 * takes in an int questionid, a string question, and the connection to the db 
 */
function editQuestion($questionID, $question, $conn){
        $sql = "UPDATE questiondb SET question = '" . $question . "' WHERE question_id = " . $questionID;
        mysqli_query($conn, $sql);
}

/**
 * Function edits a question
 * takes in an int questionid, a string question, and the connection to the db 
 */
function editQuestionPriority($questionID, $priority, $conn){
    $sql = "UPDATE questiondb SET question_priority = " . $priority . " WHERE question_id = " . $questionID;
    mysqli_query($conn, $sql);
}

/**
 * Function deletes a question
 * takes in an int questionid, and the connection to the db 
 */
function deleteQuestion($questionID, $conn){
    $sql = "DELETE FROM answerdb WHERE questionID =" . $questionID;
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM responsedb WHERE questionID =" . $questionID;
    mysqli_query($conn, $sql); 
    $sql = "DELETE FROM questiondb WHERE question_id =" . $questionID;
    mysqli_query($conn, $sql);
}

/**
 * Function edits an answer
 * takes in an int answerid, a string answer, and the connection to the db 
 */
function editAnswer($answerID, $answer, $conn){
    $sql = "UPDATE answerdb SET answer = '" . $answer . "' WHERE answerID = " . $answerID;
    mysqli_query($conn, $sql);
}

/**
* Function edits an answers priority
* takes in an int answerid, an int priority, and the connection to the db 
*/
function editAnswerPriority($answerID, $priority, $conn){
$sql = "UPDATE answerdb SET answer_priority = " . $priority . " WHERE answerID = " . $answerID;
mysqli_query($conn, $sql);
}
?>