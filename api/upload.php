<?php

// Check for file upload
if (isset($_FILES['image'])) {
  // Validate file type
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($_FILES['image']['type'], $allowedTypes)) {
    echo 'Invalid file type';
    exit;
  }

  // Generate unique filename
  $filename = md5(time() . $_FILES['image']['name']) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

  // create uploads directory if it doesn't already exist
  if (! is_dir("../uploads/")) {
      mkdir("../uploads/");

  }

  // Upload file
  if (move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $filename)) {
    // Upload successful, generate image URL
    $imageUrl = 'http://localhost/uploads/' . $filename;

    // Prepare response data
    $responseData = [
      'success' => 1,
      'file' => [
        'url' => $imageUrl
      ]
    ];

    // Encode response data to JSON
    echo json_encode($responseData);
  } else {
    echo 'Upload failed';
  }
} else {
  echo 'No file uploaded';
}