<?php
    $target_dir = "images/profpics/".$_POST['email']."/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image

    if(!empty($_POST)) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            //echo "Uw account is aangemaakt!";
            $uploadOk = 1;
        } else {
            throw new Exception("File is not an image.");
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        throw new Exception("Sorry, file already exists.");
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        throw new Exception("Sorry, your file is too large.");
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        throw new Exception("Sorry, your file was not uploaded.");
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        } else {
            throw new Exception("Sorry, there was an error uploading your file.");
        }
    }
?>