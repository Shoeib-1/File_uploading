<?php
 session_start();
 define("IMAGES_PATH","upload");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php

if (isset($_FILES['file'])){

    $errors = array();
    $extensions = array("png","jpeg","jpg");
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $file_extension = strtolower(end(explode('.',$file_name)));


    if (in_array($file_extension,$extensions) === false){
        $errors[] = "File type is not allowed!";
    }

    if ($file_size > 297152){
        $errors[] = "File size is not allowed!";
    }


    if (empty($errors)){
        move_uploaded_file($file_tmp,IMAGES_PATH."/".$file_name);
    }else{
        foreach ($errors as $error){
            echo $error."<br>";
        }
    }

}

?>

<form action="" method="post" enctype="multipart/form-data" autocomplete="on" accept-charset="UTF-8">

    <!-- <input type="file" name="file" accept="image/*">
    <br>
    <input type="submit" name="submit" value="Upload Profile"> -->


    <h2><?php echo  $_SESSION["firstname"] ." ". $_SESSION["lastname"]?></h2>
    <img src="upload/<?php echo $_SESSION["file"]?>" alt="">

</form>
</body>
</html>