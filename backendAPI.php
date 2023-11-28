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
?>