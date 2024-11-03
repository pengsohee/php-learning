<?php

function uploadFile(array $upload){
    echo "<pre>";
    var_dump($upload);
    echo "</pre>";

     // limitations for file size (make sure our server does not run out of free space.)
    // risk: server hang or server blue screen.
    // ex: 8MB file
    $size = $upload['file']['size'];
    if($size > 8 * 1024 * 1024){
        die("error: file size must be lower than 8MB");
    } 
    // 1024 because 1 byte is 1024 bits (computer always use 2^x)
    // php by itself has it's own limitation for file size, can be found in php.ini file variable upload_max_filesize or post_max_size

    // validate file extension
    $extension = pathinfo($upload['file']['name'], PATHINFO_EXTENSION);
    // echo $extension;

    $allowedExtensions = [
        'jpg', 'jpeg', 'png'
    ];

    if(!in_array($extension, $allowedExtensions, true)){
        die("error file extension must be jpg, jpeg, and png");
    }

    // validate mime type
    $mime = mime_content_type($upload['file']['tmp_name']);
    echo $mime;

    $allowedMimeType = [
        'image/jpg', 'image/jpeg', 'image/png'
    ];
    if(!in_array($mime, $allowedMimeType, true)){
        die("Error: Content must be in a form of image");
    }

    $tmpName = $upload['file']['tmp_name']; 
    // ['file'] -> first index shown in the var_dump (can be checked from file-upload.php, input type and name which is file)
    // tmp_name -> array inside the 'file' array that stores the uploaded file

    move_uploaded_file($tmpName, './uploads/uploaded.jpg');
    // move uploaded file to our own server (in this example the folder uploads)
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    uploadFile($_FILES);
}