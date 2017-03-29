<?php
include("DB.php");
if(!isset($_SESSION))
{
    session_start();
}

$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");

if ( isset($_POST["username"])
    && isset($_POST["email"])
    && isset($_POST["password"]) ) {
    $sql = "SELECT username, email
            FROM User
            WHERE username = ? OR email = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $_POST["username"], $_POST["email"]);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        if ($row !== null) {
            if (in_array($_POST["email"], $row) && in_array($_POST["username"], $row)) {
                // email and username exist error
                header('Location: ../register.php?inputerr=1');
            } elseif (in_array($_POST["username"], $row)) {
                // username exists error
                header('Location: ../register.php?inputerr=2');
            } elseif (in_array($_POST["email"], $row)) {
                // email exists error
                header('Location: ../register.php?inputerr=3');
            }
        } else {
            if (file_exists($_FILES['userImage']['tmp_name']) || is_uploaded_file($_FILES['userImage']['tmp_name'])) {
                $check = getimagesize($_FILES["userImage"]["tmp_name"]);
                $imageFileType = pathinfo($_FILES["userImage"]["tmp_name"], PATHINFO_EXTENSION);
                if($check !== false) {
                //   echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
                } else {
                //   echo 'Problem';
                  $uploadOk = 0;
                }
                $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);

                // Check file size
                if ($_FILES["userImage"]["size"] > 500000) {
                     header('Location: ../register.php?inputerr=4');
                    $uploadOk = 0;
                }
                // run the statement
                if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    // file type not supported error
                    header('Location: ../register.php?inputerr=5');
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    header('Location: ../register.php?inputerr=6');
                // if everything is ok, try to upload file
                }
            }

            mysqli_free_result($result);
            $newsql = "INSERT into User(username, email, password) values (?, ?, ?);";
            $stmt = $conn->prepare($newsql);
            $pass = md5($_POST["password"]);
            $stmt->bind_param('sss', $_POST["username"], $_POST["email"], $pass);
            $stmt->execute();

            mysqli_stmt_close($stmt);

            // get the last user id
            $getidsql = "select max(userid) from User;";
            $stmt = $conn->prepare($getidsql);
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->fetch();
            $userid = $id;
            // echo $id;
            mysqli_stmt_close($stmt);
            $_SESSION['forumuser'] = $_POST["username"];
            if (isset($_FILES["userImage"])) {
                // prepare the user image for upload
                $target_dir = "../userimages/";
                $target_file = $target_dir . basename($_FILES["userImage"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                $target_file = $target_dir . $id . '.' . $imageFileType;
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["userImage"]["tmp_name"]);
                    if($check !== false) {
                    //   echo "File is an image - " . $check["mime"] . ".";
                      $uploadOk = 1;
                    } else {
                    //   echo 'Problem';
                      $uploadOk = 0;
                    }
                }

                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
                        header("Location: ../index.php");
                    } else {
                        // misc error with file upload
                    }
                }
            }
            header("Location: ../index.php");
        }
    } else {
        echo 'There was a problem with the entered data.';
    }
}
mysqli_close($conn);
?>

<!--
$imageData = file_get_contents($_FILES['userImage']['tmp_name']);
      //store the contents of the files in memory in preparation for upload
      $sql = "INSERT INTO userImages (userid, contentType, image) VALUES(?,?,?)";

      $pdo->prepare($sql)->execute([$userid,$imageFileType,$imageData]);
  -->
