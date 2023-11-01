<?php
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

function getEM($materialid, $conn){
    $stmt = $conn->prepare("SELECT * FROM emdb WHERE materialid=?");
    $stmt->bind_param("i", $materialid)
    $results = $stmt->execute();
    while($row = $results->fetch_assoc()) {
        encode($row["name"], $row["upload_date"], $row["uploaded_by"], $row["file_type"], $row["description"], $row["upload_file_path"])
    }



}





?>