<?php
if (file_exists($_FILES['userImage']['tmp_name']) || is_uploaded_file($_FILES['userImage']['tmp_name'])) {
    $check = getimagesize($_FILES["userImage"]["tmp_name"]);
    $imageFileType = pathinfo($_FILES["userImage"]["tmp_name"], PATHINFO_EXTENSION);
    if ($check !== false) {
    //   echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
    //   echo 'Problem';
      $uploadOk = 0;
    }
    $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);

    // Check file size
    if ($_FILES["userImage"]["size"] > 500000) {
         header('Location: ../register.php?registererr=4');
        $uploadOk = 0;
    }
    // run the statement
    if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        // file type not supported error
        header('Location: ../register.php?registererr=5');
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
}
 ?>
