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
?>