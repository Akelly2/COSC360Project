<?php
// THIS DOES NOT WORK
if (!isset($_SESSION)) {
    session_start();
}
echo $_SESSION['userid'];
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
         header('Location: ../register.php?editerr=4');
        $uploadOk = 0;
    }
    // run the statement
    if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        // file type not supported error
        header('Location: ../register.php?editerr=5');
        $uploadOk = 0;
    // Check if $uploadOk is set to 0 by an error
    }
    if (isset($_FILES["userImage"])) {

        // prepare the user image for upload
        $target_dir = "../userimages/";
        $target_file = $target_dir . basename($_FILES["userImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $target_file = $target_dir . $_SESSION['userid'] . '.' . $imageFileType;
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["userImage"]["tmp_name"]);
            if($check !== false) {
            //   echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
            //   echo 'Problem';
              $uploadOk = 0;
              header('Location: ../register.php?editerr=6');
            }
        }
        echo 5;
        if ($uploadOk == 1) {
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $target_file = $target_dir . $id . '.' . $imageFileType;
            if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
                header("Location: ../index.php");
            } else {
                // misc error with file upload
            }
        }
    }
}
 ?>
